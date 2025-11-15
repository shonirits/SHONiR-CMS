
if (typeof nanobar?.go === 'function') nanobar.go(25);
var screenWidth, screenHeight, dialogWidth, dialogHeight, isDesktop, isMobile;    
        screenWidth = window.screen.width;
        screenHeight = window.screen.height;
        isMobile = window.innerWidth < 992;
        isDesktop = window.innerWidth >= 992;

        if (screenWidth < 500) {
          dialogWidth = screenWidth * .95;
          dialogHeight = screenHeight * .95;
      } else {
          dialogWidth = 425;
          dialogHeight = 250;
      }


        let load_assets = false;
let win_loaded = false;
let load_assets_locked = false;

function are_core_plugins_ready_fnc() {
  return typeof Fancybox !== "undefined" &&
         typeof Noty === "function" &&
         typeof mojs === "object" &&
         typeof bootstrap !== "undefined" &&
         typeof d.fn.select2 !== "undefined" &&
         typeof tinymce !== "undefined" &&
         typeof jQuery.ui !== "undefined" &&
         typeof jQuery.fn.slick === "function";
}

function scroll_Fnc(SHONiR_ID){
    d('html, body').animate({
                  scrollTop: d("#"+SHONiR_ID).offset().top-60
              }, 1000);

  }

  function scroll_top_fnc() {
   const btn = document.getElementById("scroll-top");
  window.addEventListener("scroll", () => {
    if (window.scrollY > 60) {
      btn.classList.add("visible");
    } else {
      btn.classList.remove("visible");
    }
    const navbar = document.getElementById('navbar_top');
    if (!navbar) return;
    if (window.scrollY > 45) {
      navbar.classList.add('fixed-top');
      const navbarHeight = navbar.offsetHeight;
      document.body.style.paddingTop = `${navbarHeight}px`;
    } else {
      navbar.classList.remove('fixed-top');
      document.body.style.paddingTop = '0';
    }
  });
}

document.addEventListener("DOMContentLoaded", function () {
  scroll_top_fnc();
  document.querySelectorAll('.dropdown-menu .dropdown-item, .navbar .nav-link').forEach(link => {
  const nextEl = link.nextElementSibling;
  if (nextEl && nextEl.classList.contains('dropdown-menu')) {
    link.classList.add('has-submenu');
  }
});

document.addEventListener('click', function (e) {
  if (!e.target.closest('.navbar')) {
    document.querySelectorAll('.navbar .dropdown .show').forEach(el => {
      bootstrap.Dropdown.getOrCreateInstance(el).hide();
    });
    document.querySelectorAll('.submenu').forEach(sub => sub.classList.remove('submenu-show'));
    document.querySelectorAll('.submenu-open').forEach(item => item.classList.remove('submenu-open'));
  }
});


const try_int_fnc = () => {
    const ready = are_core_plugins_ready_fnc();
    if (!ready) {
      setTimeout(try_int_fnc, 100);
      return;
    }

  if (isDesktop) {
    document.addEventListener('click', function (e) {
      if (!e.target.closest('.navbar')) {
        document.querySelectorAll('.navbar .dropdown .show').forEach(el => {
          bootstrap.Dropdown.getOrCreateInstance(el).hide();
        });
        document.querySelectorAll('.submenu').forEach(sub => sub.classList.remove('submenu-show'));
        document.querySelectorAll('.submenu-open').forEach(item => item.classList.remove('submenu-open'));
      }
    });

    document.querySelectorAll('.navbar .dropdown').forEach(dropdown => {
      let dropdownTimer;

      dropdown.addEventListener('mouseenter', () => {
        clearTimeout(dropdownTimer);

        document.querySelectorAll('.navbar .dropdown').forEach(drop => {
          const toggle = drop.querySelector('[data-bs-toggle="dropdown"]');
          if (toggle && toggle.classList.contains('show')) {
            bootstrap.Dropdown.getOrCreateInstance(toggle).hide();
          }
        });

        const toggle = dropdown.querySelector('[data-bs-toggle="dropdown"]');
        if (toggle && !toggle.classList.contains('show')) {
          bootstrap.Dropdown.getOrCreateInstance(toggle).show();
        }
      });

      dropdown.addEventListener('mouseleave', () => {
        dropdownTimer = setTimeout(() => {
          const toggle = dropdown.querySelector('[data-bs-toggle="dropdown"]');
          if (toggle && toggle.classList.contains('show')) {
            bootstrap.Dropdown.getOrCreateInstance(toggle).hide();
          }
        }, 500); 
      });

      dropdown.querySelectorAll('li').forEach(item => {
  const submenu = item.querySelector('.submenu');
  let submenuTimer;

  if (submenu) {
    item.addEventListener('mouseenter', () => {
      clearTimeout(submenuTimer);

      item.parentElement.querySelectorAll('.submenu').forEach(sub => sub.classList.remove('submenu-show'));
      item.parentElement.querySelectorAll('.submenu-open').forEach(openItem => openItem.classList.remove('submenu-open'));

      submenu.classList.add('submenu-show');
      item.classList.add('submenu-open');
    });

    item.addEventListener('mouseleave', () => {
      submenuTimer = setTimeout(() => {
        submenu.classList.remove('submenu-show');
        item.classList.remove('submenu-open');
      }, 500);
    });

    submenu.querySelectorAll('li').forEach(subItem => {
      const childSub = subItem.querySelector('.submenu');
      if (childSub) {
        let childTimer;

        subItem.addEventListener('mouseenter', () => {
          clearTimeout(childTimer);
          childSub.classList.add('submenu-show');
          subItem.classList.add('submenu-open');
        });

        subItem.addEventListener('mouseleave', () => {
          childTimer = setTimeout(() => {
            childSub.classList.remove('submenu-show');
            subItem.classList.remove('submenu-open');
          }, 500);
        });
      }
    });
  }
});

    });
  }

  if (isMobile) {
    document.querySelectorAll('.dropdown-menu .dropdown-item').forEach(link => {
      const nextEl = link.nextElementSibling;
      if (nextEl && nextEl.classList.contains('dropdown-menu')) {
        link.classList.add('has-submenu');
      }
    });
    document.querySelectorAll('.navbar .dropdown').forEach(dropdown => {
      dropdown.addEventListener('show.bs.dropdown', () => {
        const trigger = dropdown.querySelector('.nav-link.has-submenu');
        if (trigger) trigger.parentElement.classList.add('submenu-open-parent');
      });
      dropdown.addEventListener('hide.bs.dropdown', () => {
        const trigger = dropdown.querySelector('.nav-link.has-submenu');
        if (trigger) trigger.parentElement.classList.remove('submenu-open-parent');
      });
    });
    document.querySelectorAll('.dropdown-menu .dropdown-item').forEach(link => {
      link.addEventListener('click', function (e) {
        const nextEl = this.nextElementSibling;
        if (nextEl && nextEl.classList.contains('dropdown-menu')) {
          e.preventDefault();
          e.stopPropagation();
          const parentMenu = this.closest('.dropdown-menu');
          parentMenu.querySelectorAll('.submenu-open').forEach(sub => {
            if (sub !== nextEl) sub.classList.remove('submenu-open');
          });
          parentMenu.querySelectorAll('.submenu-open-parent').forEach(subParent => {
            if (subParent !== this.parentElement) subParent.classList.remove('submenu-open-parent');
          });
          nextEl.classList.toggle('submenu-open');
          this.parentElement.classList.toggle('submenu-open-parent');
        }
      });
    });
  }
};
  try_int_fnc(token);
});

function SHONiR() {}

function get_timezone_offset_fnc() {
  const pad = n => String(Math.floor(n)).padStart(2, '0');
  const offset = new Date().getTimezoneOffset();
  const sign = offset < 0 ? '+' : '-';
  const abs = Math.abs(offset);
  return sign + pad(abs / 60) + pad(abs % 60);
}

d(window).on("load", function () {
  nanobar.go(85);
  setTimeout(function() { nanobar.go(100);
    w('#body_content').fadeIn(2000);
    w('#body_loader').fadeOut(1000);
    win_loaded = true;
    load_assets_fnc();
    }, 300);
});

p("#order").change(function () {
  var selected = this.value;
  order_url = url+'?order='+selected+'&sort='+sort+'&limit='+limit+'&query='+query;
  redirect_fnc(order_url);
});
p("#sort").change(function () {
  var selected = this.value;
  sort_url = url+'?order='+order+'&sort='+selected+'&limit='+limit+'&query='+query;
  redirect_fnc(sort_url);
});
p("#limit").change(function () {
  var selected = this.value;
  limit_url = url+'?order='+order+'&sort='+sort+'&limit='+selected+'&query='+query;
  redirect_fnc(limit_url);
});
p( "#filters" ).on( "click", function() {
p( "#filters_zone" ).toggle( "slow" );
});

var specialKeys = new Array();
      specialKeys.push(8,46); 
      function is_key_numeric_fnc(e) {
          var keyCode = e.which ? e.which : e.keyCode;
          var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
          return ret;
      }

      var moreKeys = new Array();
                          moreKeys.push(43,45,46); 
                          function is_key_currency_fnc(e) {
                            var keyCode = e.which ? e.which : e.keyCode;
                            var ret = ((keyCode >= 48 && keyCode <= 57) || moreKeys.indexOf(keyCode) != -1);
                            return ret;
                          }

                          function input_currency_fnc(e) {
                            var id = e.id;
                            var input = document.getElementById(id);
                            var inputValue = input.value;
                            var is_currency = is_currency_fnc(inputValue);
                            if(is_currency == false){
                              d('#'+id).val('');
                            }
                            }



      function is_min_max_fnc(t) {
  if (!t || typeof t.value === 'undefined' || is_empty_fnc(t.value)) return;

  const value = Number(t.value);
  let minv = Number(t.min);
  let maxv = Number(t.max);

  if (isNaN(minv) || minv === 0) minv = 1;

  if (value < minv) {
    d(t).val('');
    return;
  }

  if (isNaN(maxv) || maxv === 0 ) return;

  if (value > maxv) {
    d(t).val('');
  }
}

       function is_currency_fnc(str) {
  if (typeof str !== 'string' || str.trim() === '') return false;

  const currencyRegex = /^[-+]?(\d+(\.\d{1,2})?|\.\d{1,2})$/;
  return currencyRegex.test(str.trim());
}

      function is_key_digit_fnc(e) {
  const key = e.key || String.fromCharCode(e.which || e.keyCode);
  return /^[0-9]$/.test(key);
}

      function prevent_newlines_fnc(textareaId) {
  const textarea = document.getElementById(textareaId);

  if (!textarea) return;

  textarea.value = textarea.value.replace(/[\r\n]+/g, ' ');

  textarea.addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
      e.preventDefault();
    }
  });

  textarea.addEventListener('input', function () {
    this.value = this.value.replace(/[\r\n]+/g, ' ');
  });
}
      
      function is_numeric_fnc(str) {
  if (typeof str !== 'string') return false;

  const trimmed = str.trim();
  const numericRegex = /^[-+]?(\d+(\.\d+)?|\.\d+)$/;

  return numericRegex.test(trimmed);
}

      function is_empty_fnc(value) {
  if (value === null || value === undefined) return true;
  if (!isNaN(value) && value !== '') return false;
  return typeof value === 'string' && value.trim().length === 0;
}


      function flash_title_fnc(currentTitle, newTitle) {
  const $doc = d(document);
  const current = $doc.attr('title');
  $doc.attr('title', current === currentTitle ? newTitle : currentTitle);
}

function int_fnc(token = ""){

  let offset = get_timezone_offset_fnc();

  setTimeout(function() { 

  let url = base_url+"Ajax/initialize";
  var visitor_data = {
    url: window.location.href,
    user_agent: navigator.userAgent,
    language: navigator.language,
    cookies_enabled: navigator.cookieEnabled,
    online_status: navigator.onLine,
    timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
    screen: {
        width: window.screen.width,
        height: window.screen.height
    }
};
    let data = {offset: offset, token: token, visitor_data: visitor_data};
    let options = {
              type: "POST",
              url: url,
              headers: {'X-Requested-With': 'XMLHttpRequest'},
              data: data,
              dataType: "json",
              success: function(response, status, xhr){   
                if(response.status === 'TRUE'){            

            if (response.data && response.data.alert && response.data.alert.message && response.data.alert.type) {
                  let alert = response.data.alert;
                  alert_fnc(alert.message, alert.type);
              }

              }
              }
            };
           p.ajax(options);   
           
           setTimeout(function() {
    d.ajax({
        url: base_url+"Ajax/cron",
        method: "GET"
    });
}, 19000);

  }, 500);
  
  

  }

  function token_fnc(length = 7){

      var chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      var token = '';
      for(var i = 0; i < length; i++) {
          token += chars[Math.floor(Math.random() * chars.length)];
      }
      return token;  
    
      }

 function load_css_fnc(url) {
  const exists = [...document.styleSheets].some(sheet =>
    sheet.href && sheet.href.includes(url)
  );
  if (exists) return;

  const link = document.createElement('link');
  link.rel = 'stylesheet';
  link.href = url;
  link.type = 'text/css';
  link.media = 'all';
  document.head.appendChild(link);
}




function validate_from_date_fnc() {
  if (typeof var_from_date === 'undefined' || !var_from_date.value) return;

  const inputValue = var_from_date.value;
  const msgSelector = "#from_date_msg";
  const inputSelector = "#from_date";
  const isValid = is_date_fnc(inputValue);

  var_from_date.setCustomValidity(isValid ? '' : "Please provide valid from date dd-mm-yyyy");

  d(msgSelector).html(isValid ? '' : 'Please provide valid from date dd-mm-yyyy');
  d(msgSelector).toggleClass("text-success", isValid);
  d(msgSelector).toggleClass("invalid-feedback", !isValid);

  d(inputSelector).toggleClass("is-valid", isValid);
}


function validate_to_date_fnc() {
  if (typeof var_to_date === 'undefined' || !var_to_date.value) return;

  const toDateValue = var_to_date.value;
  const msgSelector = "#to_date_msg";
  const inputSelector = "#to_date";

  const valid = is_date_fnc(toDateValue);

  var_to_date.setCustomValidity(valid ? '' : "Please provide valid to date dd-mm-yyyy");

  d(msgSelector).html(valid ? '' : 'Please provide valid to date dd-mm-yyyy');
  d(msgSelector).toggleClass("text-success", valid);
  d(msgSelector).toggleClass("invalid-feedback", !valid);

  d(inputSelector).toggleClass("is-valid", valid);
}

  function validate_date_range_fnc() {
  const from = var_from_date.value;
  const to = var_to_date.value;

  const fromValid = is_date_fnc(from);
  const toValid = is_date_fnc(to);

  if (!fromValid || !toValid) return false;

  const [fd, fm, fy] = from.split('-').map(Number);
  const [td, tm, ty] = to.split('-').map(Number);

  const fromDate = new Date(fy, fm - 1, fd);
  const toDate = new Date(ty, tm - 1, td);

  if (fromDate > toDate) {
    var_to_date.setCustomValidity("To date must be after or equal to From date");
    d("#to_date_msg").html("To date must be after or equal to From date").addClass("invalid-feedback").removeClass("text-success");
    d("#to_date").removeClass("is-valid");
    return false;
  } else {
    var_to_date.setCustomValidity('');
    d("#to_date_msg").html('').removeClass("invalid-feedback").addClass("text-success");
    d("#to_date").addClass("is-valid");
    return true;
  }
}

   function dom_ready_fnc() {
  if (load_assets) return;

  const autoLoadDelay = 500;
  const userEvents = ["keydown", "mousemove", "wheel", "touchmove", "touchstart", "touchend"];
  const autoLoadTimer = setTimeout(trigger_asset_load_fnc, autoLoadDelay);

  userEvents.forEach(event =>
    window.addEventListener(event, trigger_asset_load_once_fnc, { passive: true })
  );

  function trigger_asset_load_once_fnc() {
    trigger_asset_load_fnc();
    clearTimeout(autoLoadTimer);
    userEvents.forEach(event =>
      window.removeEventListener(event, trigger_asset_load_once_fnc, { passive: true })
    );
  }

  function trigger_asset_load_fnc() {
    if (!load_assets) {
      if (typeof nanobar?.go === 'function') nanobar.go(60);
      load_assets_fnc();
      load_assets = true;
    }
  }

  d(document).ready(() => {
    if (typeof nanobar?.go === 'function') nanobar.go(40);
  });
}


  function first_capitalize_fnc(str) {
  return str.toLowerCase().split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
}


  function ajax_success_fnc(request_type, response, status, xhr) {

    dialog_fnc(first_capitalize_fnc(request_type+': '+status), '<h1>'+response['data']+'</h1>');

  }

  function ajax_error_fnc(request_type, jqXhr, textStatus, errorMessage) {
  
    dialog_fnc(first_capitalize_fnc(request_type+': '+textStatus), '<h1>'+errorMessage+'</h1><hr/><p>If you suspect an issue, please try again later.</p><p>If the problem persists, consider reaching out for assistance.</p>');

  }

  function ajax_complete_fnc(request_type, data, callback = false) {

    int_fnc(token);

  }


  function load_assets_fnc() {
  if (load_assets || load_assets_locked) return;

  load_assets_locked = true;

  const cssList = [
  `https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css`,
  `https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css`,
  `https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css`,
  `https://cdn.jsdelivr.net/npm/noty@3.2.0-beta-deprecated/lib/noty.min.css`,
  `https://cdn.jsdelivr.net/npm/noty@3.2.0-beta-deprecated/lib/themes/metroui.css`,
  `https://cdn.jsdelivr.net/npm/bootstrap-cookie-alert@1.2.2/cookiealert.min.css`,
  `https://cdn.jsdelivr.net/npm/jquery-ui@1.14.1/themes/base/all.css`,
  `https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.0.0/css/all.min.css`,
  `https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css`,
  `https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css`,
  `https://cdn.jsdelivr.net/npm/star-rating-svg@3.5.0/src/css/star-rating-svg.min.css`,  
  `https://cdn.jsdelivr.net/npm/tinymce@5.1.0/skins/ui/oxide/skin.min.css`,
  `https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1.5/dist/fancybox/fancybox.min.css`,
  `https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1.5/dist/carousel/carousel.css`,
  `https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1.5/dist/carousel/carousel.arrows.css`,
  `https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1.5/dist/carousel/carousel.thumbs.css`,
  `https://cdn.jsdelivr.net/gh/shonirits/SHONiR-CMS@master/public/css/backend/default.min.css`,
  `${css_url}public/css/backend/${backend_theme}/theme.css`,
];

  cssList.forEach(path => load_css_fnc(path));

  setTimeout(() => {
    document.querySelectorAll('script[data-src]').forEach(script =>
      script.setAttribute("src", script.getAttribute("data-src"))
    );
    if (typeof nanobar?.go === 'function') nanobar.go(70);
  }, 100);

  const maxWait = 3000;

  const checkReady = setInterval(() => {
    const ready = are_core_plugins_ready_fnc();

    const timeout = Date.now() - start_timer > maxWait;
    if (ready || timeout) {
      clearInterval(checkReady);

      setTimeout(() => {
        document.querySelectorAll('img[data-src]').forEach(img =>
          img.setAttribute("src", img.getAttribute("data-src"))
        );

        if (typeof page_fnc === 'function') page_fnc();
        if (typeof nanobar?.go === 'function') nanobar.go(85);

        setTimeout(() => {
          if (typeof nanobar?.go === 'function') nanobar.go(100);
          if (d('#body_content').length && d('#body_loader').length) {
  d('#body_content').fadeIn(1000);
  d('#body_loader').fadeOut(1000);
}

        }, 100);
      }, 100);
    }
  }, 10);

  load_assets = true;
  load_assets_locked = false;
}


function on_window_ready_fnc(callback) {
  if (document.readyState === "complete") {
    callback();
  } else {
    d(window).on("load", callback);
  }
}


on_window_ready_fnc(() => {
  if (typeof nanobar?.go === 'function') nanobar.go(85);

  setTimeout(() => {
    if (typeof nanobar?.go === 'function') nanobar.go(100);
    if (typeof d === "function") {
      if (d('#body_content').length && d('#body_loader').length) {
  d('#body_content').fadeIn(1000);
  d('#body_loader').fadeOut(1000);
}

    }
    win_loaded = true;

    if (typeof load_assets_fnc === "function" && !load_assets) {
      load_assets_fnc();
    }
  }, 100);
});

(() => {
  const original = window.setInterval;
  window.setInterval = function (fn, delay, runNow) {
    if (runNow) fn();
    return original(fn, delay);
  };
})();
  
const interval_var = setInterval(load_timeout_fnc, 5);
function load_timeout_fnc() {
  const loadtime = (Date.now() - start_timer) / 1000;

  if (win_loaded) return stop_interval_fnc();

  if (loadtime > 5) {
    show_content_fnc();
    stop_interval_fnc();
  }
}
function show_content_fnc() {
  d('#body_content').show(100);
  d('#body_loader').hide(100);
  if (typeof nanobar?.go === 'function') nanobar.go(95);
}
function stop_interval_fnc() {
  clearInterval(interval_var);
}

function show_loading_fnc(id) {
  d(id).html(`<div class="wait"><p>Loading...</p><img src="${loader}" /></div>`);
}

    function show_loading_fnc(id) {
      p(id).html('<p><div class="wait" > <p> Loading... </p> <img src="'+loader+'" /></div></p>');
    }
    

  function is_date_fnc(dateString, format = 'dd-mm-yyyy') {
  const delimiters = ['-', '/', '.'];
  const delimiter = delimiters.find(d => format.includes(d));
  if (!delimiter) return false;

  const formatParts = format.toLowerCase().split(delimiter);
  const dateParts = dateString.split(delimiter);
  if (formatParts.length !== 3 || dateParts.length !== 3) return false;

  const map = {};
  for (let i = 0; i < 3; i++) {
    const f = formatParts[i];
    const d = dateParts[i];

    if ((f === 'dd' && d.length !== 2) ||
        (f === 'd' && (d.length < 1 || d.length > 2)) ||
        (f === 'mm' && d.length !== 2) ||
        (f === 'm' && (d.length < 1 || d.length > 2)) ||
        (f === 'yyyy' && d.length !== 4) ||
        (f === 'yy' && d.length !== 2)) {
      return false; 
    }

    map[f] = parseInt(d, 10);
  }

  const day = map['d'] ?? map['dd'];
  const month = map['m'] ?? map['mm'];
  const year = map['yyyy'] ?? map['yy'];

  if (!day || !month || !year || month < 1 || month > 12) return false;

  const daysInMonth = [31, is_leap_year_fnc(year) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
  return day >= 1 && day <= daysInMonth[month - 1];
}

function is_leap_year_fnc(year) {
  return (year % 4 === 0 && year % 100 !== 0) || year % 400 === 0;
}


function date_picker_fnc(e, minDate = null, maxDate = null, format = "dd-mm-yy") {
                              if (!e || !e.id) return;
                              const selector = `#${e.id}`;
                              setTimeout(() => {
                                const $el = p(selector);
                                if (!$el || typeof $el.datepicker !== 'function') return;

                                $el.datepicker({
                                  dateFormat: format,
                                  minDate: minDate,
                                  maxDate: maxDate,
                                  autoclose: true,
                                  changeMonth: true,
                                  changeYear: true
                                }).datepicker('show');
                              }, 10); 
                            }


                            function validate_date_fnc(e, format = 'dd-mm-yyyy') {
  if (!e || !e.id) return;

  const id = e.id;
  const input = document.getElementById(id);
  const msgEl = p(`#${id}_msg`);
  const inputValue = input.value;

  if (!inputValue) return;

  const isValid = is_date_fnc(inputValue, format);


  input.setCustomValidity(isValid ? '' : 'Please provide a valid date (dd-mm-yyyy)');

  msgEl.html(isValid ? '' : 'Please provide a valid date (dd-mm-yyyy)');
  msgEl.toggleClass('text-success', isValid);
  msgEl.toggleClass('invalid-feedback', !isValid);
  p(`#${id}`).toggleClass('is-valid', isValid);
}

function sound_fnc(type = 'notification'){

  if(type == 'message'){

    var url = base_url+'public/audios/message.mp3';

  }else if(type == 'initialize'){

      var url = base_url+'public/audios/initialize.mp3';
    
  }else{

    var url = base_url+'public/audios/notification.mp3';

  } 

  var sound = new Howl({
    src: [url]
  });    
  sound.once('load', function(){
    sound.play();
  });

}

function alert_fnc(alert_message, alert_type = 'information'){
    new Noty({  theme: 'metroui', type: alert_type, closeWith:['click'], timeout: 3000,
    progressBar : true,  text: alert_message,   killer: true,
    animation: {
      open: function (promise) {
          var n = this;
          var Timeline = new mojs.Timeline();
          var body = new mojs.Html({
              el        : n.barDom,
              x         : {500: 0, delay: 0, duration: 500, easing: 'elastic.out'},
              isForce3d : true,
              onComplete: function () {
                  promise(function(resolve) {
                      resolve();
                  })
              }
          });
  
          var parent = new mojs.Shape({
              parent: n.barDom,
              width      : 200,
              height     : n.barDom.getBoundingClientRect().height,
              radius     : 0,
              x          : {[150]: -150},
              duration   : 1.2 * 500,
              isShowStart: true
          });
  
          n.barDom.style['overflow'] = 'visible';
          parent.el.style['overflow'] = 'hidden';
  
          var burst = new mojs.Burst({
              parent  : parent.el,
              count   : 10,
              top     : n.barDom.getBoundingClientRect().height + 75,
              degree  : 90,
              radius  : 75,
              angle   : {[-90]: 40},
              children: {
                  fill     : '#00fcff',
                  delay    : 'stagger(500, -50)',
                  radius   : 'rand(8, 25)',
                  direction: -1,
                  isSwirl  : true
              }
          });
  
          var fadeBurst = new mojs.Burst({
              parent  : parent.el,
              count   : 2,
              degree  : 0,
              angle   : 75,
              radius  : {0: 100},
              top     : '90%',
              children: {
                  fill     : '#00fcff',
                  pathScale: [.65, 1],
                  radius   : 'rand(12, 15)',
                  direction: [-1, 1],
                  delay    : .8 * 500,
                  isSwirl  : true
              }
          });
  
          Timeline.add(body, burst, fadeBurst, parent);
          Timeline.play();
      },
      close: function (promise) {
          var n = this;
          new mojs.Html({
              el        : n.barDom,
              x         : {0: 500, delay: 10, duration: 500, easing: 'cubic.out'},
              skewY     : {0: 10, delay: 10, duration: 500, easing: 'cubic.out'},
              isForce3d : true,
              onComplete: function () {
                  promise(function(resolve) {
                      resolve();
                  })
              }
          }).play();
      }
  }
  }).show();
  
  }

  function currency_converter_fnc(from, to, amount) {

  get = amount/from;

  total = get*to; 

return total;

}

function redirect_fnc(link){

window.location.href = link;
window.location.replace(link);

}

    function flash_title(current_title, new_title){
      if (d(document).attr('title') == current_title) {
        d(document).attr('title', new_title);
      } else {
        d(document).attr('title', current_title);
      }
    }



    function modal_fnc(id, title, content) {
      let current_title = d(document).attr('title');
    let dialog_interval = setInterval(function() {
        flash_title_fnc(current_title, title);
    }, 1000);
      
      d('#' + id).remove();

    var modalHtml = 
    '<div class="modal t-modal fade" id="'+id+'" tabindex="-1" aria-labelledby="'+id+'Title" aria-hidden="true">' +
    '<div class="modal-dialog modal-dialog-centered">' +
    '<div class="modal-header">' +
                '<h5 class="modal-title" id="'+id+'Title">'+title+'</h5>' +
            '</div>' +
        '<div class="modal-content">' +
         '<button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>' +
            '<div class="modal-body">' +
                content +
            '</div>' +
        '</div>' +
    '</div>' +
'</div>';

    d('body').append(modalHtml);

    var modal = new bootstrap.Modal(d('#' + id)[0], {
  backdrop: 'static',
  keyboard: false
});

    modal.show();


    d('#' + id).on('hide.bs.modal', function (event) {
    event.preventDefault(); 
    var modalElement = d(this);
    modalElement.addClass('closing'); 
            clearInterval(dialog_interval);
            d(document).attr('title', current_title);
    setTimeout(() => {
        let modalInstance = bootstrap.Modal.getInstance(modalElement[0]);
        if (modalInstance) {
            modalInstance.dispose(); 
        }
        modalElement.remove(); 
        d('.modal-backdrop').remove();
        d('body').removeClass('modal-open');
        d('body').css({
            'overflow': 'auto', 
            'padding': '0px'
        }); 
    }, 175); 
});
    
    }

function validate_search_fnc() {
    var query = document.getElementById("query-fld").value.trim();
    if (query === "") {
        dialog_fnc('Keywords required', 'Please enter a search term, such as a product name or model number, to find relevant results. Ensure your input is specific to get the best matches.');
        return false;
    }
    return true;
}


    function dialog_fnc( title = 'Welcome', content = 'Thank you for visting our website!') {
      var current_title = d(document).attr('title');
      dialog_interval = setInterval(function() {
        flash_title_fnc(current_title, title);
      }, 1000);
      d('<div></div>').appendTo('body')
        .html('<div>' + content + '</div>')
        .dialog({
          modal: true,
          minWidth: dialogWidth,
          minHeight: dialogHeight,
          zIndex: 99999,
          title: title,            
          autoOpen: true, 
          pposition: {
                my: "center",
                at: "center",
                of: window
            },    
          close: function(event, ui) {
            clearInterval(dialog_interval);
            d(document).attr('title', current_title);
            d(this).remove();
          }
        });
    
    }

    function wait_fnc(title, content) {
      var current_title = d(document).attr('title');
       dialog_interval = setInterval(function() {
        flash_title_fnc(current_title, title);
      }, 1000);
    var ddialog = d('<div></div>')
        .html("<div class='wait' > <p>"+content+"</p> <img src='"+loader+"' /> </div>")
        .dialog({
            autoOpen: false,
            resizable: false,
            minWidth: dialogWidth,
          minHeight: dialogHeight,
          closeOnEscape: false,
            modal: true,
            show: "blind",
            hide: "explode",
            title: title,
            create: function() {
                d(this).parent().find(".ui-dialog-titlebar-close").remove(); 
            },
            close: function(e) {
            clearInterval(dialog_interval);
            d(document).attr('title', current_title);
				e.preventDefault();
        d(this).dialog('destroy').remove();
			}
        });
    ddialog.dialog('open');

}

      function confirm_fnc(oneName, oneUrl='', oneCallback, twoName, twoUrl='', twoCallback, title = 'Confirmation', content = 'Are you sure you want to proceed?') {
        var current_title = d(document).attr('title');
        confirm_interval = setInterval(function() {
          flash_title_fnc(current_title, title);
        }, 1000);
        d('<div></div>').appendTo('body')
          .html('<div><h6>' + content + '</h6></div>')
          .dialog({
            modal: true,
            minWidth: dialogWidth,
            minHeight: dialogHeight,
            zIndex: 99999,
            dialogClass: 'no_close',
            title: title,            
            autoOpen: true,            
            closeOnEscape: false,
            buttons: [
              {
                  text: oneName,
                  click: function (){
                    if(oneCallback){oneCallback();} 
                    if(oneUrl){redirect_fnc(oneUrl);} 
                    clearInterval(confirm_interval); 
                    d(document).attr('title', current_title);  
                d(this).dialog("close");
                  }
              },
              {
                text: twoName,
                click: function (){
                  if(twoCallback){twoCallback();} 
                  if(twoUrl){redirect_fnc(twoUrl);} 
                  clearInterval(confirm_interval);
                  d(document).attr('title', current_title);
                d(this).dialog("close");
                }
            },
          ],
            close: function(event, ui) {
              d(this).remove();
            },
            open: function(event, ui) { 
              d(this).parent().children().children('.ui-dialog-titlebar-close').hide();
          }
          });
      
      }
      
      
      function overlay_fnc(id, act='show'){
        d(id).LoadingOverlay(act, {
          image       : loader,
          imageAnimation: '',
          imageResizeFactor: 0.5,
          text        : "Please Wait..."
      });      
      setTimeout(function(){
        d(id).LoadingOverlay("text", "Yep, still loading...");
      }, 5000); 
      }


var isEmptyArray = function(arr) {
        response = true;
        if(typeof(arr) !== 'undefined' && arr !== null){
          response = (arr || []).length === 0;
        };

        return response;
        };

var isElementExist = function(ele) {
          var element =  document.getElementById(ele);
        return ( typeof(element) !== 'undefined' && element !== null && d('#'+ele).length > 0);
        };

var isEmpty = function(input_val) {
        return ( typeof(input_val) !== 'undefined' && input_val !== null && input_val.length > 0);
        };

    function is_valid_email(email) {
  const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return pattern.test(email.trim());
}


       function dump_fnc(data, level = 0, seen = new WeakSet()) {
  const indent = (lvl) => '  '.repeat(lvl);
  let output = '';

  const prefix = indent(level);

  if (data === null) {
    output += `${prefix}null\n`;
  } else if (typeof data === 'undefined') {
    output += `${prefix}undefined\n`;
  } else if (typeof data === 'string') {
    output += `${prefix}"${data}"\n`;
  } else if (typeof data === 'number' || typeof data === 'boolean') {
    output += `${prefix}${data}\n`;
  } else if (typeof data === 'symbol') {
    output += `${prefix}${data.toString()}\n`;
  } else if (typeof data === 'function') {
    output += `${prefix}[Function: ${data.name || 'anonymous'}]\n`;
  } else if (typeof data === 'object') {
    if (seen.has(data)) {
      output += `${prefix}*RECURSION*\n`;
      return output;
    }
    seen.add(data);

    const isArray = Array.isArray(data);
    output += `${prefix}${isArray ? 'Array' : 'Object'} (\n`;

    const entries = isArray
      ? data.map((v, i) => [i, v])
      : Object.entries(data);

    for (const [key, val] of entries) {
      output += `${indent(level + 1)}[${key}] => `;
      output += dump_fnc(val, level + 1, seen);
    }

    output += `${prefix})\n`;
  } else {
    output += `${prefix}${String(data)}\n`;
  }

  if (level === 0) console.log(output);
  return output;
}

 dom_ready_fnc(); 
