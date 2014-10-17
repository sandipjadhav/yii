Admin Home
<?php
if (Yii::app()->user->isguest === false)
{
    if(Yii::app()->getModule('user')->isAdmin()) {
    ?>
    <ul>
        <li><?php echo CHtml::link('Users', array('/user/user/index')); ?></li>
        <li><?php echo CHtml::link('Dealerships', array('dealership/index')); ?></li>
        <li><?php echo CHtml::link('Sales Persons', array('salesperson/index')); ?></li>
        <li><?php echo CHtml::link('Deal', array('deal/index')); ?></li>
        <li><?php echo CHtml::link('Cars', array('car/index')); ?></li>
        <li><?php echo CHtml::link('SavedCars', array('savedcars/index')); ?></li>
        <li><?php echo CHtml::link('Search History', array('searchhistory/index')); ?></li>
        <li><?php echo CHtml::link('Deal History', array('dealhistory/index')); ?></li>
    </ul>
    <?php
}
}?>



