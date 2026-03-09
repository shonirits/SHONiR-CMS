<?php echo view('backend/'.$cc['backend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/head');?>
  </head>
  <body><?php echo view('backend/'.$cc['backend_theme'].'/common/body_start');?>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/header');?>
  <div class="container">
  <div class="row">
    <div class="col-sm-8 mt-3">
   <div class="card shadow-sm bg-body rounded">
        <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title">Currency Converter</h5>
        <div class="d-flex"><i class="fas fa-exchange-alt fa-lg"></i></div>
        </div>

        <div class="card-body">
        <div class="input-group input-group-lg my-3">
  <span class="input-group-text">Amount</span>
  <input type="text" class="form-control" name="currency_amount" id="currency_amount" onkeypress="return is_key_numeric_fnc(event);" placeholder="0.00">
</div>

<div class="input-group input-group-lg  mb-3">
  <span class="input-group-text" >From</span>
        <select class="form-select form-select-lg" name="currency_from" id="currency_from">
        <?php foreach($currencies as $key){?>
  <option value="<?php echo $key['exchange_rate']; ?>"><?php echo $key['name']; ?></option>
  <?php }?>
</select>
</div>

<div class="input-group input-group-lg  mb-3">
  <span class="input-group-text" >TO</span>
        <select class="form-select form-select-lg" name="currency_to" id="currency_to">
        <?php foreach($currencies as $key){?>
  <option value="<?php echo $key['exchange_rate']; ?>"><?php echo $key['name']; ?></option>
  <?php }?>
</select>
</div>

<div class="d-flex justify-content-center align-middle fs-1 fw-bolder my-4" id="exchange_rate_results">0.00</div>
        </div>
  </div>
  </div>
  <div class="col-sm-4 mt-3">
  <div class="card shadow-sm bg-body rounded">

        <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title">Exchange Rates</h5>
        <div class="d-flex"><i class="fas fa-coins fa-lg"></i></div>
        </div>

        <div class="card-body">

        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-end align-items-end">
            <small class="text-muted"><em>All rates are based on US Dollar</em></small>
          </li>
          <?php foreach($exchange_rates as $key){?>
        <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo $key['name']; ?> <span class="d-flex"><?php
          echo $key['symbol'].' '.number_format((float)$key['exchange_rate'], 3, '.', '');
          ?></span></li>
        <?php }?>
        <li class="list-group-item d-flex justify-content-end align-items-end">
  <small class="text-muted"><em>Last Updated <?php echo time_difference_fnc(time(), $cc['currency_last_update']); ?></em></small>
</li>
         </ul>

        </div>
        </div>
  </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
    <div class="card shadow-sm bg-body rounded mt-4">

<div class="card-header d-flex justify-content-between align-items-center">
<h5 class="card-title">World Clock</h5>
<div class="d-flex"><i class="fas fa-clock fa-lg"></i></div>
</div>

<div class="card-body">
<div class="row">


<div class="col-sm-3 p-1">
 <div class="m-2 p-2 border"> 

<div class="clock_label text-center"> Karachi, Pakistan</div>

<div id="Karachi" class="analog_clock d-flex justify-content-center">
<div>
<div class="info date"></div>
<div class="info time"></div>
</div>
<div class="dot"></div>
<div>
<div class="hour-hand"></div>
<div class="minute-hand"></div>
<div class="second-hand"></div>
</div>
<div>
<span class="h_3">3</span>
<span class="h_6">6</span>
<span class="h_9">9</span>
<span class="h_12">12</span>
</div>
<div class="diallines"></div>
</div>

</div>
</div>

<div class="col-sm-3 p-1">
 <div class="m-2 p-2 border"> 

<div class="clock_label text-center"> New York, USA</div>

<div id="New_York" class="analog_clock d-flex justify-content-center">
<div>
<div class="info date"></div>
<div class="info time"></div>
</div>
<div class="dot"></div>
<div>
<div class="hour-hand"></div>
<div class="minute-hand"></div>
<div class="second-hand"></div>
</div>
<div>
<span class="h_3">3</span>
<span class="h_6">6</span>
<span class="h_9">9</span>
<span class="h_12">12</span>
</div>
<div class="diallines"></div>
</div>

</div>
</div>

<div class="col-sm-3 p-1">
 <div class="m-2 p-2 border"> 

<div class="clock_label text-center"> Dubai, UAE</div>

<div id="Dubai" class="analog_clock d-flex justify-content-center">
<div>
<div class="info date"></div>
<div class="info time"></div>
</div>
<div class="dot"></div>
<div>
<div class="hour-hand"></div>
<div class="minute-hand"></div>
<div class="second-hand"></div>
</div>
<div>
<span class="h_3">3</span>
<span class="h_6">6</span>
<span class="h_9">9</span>
<span class="h_12">12</span>
</div>
<div class="diallines"></div>
</div>

</div>
</div>

<div class="col-sm-3 p-1">
 <div class="m-2 p-2 border"> 

<div class="clock_label text-center"> Berlin, Germany</div>

<div id="Berlin" class="analog_clock d-flex justify-content-center">
<div>
<div class="info date"></div>
<div class="info time"></div>
</div>
<div class="dot"></div>
<div>
<div class="hour-hand"></div>
<div class="minute-hand"></div>
<div class="second-hand"></div>
</div>
<div>
<span class="h_3">3</span>
<span class="h_6">6</span>
<span class="h_9">9</span>
<span class="h_12">12</span>
</div>
<div class="diallines"></div>
</div>

</div>
</div>

<div class="col-sm-3 p-1">
 <div class="m-2 p-2 border"> 

<div class="clock_label text-center"> Istanbul, Turkey</div>

<div id="Istanbul" class="analog_clock d-flex justify-content-center">
<div>
<div class="info date"></div>
<div class="info time"></div>
</div>
<div class="dot"></div>
<div>
<div class="hour-hand"></div>
<div class="minute-hand"></div>
<div class="second-hand"></div>
</div>
<div>
<span class="h_3">3</span>
<span class="h_6">6</span>
<span class="h_9">9</span>
<span class="h_12">12</span>
</div>
<div class="diallines"></div>
</div>

</div>
</div>

<div class="col-sm-3 p-1">
 <div class="m-2 p-2 border"> 
<div class="clock_label text-center"> Melbourne, Australia</div>

<div id="Melbourne" class="analog_clock d-flex justify-content-center">
<div>
<div class="info date"></div>
<div class="info time"></div>
</div>
<div class="dot"></div>
<div>
<div class="hour-hand"></div>
<div class="minute-hand"></div>
<div class="second-hand"></div>
</div>
<div>
<span class="h_3">3</span>
<span class="h_6">6</span>
<span class="h_9">9</span>
<span class="h_12">12</span>
</div>
<div class="diallines"></div>
</div>
</div>
</div>

<div class="col-sm-3 p-1">
 <div class="m-2 p-2 border"> 

<div class="clock_label text-center"> Riyadh, Saudi Arabia</div>

<div id="Riyadh" class="analog_clock d-flex justify-content-center">
<div>
<div class="info date"></div>
<div class="info time"></div>
</div>
<div class="dot"></div>
<div>
<div class="hour-hand"></div>
<div class="minute-hand"></div>
<div class="second-hand"></div>
</div>
<div>
<span class="h_3">3</span>
<span class="h_6">6</span>
<span class="h_9">9</span>
<span class="h_12">12</span>
</div>
<div class="diallines"></div>
</div>

</div>
</div>

<div class="col-sm-3 p-1">
 <div class="m-2 p-2 border"> 

<div class="clock_label text-center"> Moscow, Russia</div>

<div id="Moscow" class="analog_clock d-flex justify-content-center">
<div>
<div class="info date"></div>
<div class="info time"></div>
</div>
<div class="dot"></div>
<div>
<div class="hour-hand"></div>
<div class="minute-hand"></div>
<div class="second-hand"></div>
</div>
<div>
<span class="h_3">3</span>
<span class="h_6">6</span>
<span class="h_9">9</span>
<span class="h_12">12</span>
</div>
<div class="diallines"></div>
</div>

</div>
</div>

<div class="col-sm-3 p-1">
 <div class="m-2 p-2 border"> 

<div class="clock_label text-center"> Kolkata, India</div>

<div id="Kolkata" class="analog_clock d-flex justify-content-center">
<div>
<div class="info date"></div>
<div class="info time"></div>
</div>
<div class="dot"></div>
<div>
<div class="hour-hand"></div>
<div class="minute-hand"></div>
<div class="second-hand"></div>
</div>
<div>
<span class="h_3">3</span>
<span class="h_6">6</span>
<span class="h_9">9</span>
<span class="h_12">12</span>
</div>
<div class="diallines"></div>
</div>

</div>
</div>

<div class="col-sm-3 p-1">
 <div class="m-2 p-2 border"> 

<div class="clock_label text-center"> Shanghai, China</div>

<div id="Shanghai" class="analog_clock d-flex justify-content-center">
<div>
<div class="info date"></div>
<div class="info time"></div>
</div>
<div class="dot"></div>
<div>
<div class="hour-hand"></div>
<div class="minute-hand"></div>
<div class="second-hand"></div>
</div>
<div>
<span class="h_3">3</span>
<span class="h_6">6</span>
<span class="h_9">9</span>
<span class="h_12">12</span>
</div>
<div class="diallines"></div>
</div>

</div>
</div>

<div class="col-sm-3 p-1">
 <div class="m-2 p-2 border"> 

<div class="clock_label text-center"> London, England</div>

<div id="London" class="analog_clock d-flex justify-content-center">
<div>
<div class="info date"></div>
<div class="info time"></div>
</div>
<div class="dot"></div>
<div>
<div class="hour-hand"></div>
<div class="minute-hand"></div>
<div class="second-hand"></div>
</div>
<div>
<span class="h_3">3</span>
<span class="h_6">6</span>
<span class="h_9">9</span>
<span class="h_12">12</span>
</div>
<div class="diallines"></div>
</div>

</div>
</div>

<div class="col-sm-3 p-1">
 <div class="m-2 p-2 border"> 

<div class="clock_label text-center"> Kuala Lumpur, Malaysia</div>

<div id="Kuala_Lumpur" class="analog_clock d-flex justify-content-center">
<div>
<div class="info date"></div>
<div class="info time"></div>
</div>
<div class="dot"></div>
<div>
<div class="hour-hand"></div>
<div class="minute-hand"></div>
<div class="second-hand"></div>
</div>
<div>
<span class="h_3">3</span>
<span class="h_6">6</span>
<span class="h_9">9</span>
<span class="h_12">12</span>
</div>
<div class="diallines"></div>
</div>

</div>
</div>

</div>
</div>
</div>
</div>

  </div>
  </div>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/footer');?>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/body_end');?>
  <script data-src="https://cdn.jsdelivr.net/gh/shonirits/shonir-analog-clock@main/shonir-analog-clock/0.1/js/shonir_analog_clock.js"></script>
  <script>
        function content_fnc() {

          load_css_fnc('https://cdn.jsdelivr.net/gh/shonirits/shonir-analog-clock@main/shonir-analog-clock/0.1/css/shonir_analog_clock.css');


          function try_int_clock_fnc() {
              if (typeof int_shonir_analog_clock === "function") {
                  int_shonir_analog_clock("Karachi", "Asia/Karachi");
                  int_shonir_analog_clock("New_York", "America/New_York");
                  int_shonir_analog_clock("Dubai", "Asia/Dubai");
                  int_shonir_analog_clock("Berlin", "Europe/Berlin");
                  int_shonir_analog_clock("Istanbul", "Asia/Istanbul");
                  int_shonir_analog_clock("Melbourne", "Australia/Melbourne");
                  int_shonir_analog_clock("Riyadh", "Asia/Riyadh");
                  int_shonir_analog_clock("Moscow", "Europe/Moscow");
                  int_shonir_analog_clock("Kolkata", "Asia/Kolkata");
                  int_shonir_analog_clock("Shanghai", "Asia/Shanghai");
                  int_shonir_analog_clock("London", "Europe/London");
                  int_shonir_analog_clock("Kuala_Lumpur", "Asia/Kuala_Lumpur");
              } else {
                  setTimeout(try_int_clock_fnc, 500);
              }
          }

          try_int_clock_fnc();          

          function do_currency_converter_fnc(from, to, amount){

    var_return = 'NAN';
   
    if(amount>0){

      var_return = currency_converter_fnc(from, to, amount);
      var_return =  var_return.toFixed(3);

   }
   
    p("#exchange_rate_results").hide().html(var_return).fadeIn("slow");

  }

  p(document).on("keyup", "#currency_amount", function() {
  do_currency_converter_fnc(p('#currency_from').val(), p('#currency_to').val(), p('#currency_amount').val());
});

  p(document).on("change", "#currency_amount", function() {
  do_currency_converter_fnc(p('#currency_from').val(), p('#currency_to').val(), p('#currency_amount').val());
}); 

p(document).on("change", "#currency_from", function() {
  do_currency_converter_fnc(p('#currency_from').val(), p('#currency_to').val(), p('#currency_amount').val());
});

p(document).on("change", "#currency_to", function() {
  do_currency_converter_fnc(p('#currency_from').val(), p('#currency_to').val(), p('#currency_amount').val());
});

      var from_select = document.getElementById('currency_from');
              var from_items = from_select.getElementsByTagName('option');
              var from_index = Math.floor(Math.random() * from_items.length);
              from_select.selectedIndex = from_index;

      var to_select = document.getElementById('currency_to');
              var to_items = to_select.getElementsByTagName('option');
              var to_index = Math.floor(Math.random() * to_items.length);
              to_select.selectedIndex = to_index;
        }
  </script>
</body>
<?php echo view('backend/'.$cc['backend_theme'].'/common/page_end');?>