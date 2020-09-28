const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-ul');
    const navUl = document.querySelectorAll('.nav-ul li');

    burger.addEventListener('click',()=>{
      //toggle nav
      nav.classList.toggle('nav-active');

      //animate list
      navUl.forEach((link,index)=>{
        if (link.style.animation) {
          link.style.animation = ''
        } else {
          link.style.animation = `navUlFade 0.5s ease forwards ${index / 7 + 0.5}s`;
        }
      });

      //Cross toggle
      burger.classList.toggle('toggle');

    });

}

navSlide();
