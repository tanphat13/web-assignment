

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

function openUpdateForm() {
  document.getElementById('box-form').classList.add('active');
  return;
}

function closeUpdateBox() {
  document.getElementById('box-form').classList.remove('active');
  return;
}

function confirmRemoveAddress(index, user_id) {
  let address = document.getElementById('address-'+index).firstElementChild.innerText;
  document.getElementById('message').innerHTML = "<p>Do you want to remove this address (<em class='font-weight-bold'>" + address +  "</em>) ?</p>";
  document.getElementById('confirm_button').setAttribute('onclick', 'deleteAddress('+index+', '+user_id+')');
  document.getElementById('box-confirm').classList.add('active');
  return;
}

function deleteAddress(index, user_id) {
  let xhttp = new XMLHttpRequest();
  let address = document.getElementById('address-'+index).firstElementChild.innerHTML;
  xhttp.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      document.getElementById('address-'+index).remove();
      document.getElementById('box-confirm').classList.remove('active');
    }
  };
  xhttp.open("POST", "/delete-address", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("user_id="+user_id+"&address="+address);
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
  if (user_id === undefined) {
    document.getElementById('loginForm').classList.add('active');
    return;
  }
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
  if (user_id === undefined) {
    document.getElementById('loginForm').classList.add('active');
    return;
  }
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

function addToCart(user_id) {
  if (user_id === undefined) {
    document.getElementById('loginForm').classList.add('active');
    return;
  }
  window.location.href = window.location.origin+'/my-cart';
  return;
}

function confirmRemoveProduct(product_id) {
  let product_name = document.getElementById('product-'+product_id).innerText;
  document.getElementById('message').innerHTML = "<p>Do you want to remove <em class='font-weight-bold'>" + product_name +  "</em> from your cart ?</p>";
  document.getElementById('confirm_button').setAttribute('onclick', 'removeProduct('+product_id+')');
  document.getElementById('box-confirm').classList.add('active');
  return;
}

function closeBox() {
  document.getElementById('box-confirm').classList.remove('active');
  return;
}

function removeProduct(product_id) {
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      let productPrice = document.getElementById('product-item-'+product_id).firstChild.nextElementSibling.nextElementSibling.lastElementChild.innerHTML;
      productPrice = productPrice.split(" ")[1].split(".").join('');
      document.getElementById('product-item-'+product_id).remove();
      document.getElementById('number-in-cart').innerText = parseInt(document.getElementById('number-in-cart').innerText) - 1;
      let totalPrice = document.getElementById('total-price').innerText;
      totalPrice = parseInt(totalPrice.split(" ")[0].split(".").join(''));
      console.log(totalPrice);
      document.getElementById('total-price').innerText = (totalPrice - productPrice).toLocaleString('de-DE') + " VND";
      document.getElementById('total-charge').innerText = (totalPrice - productPrice).toLocaleString('de-DE') + " VND";
      document.getElementById('box-confirm').classList.remove('active');
    }
  }
  xhttp.open("POST", "/remove-product", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("removing_id="+product_id);
}

function handleOrderMethod(method, user_id = 0) {
  let request_path = '/my-address?user_id='+user_id;
  if (method === 'store') {
    request_path = '/all-branch';
  }
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      document.getElementById('address').innerHTML = this.responseText;
    }
  }
  xhttp.open("GET", request_path, true);
  xhttp.send();
}

function confirmCancelOrder(order_id) {
  document.getElementById('box-confirm').classList.add('active');
  document.getElementById('confirm_button').setAttribute('onclick', 'cancelOrder('+order_id+')');
  return; 
}

function cancelOrder(order_id) {
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      document.getElementById('box-confirm').classList.remove('active');
      location.reload();
    }
  }
  xhttp.open("GET", "cancel-order?id="+order_id, true);
  xhttp.send();
}

function updateOrder(order_id) {
  let status = document.getElementById('status').value;
  let delivery_date = document.getElementById('delivery-date').value;
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      // console.log(this.responseText);
      location.reload();
    }
  }
  xhttp.open("POST", "update-order", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("order_id="+order_id+"&status="+status+"&delivery_date="+delivery_date);
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
          updateForm.classList.add("active");
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

 // Search feature

 function searchStaff(searchInput){
  const  options = document.getElementById('search-option');
  let optionValue = options.value;
  const tableContent = document.getElementById('table-content');
  // console.log(optionValue);
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4 && xhttp.status === 200) {
      tableContent.innerHTML = xhttp.responseText;
    }
  };
  xhttp.open(
    "GET",
    `http://localhost:8080/admin/search?key=${searchInput}&options=${optionValue}`,
    true
  );
  xhttp.send();
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
       let message = document.getElementById("update-message");
       message.innerHTML = xhttp.responseText;
       setTimeout(function (){
        updateForm.classList.remove('active');
       },3000 )
     }
   };
   xhttp.open("POST", `http://localhost:8080/admin/update-staff-info`, true);
   xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
   xhttp.send(
     JSON.stringify(object)
  );
 }

 function closeUpdateForm(){
   const updateForm = document.getElementById("staff-update-form");
   updateForm.classList.remove("active");
  updateForm.setAttribute('data-staff','');
 }



 function EditCell(){
   const properties = document.getElementsByClassName("table-cell-value");
   let dataObject = {};

   for(let i = 0 ; i< properties.length; i++){
    let propKey = properties[i].getAttribute("data-content");
    dataObject = { ...dataObject, [propKey]: properties[i].innerHTML };
   }

   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function () {
     if (xhttp.readyState == 4 && xhttp.status == 200) {
      //  
      console.log(xhttp.responseText);
     }
   };
   xhttp.open(
     "POST",
     `http://localhost:8080/admin/manage-products/update-specific-product`,
     true
   );
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send(JSON.stringify(dataObject));
}
function openConfirmDelete(model,key){
  const confirmBox = document.getElementById("delete-confirm");
  confirmBox.setAttribute('data-model',model);
  confirmBox.setAttribute("data-key", key);
  confirmBox.classList.add("active");
  console.log()
}
function closeConfirmDelete(){
   const confirmBox = document.getElementById("delete-confirm");
   const message = document.getElementById("confirm-delete-message");
   message.innerHTML = "Do you want to deletegit";
   confirmBox.setAttribute("data-model", '');
   confirmBox.setAttribute("data-key", '');
   confirmBox.classList.remove("active");
}
function deleteModel(){
  const confirmBox = document.getElementById("delete-confirm");
  let model = confirmBox.getAttribute("data-model");
  let key = confirmBox.getAttribute("data-key");
  console.log(`${key} ${model}`);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      const message = document.getElementById("confirm-delete-message");
      message.innerHTML = xhttp.responseText;
       setTimeout(function () {
         confirmBox.classList.remove("active");
         locatiton.href =  window.location.href;
       }, 2000);
    }
  };
  xhttp.open(
    "GET",
    `http://localhost:8080/admin/delete?delete=${model}&key=${key}`
  );
  xhttp.send();
}