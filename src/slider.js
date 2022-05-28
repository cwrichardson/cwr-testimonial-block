import Swiper, { Pagination } from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';

function setRating() {
    const testimonial = document.querySelector('.swiper-slide-active');
    let rating = testimonial.getAttribute('data-rating');
    const r = document.querySelector(':root');
    r.style.setProperty('--testimonial-star-rating', rating);
}

// init Swiper
window.addEventListener( 'DOMContentLoaded', () => {
  const swiper = new Swiper('.swiper', {
    modules: [ Pagination ],
    pagination: {
      clickable: true,
      el: '.swiper-pagination',
    },
  });

  setRating();

  swiper.on( 'slideChange', setRating );

});

/*
window.addEventListener( 'DOMContentLoaded', () => {
  const container = document.querySelector('.testimonial-container');
  const dotsContainer = document.querySelector('.testimonial-dots');
  const dots = [...dotsContainer.children];

  // We add an event listener on the parent container to the dots.
  dotsContainer.addEventListener('click', ({
    target
  }) => {
    // If the item clicked was not a dot, don't do anything
    if (!target.matches('.testimonial-dot')) return;
    const myIndex = dots.indexOf(target);
    // Move the container -100% * the dot index
    const offset = -100 * myIndex;
    container.style.transform = `translateX(${-100 * myIndex}%)`;
    dots.map(d => d.classList.remove('active'));
    target.classList.add('active');
  });
} );
*/

/**
let testimonialIndex = 1;
let testimonials, dots;

window.addEventListener( 'DOMContentLoaded', () => {
  testimonials = document.getElementsByClassName("testimonial");
  dots = document.getElementsByClassName("testimonial-dot");

  for ( let i = 0; i < dots.length; i++ ) {
    dots[i].onclick = () => currentTestimonial(i + 1);
  }

  showTestimonial(testimonialIndex);
} );

// dot image controls
function currentTestimonial(n) {
  showTestimonial(testimonialIndex = n);
}

function showTestimonial(n) {
  if (n > testimonials.length) {testimonialIndex = 1};
  if (n < 1) {testimonialIndex = testimonials.length};

  for ( let i = 0; i < testimonials.length; i++) {
    testimonials[i].classList.remove('active');
    testimonials[i].setAttribute('aria-hidden', true);
  }
  for ( let i = 0; i < dots.length; i++ ) {
    dots[i].className = dots[i].className.replace(" active", "");
  }

  const testimonial = testimonials[testimonialIndex-1];

  const rating = testimonial.getAttribute('data-rating');
  const r = document.querySelector(':root');
  r.style.setProperty('--star-rating', rating);

  testimonial.classList.add('active');
  testimonial.setAttribute('aria-hidden', false);

  dots[testimonialIndex-1].className += " active";
}
*/
