<?php
/**
 * Created by PhpStorm.
 * User: sandip.jadhav
 * Date: 18/01/2015
 * Time: 1:28 PM
 */
if(is_array($cars)){
?>
<ul id="miniGarage">
<?php

foreach($cars as $car){
    $objCar = json_decode($car, true);
    ?>
        <li id="garageCar_<?php echo $objCar['id']; ?>">
            <a href="javascript:void(0);" onClick="removeGarageCar('<?php echo $objCar['id']; ?>')">Remove</a>
             | <a href="javascript:void(0);" onClick="buyThisCar('<?php echo $objCar['id']; ?>')">Buy Car</a>
            <table>
                <tr>
                    <td><img src="<?php echo Yii::app()->customUtility->extractStylePhoto($objCar['id']);?>" style="height: 80px; width: 100px"></td>
                    <td>
                        <table>
                            <tr><td>Name : <?php echo $objCar['make']['name']; ?></td></tr>
                            <tr><td>Model: <?php echo $objCar['model']['name']; ?></td></tr>
                            <tr><td>Year: <?php echo $objCar['year']['year']; ?></td></tr>
                            <tr><td>Price: <?php echo $objCar['price']['baseMSRP']; ?></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
        </li>
    <?php
} ?>
</ul>
<div>
    <?php if(count($cars) > 0){ ?>
        <div style="padding:10px;"><a class="btn btn-md btn-primary" href="javascript:void(0)" onclick="compareCars()" role="button">Compare Cars</a></div>
      <!--  <input type="button" value="Compare Cars" href="javascript:void(0)" onclick="compareCars()" />-->
    <?php } ?>
</div>
<?php
}else{ ?>
    <div style="text-align: center; margin: 10px;"> No Cars in Wishlist</div>
<?php }
?>