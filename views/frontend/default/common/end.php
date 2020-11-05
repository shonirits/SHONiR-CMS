<script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');    }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <div class="modal fade" id="ajax-popup" tabindex="-1"
    role="dialog" aria-labelledby="ajax-popup-lable" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="right" title="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
            <div class="modal-body ajax-popup">
            </div>
        </div>
    </div>
</div>

</div>
<script src="<?php echo SHONiR_CDN_AST ?>assets/jquery/3.4.1/jquery.min.js" ></script>
<script src="<?php echo SHONiR_CDN_AST ?>assets/velocity/2.0/velocity.min.js"></script>
<script src="<?php echo SHONiR_CDN_AST ?>assets/velocity/2.0/velocity.ui.min.js"></script>
    <script src="<?php echo SHONiR_CDN_AST ?>assets/marquee/1.5.0/jquery.marquee.min.js"></script>
    <script src="<?php echo SHONiR_CDN_AST ?>assets/jquery.easing/1.4.1/jquery.easing.min.js"></script>
    <script src="<?php echo SHONiR_CDN_AST ?>assets/pause/2/jquery.pause.min.js"></script>
    <script src="<?php echo SHONiR_CDN_AST ?>assets/popper.js/1.14.6/popper.min.js"></script>
    <script src="<?php echo SHONiR_CDN_AST ?>assets/tooltip.js/1.3.1/tooltip.min.js"></script>
    <script src="<?php echo SHONiR_CDN_AST ?>assets/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>var _tooltip = jQuery.fn.tooltip;</script>
    <script src="<?php echo SHONiR_CDN_AST ?>assets/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?php echo SHONiR_CDN_AST ?>assets/fontawesome/5.10.1/js/all.min.js"></script>
    <script type="text/javascript">
var d = jQuery.noConflict();
var b = d;
var w = d;
var t = d;
var p = d;
</script>
<script>d.fn.tooltip = _tooltip;</script>
<script src="<?php echo SHONiR_CDN_AST ?>assets/fancybox/3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="<?php echo SHONiR_CDN_AST ?>assets/noty/3.2.0-beta/lib/noty.js"></script>
<script src="<?php echo SHONiR_CDN_AST ?>assets/owlcarousel/2.3.4/js/owl.carousel.min.js"></script>
<script src="<?php echo SHONiR_CDN_AST ?>assets/loading-overlay/2.1.6/dist/loadingoverlay.min.js"></script>
<script src="<?php echo SHONiR_CDN_AST ?>assets/intl-tel/16.0.15/build/js/intlTelInput.min.js"></script>
<script src="<?php echo SHONiR_CDN_AST ?>assets/fotorama/4.6.4/fotorama.js"></script>
<script src="<?php echo SHONiR_CDN_AST ?>assets/dropzone/5.7.0/dist/min/dropzone.min.js"></script>
<script src="<?php echo SHONiR_CDN_AST ?>assets/star-rating-svg/1.3.0/src/jquery.star-rating-svg.js"></script>
    <script src="<?php echo SHONiR_CDN_AST ?>js/frontend/default.js"></script>
    <script src="<?php echo SHONiR_BASE ?>js/frontend/<?php echo SHONiR_THEME ?>/theme.js"></script>

    <div class="alert text-center cookiealert" role="alert">
    By using this website you allow us to place cookies on your computer. They are harmless and never personally identify you.
    We uses cookies in order to enable essential services and functionality on our site and to collect data on how visitors interact with our site, products, services and ensure you get the best experience on our website. <a href="https://en.wikipedia.org/wiki/HTTP_cookie" target="_blank">Learn more</a>

    <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
        I agree
    </button>
</div>
<script src="<?php echo SHONiR_CDN_AST ?>assets/cookiealert/0.1/cookiealert.js"></script>
<script>
function SHONiR_Show_Loading_Fnc(id) {
  p(id).html('<p><div class="wait" > <p> Loading... </p> <img src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.SHONiR_SETTINGS['config_loader'];?>"/></div></p>');
}

p(document).ready(function(){

   <?php

if(SHONiR_Session_Exist_Fnc('SHONiR_Alert')){

    $SHONiR_Alert = SHONiR_Session_Read_Fnc('SHONiR_Alert');

  echo "SHONiR_Alert_Fnc('".$SHONiR_Alert['message']."', '".$SHONiR_Alert['type']."');";;

  SHONiR_Session_Delete_Fnc('SHONiR_Alert');

}

?>

if(p('.goog-te-banner-frame').length > 0){
            p('.goog-te-banner-frame').css('display','none');
           p('body').css('top',0);
    }

    });


    p(function() {

 p(".th-menu .navbar-nav .dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
    event.preventDefault();
    event.stopPropagation();

    p(this).siblings().toggleClass("show");


    if (!p(this).next().hasClass('show')) {
      p(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
    }
    p(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
      p('.th-menu .navbar-nav .dropdown-submenu .show').removeClass("show");
    });

  });

    });
  </script>
  <style>
.google-translate {
    display: inline-block;
    vertical-align: top;
    padding-top: 15px;
}

.goog-logo-link {
    display: none !important;
}

.goog-te-gadget {
    color: transparent !important;
    display: inline-flex !important;
}

.goog-te-gadget .goog-te-combo {
  margin:0;
}
    </style>
    <?php echo SHONiR_SETTINGS['code_footer']?>