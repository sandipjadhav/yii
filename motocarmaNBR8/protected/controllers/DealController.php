<?php

class DealController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','Selectdealer'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{ 
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function actionSelectdealer()
	{
            $dealers = Dealership::model()->findAll();
            
            $this->render('selectdealer',array('dealers'=>$dealers));
	}
        
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Deal;
                Yii::app()->clientScript->registerCoreScript('jquery'); 
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
		if(isset($_POST['Deal']))
		{       
                    $submitData = $_POST['Deal'];
                    
                    $offerExists = $this->isOfferExistsWithDealer(Yii::app()->user->Id, $submitData['Dealership_ID']);
                    if($offerExists === FALSE){
                        if($submitData['Car_ID'] == ''){
                            $arrCarInfo = $this->getCarDetailsForPreviewPage();
                            $car=new Car;
                            $car->Make = $arrCarInfo['Make'];
                            $car->Price = $arrCarInfo['Price'];
                            $car->Model = $arrCarInfo['Model'];
                            $car->StyleID = $arrCarInfo['StyleID'];
                            $car->Year = $arrCarInfo['Year'];
                            $car->ID = NULL;

                            if($car->save()){
                                $submitData['Car_ID'] = $car->ID;
                                $submitData['ID'] = NULL;
                                $model->attributes=$submitData;
                            }
                        }else{
                            $model->attributes=$_POST['Deal'];
                        }
                        if($model->save()){

                            $salesperson = SalesPerson::model()->findByPk($model->SalesPerson_ID);
                            $user = User::model()->findByPk(Yii::app()->user->Id);

                            Yii::import('application.modules.message.models.*');
                            $message = new Message;
                            $message->sender_id = Yii::app()->user->Id; 
                            $message->receiver_id = $salesperson->User_ID; 
                            $message->subject = 'New Offer Notification';
                            $body =     'Dear, '.$salesperson->Name;
                            $body .=    '<br/> Offer Details:';
                            $body .=    "Customer: ".$user->username."<br/>";
                            $body .=    "Make: ".$arrCarInfo['Make']."<br/>";
                            $body .=    "Model: ".$arrCarInfo['Model']."<br/>";
                            $body .=    "Price: ".$arrCarInfo['Price']."<br/>";
                            $body .=    "Year: ".$arrCarInfo['Year']."<br/>";
                            $message->body = $body; 
                            $message->created_at = date("Y-m-d h:i:s"); 
                            $message->save();

                            $dealStatus = DealStatus::model()->findByPk($model->DealStatus_ID);


                            $DealHistory = new DealHistory;
                            $DealHistory->Car_ID = $model->Car_ID;
                            $DealHistory->Deal_ID = $model->ID;
                            $DealHistory->DealStatus_ID = $model->DealStatus_ID;
                            $DealHistory->DealStatus  = $dealStatus->DealStatus;
                            $DealHistory->Make = $arrCarInfo['Make'];
                            $DealHistory->Model = $arrCarInfo['Model'];
                            $DealHistory->Price = $arrCarInfo['Price'];
                            $DealHistory->SalesPersonUserName = $salesperson->Name;
                            $DealHistory->SalesPerson_ID = $model->SalesPerson_ID;
                            $DealHistory->StyleID = $arrCarInfo['StyleID'];
                            $DealHistory->UserName =  $user->username;
                            $DealHistory->User_ID = Yii::app()->user->Id;
                            $DealHistory->Year = $arrCarInfo['Year'];

                            $DealHistory->save();
                            Yii::app()->user->setState("guest_style",'');
                            $this->redirect(array('site/UserHome','message'=>'dealSuccess'));
                        }
                    }else{
                        Yii::app()->user->setFlash('error', "You have already made an offer to the dealer selected. Please select another dealer.");
                    }
		}
                
                $arrCarInfo = $this->getCarDetailsForPreviewPage();
                
                $roles = Rights::getAssignedRoles(Yii::app()->user->Id);
                $model->DealStatus_ID = 3;
                $model->User_ID = Yii::app()->user->Id;
                $model->DateAdded = $model->LastModified = date("Y-m-d h:i:s");
                $this->render('create',array(
                        'model'=>$model,'currentRole'=>strtolower(current($roles)->name),
                        'arrCarInfo'=>$arrCarInfo
                ));
                
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
		if(isset($_POST['Deal']))
		{
			$model->attributes=$_POST['Deal'];
			if($model->save()){
                                if(isset($_POST['Deal']['Update_Purpose']) 
                                    && $_POST['Deal']['Update_Purpose']=='process'
                                    && !in_array($model->DealStatus_ID, array(3,4))){
                                
                                $dealStatus = DealStatus::model()->findByPk($model->DealStatus_ID);
                                
                                $salesperson = SalesPerson::model()->findByPk($model->SalesPerson_ID);
                                
                                $customer = User::model()->findByPk($model->User_ID);
                                
                                $user = User::model()->findByPk(Yii::app()->user->Id);
                                
                                $car = Car::model()->findByPk($model->Car_ID);
                                
                                Yii::import('application.modules.message.models.*');
                                $message = new Message;
                                $message->sender_id = Yii::app()->user->Id; 
                                $message->receiver_id = $model->User_ID; 
                                $message->subject = 'Motocarma Offer Notification - Offer '.$dealStatus->DealStatus;
                                $body =     "Dear ".$customer->username.",";
                                $body .=    "\n Your offer with status mentioned below is ".$dealStatus->DealStatus;
                                $body .=    "\n Offer Details:";
                                $body .=    "Customer: ".$user->username."\n ";
                                $body .=    "Make: ".$car->Make."\n ";
                                $body .=    "Model: ".$car->Model."\n ";
                                $body .=    "Price: ".$model->Price."\n ";
                                $body .=    "Year: ".$car->Year."\n ";
                                $message->body = $body; 
                                $message->created_at = date("Y-m-d h:i:s"); 
                                $message->save();
                                
                                
                                $DealHistory = new DealHistory;
                                $DealHistory->Car_ID = $model->Car_ID;
                                $DealHistory->Deal_ID = $model->ID;
                                $DealHistory->DealStatus_ID = $model->DealStatus_ID;
                                $DealHistory->DealStatus  = $dealStatus->DealStatus;
                                $DealHistory->Make = $car->Make;
                                $DealHistory->Model = $car->Model;
                                $DealHistory->Price = $model->Price;
                                $DealHistory->SalesPersonUserName = $salesperson->Name;
                                $DealHistory->SalesPerson_ID = $model->SalesPerson_ID;
                                $DealHistory->StyleID = $car->StyleID;
                                $DealHistory->UserName =  $user->username;
                                $DealHistory->User_ID = Yii::app()->user->Id;
                                $DealHistory->Year = $car->Year;

                                $DealHistory->save();
                                
                            }
                            $this->redirect(array('view','id'=>$model->ID));
                        }
		}
                
                $roles = Rights::getAssignedRoles(Yii::app()->user->Id);
                $role = current($roles);
		$this->render('update',array(
			'model'=>$model,'currentRole'=>strtolower($role->name)
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{ 
            $roles = Rights::getAssignedRoles(Yii::app()->user->Id); 
            $criteria = array();
            if (count($roles) === 1) { 
                $role = current($roles);
                if($role->name == 'dealer'){
                    $dealership=  Dealership::model()->findByAttributes(array('User_ID'=>Yii::app()->user->Id));
                    $criteria = array(
                                'condition'=>'t.Dealership_ID='.$dealership->ID,
                                'with'=>array('salesPerson'=>array('select'=>'Name'))
                                );
                }elseif(strtolower($role->name) == 'salesperson'){
                    $salesperson= SalesPerson::model()->findByAttributes(array('User_ID'=>Yii::app()->user->Id));
                    $criteria = array(
                                'condition'=>'SalesPerson_ID='.$salesperson->ID,
                                'with'=>array('salesPerson'=>array('select'=>'Name'))
                                );
                }elseif(strtolower($role->name) == 'authenticated'){
                    $criteria = array(
                                'condition'=>'t.User_ID='.Yii::app()->user->Id,
                                'with'=>array('salesPerson'=>array('select'=>'Name'))
                                );
                }
            }
		$dataProvider=new CActiveDataProvider('Deal',
                        array(
                                'criteria'=> $criteria
                            )
                        );
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Deal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Deal']))
			$model->attributes=$_GET['Deal'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Deal the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Deal::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Deal $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='deal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        private function getCarDetailsForPreviewPage(){
            $carInfo = array();
            if(Yii::app()->user->getState("guest_style")!=''){
                //unset(Yii::app()->session['userid']);
                
                $jsonStyle = Yii::app()->user->getState("guest_style");

                $objStyle = json_decode($jsonStyle);
                $carInfo['Make'] = $objStyle->make->name;
                $carInfo['Model'] = $objStyle->model->name;
                $carInfo['Year'] = $objStyle->year->year;
                $carInfo['Price'] = $objStyle->price->baseMSRP;
                $carInfo['StyleID'] = $objStyle->id;
            }else{
                $userId = Yii::app()->user->Id;
                $car =  Car::model()
                        ->with(
                                array(
                                    'savedCars'=>array('joinType'=>'INNER JOIN',
                                                      'condition'=> 'savedCars.User_ID ='. $userId,
                                                      'order'=>'savedCars.ID DESC',
                                                      'limit'=>'1'),
                                    )
                                )
                        ->find();
                
                $carInfo['Make'] = $car['Make'];
                $carInfo['Model'] = $car['Model'];
                $carInfo['Year'] = $car['Year'];
                $carInfo['Price'] = $car['Price'];
                $carInfo['StyleID'] = $car['StyleID'];
                
         
            }
            
            return $carInfo;
        }
        
      private function isOfferExistsWithDealer($userId, $dealerId){
         $deals =  Deal::model()->findAllByAttributes(array("User_ID"=>$userId,"Dealership_ID"=>$dealerId));
         
         return (count($deals)>0 ? true : false);
         
      }
}
