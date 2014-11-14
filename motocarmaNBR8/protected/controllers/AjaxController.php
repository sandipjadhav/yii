<?php

class AjaxController extends Controller
{
	public function actionSelectcar()
	{ 
            /*
            $jsonStyle = Yii::app()->user->getState("guest_style");
            $arrStyle = json_decode($jsonStyle);
            echo "<pre>"; var_dump($arrStyle); die;
            */
            $jsonStyle = file_get_contents('php://input');
            Yii::app()->user->setState("guest_style",$jsonStyle);
            if(Yii::app()->user->isGuest){
                
                echo json_encode(array('url'=>'login'));
            }else{
                echo json_encode(array('url'=>'dealer'));
            }
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