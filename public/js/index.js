

let inforWindow;
let Marker = [];

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
  infoWindow = new google.maps.InfoWindow();
  displayStore(stores);
  init();
}
function init(){
  showMarker(stores);
}

function displayStore(storesData){
  console.log(storesData);
}

function showMarker(storesData) {
  var bounds = new google.maps.LatLngBounds();
 storesData.forEach((store, index) => {
    var storeLocation = new google.maps.LatLng(
      store.coordinates.latitude,
      store.coordinates.longitude
    );
    bounds.extend(storeLocation);
    var storeInfo = {
      name: store.name,
      address: store.addressLines,
      phoneNumber: store.phoneNumber,
      openStatusText: store.openStatusText,
    };
    //console.log(storeInfo)
    createMarker(storeLocation, storeInfo, index);
  });
  map.fitBounds(bounds);
}

function createMarker(location ,storeInfo, index){
  let param = storeInfo.address
    .join(" ")
    .split(" ")
    .join("+")
    .replace(",", "2%C");
  
  var html = `<div class='marker-info'>
                <div class='store-marker-name-container'>
                  <h4>${storeInfo.name}</h4>
                  <p>${storeInfo.openStatusText}</p>
                </div>
                <div class='store-marker-address'>
                  <div class='icon'>
                    <i class="fas fa-map-marked-alt"></i>
                  </div>
                  <p href="https://www.google.com/maps/dir/?api=1&origin=Hẻm+32+Trần+Nhật+Duật%2C+Phường+5%2C+Tp.+Đà+Lạt%2C+Lâm+Đồng%2c+Việt+Nam&destination=${param} style="text-decoration:none"><p>${storeInfo.address[0]}</p> </a>
                </div>
                <div class='store-market-phoneNumber'>
                  <div class='icon'>
                    <i class="fas fa-phone"></i>
                  </div>
                  <p>${storeInfo.phoneNumber}</p>
                </div>
              </div>`;
  var marker = new google.maps.Marker({
    map: map,
    position: location,
    label: index.toString(),

  });
  google.maps.event.addListener(marker, "click", function () {
    infoWindow.setContent(html);
    infoWindow.open(map, marker);
    // let inforCard = document.getElementById("detail-info");
    // inforCard.innerHTML = html;
  });
  Marker.push(marker);

}

function clear(){
  infoWindow.close();
  for(let i=0; i<Marker.length;i++){
    Marker[i].setMap(null);
  }
  Marker.length=0;
}

// function setOnClickStore(){
//   var storeElements = document.querySelectorAll('.store-container');
//   storeElements.forEach((store,index)=>{
//     store.addEventListener('click',function(){
//       google.maps.event.trigger(Marker[index], 'click')
//     })
//   })
// }


// This is function for admin page
 function getStaffId(staffId) {
    const updateForm = document.getElementById('staff-update-form');
    updateForm.setAttribute("data-staff",`${staffId}`);
    const nameInput = document.getElementById('fullname');
    const emailInput = document.getElementById("email");
    const phoneInput = document.getElementById("phone");
    //updateForm.classList.toggle("active");
     var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function () {
       if (xhttp.readyState == 4 && xhttp.status == 200) {
          var response = JSON.parse(this.responseText);
          nameInput.value = response.fullname;
          emailInput.value = response.email;
          phoneInput.value = response.phone;
       }
     };
     xhttp.open(
       "GET",
       `http://localhost:8080/admin/specific-staff?id=${staffId}`,
       true
     );
     xhttp.send();
     // alert(staffId);
 }

 function updateStaffInfo(){
   const updateForm = document.getElementById("staff-update-form");
   const staffId = updateForm.getAttribute("data-staff");
   let object = {id:staffId};
   const inputArr  = document.getElementsByTagName('input');
    for(let i = 0; i<inputArr.length;i++){
      if(updateForm.contains(inputArr[i])){
        var key = inputArr[i].id;
        var value = inputArr[i].value;
        object[`${key}`]=value
      }
    }
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function () {
     if (xhttp.readyState == 4 && xhttp.status == 200) {
       console.log(xhttp.responseText);
     }
   };
   xhttp.open("POST", `http://localhost:8080/admin/update-staff-info`, true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
   xhttp.send(
     JSON.stringify(object)
  );
 }