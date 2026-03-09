<div class="alert text-center cookiealert" role="alert">
    <br>
    By using this website you allow us to place cookies on your computer. They are harmless and never personally identify you.
    We uses cookies in order to enable essential services and functionality on our site and to collect data on how visitors interact with our site, products, services and ensure you get the best experience on our website. <a href="https://en.wikipedia.org/wiki/HTTP_cookie" target="_blank">Learn more</a><br><br>
    <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
        I agree
    </button>
    <br><br>
</div>
</div>
<div id="scroll-top" data-bs-toggle="tooltip" title="Scroll Top"><a href="javascript:scroll_Fnc('body_content')" ><i class="fas fa-arrow-up"></i></a></div>
<script data-src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/velocity-animate@1.5.2/velocity.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/velocity-animate@1.5.2/velocity.ui.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/bounce.js@0.8.2/bounce.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/mo-js@0.288.2/build/mo.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
<script>
   function check_bootstrap_fnc() {
        if (typeof bootstrap !== "undefined") {
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
d('[data-bs-toggle="tooltip"]').tooltip();
var bootstrapmodal = d.fn.modal.noConflict();
d.fn.bsmodal = bootstrapmodal;
        } else {
            setTimeout(check_bootstrap_fnc, 10);
        }
    }
</script>
<script data-src="https://cdn.jsdelivr.net/npm/jquery-ui@1.14.1/dist/jquery-ui.min.js"></script>
<script>
   function check_jqueryui_fnc() {
        if (typeof jQuery.ui !== "undefined") {
        d.widget.bridge('uitooltip', d.ui.tooltip);
        d('.uitooltip').uitooltip();
        } else {
            setTimeout(check_jqueryui_fnc, 10);
        }
    }
</script>
<script data-src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.0.0/js/all.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/noty@3.2.0-beta-deprecated/lib/noty.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/bootstrap-cookie-alert@1.2.2/cookiealert.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/star-rating-svg@3.5.0/dist/jquery.star-rating-svg.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/tinymce@5.1.0/tinymce.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1.5/dist/fancybox/fancybox.umd.min.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1.5/dist/carousel/carousel.umd.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1.5/dist/carousel/carousel.lazyload.umd.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1.5/dist/carousel/carousel.arrows.umd.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1.5/dist/carousel/carousel.thumbs.umd.js"></script>
<script src="https://cdn.jsdelivr.net/gh/shonirits/SHONiR-CMS@master/public/js/backend/default.min.js"></script>
<script data-src="<?php echo $cc['js_url'].'public/js/backend/'.$cc['backend_theme'].'/theme.js'; ?>"></script>