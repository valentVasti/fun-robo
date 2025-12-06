// award-container Delay Animation
document.addEventListener('DOMContentLoaded', function () {
    const awardContainer = document.querySelectorAll('.awards-container');
  
    awardContainer.forEach((card, index) => {
      const dynamicDelay = index * 200; // Adjust the multiplier based on your preference
      card.setAttribute('data-aos-delay', dynamicDelay);
    });
  
    AOS.init({
      duration: 1000,
      once: true,
    });
  });
  