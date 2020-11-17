"use strict";

document.addEventListener('DOMContentLoaded', function () {
  var loginForm = document.getElementById("loginForm");
  var loginBtn = document.getElementById("loginBtn"); //loginForm.classList.toggle('active');

  if (loginBtn) {
    loginBtn.onclick = function () {
      console.log(loginBtn);
      loginForm.classList.toggle("active");
    };
  }
}, false);