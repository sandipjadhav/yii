<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ 
if (Yii::app()->user->isguest === false)
{
    if(isset($message) && $message == 'dealSuccess'){
?>
    <div class='flash-success'>
        Your offer has been successfully submitted. The dealership will review the offer and will respond within 72 hours.
    </div>
    <?php } ?>

<script>
    var style_id = '<?php echo $arrCarInfo['StyleID'] ; ?>';
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
</script>

User Home
<ul>
        <!--TODO SK : Deals, dealership and sales persons need to be filtered by Dealership  -->
                <li><?php echo CHtml::link('Profile', array('user/profile')); ?></li>
                <li><?php echo CHtml::link('Deals', array('deal/index')); ?></li>
                <li><?php echo CHtml::link('Saved Cars', array('savedCars/index')); ?></li>
            </ul>

<ul>
                <li>Recent Car Selected : 
                    <div id="CarInfo">
                        <ul>
                            <li>Make: <span id="carName"><?php echo $arrCarInfo['Make'] ; ?></span></li>
                            <li>Model: <span id="carModel"><?php echo $arrCarInfo['Model'] ; ?></span></li>
                            <li>Year: <span id="carYear"><?php echo $arrCarInfo['Year'] ; ?></span></li>
                            <li>Price: <span id="carPrice"><?php echo $arrCarInfo['Price'] ; ?></span></li>
                            <li><img src="" id="carPhoto" style="height:200px;width:200px" /> </li>
                        </ul>       
                    </div>
                </li>
            </ul>

<?php
    if($guestStyleExists && $guestStyleExists !=''){
        echo CHtml::link('Make an offer', array('deal/create'));
    }
}
?>
