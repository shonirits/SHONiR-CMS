// owl carousel start
t(document).ready(function() {
           
    var same = t('.same_products');
    same.owlCarousel({
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,lazyLoad: true,
        rewind:true,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });
    
    // Go to the next item
    t('.samep').click(function() {
        same.trigger('next.owl.carousel');
    })
    // Go to the previous item
    t('.samen').click(function() {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        same.trigger('prev.owl.carousel', [300]);
    })



    var like = t('.like_products');
    like.owlCarousel({
        lazyLoad: true,  autoplay:true,
        autoplayTimeout:3000,lazyLoad: true,
        autoplayHoverPause:true,
        rewind:true,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });
    
    // Go to the next item
    t('.likep').click(function() {
        like.trigger('next.owl.carousel');
    })
    // Go to the previous item
    t('.liken').click(function() {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        like.trigger('prev.owl.carousel', [300]);
    })


    var trend = t('.trend_products');
    trend.owlCarousel({
        lazyLoad: true,
        rewind:true,
         autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });
    
    // Go to the next item
    t('.trendp').click(function() {
        trend.trigger('next.owl.carousel');
    })
    // Go to the previous item
    t('.trendn').click(function() {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        trend.trigger('prev.owl.carousel', [300]);
    })
   
  });
//   owl carousel end


// uploader start


function readURL(input) {
if (input.files && input.files[0]) {

  var reader = new FileReader();

  reader.onload = function(e) {
    t('.image-upload-wrap').hide();

    t('.file-upload-image').attr('src', e.target.result);
    t('.file-upload-content').show();

    t('.image-title').html(input.files[0].name);
  };

  reader.readAsDataURL(input.files[0]);

} else {
  removeUpload();
}
}

function removeUpload() {
t('.file-upload-input').replaceWith(t('.file-upload-input').clone());
t('.file-upload-content').hide();
t('.image-upload-wrap').show();
}
t('.image-upload-wrap').bind('dragover', function () {
      t('.image-upload-wrap').addClass('image-dropping');
  });
  t('.image-upload-wrap').bind('dragleave', function () {
      t('.image-upload-wrap').removeClass('image-dropping');
});


// upload end