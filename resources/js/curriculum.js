// Curriculum Wrapper Delay Animation
document.addEventListener('DOMContentLoaded', function () {
  const curriculumWrappers = document.querySelectorAll('.subject');

  curriculumWrappers.forEach((card, index) => {
    const dynamicDelay = index * 200; // Adjust the multiplier based on your preference
    card.setAttribute('data-aos-delay', dynamicDelay);
  });

  AOS.init({
    duration: 1000,
    once: true,
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const deskripsiDivs = document.querySelectorAll('.deskripsi');

  deskripsiDivs.forEach(function (deskripsi) {
    const olElements = deskripsi.querySelectorAll('ol');

    olElements.forEach(function (ol) {
      const ul = document.createElement('ul');
      while (ol.firstChild) {
        const li = document.createElement('li');
        li.appendChild(ol.firstChild);
        ul.appendChild(li);
      }
      ol.parentNode.replaceChild(ul, ol);
    });
  });
});

