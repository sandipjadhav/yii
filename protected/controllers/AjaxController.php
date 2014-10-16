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
            
            if(Yii::app()->user->isGuest){
                Yii::app()->user->setState("guest_style",$jsonStyle);
                echo json_encode(array('url'=>'login'));
            }else{
                echo json_encode(array('url'=>'dealer'));
            }
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