<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
          media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
          media="print"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
          media="screen, projection"/>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/common.css"/>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <?php Yii::app()->customUtility->addSideBar(); ?>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div id="header">
    <div id="logo"><?php /*?><?php echo CHtml::encode(Yii::app()->name); ?><?php */ ?></div>
    <div id="mainmenu">
        <?php $this->widget('zii.widgets.CMenu', array(
            'items'=>array(
                array('label'=>Yii::t('app','Home'), 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>Yii::t('app','User Home'), 'url'=>array('/site/UserHome'), 'visible'=>!Yii::app()->user->isGuest),
                array('label' => Yii::t('app', 'Search'), 'url' => array('/site/index')),
                array('label'=>Yii::t('app','Contact'), 'url'=>array('/site/contact')),
                array('label'=>Yii::t('app','Login'), 'url'=>array('/user/login'),'visible'=>Yii::app()->user->isGuest),
                array('label' => Yii::t('app', 'Rights'), 'url' => array('/rights')),
                array('url' => Yii::app()->getModule('message')->inboxUrl,
                    'label' => 'Messages' .
                        (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) ?
                            ' (' . Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) . ')' :
                            ''),
                    'visible' => !Yii::app()->user->isGuest),
                array('label'=>Yii::t('app','Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ,
            ))); ?>
    </div>
</div>
<!-- header -->
<!--<div class="container" id="page">-->


<!--/*
$this->widget('zii.widgets.CMenu',array(
    /*'items'=>array(
        array('label'=>'Home', 'url'=>array('/site/index')),
        array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
        array('label'=>'Contact', 'url'=>array('/site/contact')),
        //array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
        //array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
    array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register"), 'visible'=>Yii::app()->user->isGuest),
array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
    ),*/
    'items'=>array(
        //...
        /* array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest), */
        /* array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest), */
        array('label'=>'Rights', 'url'=>array('/rights'), 'visible'=>!Yii::app()->user->isGuest),
        array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
        array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register"), 'visible'=>Yii::app()->user->isGuest),
        array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
        array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
        //...
    ),
));
*/-->

<!-- mainmenu -->
<div class="cb"></div>
<?php if (isset($this->breadcrumbs)): ?>
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $this->breadcrumbs,
    )); ?><!-- breadcrumbs -->
<?php endif ?>
<div class="cb"></div>
<?php
$roles = Rights::getAssignedRoles(Yii::app()->user->Id);
$current_role = strtolower(current($roles)->name);
if (Yii::app()->user->Id == null || $current_role == 'authenticated') {
    ?>
    <div id="extruderBottom" class="{title:'Wishlist', url: 'index.php?r=ajax/garageInfo'}"></div>
<?php } ?>
<?php echo $content; ?>

<div class="clear"></div>

<!--
	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by MotoCarma.
		All Rights Reserved.
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

<!--</div><!-- page -->
<footer class="footer light">

    <div class="footer-content row">
        <div class="col-sm-12">
            <div class="logo-wrapper">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo-white.png" alt="Handshake">
            </div>
            <p>We’re four car guys with many years of experience in sales and all levels of management in high volume
                dealerships on both coasts. We’ve seen the angst and anguish, the anger and discomfort on customer’s
                faces before, during, and after a car buying experience.
            </p>

            <p>
                We firmly believe it’s time for a different approach that takes the frustration out and puts the fun in!

            </p>

            <p>
                Our aim is to place you, the customer, firmly in control of the process so that you may proceed along
                the purchase journey at your pace, in an environment of your choosing, and on your time.

            </p>

            <p>
                We know what car buying is like from both sides of the negotiating table - we buy cars too! So we’ve
                distilled the process down to its essential elements. If you enjoy negotiating, you have free range. If
                you prefer to cut to the chase, we have tools that allow you to do that as well.
                We want to help reshape the car buying experience and hope that you’ll join us!
            </p>

            <p><strong>The motoCarma Team</strong></p>
        </div>
        <div class="col-sm-5 social-wrap">
            <!--<div class="footer-title">Social Networks</div>
            <ul class="list-inline socials">
                <li><a href="#"><span class="icon icon-socialmedia-08"></span></a></li>
                     <li><a href="#"><span class="icon icon-socialmedia-07"></span></a></li>
                              <li><a href="#"><span class="icon icon-socialmedia-26"></span></a></li>


            </ul>-->

        </div>
        <!--<div class="col-sm-3">
          <div class="footer-title">Contacts</div>
            <ul class="list-unstyled">
                <li>
                    <span class="icon icon-chat-messages-14"></span>
                <a href="mailto:info@motocarma.com">info@motocarma.com</a></li>

            </ul>
          </div>-->
    </div>

    <div class="copyright">motoCarma 2015. All rights reserved.</div>
</footer>

</body>
</html>
