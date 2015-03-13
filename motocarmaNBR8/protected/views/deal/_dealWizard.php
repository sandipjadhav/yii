<?php
/* @var $this DealController */
/* @var $model Deal */
/* @var $form CActiveForm */
?>
<div class="Table">
<div class="Row">
<div class="Cell" style="width: 40%; vertical-align: top">
    <div class="form" style="width: 100% ; padding-left: 15px">
        <div class="dealCarInfo">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'deal-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documenta
                // tion of CActiveForm for details on this.
                'enableAjaxValidation' => false,
            )); ?>
            <?php echo $form->errorSummary($model); ?>
            <?php echo $form->hiddenField($model, 'ID'); ?>
            <?php echo $form->hiddenField($model, 'Car_ID'); ?>
            <?php echo $form->hiddenField($model, 'User_ID'); ?>
            <?php echo $form->hiddenField($model, 'DealStatus_ID'); ?>
            <?php echo $form->hiddenField($model, 'DateAdded'); ?>
            <?php echo $form->hiddenField($model, 'LastModified'); ?>
            <?php echo $form->hiddenField($model, 'Dealership_ID'); ?>
            <?php echo $form->hiddenField($model, 'SalesPerson_ID'); ?>
            <?php echo $form->hiddenField($model, 'Price'); ?>
            <?php echo $form->hiddenField($model, 'StyleID'); ?>
            <?php echo $form->hiddenField($model, 'SalesTax'); ?>
            <input type="hidden" id="hiddenTMV"
                   value="<?php echo Yii::app()->customUtility->getDmvFromArray($arrCarInfo['Price']); ?>"/>
            <ul>
                <li>
                    <h3 class="viewTitle">Vehicle Details</h3>
                    <img id="carPhoto" style="height: 200px" src=""/>
                    <ul>
                        <li>Make: <?php echo $arrCarInfo['Make']; ?></li>
                        <li>Model: <?php echo $arrCarInfo['Model']; ?></li>
                        <li>Year: <?php echo $arrCarInfo['Year']; ?></li>
                        <li>TMV: <?php echo $tmvObj->tmv->nationalBasePrice->tmv; ?></li>

                    </ul>


                    <h3 class="viewTitle">Dealer Details</h3>
                    <ul>
                        <li>Name: <?php echo $dealer->getDealerName(); ?></li>
                        <li>Address : <?php echo $dealer->getDealerAddress(); ?></li>
                        <li>
                            Phone: <?php echo(trim($dealer->WorkPhone) == '' ? 'N/A' : trim($dealer->WorkPhone)); ?></li>
                        <li>Website: <?php echo $dealer->Website; ?></li>
                    </ul>
                </li>
                <li>
                    <h3 class="viewTitle">Salesperson Details</h3>
                    <ul>
                        <li>Name: <?php echo $salesperson->getSalespersonName(); ?></li>
                        <li>Email : <?php echo $salesperson->Email; ?></li>
                        <li>
                            Phone: <?php echo(trim($salesperson->ContactPhone) == '' ? 'N/A' : trim($salesperson->ContactPhone)); ?></li>
                        <li>Photo: <img src="<?php echo $salesperson->getPhoto(); ?>" style="width: 80px; height: 100px"
                            ?>
                        </li>
                    </ul>
                </li>
            </ul>
            <?php if (count($dealHistory) > 0) { ?>

                <script>
                    /*
                     * jQuery UI Dialog: Load Content via AJAX
                     * http://salman-w.blogspot.com/2013/05/jquery-ui-dialog-examples.html
                     */
                    $(function () {
                        $("#dialog").dialog({
                            autoOpen: false,
                            title: 'Deal history',
                            modal: true,
                            width: 700,
                            height: 600,
                            buttons: {
                                "Close": function () {
                                    $(this).dialog("close");
                                }
                            }
                        });
                        $(".dialogify").on("click", function (e) {
                            e.preventDefault();
                            $("#dialog").html("");
                            $("#dialog").dialog("option", "title", "Deal History").dialog("open");
                            $("#dialog").load(this.href, function () {
                                $(this).dialog("option", "title", 'Deal History');
                                $(this).find("h1").remove();
                            });
                        });
                    });
                </script>


                <div id="dialog" title="Deal History"></div>
                <a href="<?php echo $this->createUrl('ajax/dealhistory', array('dealId' => $model->ID)); ?>"
                   class="dialogify">Deal History</a>
            <?php } ?>
            <h4>Vehicle Reviews</h4>
            <?php if (count($reviews) > 0) { ?>

                <table>
                    <?php foreach ($reviews as $review) { ?>
                        <tr>
                            <td>
                                <b><?php echo $review->title; ?></b>

                                <p>
                                    <?php echo $review->text; ?></b>
                                </p>

                            </td>

                        </tr>
                        <tr>
                            <td>
                                Ratings :
                                <ul>
                                    <?php foreach ($review->ratings as $ratings) { ?>
                                        <?php
                                        $type = str_replace('_', ' ', $ratings->type);
                                        $type = ucwords(strtolower($type));
                                        ?>
                                        <li><?php echo $type . " : " . $ratings->value . '/5'; ?></li>
                                    <?php } ?>
                                </ul>
                            </td>
                        </tr>
                    <? } ?>
                </table>
            <?php
            } else {
                echo "No Reviews Found";
            } ?>

            <!--div class="row buttons" style="display: none">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Make an offer' : 'Save'); ?>
                    </div-->
        </div>

    </div>
</div>
<!-- form -->
<div class="Cell" style="width: 60%">
    <h3 class="viewTitle">Calculator</h3>
    <span style="color: red" id="calculator-error"></span>

    <div class="calculator">
        <div class="Table">
            <div class="Row">
                <div class="Cell calcCell">
                    <div><label for="paramMsrp">MSRP:</label> <input class="readonly" type="text" name="paramMsrp"
                                                                     id="paramMsrp"
                                                                     value="<?php echo number_format($arrCarInfo['Price'], 2, '.', '') ?>">
                    </div>
                    <!--div><label for="paramDocFee" >Documentation Fee:</label><input class="dealer-readonly" type="text" name="paramDocFee" id="paramDocFee" value="<?php echo $model->DocFee; ?> " > </div>
                                <div><label for="paramSmog" >Smog:</label><input class="dealer-readonly" type="text" name="paramSmog" id="paramSmog" value="<?php echo $model->Smog; ?> " > </div>
                                <div><label for="paramSmogCertFee" >Smog Cert Fee:</label> <input class="dealer-readonly" type="text" name="paramSmogCertFee" id="paramSmogCertFee" value="<?php echo $model->SmogCertFee; ?> "> </div>
                                <div><label for="paramTireFee" >Tire Fee:</label> <input class="dealer-readonly" type="text" name="paramTireFee" id="paramTireFee" value="<?php echo $model->TireFee; ?> "> </div-->
                    <div><label for="paramDmv">DMV:</label><input class="dealer-readonly" type="text" name="paramDmv"
                                                                  id="paramDmv" value="<?php echo $model->DmvEt; ?> ">
                    </div>
                    <!--div><label for="paramDmAf" >DMV Additional Fee%:</label><input class="dealer-readonly" type="text" name="paramDmAf" id="paramDmAf" value="<?php echo $model->DmvAddiFee; ?> "> </div>
                                <div><label for="paramLicenseFee" >License Fee:</label> <input class="dealer-readonly" type="text" name="paramLicenseFee" id="paramLicenseFee" value="<?php echo $model->LicenseFee; ?> "> </div-->
                    <!--div><label for="paramRebate" >Rebate:</label> <input class="dealer-readonly" type="text" name="paramRebate" id="paramRebate" value="<?php echo $model->rebate; ?> "> </div-->
                    <input class="dealer-readonly" type="hidden" name="paramRebate" id="paramRebate" value="0.00">
                    <?php
                    $salesTaxAmount = ($arrCarInfo['Price'] * $model->SalesTax) / 100;
                    $total = $arrCarInfo['Price'] + $model->DocFee + $model->Smog + $model->SmogCertFee + $model->TireFee + $model->DmvEt + $model->DmvAddiFee + $model->LicenseFee + $salesTaxAmount;
                    ?>
                    <div><label>Sales Tax Rate:</label> <span
                            id="salesTaxTxt"><?php echo number_format($model->SalesTax, 2, '.', ''); ?>%</div>
                    <div><label for="paramSalesTax"/>Sales Tax Amount:</label> <input class="dealer-readonly readonly"
                                                                                      type="text" name="paramSalesTax"
                                                                                      id="paramSalesTax"
                                                                                      value="<?php echo number_format($salesTaxAmount, 2, '.', '') ?>">
                    </div>
                    <div><label for="paramTotal">Total:</label><input class="dealer-readonly" readonly type="text"
                                                                      name="paramTotal" id="paramTotal"
                                                                      value="<?php echo $total; ?>"></div>

                </div>
                <div class="Cell calcCell">
                    <div><label for="paramOfferPrice">Offer
                            Price:</label><?php echo $form->textField($model, 'OfferPrice', array('class' => 'customer-readonly')); ?>
                        <!--input class="customer-readonly" type="text" name="paramOfferPrice" id="paramOfferPrice" value="<?php echo $model->OfferPrice; ?>" -->
                    </div>
                    <div><label for="paramDP"/>Down Payment:</label><input class="customer-readonly" type="text"
                                                                           name="paramDP" id="paramDP"
                                                                           value="<?php echo $model->DownPayment ?>">
                    </div>
                    <div><label for="APR Percentage"/>APR Percentage: </label> <input class="customer-readonly"
                                                                                      type="text" name="paramAprPct"
                                                                                      id="paramAprPct"
                                                                                      value="<?php echo $model->Apr ?>">
                    </div>
                    <div><label for="Term"/>Term: </label> <input class="customer-readonly" type="text" name="paramTerm"
                                                                  id="paramTerm" value="<?php echo $model->term ?>">
                    </div>
                    <?php
                    if ($model->ID != null && ($model->Apr * $model->term) != 0) {
                        $principle = $model->OfferPrice - $model->DownPayment;
                        $emi = Yii::app()->customUtility->emiCalculator($principle, $model->Apr, $model->term);
                    } else {
                        $emi = '0.00';
                    }
                    ?>
                    <div><label for="Emi"/> Per Month </label>: <input class="customer-readonly" readonly type="text"
                                                                       name="paramEmi" id="paramEmi"
                                                                       value="<?php echo number_format($emi, 2, '.', ''); ?>">
                    </div>
                    <div><input type="button" Value="Calculate" name="btncalc" id="btncalc" onclick="calcEmi()"></div>


                </div>
            </div>
        </div>
        <!--div class="calCol">


        </div>
        <div class="calCol" style="">

        </div -->

    </div>
    <div>
        <?php if ($currentRole == 'authenticated') { ?>
            <?php if ($model->ID != null) { ?>
                Counter Offer : <?php echo $model->CounterOffer; ?>
                <p><input type="button" id="MakeOffer" name="MakeOffer" value="Accept Offer" onclick="acceptOffer()"/> |
                    <input type="button" id="MakeOffer" name="MakeOffer" value="Update Offer" onclick="changeOffer()"/>
                </p>

            <? } else { ?>
                <p><input type="button" id="MakeOffer" name="MakeOffer" value="Make an Offer" onclick="makeOffer()"/>
                </p>

            <?php } ?>
        <?php } elseif ($currentRole == 'salesperson' || $currentRole == 'dealer') { ?>
            <p>
            <div><label for="paramCounterOffer"/>Counter Offer </label>
                : <?php echo $form->textField($model, 'CounterOffer'); ?> </div>
            <!--input type="text" id="CounterOffer" name="CounterOffer" value="<?php echo $model->CounterOffer; ?>"/ --> </p>

            <p><input type="button" id="MakeOffer" name="MakeOffer" value="Update Offer" onclick="changeOffer()"/></p>
        <?php } ?>
    </div>
    <!--/div-->
    <!--div class="Cell" style="width: 33%" -->
    <?php if (count($dealHistory) > 0) { ?>
        <!--div>
                    <h3 class="viewTitle" >Deal History</h3>
                    <div class="Table">
                        <div class="Heading">
                            <div class="Cell" style="width: 10%">Date</div>
                            <div class="Cell" style="width: 10%">Description</div>
                            <div class="Cell" style="width: 10%">Name</div>
                        </div>
                        <?php
        $i = 0;
        foreach ($dealHistory as $index => $dl) {
            ?>
                        <div class="Row">
                            <div class="Cell" style="width: 20%"><?php //echo date(Yii::app()->getModule('message')->dateFormat, strtotime($dl->Created_Date)) ?></div>
                            <div class="Cell" style="width: 60%"> <?php
            if ($i == 0) {
                echo "New deal created.";
            } else {
                echo "Deal changes:<br/>";
                /*$arrParams = json_decode($dl->ChangedParams, true);
                $strParams = array();
                $dParams = new DealerParams();
                $dParamsLabels = $dParams->attributeLabels();
                foreach($arrParams as  $pName => $param){
                    $strParams[] =  $dParamsLabels[$pName] . " Changed from ". $param['old']."To ".$param['new'];
                }
                echo implode('<br/>',$strParams);*/

            }?> </div>
                            <div class="Cell" style="width: 20%"><?php //echo $dl->getUserName(); ?> </div>
                        </div>
                        <?php $i++;
        } ?>
                    </div>
                </div -->
    <?php } ?>
    <div>
        <h3>Send message to Dealer/Salesperson</h3>

        <div class="form">
            <span id="error"></span>
            <?php if ($currentRole == 'authenticated') { ?>
                <input type='hidden' id="receiverIdField" value="Deal_SalesPerson_ID"/>
            <?php } else { ?>
                <input type='hidden' id="receiverIdField" value="Deal_User_ID"/>
            <?php } ?>

            <div class="row">
                <label class="required" for="Message_subject">Subject</label>
                <?php echo $form->textField($msgModel, 'subject', array('style' => 'width:270px')); ?>
            </div>

            <div class="row">
                <label class="required" for="Message_body">Body</label>
                <?php echo $form->textArea($msgModel, 'body', array('style' => 'width:370px;height:120px')); ?>
            </div>

            <div class="row buttons">
                <p><input type="button" id="send" name="send" value="Send" onclick="sendDealMessage()"/></p>
            </div>

        </div>
    </div>
</div>
</div>

</div>



<?php $this->endWidget(); ?>
<script type="text/javascript">
    var style_id = $("#Deal_StyleID").val();
    $(document).ready(function(){
        $(".readonly").attr('readonly', true);
        <?php if($currentRole == 'authenticated') { ?>
        $(".dealer-readonly").attr('readonly', true);
        <?php }else{ ?>
        $(".customer-readonly").attr('readonly', true);
        <?php } ?>
        if ($("#Deal_ID").val() == '') {
            loadDealerParams($("#Deal_Dealership_ID").val());
        }


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
                spOptions += "<option value='" + sp.ID + "'>" + sp.FirstName + " " + sp.LastName + "</option>"
                
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

        var salespersonInfo = $("#salesPersonInfo").val();
        if (salespersonInfo != '') {
            salespersonInfo = $.parseJSON(salespersonInfo);

            $.each(salespersonInfo, function (i, sp) {
                if (sp.ID == $("#Deal_SalesPerson_ID option:selected").val()) {
                    $("#spName").html(sp.FirstName + ' ' + sp.LastName);
                    $("#spEmail").html(sp.email);
                    $("#spPhone").html(sp.ContactPhone);
                    $('#spPhoto').attr('src', sp.Photo)
                }
            });

            var dealerId = $("#Deal_Dealership_ID").val();
            $.ajax(
                {
                    url: "<?php echo Yii::app()->createUrl('ajax/getDealerParams'); ?>",
                    data: {'dealerId': dealerId},
                    dataType: "json",
                    headers: {'Content-Type': 'application/json'}
                }).done(function (result) {
                    var total = parseFloat($("#paramMsrp").val());
                    $("#paramDocFee").val(result.DocFee);
                    total = total + parseFloat(result.DocFee);
                    $("#paramSmog").val(result.Smog);
                    total = total + parseFloat(result.Smog);
                    $("#paramSmogCertFee").val(result.SmogCertFee);
                    total = total + parseFloat(result.SmogCertFee);
                    $("#paramTireFee").val(result.TireFee);
                    total = total + parseFloat(result.TireFee);
                    //$("#paramDmv").val(result.DmvEt); total = total + parseFloat(result.DmvEt);
                    $("#paramDmv").val($("#hiddenTMV").val());
                    total = total + parseFloat($("#hiddenTMV").val());
                    $("#paramDmAf").val(result.DmvAddiFee);
                    total = total + parseFloat(result.DmvAddiFee);
                    $("#paramLicenseFee").val(result.LicenseFee);
                    total = total + parseFloat(result.LicenseFee);

                    $("#paramTotal").val(total.toFixed(2));
                })

        }
        $("#DealerInfo").html($("#Dealership_Name").val());

    }
</script>
