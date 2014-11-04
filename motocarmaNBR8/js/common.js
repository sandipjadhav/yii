/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// apply datepicker to date fields.

$(document).ready(function(){
    if(typeof(dateFields)!="undefined"){
        $.each(dateFields,function(i,field){
            applyDatePicker(field)
        });
    }
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

