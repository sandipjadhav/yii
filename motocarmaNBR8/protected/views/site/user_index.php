<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (Yii::app()->user->isguest === false)
{
    if(isset($message) && $message == 'dealSuccess'){
?>
    <div class='flash-success'>
        Your offer has been successfully submitted. The dealership will review the offer and will respond within 72 hours.
    </div>
    <?php } ?>
User Home
<ul>
        <!--TODO SK : Deals, dealership and sales persons need to be filtered by Dealership  -->
                <li><?php echo CHtml::link('Profile', array('user/profile')); ?></li>
                <li><?php echo CHtml::link('Deals', array('deal/index')); ?></li>
                <li><?php echo CHtml::link('Saved Cars', array('savedcars/index')); ?></li>
            </ul>
<?php
if($guestStyleSelected && $guestStyleSelected != ""){ ?>
<div id="CarInfo"><span><b>Recent Car Selected : </b></span>
        <ul>
            <li>Make: <span id="carName"><?php echo $guestStyleSelected->make->name ; ?></span></li>
            <li>Model: <span id="carModel"><?php echo $guestStyleSelected->model->name ; ?></span></li>
            <li>Year: <span id="carYear"><?php echo $guestStyleSelected->year->year ; ?></span></li>
            <li>Price: <span id="carPrice"><?php echo $guestStyleSelected->price->baseMSRP ; ?></span></li>
        </ul>       
    </div>
<?php echo CHtml::link('Make an offer', array('deal/create')); ?>
<?php 
}else{    
    $selectedcar = Yii::app()->session['$selectedcar'];
    echo Yii::app()->session['$selectedcar']['make'];
    echo Yii::app()->session['$selectedcar']['model'];
    echo Yii::app()->session['$selectedcar']['year'];
    echo Yii::app()->session['$selectedcar']['price'];
    //echo Yii::app()->session['$selectedcar'];
    }
}
?>
