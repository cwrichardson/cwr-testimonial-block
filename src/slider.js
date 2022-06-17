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
    effect: 'fade',
    initialSlide: '4',
  });

  setRating();

  swiper.on( 'slideChange', setRating );

});
