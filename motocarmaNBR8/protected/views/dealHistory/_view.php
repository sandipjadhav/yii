<?php
/* @var $this DealHistoryController */
/* @var $data DealHistory */
?>

<div class="view">

	<b></b>
	<?php echo CHtml::link('View', array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Car_ID')); ?>:</b>
	<?php echo CHtml::encode($data->car->Make); ?>
	<br />
        <!--
	<b><?php echo CHtml::encode($data->getAttributeLabel('Deal_ID')); ?>:</b>
	<?php echo CHtml::encode($data->Deal_ID); ?>
	<br />
        -->
	<b><?php echo CHtml::encode($data->getAttributeLabel('DealStatus_ID')); ?>:</b>
	<?php echo CHtml::encode($data->dealStatus->DealStatus); ?>
	<br />
    <?php if ($data->salesPerson && $data->salesPerson->user && $data->salesPerson->user->profile) { ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('SalesPerson_ID')); ?>:</b>
	<?php echo CHtml::encode($data->salesPerson->user->profile->getAttribute('firstname')." ".$data->salesPerson->user->profile->getAttribute('lastname')); ?>
	<br />
    <?php } ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('User_ID')); ?>:</b>
	<?php echo CHtml::encode($data->user->username); ?>
	<br />
    <?php
    $arrParams = json_decode($data->ChangedParams, true);
    $strParams = array();
    $dParams = new DealerParams();
    $dParamsLabels = $dParams->attributeLabels();
    //print_r($arrParams);
    if (count($arrParams) > 0) {
        foreach ($arrParams as $pName => $param) {
            $strParams[] = $dParamsLabels[$pName] . " Changed from " . $param['old'] . " To " . $param['new'];
        }
        echo implode('<br/>', $strParams);
    }
    ?>
    <br/>
	<b><?php echo CHtml::encode($data->getAttributeLabel('DealStatus')); ?>:</b>
	<?php echo CHtml::encode($data->DealStatus); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Make')); ?>:</b>
	<?php echo CHtml::encode($data->Make); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Model')); ?>:</b>
	<?php echo CHtml::encode($data->Model); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Price')); ?>:</b>
	<?php echo CHtml::encode($data->Price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SalesPersonUserName')); ?>:</b>
	<?php echo CHtml::encode($data->SalesPersonUserName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('StyleID')); ?>:</b>
	<?php echo CHtml::encode($data->StyleID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Year')); ?>:</b>
	<?php echo CHtml::encode($data->Year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserName')); ?>:</b>
	<?php echo CHtml::encode($data->UserName); ?>
	<br />

	*/ ?>

</div>