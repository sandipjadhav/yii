<?php
/**
 * Created by PhpStorm.
 * User: sandip.jadhav
 * Date: 20/01/2015
 * Time: 10:00 PM
 */

$attrbutes = Yii::app()->params['COMPARE_ATTRIBUTES'];
$carArray = array();
foreach ($savedCars as $car) {
    $carArray[] = json_decode($car, true);
}

//var_dump($carArray[0]);
?>
<div class="container">
    <?php if (count($savedCars) > 0) { ?>
        <div class="Table">
            <div class="Title">
                <p>Compare Cars</p>
            </div>
            <div class="Heading">
                <div class="Cell">
                    <p></p>
                    <?php if (count($carArray) < Yii::app()->params['MAX_GARAGE_COUNT']) { ?>
                        <a href="index.php?r=site/index">Add Cars</a>
                    <?php } ?>
                </div>
                <?php foreach ($carArray as $i => $car) { ?>
                    <div class="Cell col<?php echo $i; ?> compareCell">
                        <a href="javascript:void(0)"
                           onclick="removeGarageCar('<?php echo $carArray[$i]['id']; ?>'); removeColumn('<?php echo $i; ?>');">Remove</a>

                        <p><?php echo $carArray[$i]['make']['name'] ?></p>

                        <div
                            style="width: 100%; height: 100%"><?php $photo = Yii::app()->customUtility->extractStylePhoto($carArray[$i]['id']); ?>
                            <img src="<?php echo $photo ?>" style="width: 100%; height: 100%"/>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php foreach ($attrbutes as $attr) { ?>
                <div class="Row">
                    <div class="Cell">
                        <p> <?php echo $attr; ?></p>
                    </div>
                    <?php foreach ($carArray as $i => $car) { ?>
                        <div class="Cell col<?php echo $i; ?> compareCell">
                            <p><?php echo Yii::app()->customUtility->extractCarAttrValue($carArray[$i], $attr); ?></p>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="Row">
                <div class="Cell">
                </div>
                <?php foreach ($carArray as $i => $car) { ?>
                    <div class="Cell col<?php echo $i; ?> compareCell">
                        <p><?php echo Yii::app()->customUtility->addBuyButton($carArray[$i]['id']); ?></p>
                    </div>
                <?php } ?>
            </div>


        </div>


    <?php
    } else {
        echo $message;
        ?>

    <?php } ?>
</div>

<br/>
<br/>
<br/>
<br/>




