<?php

class LoginController extends Controller
{
	public $defaultAction = 'login';

	/**
	 * Displays the login page
	 */
	public function actionLogin()
    {
        if (Yii::app()->user->isGuest) {
            $jsonStyle = Yii::app()->user->getState("guest_style");

            //print_r($jsonStyle);
            //echo $returnUrl = $this->saveSavedCar();die;
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {

					$this->lastViset();
                    $returnUrl = $this->saveSavedCar();
                    $roles = Rights::getAssignedRoles(Yii::app()->user->Id);
                    $current_role = strtolower(current($roles)->name);
                    if (strtolower($current_role) == 'authenticated' && ($jsonStyle != '' || count($jsonStyle) > 0))
						$this->redirect($returnUrl);
                    else
                        $this->redirect(Yii::app()->createUrl('site/index'));
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model));
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}
        
        private function saveSavedCar(){ 
            
            $jsonStyle = Yii::app()->user->getState("guest_style");
            $returnUrl = Yii::app()->user->returnUrl;
            if ($jsonStyle != '' || count($jsonStyle) > 0) {
                $returnUrl = Yii::app()->createUrl('deal/selectDealership');
                return $returnUrl;
            }
            /*foreach($jsonStyle as $jsonStyle) {
                if(Yii::app()->user->getState("selectedCar")!='') {
                    $returnUrl = Yii::app()->createUrl('deal/create');
                    return $returnUrl;
                }
                return $returnUrl;
                if ($jsonStyle != "") {

                    $arrStyle = json_decode($jsonStyle);

                    $car = new Car;

                    $car->Make = $arrStyle->make->name;
                    $car->Price = $arrStyle->price->baseMSRP;
                    $car->Model = $arrStyle->model->name;
                    $car->StyleID = $arrStyle->id;
                    $car->Year = $arrStyle->year->year;
                    $car->ID = NULL;

                    if ($car->save()) {
                        $savedCars = new SavedCars;
                        $savedCars->Car_ID = $car->ID;
                        $savedCars->DealStatus_ID = 3;
                        $savedCars->User_ID = Yii::app()->user->id;
                        $savedCars->DateAdded = date('Ydm');
                        $car->ID = NULL;
                        if (!$savedCars->save()) {
                            echo "Error on SavedCar save:" . $savedCars->errorMessage();
                        } else {
                            $returnUrl = Yii::app()->createUrl('deal/create');
                        }
                    } else {
                        echo "Error on Car save";;
                    }
                }
            }
            return $returnUrl;*/
        }
        
}