<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
    <li>View file: <code><?php echo __FILE__; ?></code></li>
    <li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

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
               <!-- <div first-image-of-my-car data-styleid="myCars.id"></div>-->
                <first-image-of-my-car data-styleid="style.id"></first-image-of-my-car>
                <div>StyleID: {{style.id}}</div>
                <div>Make: {{style.name}}  Model: {{style.submodel.modelName}} Year: {{style.year.year}}</div>
                <div>MPG: {{style.MPG.city}} / {{style.MPG.highway}}</div>
                <div>Trim: {{style.trim}}</div>
                <div>Price: {{style.price.baseMSRP}}</div>
                <span>
            <button class="btn" ng-click="selectThisCar(style)">Select</button>
            
            <?php 
$selectedcar = array();

$selectedcar['make']="BMW";
$selectedcar['model']="3 series";
$selectedcar['year']="2015";
$selectedcar['price']="67000";

Yii::app()->session['$selectedcar'] = $selectedcar;
?>
        </span>
            </div>
        </div>
        <br/>
        <div ng-hide="myCars.styles.length">No cars found or selected.</div>
    </div>
</div>
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

