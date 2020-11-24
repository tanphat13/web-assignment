

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

function loadAvailableBranch(product_id) {
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
          document.cookie = "productId = " + product_id;
          document.getElementById('price').innerText = document.getElementById('new_price_'+product_id).innerText;
          document.getElementById('branch-container').innerHTML = this.responseText;
      }
  };
  xhttp.open("GET", "/branch?id="+product_id, true);
  xhttp.send();
}
function handleRating(myRadio, product_id, user_id) {
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
          document.getElementById('rating').innerHTML = '<p>Thank you for your rating</p>';
      }
  };
  xhttp.open("POST", "/rating", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("product_id="+product_id+"&user_id="+user_id+"&rate="+myRadio.value);
}
function loadAnswerInput(comment_id) {
  document.getElementById('comment-' + comment_id).innerHTML = 
  "<textarea id='input-comment" + comment_id + "'class='form-control input-comment' rows='3' placeholder='Input your answer'></textarea><button type='submit' value='Submit' class='btn btn-primary mb-2' onclick='submitComment(<?php echo $product['product']->product_id . ',' . $session->get('user') ?>, " + comment_id + ")'>Submit</button>"
}
function submitComment(product_id, user_id, answer_id = '') {
  let xhttp = new XMLHttpRequest();
  let is_answer = answer_id === '' ? 1 : 2;
  let input = document.getElementById('input-comment' + answer_id);
  let content = input.value;
  input.value = '';
  xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
          document.getElementById('comments').innerHTML = this.responseText;
      }
  }
  xhttp.open("POST", "/comment", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("product_id="+product_id+"&user_id="+user_id+"&is_answer="+is_answer+"&content="+content+"&answer_id="+answer_id);
}

function addToCart() {
  let cookies = document.cookie.split("; ");
  let cookieObj = new Object();
  cookies.forEach((cookie) => {
     let propArray = cookie.split("=");
     cookieObj[propArray[0]] = propArray[1];
  });
  if (!cookieObj.hasOwnProperty('cart')) {
    document.cookie = "cart = " + cookieObj.productId;
    return;
  }
  let newCartList = cookieObj.cart + "," + cookieObj.productId;
  document.cookie = "cart = " + newCartList;
}

// function setOnClickStore(){
//   var storeElements = document.querySelectorAll('.store-container');
//   storeElements.forEach((store,index)=>{
//     store.addEventListener('click',function(){
//       google.maps.event.trigger(Marker[index], 'click')
//     })
//   })
// }
