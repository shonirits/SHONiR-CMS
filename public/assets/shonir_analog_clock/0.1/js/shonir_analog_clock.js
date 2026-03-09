
function int_shonir_analog_clock(id, time_zone) {

    var clockqu =  document.querySelector('#'+id);
    var clockEl = document.getElementById(id);
    var dialLines = document.getElementById(id).getElementsByClassName('diallines');
    
    for (var i = 1; i < 60; i++) {
      clockEl.innerHTML += "<div class='diallines'></div>";
      dialLines[i].style.transform = "rotate(" + 6 * i + "deg)";
    }
    
    setInterval(function () {shonir_analog_clock(id, time_zone);}, 100);
    
    }
    
    function shonir_analog_clock(id, time_zone) {
    
      var clockqu =  document.querySelector('#'+id);
    var clockEl = document.getElementById(id);
    
    if(time_zone){ 
    
      var sys_date = new Date().toLocaleString("en-US", { timeZone: time_zone });;
      var d = new Date(sys_date);
    
    }else{
      d = new Date();
    }
    
      var h = d.getHours(),
          m = d.getMinutes(),
          s = d.getSeconds(),
          date = d.getDate(),
          month = d.getMonth() + 1,
          year = d.getFullYear(),
               
          hDeg = h * 30 + m * (360/720),
          mDeg = m * 6 + s * (360/3600),
          sDeg = s * 6,
          
          hEl = clockEl.querySelector('.hour-hand'),
          mEl = clockEl.querySelector('.minute-hand'),
          sEl = clockEl.querySelector('.second-hand'),
          dateEl = clockEl.querySelector('.date'),
          timeEl = clockEl.querySelector('.time');
    
          if(h > 19 || h < 5){
            clockEl.style.backgroundColor = "black";
          } else if(h > 17 ){
            clockEl.style.backgroundColor = "lightgray";
          } else if(h > 8){
            clockEl.style.backgroundColor = "white";
          } else if(h > 4){ 
            clockEl.style.backgroundColor = "lightblue";
          }
      
          var time = h+':'+m+':'+s;
      
      if(month < 9) {
        month = "0" + month;
      }
      
      hEl.style.transform = "rotate("+hDeg+"deg)";
      mEl.style.transform = "rotate("+mDeg+"deg)";
      sEl.style.transform = "rotate("+sDeg+"deg)";
      dateEl.innerHTML = date+"/"+month+"/"+year;
      timeEl.innerHTML = time;
    }
    