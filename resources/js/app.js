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

// document.querySelectorAll('.product').forEach(product => {
//     product.addEventListener('click', () => {
//         product.classList.toggle('active');
//     });
// });

