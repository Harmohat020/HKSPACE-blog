const navSlide = () => {
    const smallDevice = document.querySelector('.small-device');
    const nav = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');
  
    //toggle nav
    smallDevice.addEventListener('click',()=>{
        nav.classList.toggle('nav-active');
  
        //animate
        navLinks.forEach((link, index) => {
          if(link.style.animation){
            link.style.animation = '';
          }else {
            link.style.animation = `navLinkFade 0.5s ease forwards ${index/7+0.5}s`
          }
        });
  
        //menu klik animation
        smallDevice.classList.toggle('toggle');
    });
  
  }
  
  navSlide();
  
  