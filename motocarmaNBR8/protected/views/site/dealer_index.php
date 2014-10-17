<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (Yii::app()->user->isguest === false)
{
?>
Dealer Home
<ul>
        <!--TODO SK : Deals, dealership and sales persons need to be filtered by Dealership  -->
                <li><?php echo CHtml::link('Deals', array('deal/index')); ?></li>
                <li><?php echo CHtml::link('Update Dealership', array('dealership/index')); ?></li>
                <li><?php echo CHtml::link('Sales Persons', array('salesperson/index')); ?></li>
            </ul>
<?php
}
?>

