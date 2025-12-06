// Gallery Delay Animation
document.addEventListener('DOMContentLoaded', function () {
    const galleryWrapper = document.querySelectorAll('.gallery-wrapper');
  
    galleryWrapper.forEach((card, index) => {
      const dynamicDelay = index * 200; // Adjust the multiplier based on your preference
      card.setAttribute('data-aos-delay', dynamicDelay);
    });
  
    AOS.init({
      duration: 1000,
      once: true,
    });
  });
  