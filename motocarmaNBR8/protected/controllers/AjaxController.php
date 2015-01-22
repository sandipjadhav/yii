<?php

class AjaxController extends Controller
{
    public function beforeAction($action)
    {
        $this->layout = false;
        return parent::beforeAction($action);
    }
	public function actionSelectcar()
    {
            /*
            $jsonStyle = Yii::app()->user->getState("guest_style");
            $arrStyle = json_decode($jsonStyle);
            echo "<pre>"; var_dump($arrStyle); die;
            */


        $currentSavedCars = array();


        //header('content-type: application/json');
            $jsonStyle = file_get_contents('php://input');
        $selectedCar = json_decode($jsonStyle);
        $currentSavedCars = Yii::app()->user->getState("guest_style");
        if (count($currentSavedCars) < Yii::app()->params['MAX_GARAGE_COUNT']) {
            if (is_array($currentSavedCars)) {
                if (count($currentSavedCars) > 0) {
                    foreach ($currentSavedCars as $car) {
                        $objCarInfo = json_decode($car);
                        if ($selectedCar->id == $objCarInfo->id) {
                            $error = array('error' => 'CAR_ALREADY_SELECTED', 'message' => 'Selected car has been already added to the wishlist.');
                            header('HTTP/1.1 500 Internal Server Error');
                            echo json_encode($error);
                            die;
                        } else {
                            $currentSavedCars[] = $jsonStyle;
                            Yii::app()->user->setState("guest_style", $currentSavedCars);
                            $currentSavedCars = Yii::app()->user->getState("guest_style");
                            $this->renderPartial('_miniGarage', array('cars' => $currentSavedCars), false, true);
                            die;
                        }
                    }
                } else {
                    $currentSavedCars[] = $jsonStyle;
                    Yii::app()->user->setState("guest_style", $currentSavedCars);
                    $currentSavedCars = Yii::app()->user->getState("guest_style");
                    $this->renderPartial('_miniGarage', array('cars' => $currentSavedCars), false, true);
                }
            } else {
                $currentSavedCars[] = $jsonStyle;
                Yii::app()->user->setState("guest_style", $currentSavedCars);
                $currentSavedCars = Yii::app()->user->getState("guest_style");
                $this->renderPartial('_miniGarage', array('cars' => $currentSavedCars), false, true);
            }


        } else {
            $error = array('error' => 'MAX_GARAGE_COUNT_EXCEEDED', 'message' => 'Maximum of ' . Yii::app()->params['MAX_GARAGE_COUNT'] . ' cars are allowed in wishlist.');
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode($error);
            die;
        }
        /*if(Yii::app()->user->isGuest){

            echo json_encode(array('url'=>'login'));
        }else{
            echo json_encode(array('url'=>'dealer'));
        }*/
	}

    private function getGarage()
    {
        $currentSavedCars = Yii::app()->user->getState("guest_style");

        return json_encode($currentSavedCars);
    }


    public function actionGarageInfo()
    {
        $currentSavedCars = Yii::app()->user->getState("guest_style");

        $this->renderPartial('_miniGarage', array('cars' => $currentSavedCars), false, true);

    }

    public function actionRemoveGarageCar()
    {
        $carId = $_GET['carId'];
        $newCarSession = array();
        $currentSavedCars = Yii::app()->user->getState("guest_style");
        foreach ($currentSavedCars as $seq => $carJson) {
            $car = json_decode($carJson, true);
            if ($car['id'] != $carId) {
                $newCarSession[] = $carJson;
            }
        }

        Yii::app()->user->setState("guest_style", $newCarSession);
        $this->renderPartial('_miniGarage', array('cars' => $newCarSession), false, true);
    }


    public function actionDealerSalesperson()
	{
            $criteria = new CDbCriteria;
            //$criteria->select="t.ID, t.Name";
            $criteria->condition="t.Dealership_ID = :dealer_id";
            $criteria->params=array(":dealer_id"=>$_GET['dealerId']);
            $salesPersons=SalesPerson::model()->findAll($criteria);
            
            $arraySp = array();
            foreach($salesPersons as $sp){
                $arraySp[] = array('ID'=> $sp['ID'],'Name'=>$sp->user->username);
            }
            echo json_encode(array('salesperson'=>$arraySp)); die;
        }
        
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}