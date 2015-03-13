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
        //var_dump($photoData); die;
        foreach ($photoData as $photoMain) {
            $photoBaseUrl = 'http://media.ed.edmunds-media.com/';
            $photo = "";
            if ($photoMain['subType'] == 'exterior' && $photoMain['shotTypeAbbreviation'] == 'S') {
                if (count($photoMain['photoSrcs']) > 0) {
                    $strPhotoId = str_replace($photoMain['site'] . '/photo', '', $photoMain['id']);;
                    $photo = $strPhotoId . '_175.jpg';
                    if (array_search($photo, $photoMain['photoSrcs']) === FALSE) {
                        $photo = $strPhotoId . '_131.jpg';
                    }
                    return $photoBaseUrl . $photo;
                }
            } else if ($photo == '' && $photoMain['subType'] == 'exterior' && $photoMain['shotTypeAbbreviation'] == 'FQ') {
                if (count($photoMain['photoSrcs']) > 0) {
                    $strPhotoId = str_replace($photoMain['site'] . '/photo', '', $photoMain['id']);;
                    $photo = $strPhotoId . '_175.jpg';
                    if (array_search($photo, $photoMain['photoSrcs']) === FALSE) {
                        $photo = $strPhotoId . '_131.jpg';
                    }
                    return $photoBaseUrl . $photo;
                    //$photo = $photoMain['photoSrcs'][0];return $photoBaseUrl.$photo;
                }
            } else if ($photo == '' && $photoMain['subType'] == 'exterior' && $photoMain['shotTypeAbbreviation'] == 'E') {
                if (count($photoMain['photoSrcs']) > 0) {
                    $strPhotoId = str_replace($photoMain['site'] . '/photo', '', $photoMain['id']);;
                    $photo = $strPhotoId . '_175.jpg';
                    if (array_search($photo, $photoMain['photoSrcs']) === FALSE) {
                        $photo = $strPhotoId . '_131.jpg';
                    }
                    return $photoBaseUrl . $photo;
                    //$photo = $photoMain['photoSrcs'][0];return $photoBaseUrl.$photo;
                }
            } else if ($photo == '' && $photoMain['subType'] == 'exterior' && $photoMain['shotTypeAbbreviation'] == 'RQ') {
                if (count($photoMain['photoSrcs']) > 0) {
                    $strPhotoId = str_replace($photoMain['site'] . '/photo', '', $photoMain['id']);;
                    $photo = $strPhotoId . '_175.jpg';
                    if (array_search($photo, $photoMain['photoSrcs']) === FALSE) {
                        $photo = $strPhotoId . '_131.jpg';
                    }
                    return $photoBaseUrl . $photo;
                    //$photo = $photoMain['photoSrcs'][0];return $photoBaseUrl.$photo;
                }
            }

            //return $photoBaseUrl.$photo;
        }
        return $photoBaseUrl . $photo;

    }

    function fetchEdmundStyleInfo($styleId)
    {
        $url = "https://api.edmunds.com/api/vehicle/v2/styles/" . $styleId . "?view=full&fmt=json&api_key=mexvxqeke9qmhhawsfy8j9qd";
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

        return $result;
    }

    function addBuyButton($styleId)
    {
        echo '<button class="btn btn-primary" onclick="buyThisCar(\'' . $styleId . '\')">Work a Deal</button>';
    }

    function getDealerSalesTaxByZip($zip)
    {
        $url = 'https://taxrates.api.avalara.com:443/postal?country=usa&postal=' . $zip;
        $apiKey = "E8Qqzf7MsTcFosHkCUrVghV8L66%2BtTwxFV8v3dTzs3H1hqEBII%2Ftu%2FgT6gk%2BCWLo9%2F4KBcqloARJLevX%2BzC6Rg%3D%3D";
        //echo urldecode($url.'&apikey='.$apiKey); die;
        $result = file_get_contents($url . '&apikey=' . $apiKey);

        $arrSalesTax = json_decode($result, true);
        //var_dump($arrSalesTax); die;
        return $arrSalesTax['totalRate'];
    }

    function getStyleReviews($styleId)
    {
        $url = "https://api.edmunds.com/api/vehiclereviews/v2/styles/" . $styleId . "?fmt=json&api_key=mexvxqeke9qmhhawsfy8j9qd";
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
        $reviews = json_decode($result);
        $reviews->reviews;
        return $reviews->reviews;
    }

    function getStyleTmv($styleId, $zipCode)
    {

        $url = "https://api.edmunds.com/v1/api/tmv/tmvservice/calculatenewtmv?styleid=" . $styleId . "&zip=" . $zipCode . "&fmt=json&api_key=mexvxqeke9qmhhawsfy8j9qd";
        //"https://api.edmunds.com/api/tmv/tmvservice/calculatenewtmv?styleid=".$styleId."&zip=".$zipCode."&fmt=json&api_key=mexvxqeke9qmhhawsfy8j9qd";
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
        $tmvObj = json_decode($result);
        return $tmvObj;
    }

    function getDmvFromArray($msrp)
    {
        $dmvArray = Yii::app()->params['DMV'];
        $dmv = 0;
        foreach ($dmvArray as $range => $value) {
            $r = explode('-', $range);
            if ($msrp >= $r[0] && $msrp <= $r[1]) {
                $dmv = $value;
            }
        }
        return number_format($dmv, 2);
    }

    function emiCalculator($principle, $rate, $term)
    {
        if (($rate * $term) != 0) {

            $monthly = $rate / 12 / 100;
            $start = 1;
            $length = 1 + $monthly;

            for ($i = 0; $i < $term; $i++) {
                $start = $start * $length;
            }

            $emi = $principle * $monthly / (1 - (1 / $start));


            //$emi = ($principle * $rate * pow((1+$rate),$term))/(pow((1+$rate),$term)-1);
            //$emi = $emi/12;
        } elseif ($rate == 0 && $term != 0) {
            $emi = $principle / $term;
        } else {
            $emi = '0.00';
        }

        return number_format($emi, 2, '.', '');
    }

}
