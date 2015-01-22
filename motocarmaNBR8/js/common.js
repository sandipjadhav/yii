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