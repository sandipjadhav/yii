// This file is no longer in use. Just here for historical purpose.
(function() {
  var app = angular.module('AngularSamples', []);

  var carController = function($scope, $http) {

    // get all the makes
    $http.get('https://api.edmunds.com/api/vehicle/v2/makes?state=new&view=basic&fmt=json&api_key=mexvxqeke9qmhhawsfy8j9qd')
      .then(function(response) {
      $scope.makes = response.data.makes;
      //console.log($scope.makes);
    }, function(error) {
      $scope.error1 = JSON.stringify(error);
    });
   
   // TODO SK: This one doesn't work.
   $scope.clear = function() {
    $scope.myCars = {};
    $scope.make = {};
    $scope.model = {};
    $scope.year = {};
   };
   
    $scope.getCar = function() {
    
    //https://api.edmunds.com/api/vehicle/v2/bmw/3%20series/2014/styles?state=new&view=full&fmt=json&api_key=mexvxqeke9qmhhawsfy8j9qd
//https://api.edmunds.com/api/vehicle/v2/acura/ilx?state=new&year=2014&view=basic&fmt=json&api_key=mexvxqeke9qmhhawsfy8j9qd
  $http.get('https://api.edmunds.com/api/vehicle/v2/'+$scope.make.niceName+'/'+$scope.model.niceName+'/'+$scope.year.year+'/styles?state=new&view=full&fmt=json&api_key=mexvxqeke9qmhhawsfy8j9qd')
      .then(function(response) {
      $scope.myCars = JSON.stringify(response.data);
    }, function(error) {
      $scope.error1 = JSON.stringify(error);
    });
      
    };
  };


  app.controller('carController', ['$scope', '$http', carController]);
})();