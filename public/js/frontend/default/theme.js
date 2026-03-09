
(function wait_core_plugins_ready() {

  if (typeof are_core_plugins_ready_fnc !== "function" ||
      !are_core_plugins_ready_fnc()) {

    setTimeout(wait_core_plugins_ready, 20);
    return;
  }
(function(t) {
  "use strict";

  let luxMenuDelay;

  
  function t_luxSecureFlip(el) {
    if (window.innerWidth < 992) return;
    const parent = t(el);
    const menu = parent.children('.dropdown-menu, ul');
    if (!menu.length) return;

    // Reset
    menu.removeClass('flip-left sub-flip-left');

    setTimeout(() => {
      // Measure invisible element
    menu.css({ 'display': 'block', 'visibility': 'hidden', 'opacity': '0' });
        const rect = menu[0].getBoundingClientRect();
    const viewportWidth = window.innerWidth;

    if (menu.hasClass('level-1')) {
      if (rect.right > viewportWidth) menu.addClass('flip-left');
    } else {
      if (rect.right > (viewportWidth - 10)) menu.addClass('sub-flip-left');
    }

    // Restore
    menu.css({ 'display': '', 'visibility': '', 'opacity': '' });
      }, 250);


  }

  t(document).ready(function() {
    
    // DESKTOP: Professional Hover Intent
    t('.navbar-zone li, .navbar-zone .nav-item').on('mouseenter', function(e) {
      const self = t(this);
      clearTimeout(luxMenuDelay);
      e.stopPropagation();
      
      self.siblings().removeClass('is-active animated');
      self.addClass('is-active animated');

      setTimeout(() => {
        t_luxSecureFlip(this);
      }, 250);
      
    }).on('mouseleave', function() {
      const self = t(this);
      luxMenuDelay = setTimeout(() => {
        if (!self.is(':hover')) {
           self.removeClass('is-active animated');
        }
      }, 550);
    });


    // MOBILE: Recursive Accordion with Borders
    t(document).on('click', '.t-header .has-submenu', function(e) {
      if (window.innerWidth < 992) {
        e.preventDefault();
        e.stopPropagation();

        const subMenu = t(this).next('.dropdown-menu, ul');
        
        // Close siblings for premium focus
        t(this).parent().siblings().find('.dropdown-menu, ul').slideUp(300);
        t(this).parent().siblings().find('.has-submenu').removeClass('submenu-active');
        
        subMenu.slideToggle(400);
        t(this).toggleClass('submenu-active');
      }
    });

    // STICKY POLISH: Performance-Throttled Scroll
    let scrollTimer;
    t(window).on('scroll', function() {
      if (scrollTimer) window.clearTimeout(scrollTimer);
      scrollTimer = setTimeout(function() {
        const headerMain = t('.t-header .main-zone');
        if (t(window).scrollTop() > 100) {
          headerMain.addClass('py-0 shadow-sm').removeClass('py-1');
        } else {
          headerMain.addClass('py-1').removeClass('py-0 shadow-sm');
        }
      }, 10);
    });


const ratingZones = document.querySelectorAll('.rating-zone');

ratingZones.forEach(zone => {

    const ratingContainer = zone.querySelector('[data-rating]');
    const rating = ratingContainer ? parseFloat(ratingContainer.dataset.rating) || 0 : 0;

    const starRatingContainer = zone.querySelector('.star-rating');
    const stars = starRatingContainer ? starRatingContainer.querySelectorAll('.fa-star') : [];

    const roundedRating = Math.floor(rating);
    if (roundedRating > 0) {
        zone.classList.add('rating-' + roundedRating);
    }

    if (starRatingContainer && stars.length > 0) {
        stars.forEach((star, index) => {
            const starValue = index + 1;

            star.classList.remove('fa-regular', 'fa-solid', 'fa-star', 'fa-star-half-stroke', 'filled');

            if (starValue <= rating) {
                star.classList.add('fa-solid', 'fa-star', 'filled');
            } 
            else if (starValue - 0.5 === rating) {
                star.classList.add('fa-solid', 'fa-star-half-stroke', 'filled');
            } 
            else {
                star.classList.add('fa-regular', 'fa-star');
            }
        });
    }

});


function autoFlipQuickCart(zone) {

  const content = zone.find('.quick-cart-content');
  if (!content.length) return;

  if (!content.hasClass('flip-left')) {

  setTimeout(() => {

    const rect = content[0].getBoundingClientRect();
    const viewportWidth = window.innerWidth;    

    if (rect.right > viewportWidth) {
      content.addClass('flip-left');
    }

    }, 150);

  }

}

  let cartHoverTimeout;

t('.cart-zone').on('mouseenter', function () {
  if (window.innerWidth >= 992) {
    const self = t(this);
    clearTimeout(cartHoverTimeout);
    cartHoverTimeout = setTimeout(() => {
      self.addClass('show');
      self.find('.quick-cart-content').addClass('show');
      setTimeout(() => {
        autoFlipQuickCart(self);
      }, 150);
    }, 120);
  }
}).on('mouseleave', function () {
  if (window.innerWidth >= 992) {
    const self = t(this);
    cartHoverTimeout = setTimeout(() => {
      self.removeClass('show');
      self.find('.quick-cart-content').removeClass('show');
       setTimeout(() => {
        autoFlipQuickCart(self);
      }, 250);
    }, 250);
  }
});


p("#query-fld").on("input", function() {
        search_fnc(p(this).val(), token);
    });

 
    // TRIGGER SEARCH (Mobile)
  d('.search-trigger').on('click', function(e) {
    e.preventDefault();
    if (window.innerWidth < 992) {
      d('.search-zone').addClass('is-active');
      // Gentle delay for focus to allow animation to start
      setTimeout(() => { d('#query-fld').focus(); }, 350);
    }
  });

  // CLOSE SEARCH (Click Outside)
  d(document).on('click touchstart', function(e) {
    if (window.innerWidth < 992) {
      const $searchZone = d('.search-zone');
      // If clicking outside the search zone and the trigger icon
      if ($searchZone.hasClass('is-active') && 
          !d(e.target).closest('.search-zone, .search-trigger').length) {
        $searchZone.removeClass('is-active');
      }
    }
  });

  // ESC Key to Close
  d(document).on('keydown', function(e) {
    if (e.key === "Escape") {
      d('.search-zone').removeClass('is-active');
    }
  });

t('.t-hero-slider').on('init', function(e, slick) {
    var $firstAnimatingElements = t('.slider-item:first-child').find('[data-animation-in]');
    do_slider_animations_fnc($firstAnimatingElements);
});

t('.t-hero-slider').on('beforeChange', function(e, slick, currentSlide, nextSlide) {
    var $animatingElements = t('.slider-item[data-slick-index="' + nextSlide + '"]').find('[data-animation-in]');
    do_slider_animations_fnc($animatingElements);
});

t('.t-hero-slider').slick({
    autoplay: true,
    autoplaySpeed: 5000,
    fade: true,
    cssEase: 'linear',
    arrows: true,
    dots: true,
    prevArrow: '<button class="arrows prevArrow"><i class="fa-solid fa-chevron-left"></i></button>',
    nextArrow: '<button class="arrows nextArrow"><i class="fa-solid fa-chevron-right"></i></button>',
    responsive: [
        {
            breakpoint: 768,
            settings: {
                arrows: false
            }
        }
    ]
});

function do_slider_animations_fnc(elements) {
    var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
    elements.each(function() {
        var $this = t(this);
        var $animationDelay = $this.data('delay-in');
        var $animationType = 'animate__' + $this.data('animation-in');
        $this.css({
            'animation-delay': $animationDelay + 's',
            '-webkit-animation-delay': $animationDelay + 's'
        }).addClass($animationType).one(animationEndEvents, function() {
            $this.removeClass($animationType);
        });
    });
}


  p('.t-ymal-slider').slick({
    autoplay: true,
    autoplaySpeed: 5000,
    centerMode: true,
  centerPadding: '60px',
    lazyLoad: 'ondemand',
  infinite: true,
  slidesToShow: 4,
  slidesToScroll: 4,
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
        slidesToShow: 3,
        slidesToScroll: 3
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


Fancybox.bind("[data-fancybox='galleries']", {
  Thumbs: true,
  Toolbar: {
    display: ["zoom","slideshow","fullscreen","download","thumbs","close"]
  }
});

Fancybox.bind("[data-fancybox='gallery_images']", {
  Thumbs: true,
  Toolbar: {
    display: ["zoom","slideshow","fullscreen","download","thumbs","close"]
  }
});

Fancybox.bind("[data-fancybox='gallery_videos']", {
  Thumbs: true,
  Toolbar: {
    display: ["zoom","slideshow","fullscreen","download","thumbs","close"]
  }
});



  });



})(t);

})();