<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (Yii::app()->user->isguest === false)
{
?>
Sales Person Home
<ul>
    <!--TODO SK : Deals and messages need to be filtered by Sales Person  -->
                <li><?php echo CHtml::link('Deals', array('deal/index')); ?></li>
                <li><?php echo CHtml::link('Profile', array('user/profile')); ?></li>
                <li>
                    <?php echo CHtml::link('Messages', 
                    array('url' => Yii::app()->getModule('message')->inboxUrl,
					'label' => 'Messages' .
					    (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) ?
						' (' . Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) . ')' :
						''),
					'visible' => !Yii::app()->user->isGuest)); ?>
                </li>
            </ul>
<?php
}
?>


