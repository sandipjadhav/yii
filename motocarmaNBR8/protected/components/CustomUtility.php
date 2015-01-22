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

    public function addSideBar()
    {
        $this->addJqueryUi();

        Yii::app()->clientScript->registerCSSFile(Yii::app()->getBaseUrl() . '/css/mbExtruder.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl() . '/js/jquery.hoverIntent.min.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl() . '/js/jquery.mb.flipText.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl() . '/js/mbExtruder.js');
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->getBaseUrl() . '/js/common.js');
    }

    public function extractCarAttrValue($carArray, $attribute)
    {
        //echo "<pre>";  print_r($carArray); die;
        $value = "";
        switch (trim($attribute)) {
            case  'Price':
                $value = $carArray['price']['baseMSRP'];
                break;
            case  'Make':
                $value = $carArray['make']['name'];
                break;
            case  'Model':
                $value = $carArray['model']['name'];
                break;
            case  'Year':
                $value = $carArray['year']['year'];
                break;
            case  'Transmission Type':
                $value = $carArray['transmission']['name'] . ($carArray['transmission']['transmissionType'] != '' ? '(' . $carArray['transmission']['transmissionType'] . ')' : '');
                break;
            case  'Fuel Type':
                $value = $carArray['engine']['fuelType'];
                break;
            case  'Exterior Color':
                $colors = array();
                foreach ($carArray['colors'] as $colMain) {
                    if ($colMain['category'] == 'Exterior') {
                        $colorOptions = $colMain['options'];
                        foreach ($colorOptions as $col) {
                            $colors[] = $col['name'];
                        }
                    }
                }
                return implode(',<br/>', $colors);
                break;
            case  'Interior Color':
                $colors = array();
                foreach ($carArray['colors'] as $colMain) {
                    if ($colMain['category'] == 'Interior') {
                        $colorOptions = $colMain['options'];
                        foreach ($colorOptions as $col) {
                            $colors[] = $col['name'];
                        }
                    }
                }
                return implode(',<br/>', $colors);
                break;
            case  'Navigation':
                $value = 'Not found';
                break;
            case  'Body Trim':
                $value = $carArray['trim'];
                break;
            case  'Driven Wheels (2 or 4)':
                $value = $carArray['drivenWheels'];
                break;
            case  'Number of Seats':
                $value = 'Not found';
                break;
            case  'MPG City':
                $value = $carArray['MPG']['city'];
                break;
            case  'MPG Highway':
                $value = $carArray['MPG']['highway'];
                break;
        }

        return $value;
    }

    function extractStylePhoto($styleId)
    {
        $url = "https://api.edmunds.com/v1/api/vehiclephoto/service/findphotosbystyleid?styleId=" . $styleId . "&fmt=json&api_key=mexvxqeke9qmhhawsfy8j9qd";
        //  Initiate curl
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);

        // Will dump a beauty json :3
        $photoData = json_decode($result, true);

        foreach ($photoData as $photoMain) {
            if ($photoMain['subType'] == 'exterior') {
                return 'http://media.ed.edmunds-media.com/' . $photoMain['photoSrcs'][0];
                break;
            }
        }

    }

}
