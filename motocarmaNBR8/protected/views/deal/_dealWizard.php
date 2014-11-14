<?php
/* @var $this DealController */
/* @var $model Deal */
/* @var $form CActiveForm */
?>
<h3 class="viewTitle">Select a Dealer and Sales Person</h3>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'deal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documenta
        // tion of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'ID'); ?>
	<?php echo $form->hiddenField($model,'Car_ID'); ?>
        <?php echo $form->hiddenField($model,'User_ID'); ?>
	<?php echo $form->hiddenField($model,'DealStatus_ID'); ?>
	<?php echo $form->hiddenField($model,'DateAdded'); ?>
	<?php echo $form->hiddenField($model,'LastModified'); ?>
        <div class="row dealership">
		<?php echo $form->labelEx($model,'Dealership_ID'); ?>
            <?php echo $form->dropDownList($model,'Dealership_ID', 
                            $model->getAllDealerships(), 
                            array('empty'=> 'Select a dealer',
                                'onchange'=>'getSalesperson()')
                        ); ?>
                <?php echo $form->error($model,'Dealership_ID'); ?>
	</div>
        
        <div class="row salesperson" style="display:none">
		<?php echo $form->labelEx($model,'SalesPerson_ID'); ?>
            <select id="Deal_SalesPerson_ID" name="Deal[SalesPerson_ID]" onchange="showDealPreview()">
                <option value="0"> Select </option>
            </select>
		<?php echo $form->error($model,'SalesPerson_ID'); ?>
	</div>
       
        <div class="row dealPreview" style="display:none">
            <ul>
                <li><div>Dealer : <span id="DealerInfo"></span></div></li>
                <li><div>Sales Person : <span id="SalesPersonInfo"></span></div></li>
                <li>Car Selected : 
                    <div id="CarInfo">
                        <ul> 
                            <li>Make: <span id="carName"><?php echo $arrCarInfo['Make'] ; ?></span></li>
                            <li>Model: <span id="carModel"><?php echo $arrCarInfo['Model'] ; ?></span></li>
                            <li>Year: <span id="carYear"><?php echo $arrCarInfo['Year'] ; ?></span></li>
                            <li>Price: <span id="carPrice"><?php echo $arrCarInfo['Price'] ; ?></span></li>
                            <li><span id="hidStyleId"style="display:none"><?php echo $arrCarInfo['StyleID'] ; ?></span>
                                <img id="carPhoto" style="width:100px;height:100px" src=""/>
                            </li>
                        </ul>       
                    </div>
                </li>
            </ul>
        </div>
        <div class="row userPrice" style="display:none">
		<?php echo $form->labelEx($model,'Price'); ?>
		<?php echo $form->textField($model,'Price',array('size'=>15,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Price'); ?>
	</div>


        <div class="row buttons" style="display: none">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Make an offer' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    var style_id = $("#hidStyleId").text();
    $(document).ready(function(){
    $.ajax({
        'url':'https://api.edmunds.com/v1/api/vehiclephoto/service/findphotosbystyleid?styleId='+style_id+'&fmt=json&api_key=mexvxqeke9qmhhawsfy8j9qd',
        'dataType':'json',
        'success': function(result){
            
                var photoUrl;
                var noPhoto = true;
                var car;
                for (i = 0; i < result.length; i++)
                {
                    car = result[i];
                    if (car.shotTypeAbbreviation === 'S') {
                        //code
                        photoUrl = car.photoSrcs[0];
                        noPhoto = false;
                        break;
                    }
                }
                if (noPhoto === true) {
                    car = result[0];
                    photoUrl = car.photoSrcs[0];
                }
            
           console.log(photoUrl)
           $("#carPhoto").attr('src','http://media.ed.edmunds-media.com/'+photoUrl);
        }
    });
});
    
    function getSalesperson(){
        var dealerId = $("#Deal_Dealership_ID").val();

        console.log($("#Deal_Dealership_ID").val()) 
        if(dealerId !=''){
        $.ajax({
            url: "<?php echo Yii::app()->createUrl('ajax/DealerSalesperson'); ?>",
            data: {'dealerId':dealerId},
            dataType: "json",
            headers: {'Content-Type': 'application/json'}

          }).done(function ( result ) {
              $("#Deal_SalesPerson_ID").parent().show();
              var spOptions = "<option> Select a Sales Person </option>";
            $.each(result.salesperson,function(i,sp){
                spOptions +="<option value='"+sp.ID+"'>"+sp.Name+"</option>"
                
            });
            $("#Deal_SalesPerson_ID").html(spOptions)
          })
          }
    }
    
    function showDealPreview(){
        $(".dealership").hide();
        $(".salesperson").hide();
        $(".viewTitle").text("Vehicle Details");
        $(".dealPreview").show();
        $(".userPrice").show();
        $(".buttons").show();
        
        
        
        $("#DealerInfo").html($("#Deal_Dealership_ID option:selected").text());
        $("#SalesPersonInfo").html($("#Deal_SalesPerson_ID option:selected").text());
    }
</script>
