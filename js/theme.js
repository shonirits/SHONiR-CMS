p(document).ready(function(){
    
    p('.carousel ').carousel({
    interval: 3000
  });
  
    var slidetp = p('.trending_carousel');
    slidetp.owlCarousel({
      items:4,
      lazyLoad:true,
      loop:true,
      nav:true,
      margin:10,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      responsive:{
          0:{
              items:1
          },
          400:{
              items:2
          },
          600:{
              items:3
          },            
          960:{
              items:4
          },
          1200:{
              items:4
          }
        }
  });
  
  slidetp.on('mousewheel', '.owl-stage', function (e) {
      if (e.deltaY>0) {
        slidetp.trigger('next.owl');
      } else {
        slidetp.trigger('prev.owl');
      }
      e.preventDefault();
  });
  
  
  var slidefp = p('.featured_carousel');
    slidefp.owlCarousel({
      items:4,
      lazyLoad:true,
      loop:true,
      nav:true,
      margin:10,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      responsive:{
          0:{
              items:1
          },
          400:{
              items:2
          },
          600:{
              items:3
          },            
          960:{
              items:4
          },
          1200:{
              items:4
          }
        }
  });
  
  slidefp.on('mousewheel', '.owl-stage', function (e) {
      if (e.deltaY>0) {
        slidefp.trigger('next.owl');
      } else {
        slidefp.trigger('prev.owl');
      }
      e.preventDefault();
  });
  
  
  var slidervp = p('.recently_viewed_products_carousel');
    slidervp.owlCarousel({
      items:4,
      lazyLoad:true,
      loop:true,
      nav:true,
      margin:10,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      responsive:{
          0:{
              items:1
          },
          400:{
              items:2
          },
          600:{
              items:3
          },            
          960:{
              items:4
          },
          1200:{
              items:4
          }
        }
  });
  
  slidervp.on('mousewheel', '.owl-stage', function (e) {
      if (e.deltaY>0) {
        slidervp.trigger('next.owl');
      } else {
        slidervp.trigger('prev.owl');
      }
      e.preventDefault();
  });


  var sliderp = p('.related_products_carousel');
    sliderp.owlCarousel({
      items:4,
      lazyLoad:true,
      loop:true,
      nav:true,
      margin:10,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      responsive:{
          0:{
              items:1
          },
          400:{
              items:2
          },
          600:{
              items:3
          },            
          960:{
              items:4
          },
          1200:{
              items:4
          }
        }
  });
  
  sliderp.on('mousewheel', '.owl-stage', function (e) {
      if (e.deltaY>0) {
        sliderp.trigger('next.owl');
      } else {
        sliderp.trigger('prev.owl');
      }
      e.preventDefault();
  });
  
       
  
       p('.marquee').marquee({
  
  allowCss3Support: true,
  
  css3easing: 'linear',
  
  easing: 'linear',
  
  delayBeforeStart: 1000,
  
  direction: 'left',
  
  duplicated: false,
  
  duration: 20000,
  
  gap: 20,
  
  pauseOnCycle: false,
  
  pauseOnHover: true,
  
  startVisible: false
  
  });   
  
      });