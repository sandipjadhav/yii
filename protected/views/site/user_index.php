<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (Yii::app()->user->isguest === false)
{
?>
User Home
<ul>
        <!--TODO SK : Deals, dealership and sales persons need to be filtered by Dealership  -->
                <li><?php echo CHtml::link('Profile', array('user/profile')); ?></li>
                <li><?php echo CHtml::link('Deals', array('deal/index')); ?></li>
                <li><?php echo CHtml::link('Saved Cars', array('savedcars/index')); ?></li>
            </ul>
<?php

$selectedcar = Yii::app()->session['$selectedcar'];
echo Yii::app()->session['$selectedcar']['make'];
echo Yii::app()->session['$selectedcar']['model'];
echo Yii::app()->session['$selectedcar']['year'];
echo Yii::app()->session['$selectedcar']['price'];
//echo Yii::app()->session['$selectedcar'];
}
?>
