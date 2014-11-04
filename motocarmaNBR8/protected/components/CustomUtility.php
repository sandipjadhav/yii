<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomUtility
 *
 * @author sandip.jadhav
 */
class CustomUtility extends CApplicationComponent {
    
    public function addJqueryUi(){
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
    }
    
    // Need to call addJqueryUi() first.
    public function addJqueryDatePicker($dateFields = array()){
        $this->addJqueryUi();
        
        $script = "var dateFields = [];";
        
        foreach($dateFields as $i=>$field){
            $script .= "dateFields.push(\"$field\");";
        }
        
        Yii::app()->clientScript->registerCssFile(
                Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
        $baseUrl = Yii::app()->baseUrl;
        Yii::app()->getClientScript()->registerScriptFile($baseUrl.'/js/common.js');
        
        //$script .= '; applyDatePicker(dateFields);';
        echo CHtml::script($script);
    }

}
