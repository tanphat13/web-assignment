
function initMap() {
  var HCM = {
    lat: 10.762622,
    lng: 106.660172,
  };
  map = new google.maps.Map(document.getElementById("map"), {
    center: HCM,
    zoom: 16,
    mapTypeId: "roadmap",
  });
  //make a marker on map
  var marker = new google.maps.Marker({
    position: HCM,
    map: map,
    title: "Hello Ho Chi Minh",
  });
}
