/**
 * Created by sandip.jadhav on 8/02/2015.
 */

$(document).ready(function(){
    var map;
    var infowindow;

    function initialize() {

        var lat = '';
        var lng = '';
        //var address = '90001';
        var address = $("#ZipCode").val();
        var make = $("#carName").text();
        geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                //console.log(results);
                lat = results[0].geometry.location.lat();
                lng = results[0].geometry.location.lng();
                //alert('Latitude: ' + lat + ' Logitude: ' + lng);

                var customerLocation = new google.maps.LatLng(lat, lng);

                map = new google.maps.Map(document.getElementById('googleMap'), {
                    center: customerLocation,
                    zoom: 10
                });


                var address = results[0].address_components
                $.each(address, function(index, addr){
                    //console.log(addr.types); console.log('1');
                    if(addr.types[0] == "locality" && addr.types[1] == "political"){
                        console.log(addr.long_name);
                        $.ajax({
                            url: "index.php?r=ajax/getDealersByCity",
                            type: 'GET',
                            dataType: 'json',
                            data: {'city': addr.long_name, 'make': make},
                            success: function (data, textStatus, jqXHR) {
                                $.each(data, function(i,dealer) {
                                    var contentString = '<a href="javascript:void(0)" onclick="fillSalesperson(' + dealer.id + ')"><b>' + dealer.DealerName + '<b/></a><br/>' + dealer.Address;
                                    var infowindow = new google.maps.InfoWindow({
                                        content: contentString
                                    });
                                    var geocoder = new google.maps.Geocoder();
                                    var latlang = new Array();
                                    geocoder.geocode({ 'address': dealer.Address }, function (results, status) {
                                        if (status == google.maps.GeocoderStatus.OK) {
                                            var latitude = results[0].geometry.location.lat();
                                            var longitude = results[0].geometry.location.lng();

                                                    var dealerLatLang = new google.maps.LatLng(latitude, longitude);
                                                    var marker = new google.maps.Marker({
                                                        position: dealerLatLang,
                                                        map: map,
                                                        title: dealer.DealerName
                                                    });
                                                    google.maps.event.addListener(marker, 'click', function () {
                                                        infowindow.open(map, marker);
                                                    });

                                        }
                                     });
                                });

                            }
                        });
                    }
                })

                var request = {
                    location: customerLocation,
                    radius: 500,
                    types: ['store']
                };

                createMarker(results[0],map)
                //infowindow = new google.maps.InfoWindow();
                //var service = new google.maps.places.PlacesService(map);
                //service.nearbySearch(request, callback);


            }
            else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });


    }

    function callback(results, status) {
        /*if (status == google.maps.places.PlacesServiceStatus.OK) {
            for (var i = 0; i < results.length; i++) {
                createMarker(results[i]);
            }
        }*/
    }


    var btnGetMapDealers = document.getElementById('btnGetMapDealers');
    google.maps.event.addDomListener(btnGetMapDealers, 'click', initialize);

})

function createMarker(place,map) {
    var placeLoc = place.geometry.location;
    var marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location
    });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(place.name);
        infowindow.open(map, this);
    });
}

function GetLocation(address) {
    var geocoder = new google.maps.Geocoder();
    var latlang = new Array();
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();

            alert("Latitude: " + latitude + "\nLongitude: " + longitude);
            latlang[0] = latitude;
            latlang[1] = longitude;

            return latlang;
        } else {
            return latlang;
        }

    });
};
