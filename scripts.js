
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("slide");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}

function showList(){
  let list = document.getElementById("nav-list");
  let btn1 = document.getElementsByClassName("prev");
if(list.style.display === "none"){
    list.style.display = "block";
}
else{
list.style.display = "none";
}
}

function validName(username){
 let letters = /^[A-Za-z]+$/;
 if(username.value.match(letters)) 
  return true;
  else{
    alert('Invalid user name. Must include only alphabetical letters');
    username.focus();
    return false;
  }
}
function validSurname(surname){
  let letters = /^[A-Za-z]+$/;
  if(surname.value.match(letters)) 
   return true;
   else{
     alert('Invalid user surname. Must include only alphabetical letters');
     surname.focus();
     return false;
   }
 }
 function validEmail(email){
   let dot = '.', check = false;
   for(let i = 0; i < email.value.length; i++){
     if(email.value[i] == dot) check = true;
   }
   if(check) return true;
   else{
    alert("Invalid email");
    email.focus();
    return false;
   }
 }
 function validPassword(password, mx, my){
   let password_len = password.value.length, counter = 0;
   if(password_len == 0  || password_len >= my || password_len < mx){
     for(let i = 0; i < password_len; i++){
       if(password.value[i] == '#' || password.value[i] == '!' || password.value[i] == '$' || password.value[i] == '%' || password.value[i] == '^'
       || password.value[i] >= 65 && password.value[i] <= 97) counter++; 
     }
     if(counter == 0) {
       alert("Invalid password");
       password.focus();
       return false;
   }
   else return true;
  }
   else{
     alert("Invalid password");
     password.focus();
     return false;
   }
  }  
  function validForm(){
  let username = document.registration.name;
let surname = document.registration.surname;
let email = document.registration.email;
let password = document.registration.password;
if(validName(username)){
  if(validSurname(surname)){
    if(validEmail(email)){
      if(validPassword(password, 7, 15)){
        alert("Hello, " + username + " " + surname + "!");
        return true;
      }
    }
  }
}
return false;
}
function hideUl(){
  let ul = document.getElementById("catalog");
  ul.style.display = "none";
}
  function findName() {
    let input, filter, ul, li, a, i, txtValue;
    input = document.getElementById('search');
    filter = input.value.toUpperCase();
    ul = document.getElementById("catalog");
    li = ul.getElementsByTagName('li');

    if(input.value.length == 0) {
      ul.style.display = "none";
    }
    else{
      ul.style.display = "block";
       for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByTagName("a")[0];
      txtValue = a.textContent || a.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      }
      else{
        li[i].style.display = "none";
      } 
    }
    }
   
  }

