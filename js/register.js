
function myLogin() {
  const myInput = document.getElementById("myInput");
  if (myInput.type === "password") {
    passIcon.classList.remove('icon-eye-slash');
    passIcon.classList.add('icon-eye1');
    myInput.type = "text";
  } else {
    myInput.type = "password";
    passIcon.classList.remove('icon-eye1');
    passIcon.classList.add('icon-eye-slash');
  }
}

function mySignup() {
  const userpass = document.getElementById("userPass");
  if (userpass.type === "password") {
    eyeIcon.classList.remove('icon-eye-slash');
    eyeIcon.classList.add('icon-eye1');
    userpass.type = "text";
  } else {
    userpass.type = "password";
    eyeIcon.classList.remove('icon-eye1');
    eyeIcon.classList.add('icon-eye-slash');
  }
}

function mySignup2() {
  const repass = document.getElementById("rePasswd");
  if (repass.type === "password") {
    eyeIcon2.classList.remove('icon-eye-slash');
    eyeIcon2.classList.add('icon-eye1');
    repass.type = "text";
  } else {
    repass.type = "password";
    eyeIcon2.classList.remove('icon-eye1');
    eyeIcon2.classList.add('icon-eye-slash');
  }
}

function resetPass1() {
  const reset1 = document.getElementById("pass1");
  if (reset1.type === "password") {
    eyeIcon3.classList.remove('icon-eye-slash');
    eyeIcon3.classList.add('icon-eye1');
    reset1.type = "text";
  } else {
    reset1.type = "password";
    eyeIcon3.classList.remove('icon-eye1');
    eyeIcon3.classList.add('icon-eye-slash');
  }
}

function resetPass2() {
  const reset2 = document.getElementById("pass2");
  if (reset2.type === "password") {
    eyeIcon4.classList.remove('icon-eye-slash');
    eyeIcon4.classList.add('icon-eye1');
    reset2.type = "text";
  } else {
    reset2.type = "password";
    eyeIcon4.classList.remove('icon-eye1');
    eyeIcon4.classList.add('icon-eye-slash');
  }
}

//¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤

userName.addEventListener("keyup", (eo) => {
  userName.classList.add("error");
  usermessage.style.display = "block";

  if (userName.value.length > 6) {
    userName.classList.add("success");
    usermessage.style.display = "none";
    // usericon.style.display = "block"
    userName.nextElementSibling.style.opacity = "1" // HTML Element apres l'id #username  
    // usericon.style.opacity = "1";
  } else {
    userName.classList.remove("success");
    usermessage.style.display = "block";                               
    usericon.style.opacity = "0";
  }
  activation() // call the funcition here
});

// copy this email to test momo269@hotmal.com
userEmail.addEventListener("keyup", (eo) => {
  userEmail.classList.add("error");
  mailmessage.style.display = "block";

  const regEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   if (regEmail.test(userEmail.value)) {
    userEmail.classList.add("success");
    mailmessage.style.display = "none";
    userEmail.nextElementSibling.style.opacity = "1" // HTML Element apres l'id #userEmail  
    // emailIcon.style.opacity = "1";
   } else{
    userEmail.classList.remove("success");
    mailmessage.style.display = "block";
    emailIcon.style.opacity = "0";
   } 
   activation() // call the funcition here
})

userPass.addEventListener("keyup", (eo) => {
  userPass.classList.add("error");
  passMessage.style.display = "block";

  // /^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/  lettre et chifre 8 a 12 caracteres
  const regPass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;

  if (regPass.test(userPass.value)) {
    userPass.classList.add("success");
    passMessage.style.display = "none";
    passIcon.style.opacity = "1";
  }else{
    userPass.classList.remove("success");
    passMessage.style.display = "block";
    passIcon.style.opacity = "0";
  }
  activation() // call the funcition here
})

// copy this password to test  Engstocko02@
rePasswd.addEventListener("keyup", (eo) => {
  rePasswd.classList.add("error");
  repassMessage.style.display = "block";
  if (rePasswd.value == userPass.value) {
    rePasswd.classList.add("success");
    repassMessage.style.display = "none";
    repassIcon.style.opacity = "1";
  }else{
    rePasswd.classList.remove("success");
    repassMessage.style.display = "block";
    repassIcon.style.opacity = "0";
  }
  activation() // call the funcition here
})

/*¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤
  this function to check if all html elements has a success class & enable the button register
¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤*/
const activation = () => {
  if (userName.classList.contains("success") && userEmail.classList.contains("success") && userPass.classList.contains("success") && rePasswd.classList.contains("success")) {
    register.removeAttribute("disabled");
  }else{
    register.setAttribute("disabled", "disabled");
  }
}


