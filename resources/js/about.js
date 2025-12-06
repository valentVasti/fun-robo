// about-content-section Delay Animation
document.addEventListener('DOMContentLoaded', function () {
    const aboutContent = document.querySelectorAll('.content');
    
    aboutContent.forEach((card, index) => {
      const dynamicDelay = index * 300; // Adjust the multiplier based on your preference
      card.setAttribute('data-aos-delay', dynamicDelay);
    });
  
    AOS.init({
      duration: 1000,
      once: true,
    });
  });
  
