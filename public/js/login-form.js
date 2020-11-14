document.addEventListener('DOMContentLoaded',function(){
    let loginForm = document.getElementById("loginForm");
    let loginBtn = document.getElementById("loginBtn")
    //loginForm.classList.toggle('active');
   if(loginBtn){
        loginBtn.onclick = function () {
          console.log(loginBtn);
          loginForm.classList.toggle("active");
        }; 
   }
},false);