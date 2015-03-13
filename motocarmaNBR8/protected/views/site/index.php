<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<?php
/* @var $this SiteController */
$this->pageTitle = 'Welcome to MotoCarma - Car Buying Reincarnated';
/*$this->pageTitle = Yii::app()->name;*/
?>
<!--
<p>You may change the content of this page by modifying the following two files:</p>
<ul>
    <li>View file: <code><?php echo __FILE__; ?></code></li>
    <li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>-->

<head>
    <script data-require="angular.js@1.3.0-beta.5" data-semver="1.3.0-beta.5" src="https://code.angularjs.org/1.3.0-beta.5/angular.js" type="text/javascript">
    </script>
    <script type="text/javascript" src="js/script.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular-resource.min.js">
    </script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script>
    var loginUrl = '<?php echo Yii::app()->createUrl('user/login'); ?>';
    var dealUrl = '<?php echo Yii::app()->createUrl('deal/create'); ?>';
    </script>
</head>
<body>

<div class="full-wide">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/beach-laptop.jpg"
         alt="Woman on the Beach with her Laptop">

    <div class="over-text"><h2>Connect to a dealer in real time, <br>
            on your time.</h2>

    </div>
</div>
<div class="cb"></div>

<div id="container" class="page">
    <h3 class="highlight">
        Why spend hours of your precious time at a dealership working on a car deal when you don't have to?</h3>

    <p>
        motoCarma’s team has substantial experience in the car business so we can help you navigate the car buying
        process and avoid the roadblocks created by old school approaches to buying a car.</p>

    <p>
        <strong>We simplify and streamline the process so your encounter with the dealership is a great one!</strong>
    </p>

    <div class="jumbotron" style="padding-top:20px; margin-top:20px;">

        <h3>Start your Search:</h3>

        <div ng-app='myApp'>
            <div ng-controller="CarCtrl">
                <div class="form-elements-make">
                    <label for="make">Make:</label>
                    <select id="make" ng-model="make" ng-options="make.name for make in makes" class="form-control">
                        <option value=''>Select</option>
                    </select>
                </div>
                <div class="form-elements-model">
                    <label for="model">Model:</label>
                    <select id="model" ng-model="model" ng-options="model.name for model in make.models"
                            class="form-control">
                        <option value=''>Select</option>
                    </select>
                </div>
                <div class="form-elements-year">
                    <label for="year">Year:</label>
                    <select id="year" ng-model="year" ng-options="year.year for year in model.years"
                            class="form-control">
                        <option value=''>Select</option>
                    </select>
                </div>
        <span>
            <button class="btn btn-primary" ng-disabled="!make.name || !model.name || !year.year" ng-click="getCars()">
                Get Cars
            </button>
        </span>
        <span>
            <button class="btn btn-primary" ng-disabled="!make.name || !model.name || !year.year" ng-click="clear()">
                Clear Results
            </button>
        </span>

                <hr/>
        <div id="results" ng-repeat="style in myCars.styles">
            <div class="entry" id="{{style.id}}">
               <!-- <div first-image-of-my-car data-styleid="myCars.id"></div>-->
                <first-image-of-my-car data-styleid="style.id"></first-image-of-my-car>
                <div>StyleID: {{style.id}}</div>
                <div>Make: {{style.name}}  Model: {{style.submodel.modelName}} Year: {{style.year.year}}</div>
                <div>MPG: {{style.MPG.city}} / {{style.MPG.highway}}</div>
                <div>Trim: {{style.trim}}</div>
                <div>Price: {{style.price.baseMSRP}}</div>
                <span style="right: 0">
            <label for="selCar">Add car to wishlist</label>:<input type="checkbox" styleid='{{style.id}}' class='selCar'
                                                                   id="selCar"
                                                                   value="{{style}}">

        </span>
            </div>
        </div>
        <span>
        <button ng-disabled="!myCars.styles.length" class="btn btn-primary" onclick="selectThisCar(style)">Save to
            wishlist
        </button>
        </span>
        <br/>

                <div ng-hide="myCars.styles.length">No cars found or selected.</div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>

</div>
<!-- page -->
</body>
</html>


            

<!-- 
<html lang="en" ng-app="AngularSamples">
<head>
    <script data-require="angular.js@1.3.0-beta.5" data-semver="1.3.0-beta.5" src="https://code.angularjs.org/1.3.0-beta.5/angular.js" type="text/javascript">
</script>
    <script type="text/javascript" src="js/script.js">
</script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular-resource.min.js">
</script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <div ng-app='myApp'>
    <div ng-controller="CarCtrl">
        <div>
            <label for="make">Make:</label>
            <select id="make" ng-model="make" ng-options="make.name for make in makes">
                <option value=''>Select</option>
            </select>
        </div>
        <div>
            <label for="model">Model:</label>
            <select id="model" ng-model="model" ng-options="model.name for model in make.models">
                <option value=''>Select</option>
            </select>
        </div>
        <div>
            <label for="year">Year:</label>
            <select id="year" ng-model="year" ng-options="year.year for year in model.years">
                <option value=''>Select</option>
            </select>
        </div>
        <span>
            <button class="btn" ng-disabled="!make.name || !model.name || !year.year" ng-click="getCars()">Get Cars</button>
        </span>
        <span>
            <button class="btn" ng-disabled="!make.name || !model.name || !year.year" ng-click="clear()">Clear Results</button>
        </span>
        <hr/>
        <div id="results" ng-repeat="style in myCars.styles">
            <div class="entry" id="{{style.id}}">
               
                <first-image-of-my-car data-styleid="style.id"></first-image-of-my-car>
                <div>StyleID: {{style.id}}</div>
                <div>Make: {{style.name}}  Model: {{style.submodel.modelName}} Year: {{style.year.year}}</div>
                <div>MPG: {{style.MPG.city}} / {{style.MPG.highway}}</div>
                <div>Trim: {{style.trim}}</div>
                <div>Price: {{style.price.baseMSRP}}</div>
                <span>
            <button class="btn" ng-click="selectThisCar(style)">Select</button>
        </span>
            </div>
        </div>
        <br/>
        <div ng-hide="myCars.styles.length">No cars found or selected.</div>
    </div>
</div>
</body>
</html>
-->

