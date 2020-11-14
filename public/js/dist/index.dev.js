"use strict";

var inforWindow;
var Marker = [];

function initMap() {
  var HCM = {
    lat: 10.762622,
    lng: 106.660172
  };
  map = new google.maps.Map(document.getElementById("map"), {
    center: HCM,
    zoom: 16,
    mapTypeId: "roadmap"
  }); //make a marker on map

  infoWindow = new google.maps.InfoWindow();
  displayStore(stores);
  init();
}

function init() {
  showMarker(stores);
}

function displayStore(storesData) {
  console.log(storesData);
}

function showMarker(storesData) {
  var bounds = new google.maps.LatLngBounds();
  storesData.forEach(function (store, index) {
    var storeLocation = new google.maps.LatLng(store.coordinates.latitude, store.coordinates.longitude);
    bounds.extend(storeLocation);
    var storeInfo = {
      name: store.name,
      address: store.addressLines,
      phoneNumber: store.phoneNumber,
      openStatusText: store.openStatusText
    }; //console.log(storeInfo)

    createMarker(storeLocation, storeInfo, index);
  });
  map.fitBounds(bounds);
}

function createMarker(location, storeInfo, index) {
  var param = storeInfo.address.join(" ").split(" ").join("+").replace(",", "2%C");
  var html = "<div class='marker-info'>\n                <div class='store-marker-name-container'>\n                  <h4>".concat(storeInfo.name, "</h4>\n                  <p>").concat(storeInfo.openStatusText, "</p>\n                </div>\n                <div class='store-marker-address'>\n                  <div class='icon'>\n                    <i class=\"fas fa-map-marked-alt\"></i>\n                  </div>\n                  <p href=\"https://www.google.com/maps/dir/?api=1&origin=H\u1EBBm+32+Tr\u1EA7n+Nh\u1EADt+Du\u1EADt%2C+Ph\u01B0\u1EDDng+5%2C+Tp.+\u0110\xE0+L\u1EA1t%2C+L\xE2m+\u0110\u1ED3ng%2c+Vi\u1EC7t+Nam&destination=").concat(param, " style=\"text-decoration:none\"><p>").concat(storeInfo.address[0], "</p> </a>\n                </div>\n                <div class='store-market-phoneNumber'>\n                  <div class='icon'>\n                    <i class=\"fas fa-phone\"></i>\n                  </div>\n                  <p>").concat(storeInfo.phoneNumber, "</p>\n                </div>\n              </div>");
  var marker = new google.maps.Marker({
    map: map,
    position: location,
    label: index.toString()
  });
  google.maps.event.addListener(marker, "click", function () {
    // infoWindow.setContent(html);
    infoWindow.open(map, marker);
    var inforCard = document.getElementById("detail-info");
    inforCard.innerHTML = html;
  });
  Marker.push(marker);
}

function clear() {
  infoWindow.close();

  for (var i = 0; i < Marker.length; i++) {
    Marker[i].setMap(null);
  }

  Marker.length = 0;
} // function setOnClickStore(){
//   var storeElements = document.querySelectorAll('.store-container');
//   storeElements.forEach((store,index)=>{
//     store.addEventListener('click',function(){
//       google.maps.event.trigger(Marker[index], 'click')
//     })
//   })
// }