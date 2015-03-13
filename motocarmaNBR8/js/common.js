/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// apply datepicker to date fields.

$(document).ready(function(){
    if (typeof(dateFields) != "undefined") {
        $.each(dateFields, function (i, field) {
            applyDatePicker(field)
        });
    }


    $("#extruderBottom").buildMbExtruder({
        positionFixed: true,
        position: "bottom",
        width: 350,
        extruderOpacity: 1,
        autoCloseTime: false,
        closeOnExternalClick: false,
        // hidePanelsOnClose:false,
        onExtOpen: function () {
        },
        onExtContentLoad: function () {
        },
        onExtClose: function () {
        }
    });

});

function applyDatePicker(dateField){
    console.log('1');
    $(dateField).datepicker(
    {
     dateFormat:'yy-mm-dd',
     changeMonth: true,
     changeYear: true
    });
}

function removeGarageCar(cardId) {

    $.ajax({
        url: "index.php?r=ajax/removeGarageCar",
        type: 'GET',
        data: {'carId': cardId},
        success: function (data, textStatus, jqXHR) {
            $("#garageCar_" + cardId).remove();

            $(".extruder-container").html(data);
            $('#extruderBottom').openMbExtruder(true);
            $('#extruderLeft').openPanel()
        }
    });
}

function removeColumn(colId) {
    $(".col" + colId).remove();
}


function displayGarage() {
    $http({
        url: 'index.php?r=ajax/garageInfo'
    }).success(function (data, status, headers, config) {
        console.log(data);
    }).error(function (data, status, headers, config) {
        $scope.status = status + ' ' + headers;
        console.log('failed');
    });
}


function compareCars() {
    window.location.href = "index.php?r=deal/compare";
}

function buyThisCar(styleId) {
    window.location.href = "index.php?r=deal/setSelectedCar&styleId=" + styleId;
}


function loadDealerParams(dealerId) {
    $.ajax(
        {
            url: "index.php?r=ajax/getDealerParams",
            data: {'dealerId': dealerId},
            dataType: "json",
            headers: {'Content-Type': 'application/json'}
        }).done(function (result) {
            var msrp = parseFloat($("#paramMsrp").val());
            var total = parseFloat($("#paramMsrp").val());
            $("#paramDocFee").val(result.DocFee);
            total = total + parseFloat(result.DocFee);
            $("#paramSmog").val(result.Smog);
            total = total + parseFloat(result.Smog);
            $("#paramSmogCertFee").val(result.SmogCertFee);
            total = total + parseFloat(result.SmogCertFee);
            $("#paramTireFee").val(result.TireFee);
            total = total + parseFloat(result.TireFee);
            $("#paramLicenseFee").val(result.LicenseFee);
            total = total + parseFloat(result.LicenseFee);
            //$("#paramDmv").val(result.DmvEt); total = total + parseFloat(result.DmvEt);
            $("#paramDmAf").val(result.DmvAddiFee);
            //$("#paramRebate").val(result.rebate); total = total - parseFloat(result.rebate);

            $("#paramDmv").val($("#hiddenTMV").val());

            //total = total + (msrp * parseFloat(result.DmvEt))/100;
            total = total + parseFloat($("#hiddenTMV").val());
            //total = total + (msrp * parseFloat(result.DmvAddiFee))/100;
            total = total + parseFloat(result.DmvAddiFee);
            total = total + (msrp * parseFloat($("#Deal_SalesTax").val())) / 100;

            $("#paramTotal").val(total.toFixed(2));
        })
}

function makeOffer() {
    $("#Deal_Price").val($("#paramMsrp").val())

    if ($("#paramOfferPrice").val() == '') {
        $("#calculator-error").html('Please enter offer price.');
    } else {
        $("#Deal_Price").val($("#paramOfferPrice").val());
        $("#deal-form").submit();
    }
}

function acceptOffer() {
    $("#Deal_DealStatus_ID").val('1')

    changeOffer();
}

function changeOffer() {
    $("#Deal_Price").val($("#paramMsrp").val());
    //alert($("#Deal_Price").val());
    if ($("#paramOfferPrice").val() == '') {
        $("#calculator-error").html('Please enter offer price.');
    } else {
        $("#Deal_Price").val($("#paramOfferPrice").val());
        $("#deal-form").submit();
    }
}


function sendDealMessage() {
    subject = $("#Message_subject").val();
    body = $("#Message_body").val();
    receiverId = $("#" + $("#receiverIdField").val()).val();
    error = false;
    if ($.trim(subject) == '') {
        $("#error").html('Message body can not be blank.').show()
        error = true;
    } else {
        $("#error").hide();
    }
    $.ajax(
        {
            url: "index.php?r=ajax/sendDealMessage",
            data: {'subject': subject, 'body': body, 'receiverId': receiverId},
            type: 'post',
            dataType: 'json'
        }).done(function (result) {
            if (result.success == '1') {
                $("#error").html('Message sent successfully.')
                $("#error").show();
                $("#Message_subject").val('');
                $("#Message_body").val('');
            } else {
                $("#error").html('Error while sending the message.')
                $("#error").show();
            }
        })
}


function calcEmi() {


    var offerprice = parseFloat($("#Deal_OfferPrice").val());
    if (isNaN(offerprice) || offerprice == 0) {
        alert('Please enter offer price');
        return false;
    }
    var downpayment = parseFloat($("#paramDP").val());
    if (downpayment != '' && isNaN(downpayment)) {
        alert('Please enter valid Down Payment');
        return false;
    }
    else if (downpayment == '') {
        downpayment = 0;
    }

    var principle = offerprice - downpayment; // p
    var rate = parseFloat($("#paramAprPct").val()); // r
    var term = parseFloat($("#paramTerm").val()); // n

    $.ajax(
        {
            url: "index.php?r=ajax/calculateEmi",
            data: {'principle': principle, 'rate': rate, 'term': term},
            type: 'post'
        }).done(function (result) {
            $("#paramEmi").val(result);
        })


    /* if(rate != '' && isNaN(rate)){
     alert('Please enter valid APR');
     return false;
     }else if(rate == ''){
     rate = 0;
     }

     if(term < 0 || isNaN(term )){
     alert('Please enter valid APR');
     return false;
     }else if(term == 0){
     $("#paramEmi").val(principle);
     return true;
     }

     if(rate != 0) {
     var emi = (principle * rate * Math.pow((1 + rate), term)) / (Math.pow((1 + rate), term) - 1)
     }else{
     var emi = principle;
     }
     $("#paramEmi").val((emi/term).toFixed(2));*/
}


function fillSalesperson(dealerId) {
    $.ajax({
        url: "index.php?r=ajax/DealerSalesperson",
        data: {'dealerId': dealerId},
        dataType: "json",
        headers: {'Content-Type': 'application/json'}

    }).done(function (result) {
        $("#salesPersonInfo").val(JSON.stringify(result.salesperson));
        $("#Deal_SalesPerson_ID").parent().show();
        var spOptions = "<option> Select a Sales Person </option>";
        $.each(result.salesperson, function (i, sp) {
            spOptions += "<option value='" + sp.ID + "'>" + sp.FirstName + " " + sp.LastName + "</option>"

        });
        $("#Deal_SalesPerson_ID").html(spOptions)
    })
}

function showSuggestionNotFound(suggestions_length) {
    $(".dealerSuggest").hide();
    if ($("#Dealership_Name").val() != '' && suggestions_length <= 0) {
        $(".notFound").show();
    } else {
        $(".notFound").hide();
    }
}

function suggestDealer() {
    var dealerName = $("#Dealership_Name").val();
    if (dealerName == '') {
        alert('Please enter Dealer Name.')
    } else {
        $.ajax({
            url: "index.php?r=ajax/suggestDealer",
            type: 'post',
            data: {'dealerName': dealerName}

        }).done(function (result) {
            $(".notFound").hide();
            if (result == '1') {
                $(".dealerSuggest").show();
                $(".dealerSuggest").html('Thank you for suggesting a dealer. We will get back to you shortly on your suggestion.');
            } else {
                $(".dealerSuggest").show();
                $(".dealerSuggest").html('System Error: Please try again.');
            }

        })
    }
}