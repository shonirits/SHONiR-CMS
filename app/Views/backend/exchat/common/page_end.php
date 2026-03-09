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

int_fnc(token);

   p("#query-fld").on("input", function() {
        search_fnc(p(this).val(), token);
    });

}

</script>