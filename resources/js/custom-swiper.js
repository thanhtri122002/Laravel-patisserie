var swiper = new Swiper(".mySwiper", {
    effect: "cards",
    grabCursor: true,
    on: {
      slideChange: function() {
        let activeIndex = this.slides[this.activeIndex];
        let slideId = activeIndex.getAttribute('data-slide-id');
        updateTextContent(slideId);
      },
     },
  });

function updateTextContent(slideId) {
  document.querySelectorAll('.special-product-des > .dynamic-text').forEach(content => {
    content.classList.remove('active');
  });
  let currentActiveContent = document.getElementById(slideId);
   
    if (currentActiveContent) {
        currentActiveContent.classList.add('active'); // Make the text visible
        
    }
}
  