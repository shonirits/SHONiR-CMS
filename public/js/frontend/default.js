
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
  return typeof Noty === "function" &&
         typeof mojs === "object" &&
         typeof bootstrap !== "undefined" &&
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

  function update_quantity_fnc(button, change) {
  const input = button.parentElement.querySelector('.quantity-input');
  let value = parseInt(input.value) + change;
  if (value >= 1) {
    input.value = value;
  }
}


  function int_fnc(token = token_fnc()){ 

  setTimeout(function() { 

    let offset = get_timezone_offset_fnc();

  let url = ccp.base_url+"Ajax/initialize";
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
                  
                 let quick_cart_content = '<div class="alert alert-warning" role="alert">Your cart is empty—Let’s add something!</div>';
                 let total_cart_items = 0;
                let total_quantity = 0;
                let total_price = 0;
                let hasPrice = false;
                 
                  if(response.data && response.data.cart && response.data.cart.length > 0){
                  total_cart_items = response.data.cart.length;
                 quick_cart_content = '<div class="cart-items">';
                 response.data.cart.forEach(item => {
                try {
                let uploads = JSON.parse(item.uploads);
                let itemDetails = JSON.parse(item.item_details);
                hasPrice = typeof itemDetails.price !== 'undefined';
                 let itemSubtotal = hasPrice ? itemDetails.price * item.quantity : 0;
                total_quantity += parseFloat(item.quantity); 
                total_price += itemSubtotal; 
                

              quick_cart_content += `
                      <div class="cart-item row align-items-center border-bottom py-2">
                        <div class="col-2 col-md-3 text-center">
                          <img src="${uploads.url}" alt="${itemDetails.name}" class="img-fluid rounded shadow-sm card-image">
                        </div>
                        <div class="col-10 col-md-9">
                          <div class="card border-0">
                            <div class="card-body p-2">
                              <h6 class="card-title mb-1"><a href="${itemDetails.url}" class="text-decoration-none">${itemDetails.name}</a></h6>
                              <p class="card-text mb-1"><span class="fw-bold">Model:</span> ${itemDetails.model}</p>`;
                              
                              if (hasPrice) {
                                quick_cart_content += `<p class="card-text mb-1">
                                  <span class="fw-bold">Price:</span> 
                                  ${itemDetails.price < itemDetails.price_previous ? `<span class="text-muted text-decoration-line-through me-1">${itemDetails.price_previous}</span>` : ""}
                                  <span>${itemDetails.price}</span>
                                </p>`;
                              }

                              quick_cart_content += `<p class="card-text mb-1"><span class="fw-bold">Quantity:</span> ${item.quantity}</p>`;

                              if (hasPrice) {
                                quick_cart_content += `<p class="card-text mb-0"><span class="fw-bold">Subtotal:</span> ${itemSubtotal.toFixed(2)}</p>`;
                              }

                            quick_cart_content += `</div>
                          </div>
                        </div>
                      </div>
                    `;

} catch (error) {
    console.error("Error parsing JSON:", error);
}
  });

                quick_cart_content += `
        <div class="cart-summary border-top pt-3">
            <h5>Inquiry Summary</h5>
            <p><span class="title">Total Items:</span> ${total_cart_items}</p>
            <p><span class="title">Total Quantity:</span> ${total_quantity}</p>`;

            if (hasPrice) {
            quick_cart_content += `<p><span class="title">Subtotal:</span> <span class="subtotal">${total_price.toFixed(2)}</span></p>`;
            }
        quick_cart_content += `<div class="d-flex gap-3 mt-3">
            <a href="${ccp.base_url}Cart" class="btn btn-outline-primary w-50">View Cart</a>
            <a href="${ccp.base_url}Checkout" class="btn btn-success w-50">Send Enquiry</a>
        </div>
            </div>
    </div>`;
                
                }

                d('#quick-cart-content').html(quick_cart_content); 
                d('#total-cart-items').css({ opacity: 0, transform: "scale(0.8)" }).html(total_cart_items).animate({ opacity: 1, transform: "scale(1)" }, 500);


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
        url: ccp.base_url+"Ajax/cron",
        method: "GET"
    });
}, 19000);

  }, 500);
    
  }

  function search_fnc(query = '', token = ''){

    let query_trim = query.trim();

    if (query_trim.length >= 3) {

      if (d('#query-fld').data('uiAutocomplete')) {
        d('#query-fld').autocomplete('destroy');
      }

    let url = ccp.base_url+"Ajax/search";
    let data = {query: query_trim, token: token};
    let options = {
              type: "POST",
              url: url,
              headers: {'X-Requested-With': 'XMLHttpRequest'},
              data: data,
              dataType: "json",
              success: function(response, status, xhr){   
                if(response['status'] === 'TRUE'){                   

                  if(response.data && response.data.length > 0){                    

                    d("#query-fld").autocomplete({
                  source: response.data.map(item => {
                      let uploads = JSON.parse(item.uploads);
                      return {
                          label: item.name,
                          value: item.name,
                          model: item.model,
                          price: typeof item.price !== 'undefined' ? item.price : null,
                          price_previous: typeof item.price !== 'undefined' ? item.price_previous : null,
                          img: uploads.url,
                          url: item.url
                      };
                  }),
                  minLength: 0,
                  select: function(event, ui) {
                     redirect_fnc(ui.item.url);
                     wait_fnc('Navigating to Your Destination...', `<p>Please hold on while we take you to your page. <br/>If the redirection doesn’t happen in 5 seconds, kindly <b><a href="${ui.item.url}">Click Here</a></b> to proceed manually.</p>`);
                  }
              });

                    setTimeout(() => {
                    const $input = d("#query-fld");
                    if ($input.data("uiAutocomplete")) {
                      $input.autocomplete("search", "");
                    }
                  }, 200);

                                d("#query-fld").data("uiAutocomplete")._renderItem = function(ul, item) {
                  const price = parseFloat(item.price);
                  const pricePrevious = parseFloat(item.price_previous);
                  const hasPrice = !isNaN(price);
                  const hasPrevious = !isNaN(pricePrevious);

                  return d("<li class='autocomplete-item list-group-item border-0 px-0'>")
                    .append(`
                      <div class="card shadow-sm border-0 rounded-3">
                        <div class="row g-2 align-items-center">
                          <div class="col-3 col-sm-2 text-center">
                            <img src="${item.img}" alt="${item.label}" class="img-fluid rounded card-image">
                          </div>
                          <div class="col-9 col-sm-10">
                            <div class="card-body py-2 px-3">
                              <h6 class="card-title mb-1">
                                <a href="${item.url || '#'}" class="text-decoration-none text-primary fw-semibold hover-link">${item.label}</a>
                              </h6>
                              <p class="card-text text-muted small mb-1">${item.model || ''}</p>
                              ${hasPrice ? `
                                <p class="card-text text-muted small mb-0">
                                  ${hasPrevious && pricePrevious > price ? 
                                    `<span class="text-decoration-line-through text-danger">$${pricePrevious.toFixed(2)}</span>` : ""}
                                  <strong class="text-success ms-2">$${price.toFixed(2)}</strong>
                                </p>` : ""}
                            </div>
                          </div>
                        </div>
                      </div>
                    `).appendTo(ul);
                };

                  }

                }
              }       
            };

        d.ajax(options);
       }
  }

  function get_timezone_offset_fnc() {
  const pad = n => String(Math.floor(n)).padStart(2, '0');
  const offset = new Date().getTimezoneOffset();
  const sign = offset < 0 ? '+' : '-';
  const abs = Math.abs(offset);
  return sign + pad(abs / 60) + pad(abs % 60);
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
  const existing = [...document.styleSheets].some(sheet =>
    sheet.href && sheet.href.includes(url)
  );
  if (existing) return;

  const link = document.createElement('link');
  link.rel = 'stylesheet';
  link.href = url;
  link.type = 'text/css';
  link.media = 'all';

  document.head.appendChild(link);
}

  filters_var = '';

  if(typeof add_by !== 'undefined'){
    filters_var += '&add_by='+add_by;
  }

  if(typeof organization_id !== 'undefined'){
    filters_var += '&organization_id='+organization_id;
  }

  if(typeof item_id !== 'undefined'){
    filters_var += '&item_id='+item_id;
  }

  if(typeof employee_id !== 'undefined'){
    filters_var += '&employee_id='+employee_id;
  }

  if(typeof contact_id !== 'undefined'){
    filters_var += '&contact_id='+contact_id;
  }

  if(typeof query !== 'undefined'){
    filters_var += '&query='+query;
  }


  d("#type").change(function () {
    wait_fnc('🔍 Applying Filters','Hang tight while we fetch and organize your data. This will only take a moment.');
    var selected = this.value;
    type_url = url+'?type='+selected+'&order='+order+'&sort='+sort+'&limit='+limit+filters_var;
    redirect_fnc(type_url);
  });
  d("#order").change(function () {
    wait_fnc('🔍 Applying Filters','Hang tight while we fetch and organize your data. This will only take a moment.');
    var selected = this.value;
    order_url = url+'?type='+type+'&order='+selected+'&sort='+sort+'&limit='+limit+filters_var;
    redirect_fnc(order_url);
  });
  d("#sort").change(function () {
    wait_fnc('🔍 Applying Filters','Hang tight while we fetch and organize your data. This will only take a moment.');
    var selected = this.value;
    sort_url = url+'?type='+type+'&order='+order+'&sort='+selected+'&limit='+limit+filters_var;
    redirect_fnc(sort_url);
  });
  d("#limit").change(function () {
    wait_fnc('🔍 Applying Filters','Hang tight while we fetch and organize your data. This will only take a moment.');
    var selected = this.value;
    limit_url = url+'?type='+type+'&order='+order+'&sort='+sort+'&limit='+selected+filters_var;
    redirect_fnc(limit_url);
  });
  d( "#filters" ).on( "click", function() {
  d( "#filters_zone" ).toggle( "slow" );
  });
  
function is_date(dateString, div = '-') {
  const dateFormat = /^(\d{2})[-](\d{2})[-](\d{4})$/;

  if (!dateFormat.test(dateString)) return false;

  const parts = dateString.split(div);
  if (parts.length !== 3) return false;

  const day = parseInt(parts[0], 10);
  const month = parseInt(parts[1], 10);
  const year = parseInt(parts[2], 10);

  if (month < 1 || month > 12) return false;

  const daysInMonth = [31, (isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

  return day >= 1 && day <= daysInMonth[month - 1];
}

function isLeapYear(year) {
  return (year % 4 === 0 && year % 100 !== 0) || year % 400 === 0;
}



      function validate_from_date() {
  if (typeof var_from_date === 'undefined' || !var_from_date.value) return;

  const inputValue = var_from_date.value;
  const msgSelector = "#from_date_msg";
  const inputSelector = "#from_date";
  const isValid = is_date(inputValue);

  var_from_date.setCustomValidity(isValid ? '' : "Please provide valid from date dd-mm-yyyy");

  d(msgSelector).html(isValid ? '' : 'Please provide valid from date dd-mm-yyyy');
  d(msgSelector).toggleClass("text-success", isValid);
  d(msgSelector).toggleClass("invalid-feedback", !isValid);

  d(inputSelector).toggleClass("is-valid", isValid);
}
      
      function validate_to_date() {
  if (typeof var_to_date === 'undefined' || !var_to_date.value) return;

  const toDateValue = var_to_date.value;
  const msgSelector = "#to_date_msg";
  const inputSelector = "#to_date";

  const valid = is_date(toDateValue);

  var_to_date.setCustomValidity(valid ? '' : "Please provide valid to date dd-mm-yyyy");

  d(msgSelector).html(valid ? '' : 'Please provide valid to date dd-mm-yyyy');
  d(msgSelector).toggleClass("text-success", valid);
  d(msgSelector).toggleClass("invalid-feedback", !valid);

  d(inputSelector).toggleClass("is-valid", valid);
}

function validate_date_range() {
  const from = var_from_date.value;
  const to = var_to_date.value;

  const fromValid = is_date(from);
  const toValid = is_date(to);

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


                           function date_picker(e, minDate = null, maxDate = null, format = "dd-mm-yy") {
                              if (!e || !e.id) return;
                              const selector = `#${e.id}`;
                              setTimeout(() => {
                                const $el = d(selector);
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
                    
                    function validate_date(e) {
  if (!e || !e.id) return;

  const id = e.id;
  const input = document.getElementById(id);
  const msgEl = d(`#${id}_msg`);
  const inputValue = input.value;

  if (!inputValue) return;

  const isValid = is_date(inputValue);

  input.setCustomValidity(isValid ? '' : 'Please provide a valid date (dd-mm-yyyy)');

  msgEl.html(isValid ? '' : 'Please provide a valid date (dd-mm-yyyy)');
  msgEl.toggleClass('text-success', isValid);
  msgEl.toggleClass('invalid-feedback', !isValid);
  d(`#${id}`).toggleClass('is-valid', isValid);
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

function dom_ready_fnc() {
  if (load_assets) return;

  const autoLoadDelay = 500;
  const userEvents = ["keydown", "mousemove", "wheel", "touchmove", "touchstart", "touchend"];
  const autoLoadTimer = setTimeout(triggerAssetLoad, autoLoadDelay);

  userEvents.forEach(event =>
    window.addEventListener(event, triggerAssetLoadOnce, { passive: true })
  );

  function triggerAssetLoadOnce() {
    triggerAssetLoad();
    clearTimeout(autoLoadTimer);
    userEvents.forEach(event =>
      window.removeEventListener(event, triggerAssetLoadOnce, { passive: true })
    );
  }

  function triggerAssetLoad() {
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

function load_assets_fnc() {
  if (load_assets || load_assets_locked) return;

  load_assets_locked = true;

  const cssList = [
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
  `https://cdn.jsdelivr.net/gh/shonirits/SHONiR-CMS@master/public/css/frontend/default.min.css`,
  `${ccp.css_url}public/css/frontend/${ccp.frontend_theme}/theme.css`,
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

  function first_capitalize_fnc(str) {
  return str.toLowerCase().split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
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

  function ajax_success_fnc(request_type, response, status, xhr) {

    dialog_fnc(first_capitalize_fnc(request_type+': '+status), '<h1>'+response['data']+'</h1>');

  }

  function ajax_error_fnc(request_type, jqXhr, textStatus, errorMessage) {
  
    dialog_fnc(first_capitalize_fnc(request_type+': '+textStatus), '<h1>'+errorMessage+'</h1><hr/><p>If you suspect an issue, please try again shortly.</p><p>If the problem continues, feel free to <a href="'+ccp.base_url+'Contact" class="link-primary">contact us</a> for assistance.</p>');

  }

  function ajax_complete_fnc(request_type, data, callback = false) {

    int_fnc(token);

  }

  function likes_fnc(parent, parent_type, parent_id, token) {

    let url = ccp.base_url+"Ajax/likes";
    let data = {parent: parent, parent_type: parent_type, parent_id: parent_id, token: token};
    let options = {
              type: "POST",
              url: url,
              headers: {'X-Requested-With': 'XMLHttpRequest'},
              data: data,
              dataType: "json",
              success: function(response, status, xhr){   
                if(response['status'] === 'TRUE'){   
                ajax_success_fnc('like', response, 'Success', xhr);
                d('#do_like_'+parent_type+parent_id).html('<i class="fa-solid fa-thumbs-up"></i>');
                }else{
                 ajax_error_fnc('like', xhr, 'Failed', response['data']); 
                }
              },
              error: function(jqXhr, textStatus, errorMessage){
                ajax_error_fnc('like', jqXhr, textStatus, errorMessage);                
              },
             complete: function(data){
              ajax_complete_fnc('like', data);
            }
            };

             p.ajax(options);

  }


  function ratings_fnc(parent, parent_type, parent_id, scores, token) {

    let url = ccp.base_url+"Ajax/ratings";
    let data = {parent: parent, parent_type: parent_type, parent_id: parent_id, scores: scores, token: token};
    let options = {
              type: "POST",
              url: url,
              headers: {'X-Requested-With': 'XMLHttpRequest'},
              data: data,
              dataType: "json",
              success: function(response, status, xhr){   
                if(response['status'] === 'TRUE'){   
                ajax_success_fnc('rating', response, 'Success', xhr);
                }else{
                 ajax_error_fnc('rating', xhr, 'Failed', response['data']); 
                }
              },
              error: function(jqXhr, textStatus, errorMessage){
                ajax_error_fnc('rating', jqXhr, textStatus, errorMessage);                
              },
             complete: function(data){
              ajax_complete_fnc('rating', data);
            }
            };

             p.ajax(options);

  }


function sound_fnc(type = 'notification') {
  const soundMap = {
    message: 'public/audios/message.mp3',
    initialize: 'public/audios/initialize.mp3',
    notification: 'public/audios/notification.mp3'
  };

  const filePath = soundMap[type] || soundMap.notification;
  const url = ccp.base_url + filePath;

  const sound = new Howl({ src: [url] });

  sound.once('load', () => {
    sound.play();
  });
}


function item_quick_view_fnc(details, item_image, item_url, token) {
  let id    = details.item_id;       
  let title = details.title;         
  let model = details.model;  
  let spotlight = details.spotlight; 
  let ratings = details.ratings;
  let likes   = details.likes;
  let price   = parseFloat(details.price) || 0;
  let price_previous = parseFloat(details.price_previous) || 0;
  let minimum = details.minimum;
  let stock   = details.stock;

// normalize config flags to boolean
const badgeSale     = String(ccp.badge_sale).toUpperCase() === 'TRUE';
const badgeNewbie   = String(ccp.badge_newbie).toUpperCase() === 'TRUE';
const badgeFeatured = String(ccp.badge_featured).toUpperCase() === 'TRUE';
const badgeHd       = String(ccp.badge_hd).toUpperCase() === 'TRUE';
const badgeLq       = String(ccp.badge_lq).toUpperCase() === 'TRUE';
const badgeSt       = String(ccp.badge_st).toUpperCase() === 'TRUE';

// normalize item flags to boolean
const isNewbie   = details.newbie === 1 || details.newbie === '1' || details.newbie === true;
const isFeatured = details.featured === 1 || details.featured === '1' || details.featured === true;
const isHd       = details.hd === 1 || details.hd === '1' || details.hd === true;
const isLq       = details.lq === 1 || details.lq === '1' || details.lq === true;
const isSt       = details.st === 1 || details.st === '1' || details.st === true;

let badgesHtml = '';

if (badgeSale && price < price_previous) {
  badgesHtml += `<span class="badge sale">Sale</span>`;
}
if (badgeNewbie && isNewbie) {
  badgesHtml += `<span class="badge newbie">New</span>`;
}
if (badgeFeatured && isFeatured) {
  badgesHtml += `<span class="badge featured">Featured</span>`;
}
if (badgeHd && isHd) {
  badgesHtml += `<span class="badge hd">HD</span>`;
}
if (badgeLq && isLq) {
  badgesHtml += `<span class="badge lq">LQ</span>`;
}
if (badgeSt && isSt) {
  badgesHtml += `<span class="badge st">ST</span>`;
}


  d('#' + id).remove(); 

  let ratingsHtml = '';
  if (String(ccp.ratings).toUpperCase() === 'TRUE') {
    ratingsHtml = `
      <div class="ratings">
        Rating: <span id="rate_item${id}" class="star-ratings"></span>
        <span id="rate_live_item${id}" class="live-ratings">${ratings}</span>
      </div>`;
  }

  let likesHtml = '';
  if (String(ccp.likes).toUpperCase() === 'TRUE') {
    let likeIcon = details.liked === 'true'
      ? '<i class="fa-solid fa-thumbs-up"></i>'
      : '<i class="fa-regular fa-thumbs-up"></i>';
    likesHtml = `
      <div class="likes">
        Likes: 
        <span class="do-likes" id="do_like_item${id}">${likeIcon}</span>
        <span class="info-likes" id="info_like_item${id}">${likes}</span>
      </div>`;
  }

  let priceHtml = '';
if (String(ccp.price).toUpperCase() === 'TRUE') {

  // format for display
  const currentPrice = price.toFixed(2);
  const prevPrice = price_previous.toFixed(2);

  priceHtml = `
    <div class="price">
      Price: US $ ${currentPrice} - ${price_previous > price ? prevPrice : currentPrice}
    </div>`;
}

  let categoriesHtml = '';
  if (details.categories && details.categories.length) {
    categoriesHtml = `
      <div class="categories">
        <span>Categories:</span>
        <ul>
          ${details.categories.map(cat => `<li><a href="${cat.url}">${cat.name}</a></li>`).join('')}
        </ul>
      </div>`;
  }

  let modalHtml = `
  <div class="modal item-modal fade t-items_details" id="${id}" tabindex="-1" aria-labelledby="${id}Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body" id="quick_view_item_${id}_zone">
          <div class="row">
            <div class="col-md-7">
              <div class="modal-image item_badges">
              ${badgesHtml}
                <img class="img-fluid rounded" src="${item_image}" alt="${title}">
                
              </div>
            </div>
            <div class="col-md-5">
              <form name="quick_view_item_${id}_frm" id="quick_view_item_${id}_frm" class="needs-validation" novalidate>
                <div class="pinpoint">
                  <h2 class="heading">${title}</h2>
                  <span class="model">Model: ${model}</span>
                  ${ratingsHtml}
                  ${likesHtml}
                  ${priceHtml}
                  <div class="spotlight">${spotlight}</div>
                  <div class="row quantity align-items-center">
                    <div class="col-auto">
                      <label for="quantity_${id}" class="col-form-label">Quantity:</label>
                    </div>
                    <div class="col-auto quantity">
                      <input type="number" id="quantity_${id}" name="quantity" class="form-control"
                        min="${minimum}" max="${stock}" step="1" value="${minimum}" inputmode="numeric" pattern="[0-9]*" required>
                      <div class="invalid-feedback">
                        There is a minimum ${minimum} & maximum ${stock} quantity limit for this product.
                      </div>
                    </div>
                  </div>
                  ${categoriesHtml}
                  <button type="button" class="btn btn-main"
                    onclick="javascript:add2cart_fnc('${id}', '${token}', event, true);"
                    data-toggle="tooltip" data-placement="top" title="Get Free Quote">
                    Get Free Quote
                  </button>
                  <a href="${item_url}" class="btn btn-transparent">View Product Details</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>`;
  
  d('body').append(modalHtml);
  let modal = new bootstrap.Modal(d('#' + id)[0], { backdrop: 'static', keyboard: false });
  modal.show();

d('#' + id).on('shown.bs.modal', function () {

    let ratedColors = ['#d21917', '#7f00ff', '#edda12', '#07aee5', '#007437'];
  let ratingsNum = parseFloat(ratings) || 0;
  let ratingsinitial = ratingsNum + 0.1;
  let initialRating = ratingsinitial.toFixed(0);
  let activeColor = initialRating - 1;
  d("#rate_item"+id).starRating({
    starSize: 22,
    strokeWidth: 9,
    strokeColor: '#636363',
    hoverColor: '#0037ff',
    activeColor: ratedColors[activeColor],
    ratedColors: ratedColors,
    useGradient: false,
    initialRating: ratingsNum,
    callback: function(currentRating, el) {
      ratings_fnc('items', 'item', id, currentRating, token);
    },
    onHover: function(currentIndex, currentRating, el) {
      d('#rate_live_item'+id).text(currentIndex);
    },
    onLeave: function(currentIndex, currentRating, el) {
      d('#rate_live_item'+id).text(currentRating);
    }
  });

  d('#do_like_item'+id).on('click', function() {    
    likes_fnc('items', 'item', id, token);
  });
});

}


function is_valid_email(email) {
  const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return pattern.test(email.trim());
}

function subscribe_fnc(action) {
  var form = document.getElementById('newsletter_zone');
  p(form).find(':button').prop('disabled', true);
   overlay_fnc(form);
    let data = {do: action, token: d('#newsletter_token').val(), email: d('#newsletter_email').val(), name: d('#newsletter_name').val()};
   p.ajax({
          url: ccp.base_url+'Ajax/execution', 
          type: 'POST',
          headers: {'X-Requested-With': 'XMLHttpRequest'},
          data: data,
          dataType: 'json',
          success: function (response, status, xhr) {
            if(response.status && response.data){
            if(response.status === 'TRUE'){              
            d('#newsletter_zone').html('<div class="alert alert-success my-3" role="alert">'+response.data.alert+'</div>');
            d(form).LoadingOverlay("hide");
            } else if(response.status === 'FALSE'){              
            d('#newsletter_alert').append('<div class="alert alert-danger alert-dismissible fade show my-3" role="alert">'+response.data.alert+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></div>');
            p(form).find(':button').prop('disabled', false);
            d(form).LoadingOverlay("hide");

            } else{

              d('#newsletter_alert').append('<div class="alert alert-danger alert-dismissible fade show my-3" role="alert"><b>Oops!</b> Something went wrong. Please refresh the page and try again. <p>If the problem continues, feel free to <a href="'+ccp.base_url+'Contact" class="link-primary">contact us</a> for assistance.</p></div>');
              d(form).LoadingOverlay("hide");

            }

            }else{

              dump_fnc(response);

             d('#newsletter_alert').append('<div class="alert alert-danger alert-dismissible fade show my-3" role="alert">Uh-oh! We weren’t able to process your request. A quick refresh should fix it — then please try again. <p>If the problem continues, feel free to <a href="'+ccp.base_url+'Contact" class="link-primary">contact us</a> for assistance.</p></div>');
             p(form).LoadingOverlay("hide");

            }          
          }
          
        });

}

function subscriber_fnc(token) {
    var subscriber_email = document.getElementById("subscriber_email").value.trim();
    if (is_valid_email(subscriber_email)) {

     var content = `
  <div class="text-center py-3">
    <p>Join our newsletter for exclusive insights, product updates, and deals — straight from your trusted manufacturer and supplier.</p>
  </div>
  <div id="newsletter_zone">
  <input type="hidden" name="newsletter_token" id="newsletter_token" value="` + token + `">
  <span id="newsletter_alert"></span>
    <div class="mb-3">
      <label for="name" class="form-label fw-semibold">Your Name:</label>
      <input type="text" class="form-control" id="newsletter_name" name="newsletter_name" placeholder="Enter Your Name">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label fw-semibold">Your Email:</label>
      <input type="email" class="form-control" id="newsletter_email" name="newsletter_email" placeholder="Enter Your Email Address" value="` + subscriber_email + `" disabled>
    </div>
    <div class="d-flex py-2 justify-content-between">
      <button type="button" class="btn btn-success w-45" onclick="subscribe_fnc('subscribe')">Subscribe</button>
      <button type="button" class="btn btn-danger w-45" onclick="subscribe_fnc('unsubscribe')">Unsubscribe</button>
    </div>
  </div>
`;

      modal_fnc(token, 'SUBSCRIBE TO NEWSLETTER', content);


    }else{
        dialog_fnc('Valid email required', '<b>Oops! That doesn’t look like a valid email.</b> <br> Please double-check and try again. <p>If the problem continues, feel free to <a href="'+ccp.base_url+'Contact" class="link-primary">contact us</a> for assistance.</p>');
        return false;
    }
}

function validate_search_fnc() {
    var query = document.getElementById("query-fld").value.trim();
    if (query === "") {
        dialog_fnc('Keywords required', 'Please enter a search term, such as a product name or model number, to find relevant results. Ensure your input is specific to get the best matches.');
        return false;
    }
    return true;
}

function add2cart_fnc(item_id, token = '', event = false, modal = false){


  if(item_id){

    let id;
  if (modal) {
    id = 'quick_view_item_' + item_id + '_';
  } else {
    id = 'item_' + item_id + '_';
  }

  var form = document.getElementById(id + 'frm');
  var zone = document.getElementById(id + 'zone');
    
  let data ='';

  d(zone).LoadingOverlay("show", {
    background  : "rgba(150, 150, 150, 0.5)"
    });

  if(form){

    if (form.checkValidity() === false) {

      if (!event) {
        event = new Event("dummyEvent");
    }

        event.preventDefault(); 
        event.stopPropagation();
        form.classList.add("was-validated");

        form.querySelectorAll("input").forEach(input => {
            if (!input.checkValidity()) {
                input.classList.add("is-invalid");
                let errorMsg = input.nextElementSibling;
                if (errorMsg && errorMsg.classList.contains("invalid-feedback")) {
                    errorMsg.style.display = "block";
                }
            } else {
                input.classList.remove("is-invalid");
                let errorMsg = input.nextElementSibling;
                if (errorMsg && errorMsg.classList.contains("invalid-feedback")) {
                    errorMsg.style.display = "none"; 
                }
            }
        });

        d(zone).LoadingOverlay("hide");
        return false;

} else {

form.classList.add('was-validated');

 data = '&'+d(form).serialize();

}

  }

let url = ccp.base_url+"Ajax/add2cart";
    let options = {
              type: "POST",
              url: url,
              headers: {'X-Requested-With': 'XMLHttpRequest'},
              data: 'item_id='+item_id+'&token='+token+data,
              dataType: "json",
              success: function(response, status, xhr){   
                if(response['status'] === 'TRUE'){   
                ajax_success_fnc('Free Quote Cart', response, 'Success', xhr);
                }else{
                 ajax_error_fnc('Free Quote Cart', xhr, 'Failed', response['data']); 
                }
              },
              error: function(jqXhr, textStatus, errorMessage){
                ajax_error_fnc('Free Quote Cart', jqXhr, textStatus, errorMessage);                
              },
             complete: function(data){
              ajax_complete_fnc('Free Quote Cart', data);
            }
            };

  p.ajax(options);

  d(zone).LoadingOverlay("hide");
  return true;

  }else{
   d(zone).LoadingOverlay("hide");
    return false;
  }

}

 dom_ready_fnc();   