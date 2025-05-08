import './bootstrap';
import '../scss/app.scss';
import './custom-swiper.js';
import './embeddedReturn.js';
import './checkout.js';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const burgerMenu = document.getElementById('burgerMenu');
const mobileMenu = document.getElementById('mobileMenu');
const closeBtnMenu = document.getElementById('closeBtn');

burgerMenu.addEventListener('click', visualBurgerMenu);
closeBtnMenu.addEventListener('click', closingBtn);
function visualBurgerMenu () {
    mobileMenu.classList.toggle('active');
}

function closingBtn() {
    mobileMenu.classList.remove('active');
}

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

// document.querySelectorAll('.product').forEach(product => {
//     product.addEventListener('click', () => {
//         product.classList.toggle('active');
//     });
// });

