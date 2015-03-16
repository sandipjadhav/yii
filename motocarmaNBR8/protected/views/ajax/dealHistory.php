<table style="border-color: #0099ff; border-style: solid">
<?php
    $i = 0;
    foreach($dealHistory as $dl){ ?>
        <tr><td style="border-color: #0099ff; border-style: solid">
        <div style="border-color: #0099ff; border-style: solid">
        <b>Date </b> : <?php echo $dl->Created_Date; ?><br/>
        <b>Action By</b> : <?php echo $dl->user->username; ?><br/>
        <b>Deal Status</b> : <?php echo  $dl->DealStatus ?><br/>
        <b>Description</b> : <?php

            $arrParams = json_decode($dl->ChangedParams, true);
            $strParams = array();
            $dParams = new DealerParams();
            $dParamsLabels = $dParams->attributeLabels();
            //print_r($arrParams);
            if(count($arrParams) > 0 ){
                foreach($arrParams as  $pName => $param){
                    $strParams[] =  $dParamsLabels[$pName] . " Changed from ". $param['old']." To ".$param['new'];
                }
                echo implode('<br/>',$strParams);
            }
            ?>
            <hr style="color:#F87431 ; height:2px "/>
        </div>
            </td></tr>
   <?php $i++;
    } ?>
</table>