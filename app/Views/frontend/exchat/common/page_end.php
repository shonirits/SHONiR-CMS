</html>
<script>
 var all_loaded = false;
if ( document.addEventListener ) {

  document.addEventListener( "DOMContentLoaded", function(){
    document.removeEventListener( "DOMContentLoaded", arguments.callee, false);
    var default_js_loaded = setInterval(() => {
      if (typeof isDesktop !== "undefined") {
        clearInterval(default_js_loaded);        
        dom_ready_fnc();
        all_loaded = true;
      }
}, 10);    
  }, false );

} else if ( document.attachEvent ) {
  
  document.attachEvent("onreadystatechange", function(){
    if ( document.readyState === "complete" ) {
      document.detachEvent( "onreadystatechange", arguments.callee );
     var default_js_loaded = setInterval(() => {
      if (typeof isDesktop !== "undefined") {
        clearInterval(default_js_loaded);        
        dom_ready_fnc();
        all_loaded = true;
      }
}, 10);
    }
  });

}
</script>
<script>

  function page_fnc() {

     const core_ready = are_core_plugins_ready_fnc();
    if (!core_ready) {
      setTimeout(page_fnc, 10);
      return;
    }

  check_bootstrap_fnc();
  check_jqueryui_fnc();

  if (typeof content_fnc === 'function') {
  content_fnc(token);
}

 const header = document.querySelector('.t-header');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
      header.classList.add('shrink');
    } else {
      header.classList.remove('shrink');
    }
  });

int_fnc(token);

  p('.t-hero-slider').slick({
    autoplay: true,
    autoplaySpeed: 5000,
    infinite: true,
    arrows: true,
    prevArrow: '<button type=\'button\' class=\'arrows prevArrow\'><i class="fa-solid fa-angle-left"></i></button>',
    nextArrow: '<button type=\'button\' class=\'arrows nextArrow\'><i class="fa-solid fa-angle-right"></i></button>',
    dots: true,
    speed: 300,
  slidesToShow: 1,
  adaptiveHeight: true,
  cssEase: 'linear'
  });

  p('.t-ymal-slider').slick({
    autoplay: true,
    autoplaySpeed: 5000,
    centerMode: true,
  centerPadding: '60px',
    lazyLoad: 'ondemand',
  infinite: true,
  slidesToShow: 6,
  slidesToScroll: 6,
  arrows: true,
  prevArrow: '<button type=\'button\' class=\'arrows prevArrow\'><i class="fa-solid fa-angle-left"></i></button>',
    nextArrow: '<button type=\'button\' class=\'arrows nextArrow\'><i class="fa-solid fa-angle-right"></i></button>',
    dots: true,
    speed: 300,
  cssEase: 'linear',
  responsive: [
     {
      breakpoint: 1024,
      settings: {
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 4,
        slidesToScroll: 4
      }
    },
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});


const productItems = document.querySelectorAll('.product-item');

    productItems.forEach(item => {
        const productThumb = item.querySelector('.product-thumb');
        const starRatingContainer = productThumb.querySelector('.star-rating');
        const stars = starRatingContainer ? starRatingContainer.querySelectorAll('.fa-star') : [];
        const rating = parseFloat(item.dataset.rating) || 0;

        const colorRating = rating > 0 ? Math.ceil(rating) : 0;

        if (starRatingContainer && stars.length > 0) {
            if (colorRating > 0) {
                starRatingContainer.classList.add(`rating-${colorRating}`);
            }

            stars.forEach((star, index) => {
                const starValue = index + 1;
                star.classList.remove('fa-regular', 'fa-solid', 'fa-star-half-stroke', 'filled');

                if (starValue <= rating) {
                    star.classList.add('fa-solid', 'fa-star', 'filled');
                } else if (starValue - 0.5 === rating) {
                    star.classList.add('fa-solid', 'fa-star-half-stroke', 'filled');
                } else {
                    star.classList.add('fa-regular', 'fa-star');
                }
            });
        }
    });

   p("#query-fld").on("input", function() {
        search_fnc(p(this).val(), token);
    });

}

</script>
<?php echo $cc['end_code']; ?>