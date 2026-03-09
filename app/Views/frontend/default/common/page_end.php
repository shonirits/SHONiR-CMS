</html>
<script>
// Flag to ensure dom_ready_fnc runs only once
let all_loaded = false;

/**
 * Checks if isDesktop is defined and triggers dom_ready_fnc once.
 */
function checkDesktopReady() {
  if (typeof isDesktop !== "undefined" && !all_loaded) {
    try {
      dom_ready_fnc();
    } catch (err) {
      console.error("Error in dom_ready_fnc:", err);
    }
    all_loaded = true;
    return true;
  }
  return false;
}

/**
 * Waits until isDesktop is available, then runs dom_ready_fnc.
 * Includes a safety timeout to avoid infinite polling.
 */
function waitForDesktop(maxWaitMs = 10000, intervalMs = 50) {
  const start = Date.now();
  const poll = setInterval(() => {
    if (checkDesktopReady() || Date.now() - start > maxWaitMs) {
      clearInterval(poll);
    }
  }, intervalMs);
}

// Modern DOMContentLoaded listener
document.addEventListener("DOMContentLoaded", () => {
  waitForDesktop();
}, { once: true });

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

}

</script>
<?php echo $cc['end_code']; ?>