/*--- Write Javascript Here ---*/
$(document).ready(function(){
    
});

new WOW().init();

// Hamburger Mobile Menu
var $hamburger = $(".hamburger");
$hamburger.on("click", function(e) {
  $hamburger.toggleClass("is-active");
  $('your div menu id/class').toggle();
});

// custom upload file
// Before
const uploadButton = document.querySelector('.browse-btn-before');
const fileInfo = document.querySelector('.file-info-before');
const realInput = document.getElementById('real-input-before');

uploadButton.addEventListener('click', () => {
  realInput.click();
});

realInput.addEventListener('change', () => {
  const name = realInput.value.split(/\\|\//).pop();
  const truncated = name.length > 20 
    ? name.substr(name.length - 20) 
    : name;
  
  fileInfo.innerHTML = truncated;
});

//After
const uploadButton = document.querySelector('.browse-btn-after');
const fileInfo = document.querySelector('.file-info-after');
const realInput = document.getElementById('real-input-after');

uploadButton.addEventListener('click', () => {
  realInput.click();
});

realInput.addEventListener('change', () => {
  const name = realInput.value.split(/\\|\//).pop();
  const truncated = name.length > 20 
    ? name.substr(name.length - 20) 
    : name;
  
  fileInfo.innerHTML = truncated;
});