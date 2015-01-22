var placeholderUrl = 'https://maxbuttons.com/wordpress/wp-content/themes/maxbuttonsdotcom/images/placeholder-200x150.png';

var app = angular.module('myApp', []);

// Vehicle service to get all makes and then get a particular car by make / model / year.
app.service('VehicleService', function ($q, $http) {

    this.getAllMakes = function () {
        var deferred = $q.defer();
        var url = 'https://api.edmunds.com/api/vehicle/v2/makes?state=new&view=basic&fmt=json&api_key=mexvxqeke9qmhhawsfy8j9qd'
        $http.get(url).then(function (response) {
            deferred.resolve(response.data.makes);
        }, function (error) {
            deferred.reject(new Error(JSON.stringify(error)));
        });
        return deferred.promise;
    }

    this.getCar = function (makeName, modelName, year) {
        var deferred = $q.defer();
        var url = 'https://api.edmunds.com/api/vehicle/v2/' + makeName + '/' + modelName + '/' + year + '/styles?view=full&fmt=json&api_key=mexvxqeke9qmhhawsfy8j9qd'
        $http.get(url).then(function (response) {
            deferred.resolve(response.data);
        }, function (error) {
            deferred.reject(new Error(JSON.stringify(error)));
        });
        return deferred.promise;
    };
});

// Photo service to get the photos.
app.service('VehiclePhotoService', function ($q, $http, $timeout) {

    this.getCarData = function (styleId) {
        var deferred = $q.defer();
        var url = 'https://api.edmunds.com/v1/api/vehiclephoto/service/findphotosbystyleid?styleId=' + styleId + '&fmt=json&api_key=mexvxqeke9qmhhawsfy8j9qd'
        var delay = Math.floor((Math.random() * 5000) + 1);
        console.log(delay);
        // random delay to keep api happy and don't get rate limited
        $timeout(function () {
            $http.get(url).then(function (response) {
                var carData = response.data;
                deferred.resolve(carData);
            }, function (error) {
                deferred.reject(new Error(JSON.stringify(error)));
            });
        }, delay);
        return deferred.promise;
    }

    this.getPhotoUrl = function (styleId) {
        var deferred = $q.defer();
        this.getCarData(styleId).then(function (carData) {
            try {
                //var car = carData[0];
                var photoUrl;
                var noPhoto = true;
                var car;
                for (i = 0; i < carData.length; i++)
                {
                    car = carData[i];
                    if (car.shotTypeAbbreviation === 'S') {
                        //code
                        photoUrl = car.photoSrcs[0];
                        noPhoto = false;
                        break;
                    }
                }
                if (noPhoto === true) {
                    car = carData[0];
                    photoUrl = car.photoSrcs[0];
                }

                var absolutePhotoUrl = 'http://media.ed.edmunds-media.com/' + photoUrl;
                deferred.resolve(absolutePhotoUrl);
            } catch (e) {
                deferred.resolve(placeholderUrl);
            }
        }, function (reason) {
            deferred.resolve(placeholderUrl);
        });
        return deferred.promise;
    }
});

// Custom Directive to get first image of each car.
app.directive('firstImageOfMyCar', function ($http, VehiclePhotoService) {
    return {
        restrict: "E",
        link: function (scope, elm, attrs) {
            // by default the values will come in as undefined so we need to setup a
            // watch to notify us when the value changes
            scope.$watch(attrs.styleid, function (value) {
                // let's do nothing if the value comes in empty, null or undefined
                if ((value !== null) && (value !== undefined) && (value !== '')) {
                    VehiclePhotoService.getPhotoUrl(value)
                            .then(function (value) {
                                var tag = '<img alt="" src="' + value + '" />';
                                elm.append(tag);
                            });
                }
            });
        }
    };
});

app.service('PostService', function ($q, $http) {

    this.selectCar = function () {
        var deferred = $q.defer();
        var url = 'http://localhost:8888/yii/motocarmaNBR8/index.php?r=user/profile'
        $http.post(url).then(function (response) {
            deferred.resolve(response.data.makes);
        }, function (error) {
            deferred.reject(new Error(JSON.stringify(error)));
        });
        return deferred.promise;
       /* var formData = { password: 'test pwd', email : 'test email' };
                var postData = 'myData='+JSON.stringify(formData);
                $http({
                        method : 'POST',
                        url : 'http://localhost:8888/yii/motocarmaNBR8/index.php?r=user/profile',
                        data: postData,
                        headers : {'Content-Type': 'application/x-www-form-urlencoded'}  

                }).success(function(res){
                        console.log(res);
                }).error(function(error){
                        console.log(error);
    });*/
    
}});

// Car controller to get the cars, select a car etc. Also responsible for getting the photos using Photo service.
//app.controller('CarCtrl', function ($http, $scope, VehicleService, VehiclePhotoService) {
function CarCtrl($http, $scope, VehicleService, VehiclePhotoService, PostService) {
    // init make select
    VehicleService.getAllMakes().then(function (value) {
        $scope.makes = value;
    });

    $scope.getCars = function () {
        VehicleService.getCar($scope.make.niceName, $scope.model.niceName, $scope.year.year)
                .then(function (value) {
                    console.log(value);
                    $scope.myCars = value;
                })
    };
/*
 $scope.selectThisCar = function () { PostService.selectCar().then(function (value) {
                    console.log(value);
     }); };
*/

$scope.selectThisCar = function (style) {
        $scope.selectedCar = style;
    console.log(style);
        
        // SK TODO : This doesn't work.
        // POST the selected car to the user's page so that it can be captured and saved to the database.
        $http({
            url: 'index.php?r=ajax/selectcar',
            method: "POST",
            data: JSON.stringify(style),
            headers: {'Content-Type': 'application/json'}
        }).success(function (data, status, headers, config) {

            $(".extruder-container").html(data);
            $('#extruderBottom').openMbExtruder(true);
            $('#extruderLeft').openPanel()
            //$scope.selectedCar = style; // assign  $scope.persons here as promise is resolved here 

            /*if(data.url == 'login'){
                window.location.href = loginUrl; 
            }else if(data.url == 'dealer'){
                window.location.href = dealUrl;
             }*/
        }).error(function (data, status, headers, config) {
            $scope.status = status + ' ' + headers;
            console.log('failed');
        });
    };

    $scope.displayGarage = '&displayGarage';
    /*//var method = 'POST';
     //var url = 'index.php?r=user/login';
     //$scope.codeStatus = "";
     //$//scope.selectThisCar = function (style) {
     var FormData = {
     'name': 'test'
     };
     $http({
     method: method,
     url: url,
     data: $.param({'data': FormData}),
     headers: {'Content-Type': 'application/x-www-form-urlencoded'},
     cache: $templateCache
     }).
     success(function (response) {
     $scope.codeStatus = response.data;
     }).
     error(function (response) {
     $scope.codeStatus = response || "Request failed";
     });
     return false;
     };*/

    /*var selectThisCar = function (style) {
        $scope.selectedCar = style;
        if (style !== 'undefined')
        {
            console.log(style);
            if (style.id !== 'undefined')
            {
                alert(style.id);
            }
        }
        
        $http({
     url: 'http://localhost:8888/yii/motocarmaNBR8/index.php?r=user/profile',
            method: "POST",
     data: {msg:'hello world!'},
     }).success(function () {
            //$scope.selectedCar = style; // assign  $scope.persons here as promise is resolved here 
     console.log('passed');
     }).error(function () {
            console.log('failed');
        });
     //$http.post();
        location.href = "index.php?r=user/login";
    };*/
    
   /* $scope.selectThisCar = function(style, $http){

                var formData = { password: 'test pwd', email : 'test email' };
                var postData = 'myData='+JSON.stringify(formData);
                $http({
                        method : 'POST',
                        url : 'http://localhost:8888/yii/motocarmaNBR8/index.php?r=user/profile',
                        data: postData,
                        headers : {'Content-Type': 'application/x-www-form-urlencoded'}  

                }).success(function(res){
                        console.log(res);
                }).error(function(error){
                        console.log(error);
        });
    };*/
    
    //$http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
    // SK TODO : This doesn't work.
    // POST the selected car to the user's page so that it can be captured and saved to the database.
    /*$http({
     url: 'index.php?r=user/login',
     method: "POST",
     data: {msg:'hello world!'},
     headers: {'Content-Type': 'application/x-www-form-urlencoded'}
     }).success(function (style) {
     $scope.selectedCar = style; // assign  $scope.persons here as promise is resolved here 
     console.log('passed');
     }).error(function () {
     console.log('failed');
     });*/
    /*
     $http.post('http://localhost:8888/yii/motocarmaNBR8/index.php', {msg:'hello word!'}).
     success(function(data, status, headers, config) {
     // this callback will be called asynchronously
     // when the response is available
     console.log('passed');
     //window.localStorage.setItem("style", JSON.stringify(style));
     //$window.location = 'http://localhost:8888/yii/motocarmaNBR8/index.php?r=user/profile';
     }).
     error(function(data, status, headers, config) {
     // called asynchronously if an error occurs
     // or server returns response with an error status.
     console.log('failed');
     });*/

    /*$scope.fetch = function ($http) {
     $http({
     url: 'http://localhost:8888/yii/motocarmaNBR8/index.php?r=user/login',
     method: 'POST',
     headers: {
     'Content-Type': 'application/x-www-form-urlencoded'
     },
     data: {msg: 'hello world!'}
     }).success(function () {
     //$scope.updLoginDetails = loginDetails;
     //if($scope.updLoginDetails.successful == true)
     //    {
     //       loginDetails.custId = $scope.updLoginDetails.customerDetails.cust_ID;
     //       loginDetails.userName = $scope.updLoginDetails.customerDetails.cust_NM;
     //window.localStorage.setItem("style", JSON.stringify(style));
     //$window.location = '/user/profile';
     //    }
     //else
     //alert('No access available.');
     console.log('passed');
     }).error(function (err, status) {
     console.log('failed');
     alert('No access available.');
     });
    };
     $scope.fetch();*/



    // SK TODO : Doesn't work.
    $scope.clear = function () {
        $scope.results.innerHTML = "";
    };
}

function selectThisCar() {
    $.each($(".selCar:checked"), function (index, chkbox) {
        $.ajax({
            url: 'index.php?r=ajax/selectcar',
            type: "POST",
            data: $(chkbox).val(),
            headers: {'Content-Type': 'application/json'},
            success: function (result, textStatus, jqXHR) {
                console.log("done");
                $(".extruder-container").html(result);
                $('#extruderBottom').openMbExtruder(true);
                $('#extruderLeft').openPanel()
            }
        })
    });
}