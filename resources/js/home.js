// Benefit Card Delay Animation
document.addEventListener('DOMContentLoaded', function () {
  const benefitCards = document.querySelectorAll('.benefit-card');

  benefitCards.forEach((card, index) => {
    const dynamicDelay = index * 200;
    card.setAttribute('data-aos-delay', dynamicDelay);
  });

  AOS.init({
    duration: 1000,
    once: true,
  });
});

// Curriculum Card Delay Animation
document.addEventListener('DOMContentLoaded', function () {
  const curriculumCards = document.querySelectorAll('.curriculum-card');

  curriculumCards.forEach((card, index) => {
    const dynamicDelay = index * 200;
    card.setAttribute('data-aos-delay', dynamicDelay);
  });

  AOS.init({
    duration: 1000,
    once: true,
  });
});

document.addEventListener('DOMContentLoaded', function(){
      $('.home-slick').slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows:true,
        responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            }
          },
          {
            breakpoint: 840,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
    });
});