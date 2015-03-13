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
        //header('content-type: text/json');
            $arraySp = array();
            foreach($salesPersons as $sp){
                $profileFields = ProfileField::model()->forAll()->sort()->findAll();
                if ($profileFields) {
                    foreach ($profileFields as $field) {
                        if ($field->varname == 'profilePhoto') {
                            $attribute_value = $sp->user->profile->getAttribute($field->varname);
                            $photoUrl = $attribute_value;
                        }
                    }
                }
                $arraySp[] = array(
                    'ID' => $sp['ID'],
                    'UserName' => $sp->user->username,
                    'FirstName' => $sp->user->profile->getAttribute('firstname'),
                    'LastName' => $sp->user->profile->getAttribute('lastname'),
                    'email' => $sp->user->email,
                    'ContactPhone' => $sp->ContactPhone,
                    'Photo' => $photoUrl,
                );

            }
        //echo "".Yii::app()->baseUrl . '/' . $attribute_value;
            echo json_encode(array('salesperson'=>$arraySp)); die;
    }

    public function actionDealsershiplist()
    {
        $term = Yii::app()->request->getQuery('term');
        $term = '%' . $term . '%';
        $make = Yii::app()->request->getQuery('make');
        //$make = 'ford';
        $make = strtoupper($make);


        $dealershipQuery = Yii::app()->db->createCommand()
            ->setFetchMode(PDO::FETCH_OBJ)
            ->select('distinct(d.ID), d.Name, vm.make')
            ->from('Dealership d')
            ->join('DealerMake dm', 'd.ID = dm.DealerId')
            ->join('VehicleMake vm', 'dm.MakeID = vm.id')
            //->where('UPPER(vm.make)=:make')
            ->where('UPPER(vm.make)=:make
                            AND (
                                d.Name like :Name
                                OR d.Address like :Address
                                OR d.zip like :zip
                                OR d.city like :city
                                OR d.state like :state
                            )',
                array(':make' => $make, ':Name' => $term, ':Address' => $term, ':zip' => $term, ':city' => $term, ':state' => $term));


        $dealership = $dealershipQuery->queryAll();
        //print_r($dealershipQuery->gettext());
        //var_dump($dealership);
        $lists = array();
        foreach ($dealership as $deal) {
            $lists[] = array(
                'id' => $deal->ID,
                'name' => $deal->Name,
            );
        }
        echo json_encode($lists);
    }

    public function actionGetDealerParams()
    {
        $dealerId = $_GET['dealerId'];
        $criteria = new CDbCriteria;
        $criteria->condition = "t.DealerId = :dealer_id";
        $criteria->params = array(":dealer_id" => $dealerId);
        $dealerParams = DealerParams::model()->find($criteria);

        $params = array(
            'DealerId' => ($dealerParams->DealerId),
            'DocFee' => $dealerParams->DocFee,
            'Smog' => $dealerParams->Smog,
            'SmogCertFee' => $dealerParams->SmogCertFee,
            'TireFee' => $dealerParams->TireFee,
            'DmvEt' => $dealerParams->DmvEt,
            'DmvAddiFee' => $dealerParams->DmvAddiFee,
            'LicenseFee' => $dealerParams->LicenseFee,
            'SalesTax' => $dealerParams->SalesTax,
        );
        $params['rebate'] = '100.00';
        if (!$dealerParams->DealerId) { // Because if record not found yii makes all values 'null'. retain default '0.00' except DealerId
            $params = array_fill_keys(array_keys($params), '0.00');
            $params['DealerId'] = $dealerParams->DealerId;
        }
        echo json_encode($params);
        die;

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


    public function actionSendDealMessage()
    {
        Yii::import('application.modules.message.models.*');
        $message = new Message;
        $message->sender_id = Yii::app()->user->Id;
        $message->receiver_id = $_POST['receiverId'];
        $message->subject = $_POST['subject'];
        $message->body = $_POST['body'];
        $message->created_at = date("Y-m-d h:i:s");
        $messageSent = $message->save();
        $success = 1;
        $error = json_encode(array());
        if (!$messageSent) {
            $success = 0;
            $error = $message->getErrors();
        }
        echo json_encode(array('success' => $success, 'errors' => $error));
    }

    public function actionGetDealersByCity()
    {
        $city = $_GET['city'];
        $make = $_GET['$make'];
        /*$criteria = new CDbCriteria;
        //$criteria->select="t.ID, t.Name";
        $criteria->condition="t.city = :city";
        $criteria->params=array(":city"=>$city);
        $dealers=Dealership::model()->findAll($criteria);
        */

        $dealershipQuery = Yii::app()->db->createCommand()
            ->setFetchMode(PDO::FETCH_OBJ)
            ->select('distinct(d.ID), d.Name, vm.make')
            ->from('Dealership d')
            ->join('DealerMake dm', 'd.ID = dm.DealerId')
            ->join('VehicleMake vm', 'dm.MakeID = vm.id')
            //->where('UPPER(vm.make)=:make')
            ->where(' UPPER(d.city) like ' . strtoupper("'%" . $city . "%'"));


        $dealers = $dealershipQuery->queryAll();
        //var_dump($dealershipQuery);


        $dealerArray = array();
        foreach ($dealers as $dealer) {
            //$dealerArray[] = array($dealer->lat, $dealer->lang);
            $address = $dealer->street . ', ' . $dealer->city . ', ' . $dealer->zip;
            $dealerArray[] = array('id' => $dealer->ID, 'DealerName' => $dealer->Name, 'Address' => $address);
        }
        //$dealerArray[] = array('id'=>'501','DealerName'=>'Dealer 1','Address'=>'Lane 1','latlang'=>array('34.060328','-118.273717'));
        //$dealerArray[] = array('id'=>'502','DealerName'=>'Dealer 2','Address'=>'Lane 2','latlang'=>array('34.076254','-118.282986'));
        echo json_encode($dealerArray);
        die;

    }

    public function actionSuggestDealer()
    {
        $dealerName = $_POST['dealerName'];
        $subject = 'User suggested a dealer';
        $body = 'User suggested a dealer:' . $dealerName;
        $header = "From: no-reply@motocarma.com";
        mail(Yii::app()->params['adminEmail'], $subject, $body, $header);
        echo '1';
    }


    public function actionDealhistory()
    {
        $roles = Rights::getAssignedRoles(Yii::app()->user->Id);

        $dealHistory = DealHistory::model()->findAllByAttributes(array('Deal_ID' => $_GET['dealId']), array('order' => 'ID desc'));

        /*$criteria = array();
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

        $dealHistory = Deal::model()->findAll($criteria);
        */
        $this->render('dealHistory', array(
            'dealHistory' => $dealHistory,
        ));
    }


    public function actionCalculateEmi()
    {
        $principle = $_POST['principle'];
        $rate = $_POST['rate'];
        $term = $_POST['term'];

        $emi = Yii::app()->customUtility->emiCalculator($principle, $rate, $term);

        echo $emi;
        die;
    }
}