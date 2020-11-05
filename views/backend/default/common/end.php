</div>

<script src="assets/jquery/3.4.1/jquery.min.js" ></script>
<script type="text/javascript">
var d = jQuery.noConflict();
var b = d;
var w = d;
var z = d;
var p = d;
</script>
<script src="assets/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
b.widget.bridge('uibutton', b.ui.button);
b.widget.bridge('uitooltip',b.ui.tooltip);
</script>
    <script src="assets/marquee/1.5.0/jquery.marquee.min.js"></script>
    <script src="assets/jquery.easing/1.4.1/jquery.easing.min.js"></script>
    <script src="assets/pause/2/jquery.pause.min.js"></script>
    <script src="assets/popper.js/1.14.6/popper.min.js"></script>
    <script src="assets/tooltip.js/1.3.1/tooltip.min.js"></script>
    <script src="assets/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="assets/fontawesome/5.10.1/js/all.min.js"></script>
<script src="assets/fancybox/3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="assets/noty/3.2.0-beta/lib/noty.js"></script>
<script src="assets/tinymce/5/tinymce.min.js"></script>
<script src="assets/select2/4.0.11/js/select2.min.js"></script>
<script src="assets/sb-admin-2/js/sb-admin-2.min.js"></script>
  <script src="assets/sb-admin-2/vendor/chart.js/Chart.min.js"></script>
  <script src="assets/sb-admin-2/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="assets/momentjs/2.26.0/moment.min.js"></script>
  <script src="assets/daterangepicker/3.1/daterangepicker.js"></script>
<script src="js/backend/default.js"></script> 
<script src="js/backend/default/theme.js"></script>

    <script>

p(document).ready(function(){
  p('[data-toggle="tooltip"]').tooltip();
	p('#shonirall').fadeIn(3000);
    new WOW().init();
   setTimeout(function() {   }, 5000);

   <?php

if(SHONiR_Session_Exist_Fnc('SHONiR_Alert')){

    $SHONiR_Alert = SHONiR_Session_Read_Fnc('SHONiR_Alert');

  echo "SHONiR_Alert_Fnc('".$SHONiR_Alert['message']."', '".$SHONiR_Alert['type']."');";;

  SHONiR_Session_Delete_Fnc('SHONiR_Alert');

}

?>

	})
  </script>   
