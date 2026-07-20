import './bootstrap';
import '../scss/app.scss';
import './custom-swiper.js';

document.querySelectorAll('.navlink-about-us a').forEach(link => {
    link.addEventListener('click', transitionAboutUs);
});

function transitionAboutUs(event) {
    event.preventDefault();
    document.querySelectorAll('.section-inf > div').forEach(section => {

        if (section.classList.contains('grid')) {
            
            section.classList.remove('grid');
           
        }
    });

    const target = event.target.getAttribute('data-target');
    
    document.getElementById(target).classList.add('grid');
}

const burger = document.getElementById('burgerMenu');
    const mobileMenu = document.getElementById('mobileMenu');
    const closeBtn = document.getElementById('closeBtn');

    burger.addEventListener('click', () => {
        mobileMenu.classList.remove('translate-x-full');
    });

    closeBtn.addEventListener('click', () => {
        mobileMenu.classList.add('translate-x-full');
    });
    
// document.querySelectorAll('.product').forEach(product => {
//     product.addEventListener('click', () => {
//         product.classList.toggle('active');
//     });
// });

