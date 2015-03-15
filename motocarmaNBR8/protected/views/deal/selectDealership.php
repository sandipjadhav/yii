<h3 class="viewTitle">Select a Dealer and Sales Person</h3>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'deal-form',
    'action'=>Yii::app()->createUrl('/deal/create'),
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documenta
    // tion of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAhMTDTth7NehPtNO20J7G8_gGdhdl5XWw"></script>
<?php echo CHtml::scriptFile(Yii::app()->request->baseUrl . "/js/dealerMap.js");
?>
<?php echo CHtml::hiddenField('submitPage' , 'DealerSelect', array('id' => 'submitPage')); ?>
    <div class="Table" style="width: 100%">
        <div class="Row"  style="height: 200px">
            <div class="Cell" style="width: 50%">
                    <div class="row dealership" style="margin-right: 10px">
                        <label for="ZipCode" class="required">Zip Code <span class="required">*</span></label>
                        <input type="text" name="ZipCode" id="ZipCode"><br/>
                        <?php
                            echo $form->labelEx($model,'Dealership_ID');

                        $dealModel = new Dealership();
                        $this->widget('ext.typeahead.TbTypeAhead',array(
                            'model' => $dealModel,
                            'attribute' => 'Name',
                            'enableHogan' => true,
                            'options' => array(
                                array(
                                    'name' => 'DealershipSuggest',
                                    'valueKey' => 'name',
                                    'remote' => array(
                                        'url' => Yii::app()->createUrl('/ajax/dealsershipList') . '&term=%QUERY&make='.$arrCarInfo['Make'],
                                    ),
                                    'template' => '<p>{{name}}</p>',
                                    'engine' => new CJavaScriptExpression('Hogan'),
                                )
                            ),
                            'events' => array(
                                'selected' => new CJavascriptExpression("function(obj, datum, name) {
                                        $('#Deal_Dealership_ID').val(datum.id)
                                        getSalesperson();
                                        //console.log(datum.id);
                                        console.log(datum);
                                        //console.log(name);
                                     }")
                            ),
                        ));
                        ?>
                        <div class="notFound" style="display: none">
                            <span style="color: red">Sorry. We could not find any dealer with entered details.</span><br/>
                            To suggest us about this dealer please type dealer name in above text box
                            and click <input type="button" value="Here" onclick="suggestDealer()"/>.
                        </div>
                        <div class="dealerSuggest" style="display: none">

                        </div>

                        <?php echo $form->hiddenField($model,'Dealership_ID'); ?>
                        <?php echo $form->error($model,'Dealership_ID'); ?>
                    </div>

                    <div class="row salesperson" style="display:none">
                        <?php echo $form->labelEx($model,'SalesPerson_ID'); ?>
                        <select id="Deal_SalesPerson_ID" name="Deal[SalesPerson_ID]" onchange="showDealPreview()">
                            <option value="0"> Select </option>
                        </select>
                        <input type="hidden" name="salesPersonInfo" id="salesPersonInfo"/>
                        <?php echo $form->error($model,'SalesPerson_ID'); ?>
                    </div>
            </div>
            <div class="Cell">
                <h3>Find Dealer in Map</h3>
                <input type="button" name="btnGetMapDealers" id="btnGetMapDealers" value="Find Nearby Dealer" onclick="populateMap()"><br/>
                <br/>
                <div id="googleMap" style="height: 400px; width: 400px">

                </div>

            </div>
        </div>
    </div>

<div class="row dealPreview" style="display:none">
    <ul>
        <li><div>Dealer : <span id="DealerInfo"></span></div></li>
        <li><div>Sales Person :
                <div id="SalesPersonInfo">
                    <ul>
                        <li>Name: <span id="spName"></span></li>
                        <li>Email: <span id="spEmail"></span></li>
                        <li>Phone: <span id="spPhone"></span></li>
                        <li>Photo: <img id="spPhoto" style="height: 50px;width: 50px"/></li>
                    </ul>
                </div></div></li>
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
<br/>
<br/>
<?php $this->endWidget(); ?>

<script type="text/javascript">
    var style_id = $("#hidStyleId").text();
    $(document).ready(function(){
        $(".readonly").attr('readonly',true);
        <?php if($currentRole == 'authenticated') { ?>
        $(".dealer-readonly").attr('readonly',true);
        <?php }else{ ?>
        $(".customer-readonly").attr('readonly',true);
        <?php } ?>

        $("#Dealership_Name").focus(function(){
            if($.trim($("#ZipCode").val()) == ''){
                alert('Please enter Zip code.') ;
                $("#ZipCode").focus();
            }
        });


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
                $("#salesPersonInfo").val(JSON.stringify(result.salesperson));
                $("#Deal_SalesPerson_ID").parent().show();
                var spOptions = "<option> Select a Sales Person </option>";
                $.each(result.salesperson,function(i,sp){
                    spOptions +="<option value='"+sp.ID+"'>"+sp.FirstName+" "+sp.LastName+"</option>"

                });
                $("#Deal_SalesPerson_ID").html(spOptions)
            })
        }
    }

    function showDealPreview(){

        $("#deal-form").submit();
        /*
        $(".dealership").hide();
        $(".salesperson").hide();
        $(".viewTitle").text("Vehicle Details");
        $(".dealPreview").show();
        $(".userPrice").show();
        $(".buttons").show();

        var salespersonInfo = $("#salesPersonInfo").val();
        if(salespersonInfo != ''){
            salespersonInfo = $.parseJSON(salespersonInfo);

            $.each(salespersonInfo,function(i,sp){
                if(sp.ID == $("#Deal_SalesPerson_ID option:selected").val()){
                    $("#spName").html(sp.FirstName + ' ' + sp.LastName);
                    $("#spEmail").html(sp.email);
                    $("#spPhone").html(sp.ContactPhone);
                    $('#spPhoto').attr('src',sp.Photo)
                }
            });

            var dealerId = $("#Deal_Dealership_ID").val();
            $.ajax(
                {
                    url: "<?php echo Yii::app()->createUrl('ajax/getDealerParams'); ?>",
                    data: {'dealerId': dealerId},
                    dataType: "json",
                    headers: {'Content-Type': 'application/json'}
                }).done(function ( result ) {
                    var total = parseFloat($("#paramMsrp").val());
                    $("#paramDocFee").val(result.DocFee); total = total + parseFloat(result.DocFee);
                    $("#paramSmog").val(result.Smog);  total = total + parseFloat(result.Smog);
                    $("#paramSmogCertFee").val(result.SmogCertFee); total = total + parseFloat(result.SmogCertFee);
                    $("#paramTireFee").val(result.TireFee); total = total + parseFloat(result.TireFee);
                    $("#paramDmv").val(result.DmvEt); total = total + parseFloat(result.DmvEt);
                    $("#paramDmAf").val(result.DmvAddiFee); total = total + parseFloat(result.DmvAddiFee);
                    $("#paramLicenseFee").val(result.LicenseFee); total = total + parseFloat(result.LicenseFee);

                    $("#paramTotal").val(total.toFixed(2));
                })

        }
        $("#DealerInfo").html($("#Dealership_Name").val());
        */
    }

    function populateMap(){

    }

</script>