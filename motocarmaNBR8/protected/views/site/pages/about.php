<?php
/* @var $this SiteController */

$this->pageTitle = 'Welcome to MotoCarma - Car Buying Reincarnated';
/*$this->breadcrumbs=array(
	'About',
);*/
?>

<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slide-1.jpg" alt="First slide">

            <div class="container">
                <div class="carousel-caption">
                    <h1>Connect to a dealer in real time, on your time.</h1>

                    <p>motoCarma provides a new car buyer with an alternative to the lengthy showroom visit that has
                        been the standard experience for car shoppers since the fifties.</p>

                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Start your search</a></p>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slide-2.jpg" alt="Second slide">

            <div class="container">
                <div class="carousel-caption">
                    <h1>Car Buying Reincarnated</h1>

                    <p>Ever wonder why they make it so hard to buy a car?<br/>
                        We did too, and that's why we created Motocarma.</p>
                    <!-- <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>-->
                </div>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slide-3.jpg" alt="Third slide">

            <div class="container">
                <div class="carousel-caption">
                    <h1>What We Do</h1>

                    <p>Car buying should be fun from the moment you first start looking <br>
                        until you drive away with it!</p>

                    <p>&nbsp;</p>

                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Start your search</a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel -->
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="col-md-4" align="center">
            <i class="fa fa-check fa-3"></i><br>
            <h4 class="highlight">I KNOW WHAT I WANT</h4>

            <p>
                You’ve finished your research,<br>you’ve nailed it down to make, model, <br>trim level and even a
                color<br> and just want to get started.
            </p>

            <p><a class="btn btn-sm btn-primary" href="#" role="button">Start your search</a></p>
        </div>
        <div class="col-md-4" align="center">
            <i class="fa fa-exchange fa-3"></i><br>
            <h4 class="highlight">I KINDA KNOW WHAT I WANT</h4>

            <p>
                Maybe there are three vehicles<br>
                you're looking at and you're not <br>
                quite sure which one <br>
                will be perfect for you.
            </p>

            <p><a class="btn btn-sm btn-info" href="#" role="button">Start your search</a></p>

        </div>
        <div class="col-md-4" align="center">
            <i class="fa fa-question fa-3"></i><br>
            <h4 class="highlight">I NEED HELP</h4>

            <p>
                Use our research tools that include <br>
                reviews, options & technical stats as <br>
                well as side by side comparisons,<br>
                you’re closer than you think. </p>

            <p><a class="btn btn-sm btn-warning" href="#" role="button">Research</a></p>

        </div>

    </div>
    <p>&nbsp;</p>

    <p>&nbsp;</p>
    <hr class="featurette-divider">
    <div class="col-md-12">
        <div id="hero" class="static-header light clearfix">
            <div class="text-heading">
                <h2 class="featurette-heading"><span class="highlight">Connect to a dealer</span> in real time, on
                    your time.</h2>

                <p>
                    Why spend hours of your precious time at a dealership working on a car deal when you don't have
                    to?</p>

                <p>
                    motoCarma’s team has substantial experience in the car business so we can help you navigate the
                    car buying process and avoid the roadblocks created by old school approaches to buying a
                    car.</p>

                <p>
                    <strong>We simplify and streamline the process so your encounter with the dealership is a great
                        one!</strong>
                </p>
                <ul class="list-inline">
                    <li><a href="index.php" class="btn btn-primary animated hiding" data-animation="bounceIn"
                           data-delay="700">Search Now</a></li>
                    <li><a href="index.php?r=user/login" class="btn btn-default animated hiding"
                           data-animation="bounceIn" data-delay="900">Login</a></li>
                </ul>
            </div>

        </div>
        <hr class="featurette-divider">
        <div class="col-md-12">

            <h2 class="featurette-heading"><span class="highlight">How</span> We Do It</h2>

            <div class="sub-heading">
                <p>motoCarma connects you with a dealership and a motoCarma screened sales representative of your
                    choosing. It can be anonymous at first, if that’s how you prefer to begin the conversation.
                </p>

                <p class="highlight">Through instant messaging, email, chat or even voice you can communicate with
                    the representative and begin your car purchase.
                </p>

                <p>
                    Use motoCarma’s exclusive <strong>Work a Deal</strong> function, our realtime transactional
                    dashboard, and other tools that help you make an informed decision to get on the right track to
                    the best car buying experience you’ve ever had!
                </p>
                <br>
                <br>
            </div>
        </div>
        <hr class="featurette-divider">
        <br>

        <div class="section-content row">
            <div class="col-sm-4" align="center">

                <i class="fa fa-laptop fa-3"></i><br>

                <h2 class="highlight">Research Vehicles</h2>

                <p class="thin">Once a visitor arrives on our site they can research vehicles, read reviews and
                    settle on a vehicle.<br>
                    They can also learn about us, how our process works and whether it may be a fit for them.</p>

                <!--<span class="icon icon-arrows-04"></span>-->
            </div>
            <div class="col-sm-4" align="center">

                <i class="fa fa-user fa-3"></i>

                <h2 class="highlight">Login</h2>

                <p class="thin">In order to move forward the consumer will need to create a login.<br>
                    At this stage the consumer may want to create an anonymous identity until they feel comfortable
                    revealing themselves.</p>

                <!--<span class="icon icon-arrows-04"></span>-->
            </div>
            <div class="col-sm-4" align="center">

                <i class="fa fa-usd fa-3"></i>

                <h2 class="highlight">Pricing</h2>

                <p class="thin">Using the selected dealer's pricing matrix the consumer can get a price quote on the
                    vehicle they're interested in.</p>

            </div>
        </div>

    </div>
</div>
<br/>
<br/>

<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->
<div class="container">
    <div class="row">

        <!-- Three columns of text below the carousel -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading"><span class="highlight">What</span> We Do</h2>

                <div class="sub-title">Car buying should be fun from the moment you first start looking <br>until
                    you drive away with it!
                </div>
                <p>MotoCarma provides a new car buyer with an alternative to the lengthy showroom visit and trial by
                    fire
                    that has informed the standard experience for car shoppers since the fifties. </p>

                <p> Sure the Internet has provided
                    transparency and competitive pricing but the consumer, from Cars.com to TrueCar, is still thrown
                    to the
                    wolves in order to complete the process. Autotrader, in a recent survey, showed that 72% of
                    those
                    surveyed had a negative experience once they engaged with the dealership. </p>

                <p class="lead">&nbsp;</p>
            </div>
            <div class="col-md-5">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/keys-screen.jpg" alt="Keys screen"
                     class="side-img">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-5">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/handshake.jpg" alt="Handshake"
                     class="side-img">
            </div>
            <div class="col-md-7">
                <h2 class="featurette-heading">Our <span class="highlight">Approach</span></h2>

                <div class="sub-heading">
                    At motoCarma we bring value to both the consumer and the dealer!
                </div>
                <br/>

                <p>Our approach is quite simple. Create a safe, comfortable environment for the consumer where they
                    can
                    make informed decisions without the pressure from dealership personnel. If the customer is
                    comfortable
                    it follows that they may be more open to purchasing items that are usually sold in a high
                    pressure setting.
                    For example, if the customer buys an extended warranty, Gap insurance or a Lojack anti-theft
                    system,
                    there is potential for building back end profit for the dealer when the front end margin has
                    been compromised
                    by transparency and competitive Internet pricing.</p>
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row">
            <div class="col-md-12">
                <h2 class="featurette-heading">Why we are<span class="highlight"> Different</span></h2>


                <p> The deal you make online is guaranteed by motoCarma. We’re with you until you turn the key and
                    drive away in your new vehicle.
                    Most car buying sites leave you to fend for yourself once your arrive at the dealership door,
                    and pricing certificates don’t always hold up when you sit down to complete your purchase. </p>

                <p>With motoCarma there are no unpleasant surprises, no bait and switch tactics, or other
                    unscrupulous sales methods.

                </p>

                <p>The vehicle you chose, negotiated for, and agreed to buy online is the very same vehicle you pick
                    up from the dealership or have delivered to you.
                </p>

                <p> You won’t find the car you thought you were buying suddenly unavailable or with additional
                    accessories that you did not agree to buy.
                    We take the mystery out and put the mastery in.</p>
                <br><br>
            </div>
        </div>

        <!-- /END THE FEATURETTES -->


    </div>
</div>
</div>

<div class="full-wide">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mom-child.jpg" alt="Third slide">
</div>
<!--<h1>About</h1>

<p>This is a "static" page. You may change the content of this page
by updating the file <code><?php echo __FILE__; ?></code>.</p>
-->