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

// Car controller to get the cars, select a car etc. Also responsible for getting the photos using Photo service.
function CarCtrl($scope, VehicleService, VehiclePhotoService) {
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

    $scope.selectThisCar = function ($http, style) {
        $scope.selectedCar = style;
        console.log(style);
        alert(style.id);

        // SK TODO : This doesn't work.
        // POST the selected car to the user's page so that it can be captured and saved to the database.
        /*$http({
            url: 'index.php?r=user/profile',
            method: "POST",
            data: JSON.stringify(style),
            headers: {'Content-Type': 'application/json'}
        }).success(function (data, status, headers, config) {
            $scope.selectedCar = style; // assign  $scope.persons here as promise is resolved here 
            console.log('passed');
        }).error(function (data, status, headers, config) {
            $scope.status = status + ' ' + headers;
            console.log('failed');
        });*/
    };

    // SK TODO : Doesn't work.
    $scope.clear = function () {
        $scope.results.innerHTML = "";
    };
}