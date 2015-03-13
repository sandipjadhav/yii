Admin Home
<?php
if (Yii::app()->user->isguest === false)
{
    if(Yii::app()->getModule('user')->isAdmin()) {
    ?>
    <ul>
        <li><?php echo CHtml::link('Users', array('/user/user/index')); ?></li>
        <li><?php echo CHtml::link('Dealerships', array('dealership/index')); ?></li>
        <li><?php echo CHtml::link('Sales Persons', array('salesPerson/index')); ?></li>
        <li><?php echo CHtml::link('Deal', array('deal/index')); ?></li>
        <li><?php echo CHtml::link('Cars', array('car/index')); ?></li>
        <li><?php echo CHtml::link('SavedCars', array('savedCars/index')); ?></li>
        <li><?php echo CHtml::link('Search History', array('searchHistory/index')); ?></li>
        <li><?php echo CHtml::link('Deal History', array('dealHistory/index')); ?></li>
    </ul>
    <?php
}
}?>



