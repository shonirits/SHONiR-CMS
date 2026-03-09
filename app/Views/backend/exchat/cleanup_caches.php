<?php echo view('backend/'.$cc['backend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/head');?>
  </head>
  <body><?php echo view('backend/'.$cc['backend_theme'].'/common/body_start');?>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/header');?>
       <div class="container">
        <div class="row">
    <div class="col">
      <h3 class="m-3">Cleanup Caches</h3>
      </div>
  </div>
        <div class="row">
    <div class="col">
      <ul id="taskStatus" class="mt-3 list-unstyled">
  <li>🧹 Clear Session Data <span class="status-icon"></span></li>
  <li>🗃️ Optimize Database Tables <span class="status-icon"></span></li>
  <li>⚙️ Purge PHP Cache Files <span class="status-icon"></span></li>
  <li>🧾 Refresh HTML Page Cache <span class="status-icon"></span></li>
  <li>🖼️ Cleanup Cached Images <span class="status-icon"></span></li>
</ul>

      </div>
  </div>
  <div class="row">
    <div class="col">
      
      <div id="progressbar"><div id="progress-label">0%</div></div>
      <button id="startCleanup" class="btn btn-danger mt-3">Start Cleanup</button>
    </div>
  </div>
</div>

  <?php echo view('backend/'.$cc['backend_theme'].'/common/footer');?>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/body_end');?>
  <script>
function content_fnc() {

   p("#progressbar").progressbar({
    value: 0,
    change: function () {
      p("#progress-label").text(p("#progressbar").progressbar("value") + "%");
    }
  });

  p("#startCleanup").on("click", function () {
    const steps = [1, 2, 3, 4, 5];
    let currentStep = 0;

    p("#startCleanup").prop("disabled", true);

    function runCleanupStep() {
      if (currentStep >= steps.length) return;

      p.ajax({
        url: base_url + "Ajax/cron",
        method: "POST",
        data: { do: true, step: steps[currentStep] },
        success: function () {
          let percent = Math.floor(((currentStep + 1) / steps.length) * 100);
          p("#progressbar").progressbar("value", percent);
          const $item = p("#taskStatus li").eq(currentStep);
              $item.addClass("completed");
              const $icon = $item.find(".status-icon");
              $icon.hide();
              $icon.html(`<i class="fas fa-check-circle"></i>`);
              $icon.fadeIn(900); 
          currentStep++;
          if (currentStep >= steps.length) {
          p("#progress-label").text("Cleanup Complete 🎉");
          p("#progress-label").css({ color: "#28a745", fontWeight: "bold" });
          return;
          }
          setTimeout(runCleanupStep, 7000);
        },
        error: function () {
          alert("Error during cleanup step " + steps[currentStep]);
        }
      });
    }

    p("#progressbar").progressbar("value", 0);
    p("#progress-label").text("0%");
    setTimeout(runCleanupStep, 7000);
  });

  }
    
</script>
</body>
<?php echo view('backend/'.$cc['backend_theme'].'/common/page_end');?>
