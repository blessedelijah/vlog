// Get references to the DOM elements
const profileImgBox = document.getElementById('image_block'); // Your image box id
const profileImageInput = document.getElementById('chooseProfile'); // Your input tag id
const profileimage = document.getElementById('profile-pix'); // The img tag inside your image box- the id

// Add an event listener for when the image box is clicked

if(profileImgBox){
  profileImgBox.addEventListener('click', () => {
    // Simulate a click on the hidden file input
    profileImageInput.click();
});
}


// Add an event listener for when a file is selected in the file input
if(profileImageInput){
  profileImageInput.addEventListener('change', (event) => {
    // Check if a file has been selected
    if (event.target.files && event.target.files[0]) {
        const reader = new FileReader();

        // Once the file is read, update the image preview
        reader.onload = function(e) {
            profileimage.src = e.target.result; // Set the image preview to the selected file
        };

        // Read the selected file as a Data URL
        reader.readAsDataURL(event.target.files[0]);
    }
});
}


let deletebox = document.querySelector('#deletebox');

if(deletebox){
  setTimeout(() => {
    deletebox.style.display = 'none';
  }, 3000);
}


let custom_box = document.querySelectorAll('#custom_amenitie_chkbox');

custom_box.forEach(custom_boxs => {
  custom_boxs.addEventListener('click', function(){
    custom_boxs.classList.toggle('customised_amenities_addclass');
    custom_boxs.parentNode.querySelector('.mainchkbox').click();
    custom_boxs.parentNode.querySelector('.fa-check').classList.toggle('customised_amenities_Chkmarkaddclass');
  })
});

const currentLocation = location.href;
const menuItem = document.querySelectorAll('aside ul a');
const menuLength = menuItem.length;

  for(let i = 0; i<menuLength; i++){
    if(menuItem[i].href === currentLocation){
      menuItem[i].className = "active-dash";
    }
  }

$(document).ready(function(){
    $('.fi-rr-menu-burger').on('click', function(){
        $('#left_sidebar ul a').toggleClass('list-container');
        $('#left_sidebar ul a li span').toggleClass('spa-con');
        $('#left_sidebar').toggleClass('aside-clas');
        $('#dash_logo_con span').toggleClass('logo-spa');
        $('main').toggleClass('main-cla');
        
    })

    $('header .dark-mode-switch-con .circle-switch').on('click', function(){
        $(this).toggleClass('move-switch');
        $('aside, header').toggleClass('change-to-dark');
        $('main').toggleClass('change-to-darker');
        $('#add-prop-holder p').toggleClass('changecolor');
        $('#main_container').toggleClass('main_container-dark');
        $('.fi-rr-menu-burger').toggleClass('burger-white');
        $('#li-sec').toggleClass('li-dark');
        $('aside ul a li i, aside ul a li span').toggleClass('changeicon-to-white');
        $('.active-dash i, .active-dash span').toggleClass('change-active-icon');
    })

  
});

// $('.custom_chekbox').on('click', function(){
//   $(this).toggleClass('custom_chekbox_active');
//   $(this).children('.fa-check').toggleClass('custom_chekbox_innerimg');
//   const sib = $(this).siblings('.originalchek');
//   sib.trigger("click");
// });

let loginSuccessModal = document.querySelector('#loginSuccess-modal');
let exitSucessIcon = document.querySelector('#exitSucessIcon');

if(exitSucessIcon){
  exitSucessIcon.addEventListener('click', function(){
    loginSuccessModal.style.display = 'none';
  })
}


setTimeout(() => {
  if(loginSuccessModal){
    loginSuccessModal.style.display = 'none';
  }
},5000);

let successBox = document.querySelector('#success_box');

setTimeout(() => {
  if(successBox){
    successBox.style.display = 'none';
  }
}, 5000);

// $(document).ready(function() {
//   $('select').niceSelect();
// });


