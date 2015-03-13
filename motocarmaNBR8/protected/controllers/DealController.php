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
            ), array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'Compare', 'SetSelectedCar', 'SelectDealership'),
                'users' => array('*'),
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

    public function actionCompare()
    {
        $message = '';
        $data = array();
        $row = 1;
        $savedCars = array();
        if (Yii::app()->user->id) {
            $savedCars = Yii::app()->user->getState("guest_style");
        } else {
            $savedCars = Yii::app()->user->getState("guest_style");
        }
        if ($savedCars == '' || (is_array($savedCars) && count($savedCars) == 0)) {
            $message = 'There are no cars in wishlist for comparison';
            $savedCars = array();
        }
        $this->render('compare', array('savedCars' => $savedCars, 'message' => $message));
    }

    public function actionSelectDealership()
    {
        Yii::app()->clientScript->registerCoreScript('jquery');
        $styleId = Yii::app()->user->getState("selectedCar");
        $arrCarInfo = $this->getCarDetailsForPreviewPage($styleId);
        $this->render('selectDealership', array('arrCarInfo' => $arrCarInfo, 'styleId' => $styleId, 'model' => new Deal()));
        Yii::import('ext.select2.Select2');
    }


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
    {
        //print_r($_POST); die;
        $arrCarInfo = $this->getCarDetailsForPreviewPage();
        $model = new Deal;
        Yii::app()->clientScript->registerCoreScript('jquery');
        $styleId = Yii::app()->user->getState("selectedCar");

        if ($styleId != '' || $styleId != null) {

        }
        $reviews = Yii::app()->customUtility->getStyleReviews($arrCarInfo['StyleID']);
        $tmvObj = Yii::app()->customUtility->getStyleTmv($arrCarInfo['StyleID'], $_POST['ZipCode']);

        //echo "<pre>";print_r($arrCarInfo); echo "</pre>"; die;

        Yii::import('ext.select2.Select2');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        Yii::import('application.modules.message.models.*');
        if (isset($_POST['Deal'])) {
            $submitData = $_POST['Deal'];
            if ($_POST['submitPage'] == 'DealerSelect') {
                $model->Dealership_ID = $submitData['Dealership_ID'];
                $model->SalesPerson_ID = $submitData['SalesPerson_ID'];
                $model->StyleID = $styleId;


                if ($submitData['Dealership_ID'] != '') {
                    $dealer = Dealership::model()->findByPk($submitData['Dealership_ID']);
                    if ($dealer->zip) {

                        $salesTax = Yii::app()->customUtility->getDealerSalesTaxByZip($dealer->zip);
                        $model->SalesTax = number_format($salesTax, 2);

                    }

                }
                if ($submitData['SalesPerson_ID'] != '') {
                    $salesperson = SalesPerson::model()->findByPk($submitData['SalesPerson_ID']);
                }

                Yii::app()->clientScript->registerCoreScript('jquery');

                $styleId = Yii::app()->user->getState("selectedCar");
                $arrCarInfo = $this->getCarDetailsForPreviewPage();


            } else {

                $submitData = $_POST['Deal'];
                //print_r($_POST);
                //die;
                $offerExists = $this->isOfferExistsWithDealer(Yii::app()->user->Id, $submitData['Dealership_ID']);
                $offerExists = false;
                if ($offerExists === FALSE) {
                    //print_r($_POST); die;
                    $submitData['DocFee'] = $_POST['paramDocFee'];
                    $submitData['Smog'] = $_POST['paramSmog'];
                    $submitData['SmogCertFee'] = $_POST['paramSmogCertFee'];
                    $submitData['TireFee'] = $_POST['paramTireFee'];
                    $submitData['DmvEt'] = $_POST['paramDmv'];
                    $submitData['DmvAddiFee'] = $_POST['paramDmAf'];
                    $submitData['LicenseFee'] = $_POST['paramLicenseFee'];
                    $submitData['DownPayment'] = $_POST['paramDP'] == '' ? '0.00' : $_POST['paramDP'];
                    $submitData['Apr'] = $_POST['paramAprPct'];
                    $submitData['Price'] = $_POST['paramMsrp'];
                    $submitData['term'] = $_POST['paramTerm'];

                    $submitData['term'] = $_POST['paramTerm'] == '' ? '0' : $_POST['paramTerm'];
                    $submitData['rebate'] = $_POST['paramRebate'];

                    $model->attributes = $submitData;

                    if ($model->save()) {
                        $salesperson = SalesPerson::model()->findByPk($model->SalesPerson_ID);
                        $user = User::model()->findByPk(Yii::app()->user->Id);

                        $message = new Message;
                        $message->sender_id = Yii::app()->user->Id;
                        $message->receiver_id = $salesperson->User_ID;
                        $message->subject = 'New Offer Notification';
                        $body = 'Dear, ' . $salesperson->Name;
                        $body .= '<br/> Offer Details:';
                        $body .= "Customer: " . $user->username . "<br/>";
                        $body .= "Make: " . $arrCarInfo['Make'] . "<br/>";
                        $body .= "Model: " . $arrCarInfo['Model'] . "<br/>";
                        $body .= "Price: " . $arrCarInfo['Price'] . "<br/>";
                        $body .= "Year: " . $arrCarInfo['Year'] . "<br/>";
                        $body .= "Offer Price: " . $submitData['OfferPrice'] . "<br/>";
                        $message->body = $body;
                        $message->created_at = date("Y-m-d h:i:s");
                        $message->save();

                        $dealStatus = DealStatus::model()->findByPk($model->DealStatus_ID);


                        $DealHistory = new DealHistory;
                        $DealHistory->Car_ID = $model->Car_ID;
                        $DealHistory->Deal_ID = $model->ID;
                        $DealHistory->DealStatus_ID = $model->DealStatus_ID;
                        $DealHistory->DealStatus = $dealStatus->DealStatus;
                        $DealHistory->Make = $arrCarInfo['Make'];
                        $DealHistory->Model = $arrCarInfo['Model'];
                        $DealHistory->Price = $arrCarInfo['Price'];
                        $DealHistory->SalesPersonUserName = $salesperson->Name;
                        $DealHistory->SalesPerson_ID = $model->SalesPerson_ID;
                        $DealHistory->StyleID = $arrCarInfo['StyleID'];
                        $DealHistory->UserName = $user->username;
                        $DealHistory->User_ID = Yii::app()->user->Id;
                        $DealHistory->Year = $arrCarInfo['Year'];
                        $DealHistory->message_id = $message->id;

                        $DealHistory->save();
                        Yii::app()->user->setState("guest_style", '');

                        $this->redirect(array('site/UserHome', 'message' => 'dealSuccess'));

                    } else {
                        print_r($model->getErrors());
                    }

                } else {
                    Yii::app()->user->setFlash('error', "You have already made an offer to the dealer selected. Please select another dealer.");
                }
            }
        }

        $messagesAdapter = Message::getAdapterForInbox(Yii::app()->user->getId());
        $pager = new CPagination($messagesAdapter->totalItemCount);
        $pager->pageSize = 10;
        $messagesAdapter->setPagination($pager);


                $roles = Rights::getAssignedRoles(Yii::app()->user->Id);
                $model->DealStatus_ID = 3;
                $model->User_ID = Yii::app()->user->Id;
                $model->DateAdded = $model->LastModified = date("Y-m-d h:i:s");
                $this->render('create',array(
                        'model'=>$model,'currentRole'=>strtolower(current($roles)->name),
                    'arrCarInfo' => $arrCarInfo,
                    'messagesAdapter' => $messagesAdapter,
                    'dealer' => $dealer,
                    'salesperson' => $salesperson,
                    'msgModel' => new Message,
                    'reviews' => $reviews,
                    'tmvObj' => $tmvObj
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
        //var_dump($model->Dealership_ID); die;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $dealStatus = DealStatus::model()->findByPk($model->DealStatus_ID);

        $salesperson = SalesPerson::model()->findByPk($model->SalesPerson_ID);
        $dealer = Dealership::model()->findByPk($model->Dealership_ID);

        $customer = User::model()->findByPk($model->User_ID);

        $dealStatus = DealStatus::model()->findByPk($model->DealStatus_ID);
        $arrCarInfo = $this->getCarDetailsForPreviewPage($model->StyleID);

        $reviews = Yii::app()->customUtility->getStyleReviews($model->StyleID);
        //$reviews = json_decode($jsonReviews);
        $tmvObj = Yii::app()->customUtility->getStyleTmv($arrCarInfo['StyleID'], $_POST['ZipCode']);


        //print_r($_POST['Deal']); die;

        Yii::import('application.modules.message.models.*');


        if (isset($_POST['Deal']))
		{
            $submitData = $_POST['Deal'];
            $submitData['DocFee'] = $_POST['paramDocFee'];
            $submitData['Smog'] = $_POST['paramSmog'];
            $submitData['SmogCertFee'] = $_POST['paramSmogCertFee'];
            $submitData['TireFee'] = $_POST['paramTireFee'];
            $submitData['DmvEt'] = $_POST['paramDmv'];
            $submitData['DmvAddiFee'] = $_POST['paramDmAf'];
            $submitData['LicenseFee'] = $_POST['paramLicenseFee'];
            $submitData['DownPayment'] = $_POST['paramDP'] == '' ? '0.00' : $_POST['paramDP'];
            $submitData['Apr'] = $_POST['paramAprPct'];
            $submitData['Price'] = $_POST['paramMsrp'];
            $submitData['term'] = $_POST['paramTerm'];

            $submitData['term'] = $_POST['paramTerm'] == '' ? '0' : $_POST['paramTerm'];
            $submitData['rebate'] = $_POST['paramRebate'];


            $changedParams = $model->getDealParamChanges($submitData);
            //print_r($submitData); die;
            $model->attributes = $submitData;
			if($model->save()){

                if ($model->DealStatus_ID == 3) {

                    $dealStatus = DealStatus::model()->findByPk($model->DealStatus_ID);

                    $salesperson = SalesPerson::model()->findByPk($model->SalesPerson_ID);

                    $customer = User::model()->findByPk($model->User_ID);

                    $user = User::model()->findByPk(Yii::app()->user->Id);

                    $car = Car::model()->findByPk($model->Car_ID);

                    Yii::import('application.modules.message.models.*');
                    $message = new Message;
                    $message->sender_id = Yii::app()->user->Id;
                    $message->receiver_id = $model->User_ID;
                    $message->subject = 'Motocarma Offer Notification - Offer' . $dealStatus->DealStatus;
                    $body = "Dear " . $customer->username . ",";
                    $body .= "\n Your offer with status mentioned below is " . $dealStatus->DealStatus;
                    $body .= "\n Offer Details:";
                    $body .= "Customer: " . $user->username . "\n ";
                    $body .= "Make: " . $arrCarInfo['Make'] . "<br/>";
                    $body .= "Model: " . $arrCarInfo['Model'] . "<br/>";
                    $body .= "Price: " . $arrCarInfo['Price'] . "<br/>";
                    $body .= "Year: " . $arrCarInfo['Year'] . "<br/>";
                    $body .= "Offer Price: " . $submitData['OfferPrice'] . "<br/>";
                    $message->body = $body;
                    $message->created_at = date("Y-m-d h:i:s");
                    $message->save();


                    $DealHistory = new DealHistory;
                    $DealHistory->Car_ID = $model->Car_ID;
                    $DealHistory->Deal_ID = $model->ID;
                    $DealHistory->DealStatus_ID = $model->DealStatus_ID;
                    $DealHistory->DealStatus = $dealStatus->DealStatus;
                    $DealHistory->Make = $arrCarInfo['Make'];
                    $DealHistory->Model = $arrCarInfo['Model'];
                    $DealHistory->Price = $arrCarInfo['Price'];
                    $DealHistory->SalesPersonUserName = $salesperson->Name;
                    $DealHistory->SalesPerson_ID = $model->SalesPerson_ID;
                    $DealHistory->StyleID = $arrCarInfo['StyleID'];
                    $DealHistory->UserName = $user->username;
                    $DealHistory->User_ID = Yii::app()->user->Id;
                    $DealHistory->Year = $arrCarInfo['Year'];
                    $DealHistory->ChangedParams = json_encode($changedParams);
                    $DealHistory->message_id = $message->id;

                    $DealHistory->save();
                    //print_r($DealHistory->getErrors());
                    //die;

                }
                $this->redirect(array('index', 'id' => $model->ID));
            } else {
                print_r($model->getErrors());
            }
		}

        $roles = Rights::getAssignedRoles(Yii::app()->user->Id);
        $role = current($roles);

        $dealHistory = DealHistory::model()->findAllByAttributes(array('Deal_ID' => $model->ID));

        $messagesAdapter = Message::getAdapterForInbox(Yii::app()->user->getId());
        $pager = new CPagination($messagesAdapter->totalItemCount);
        $pager->pageSize = 10;
        $messagesAdapter->setPagination($pager);

		$this->render('update',array(
            'model' => $model,
            'currentRole' => strtolower(current($roles)->name),
            'arrCarInfo' => $arrCarInfo,
            'messagesAdapter' => $messagesAdapter,
            'dealer' => $dealer,
            'salesperson' => $salesperson,
            'dealHistory' => $dealHistory,
            'msgModel' => new Message,
            'reviews' => $reviews,
            'tmvObj' => $tmvObj
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

    private function getCarDetailsForPreviewPage($styleId = null)
    {
            $carInfo = array();

        if ($styleId == null) {
            $styleId = Yii::app()->user->getState("selectedCar");
        }

        if ($styleId == null) {
            if (Yii::app()->user->getState("guest_style") != '') {
                //unset(Yii::app()->session['userid']);
                $savedCars = Yii::app()->user->getState("guest_style");
                foreach ($savedCars as $car) {
                    $objStyle = json_decode($car);
                    if ($objStyle->id == $styleId) {

                        $carInfo['Make'] = $objStyle->make->name;
                        $carInfo['Model'] = $objStyle->model->name;
                        $carInfo['Year'] = $objStyle->year->year;
                        $carInfo['Price'] = $objStyle->price->baseMSRP;
                        $carInfo['StyleID'] = $objStyle->id;
                    }
                }
            } else {
                $result = Yii::app()->customUtility->fetchEdmundStyleInfo($styleId);
                $objStyle = json_decode($result);
                $carInfo['Make'] = $objStyle->make->name;
                $carInfo['Model'] = $objStyle->model->name;
                $carInfo['Year'] = $objStyle->year->year;
                $carInfo['Price'] = $objStyle->price->baseMSRP;
                $carInfo['StyleID'] = $objStyle->id;
            }
        } else {
            $result = Yii::app()->customUtility->fetchEdmundStyleInfo($styleId);

            $objStyle = json_decode($result);
            $carInfo['Make'] = $objStyle->make->name;
            $carInfo['Model'] = $objStyle->model->name;
            $carInfo['Year'] = $objStyle->year->year;
            $carInfo['Price'] = $objStyle->price->baseMSRP;
            $carInfo['StyleID'] = $objStyle->id;
        }
            return $carInfo;
        }
        
      private function isOfferExistsWithDealer($userId, $dealerId){
         $deals =  Deal::model()->findAllByAttributes(array("User_ID"=>$userId,"Dealership_ID"=>$dealerId));
         
         return (count($deals)>0 ? true : false);
         
      }

    public function actionSetSelectedCar()
    {

        Yii::app()->user->setState("selectedCar", $_GET['styleId']);
        if (Yii::app()->user->Id) {
            $this->redirect(Yii::app()->createUrl('deal/selectDealership'));
        } else {
            $this->redirect(Yii::app()->createUrl('user/login'));
        }
    }
}
