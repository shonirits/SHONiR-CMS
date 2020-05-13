function SHONiR_Scroll_Fnc(SHONiR_ID){
    d('html, body').animate({
                  scrollTop: d("#"+SHONiR_ID).offset().top
              }, 2000);

  }


  function SHONiR() {}

function SHONiR_Dialog_Fnc(title, content) {
  SHONiR_Close_Fnc();
    var ddialog = d('<div></div>')
        .html("<div id='dialogcontent'>" + content + "</div>")
        .dialog({
            autoOpen: false,
            resizable: true,
            height: "auto",
            width: 550,
            modal: true,
            show: "blind",
            hide: "explode",
            title: title,
            close: function(e) {
                e.preventDefault();
d(this).dialog('destroy').remove();
            }
        });

    ddialog.dialog('open');
    d("#btn-submit-fnc").button("disable");

}

function SHONiR_Agree_Fnc(form, title, content) {

    var ddialog = d('<div></div>')
        .html("<div id='dialogcontent'>" + content + "</div>")
        .dialog({
            autoOpen: false,
            resizable: true,
            height: "auto",
            width: 550,
            modal: true,
            show: "blind",
            hide: "explode",
            title: title,
            close: function(e) {
				e.preventDefault();
d(this).dialog('destroy').remove();
            },
            create: function (e, ui) {
                var pane = d(this).dialog("widget").find(".ui-dialog-buttonpane")
                d("<label class='tandc' ><input type='checkbox' onChange='SHONiR_TandC_Fnc(this);' name='tandc'  id='tandc'> I agree to the terms and conditions </label>").prependTo(pane)
            },

            buttons: [{
                id:"btn-submit-fnc",
                text: "Submit",
                click: function() {
                    form.submit();
                    SHONiR_Wait_Fnc('Processing...', 'Please do not refresh the page and wait while we are processing your request.');
                    d(this).dialog("close");
                }
            },
            {
                id:"btn-edit-fnc",
                text: "Edit",
                click: function() {
                   d(this).dialog("close");
                }
            }]


        });

    ddialog.dialog('open');
    d("#btn-submit-fnc").button("disable");

}


function SHONiR_TandC_Fnc(e){

    if(d(e).is(':checked')){
        d("#btn-submit-fnc").button("enable");
    } else {
        d("#btn-submit-fnc").button("disable");
    }
}


function SHONiR_Wait_Fnc(title, content) {
    var ddialog = d('<div></div>')
        .html("<div class='wait' > <p>"+content+"</p> <img src='"+SHONiR_Loader+"' /> </div>")
        .dialog({
            autoOpen: false,
            resizable: false,
            width: 400,
            modal: true,
            show: "blind",
            hide: "explode",
            title: title,
            close: function(e) {
				e.preventDefault();
d(this).dialog('destroy').remove();
			}
        });
    ddialog.dialog('open');

}


function SHONiR_Close_Fnc(){
  d(".ui-dialog-content").dialog("close");
}



function SHONiR_ShowPassword_Fnc(password) {

    if(d("span.password").text() == '********')    {
        d("#show_password").addClass("fa-eye-slash");
        d("span.password").text(password)
    }else{
        d("#show_password").removeClass("fa-eye-slash");
        d("span.password").text('********')
    }

}

function SHONiR_Alert_Fnc(SHONiR_Message, SHONiR_Type = 'information'){

  new Noty({  theme: 'metroui', type: SHONiR_Type, timeout     : 3000,
  progressBar : true,  text: SHONiR_Message,
animation: {
open: 'animated bounceInRight',
    close: 'animated bounceOutRight',
easing: 'swing',
speed: 700
}
}).show();

}


function SHONiR_Redirect_Fnc(url) {
d(location).attr('href', url);
}

function SHONiR_Ajax_Popup_Fnc(url) {

d('#ajax-popup').modal('show');

request = d.ajax({
  url: url,
  type: "get",
  cache: false
});


request.done(function (response, textStatus, jqXHR){
 p(".ajax-popup").html(response);
});


request.fail(function (jqXHR, textStatus, errorThrown){
  alert("The following error occurred: "+
  textStatus, errorThrown);
});


  }


  function SHONiR_Captcha_Fnc()
  {

  d("#captcha_icon").addClass("fa-spin");
  d("#captcha_image").attr("src",SHONiR_BASE+'Captcha?'+ Math.random());
  d("#captcha_image").one("load",function(){d("#captcha_icon").removeClass("fa-spin");})

}

function SHONiR_AddtoCart_Fnc(product_id){

  var id = 'SHONiR_Product_' + product_id + '_';

 var form = document.getElementById(id + 'Frm');

 if(form){

  if (form.checkValidity() === false) {

    event.preventDefault();
    event.stopPropagation();

} else {

  d('#'+ id + 'Area').LoadingOverlay("show", {
    background  : "rgba(150, 150, 150, 0.5)"
    });

    data = p(form).serialize();

                    request = d.ajax({
              url: SHONiR_BASE+"Ajax/Add-to-Cart/" + product_id,
              type: "post",
              dataType:"json",
              data: 'SHONiR=SHONiR&'+data,
              cache: false
          });
          request.done(function (response, textStatus, jqXHR){
            if(response['type']==='success'){

                d('#'+ id + 'Area').LoadingOverlay("hide");
                p('#'+ id + 'Area').html('<div class="alert alert-success fade show" role="alert"> ' + response['message'] + ' </div>');

              }else if(response['type']==='redirect'){

              SHONiR_Redirect_Fnc(SHONiR_BASE+"Go/i/" + product_id);

              }else{

               d('#'+ id + 'Area').LoadingOverlay("hide");
               p('#'+ id + 'Area').prepend('<div class="alert alert-danger alert-dismissible fade show" role="alert"> ' + response['message'] + ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">&times;</span> </button></div>');

            }
        });

    request.fail(function (jqXHR, textStatus, errorThrown){
      d('#'+ id + 'Area').LoadingOverlay("hide");
    alert("The following error occurred: "+
    textStatus, errorThrown);
});

}

form.classList.add('was-validated');

 }else{

  SHONiR_Wait_Fnc('Add to Cart', 'Please Wait..');

  request = d.ajax({
    url: SHONiR_BASE+"Ajax/Add-to-Cart/" + product_id,
    type: "post",
    dataType:"json",
    data: 'SHONiR=SHONiR',
    cache: false
});
request.done(function (response, textStatus, jqXHR){
  if(response['type']==='success'){

    SHONiR_Alert_Fnc(response['message'], 'success');
    SHONiR_Close_Fnc();

    }else if(response['type']==='redirect'){

    SHONiR_Redirect_Fnc(SHONiR_BASE+"Go/Pr/" + product_id);
    SHONiR_Close_Fnc();

    }else{

      SHONiR_Alert_Fnc(response['message'], 'error');
      SHONiR_Close_Fnc();

  }
});

request.fail(function (jqXHR, textStatus, errorThrown){
d('#'+ id + 'Area').LoadingOverlay("hide");
alert("The following error occurred: "+
textStatus, errorThrown);
});

 }

}

  function SHONiR_Subscribe_Fnc(UnSubscribe = false){

    var ajax = false;

    if (typeof(UnSubscribe)==='undefined') UnSubscribe = false;



  if(UnSubscribe !== false){

    var email = UnSubscribe;

    ajax = false

  }else{

  var email =  d('#SHONiR_Subscribe_Frm').find('input[name="email"]').val();

  }

  if(email == ''){

    alert('Email: required \n');

    return false;

    }else if(email == 'Type your email address...'){

    alert('Email: required \n');

    return false;

    }else{

    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    if(!emailReg.test(email)) {

     alert('Email: Please enter a valid email \n');

     return false;

            }else{

              ajax = true;

            }

            if(ajax){

              SHONiR_Wait_Fnc('Processing your request...', 'Please wait while we process your request.');

              if(UnSubscribe !== false){

            d("#SHONiR_Subscribe_Frm :input").attr("disabled", true);

            request = d.ajax({
              url: SHONiR_BASE+"Ajax/Email/UnSubscribe",
              type: "post",
              data: 'SHONiR=SHONiR&email='+UnSubscribe,
              cache: false
          });



              }else{

            var data = d("#SHONiR_Subscribe_Frm").serialize();

            d("#SHONiR_Subscribe_Frm :input").attr("disabled", true);

            request = d.ajax({
              url: SHONiR_BASE+"Ajax/Email/Subscribe",
              type: "post",
              data: 'SHONiR=SHONiR&'+data,
              cache: false
          });

        }

          request.done(function (response, textStatus, jqXHR){
            SHONiR_Dialog_Fnc('Email Subscribe/UnSubscribe', response)
        });


            request.fail(function (jqXHR, textStatus, errorThrown){
              SHONiR_Close_Fnc();
              alert("The following error occurred: "+
              textStatus, errorThrown);
          });

          request.always(function () {
            d("#SHONiR_Subscribe_Frm :input").attr("disabled", false);

        });

      }


    }

  }
  function SHONiR_Live_Fnc(){
    d.getScript(SHONiR_BASE+"Ajax/Cart/Items?r="+ Math.random());
    }

    d(document).ready(function(){
      d('#shonirall').fadeIn(3000);
      d('#shonirloader').fadeOut(2000);
    new WOW().init();
      SHONiR_Live_Fnc();
  d('[data-toggle="tooltip"]').tooltip();
var Live = setInterval(function(){SHONiR_Live_Fnc();},5000);
    });
