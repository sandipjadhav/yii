<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Messages:inbox"); ?>
<?php
	//$this->breadcrumbs=array(
		//MessageModule::t("Messages"),
		//MessageModule::t("Inbox"),
	//);
?>
<div class="full-wide-contact">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/guy-beach.jpg"
         alt="Guy on the beach with his laptop">

   <!-- <div class="over-text-inbox">Inbox

    </div>-->
</div>
<h2><?php echo MessageModule::t('Inbox'); ?></h2>
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_styles') ?>
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_flash') ?>
<div id="container" class="page">
<div class="row">
	<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>
	
		

		<?php if ($messagesAdapter->data): ?>
			<?php $form = $this->beginWidget('CActiveForm', array(
				'id'=>'message-delete-form',
				'enableAjaxValidation'=>false,
				'action' => $this->createUrl('delete/')
			)); ?>

			<table class="bordered-table zebra-striped">
				<tr>
					<th class="from-to">From</th>
					<th>Subject</th>
					<th>Date</th>
				</tr>
				<?php foreach ($messagesAdapter->data as $index => $message): ?>
					<tr class="<?php echo $message->is_read ? 'read' : 'unread' ?>">
						<td>
							<?php echo CHtml::checkBox("Message[$index][selected]"); ?>
							<?php echo $form->hiddenField($message,"[$index]id"); ?>
							<?php echo $message->getSenderName(); ?>
						</td>
						<td><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></td>
						<td><span class="date"><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></td>
					</tr>
				<?php endforeach ?>
			</table>

			<div>
				<button class="btn danger"><?php echo MessageModule::t("Delete Selected") ?></button>
			</div>

		<?php $this->endWidget(); ?>
		<div class="pagination">
			<?php $this->widget('CLinkPager', array('header' => '', 'pages' => $messagesAdapter->getPagination(), 'htmlOptions' => array('class' => 'pager'))) ?>
		</div>
		<?php endif; ?>

</div>
</div> <!-- end container -->
