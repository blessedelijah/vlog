// window.alert('hi');

let successbox = document.querySelector('#success_box');
let errorbox = document.querySelector('#error_box');

setTimeout(() => {
   successbox.style.display = 'none';
}, 5000);


setTimeout(() => {
   errorbox.style.display = 'none';
}, 5000);

let socialName = document.querySelectorAll('#socialName');

if(socialName){
   socialName.forEach(socialNames => {

      socialNames.addEventListener('mouseenter', function(e){
          let $this = e.target;
      //     console.log($this);
          let parent = $this.parentElement;
          let firstchildBox = parent.children[0].children[0];
          firstchildBox.classList.add('SocialIconclass')
      });

  
   socialNames.addEventListener('mouseleave', function(e){
         let $this = e.target;
         let parent = $this.parentElement;
         let firstchildBox = parent.children[0].children[0];
         firstchildBox.classList.remove('SocialIconclass')
      });
   });
}



// let blogImgBoxs = document.querySelectorAll('#blogImgBox');

// window.addEventListener('scroll', function(){

//    blogImgBoxs.forEach(blogImgBox => {
//       blogImgBox.classList.add('animate__fadeInLeftBig');
//    });
// })


let header = document.querySelector('#header');
let vloggy = document.querySelector('#vloggy');

window.addEventListener('scroll', function(){

   if(header && vloggy){
      if(scrollY > 280){

         header.style.background = 'white';
         header.classList.add('animate__fadeInDown');
         header.style.width = '100%';
         header.style.borderRadius = '0';
         header.style.top = '0';
         // vloggy.style.color = 'white';
         vloggy.style.transition = '0s';
      
        }else{
         header.classList.remove('animate__fadeInDown');
         header.style.background = 'white';
         header.style.width = '80%';
         header.style.borderRadius = '50px';
         header.style.top = '';
         // vloggy.style.color = 'black';
         vloggy.style.transition = '0.3s ease-in-out';
      
        }
   }
  
})

   let more = document.querySelector('#mega_con');
   let arrowdown = document.querySelector('#arrow-down');
   let mega = document.querySelector('#mega');

   if(more){

      more.addEventListener('click', function(){
         arrowdown.classList.toggle('arrowDownClass');
         mega.classList.toggle('megaToggle');
      })
   }


   let loginSuccessModal = document.querySelector('#loginSuccess-modal');
   let exitSucessIcon = document.querySelector('#exitSucessIcon');

   if(exitSucessIcon){

      exitSucessIcon.addEventListener('click', function(){
         loginSuccessModal.style.display = 'none';
      })
   }

   if(loginSuccessModal){
      setTimeout(() => {
         loginSuccessModal.style.display = 'none';
       },10000);
   }






   


