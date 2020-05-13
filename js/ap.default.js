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


function SHONiR_Confirm_Fnc(title, content, url) {
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
            buttons: {
              Yes: function() {              
                SHONiR_Redirect_Fnc(url);
                SHONiR_Wait_Fnc('Processing your request...', 'Please wait while we process your request.');  
              },
              No: function() {    
               d(this).dialog("close");
              }
            },
            close: function(e) {
        		e.preventDefault();
d(this).dialog('destroy').remove();
            }
        });

    ddialog.dialog('open');
    d("#btn-submit-fnc").button("disable");

}




function SHONiR_Wait_Fnc(title, content) {
  SHONiR_Close_Fnc();
    var ddialog = d('<div></div>')
        .html(content)
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



function SHONiR_Link_External_Fnc(url){

var r = true;

if (url.trim()) {

var c = document.createElement('a');
c.href = url.toLowerCase();
c = c.hostname;

var b = document.createElement('a');
b.href = SHONiR_BASE.toLowerCase();
b = b.hostname;

if(c === b){

r = false

}

}

return r;

}

  function SHONiR_Login_Fnc(){

  var username =  d('#SHONiR_Login_Frm').find('input[name="username"]').val();
  var password =  d('#SHONiR_Login_Frm').find('input[name="password"]').val();
  var redirect =  d('#SHONiR_Login_Frm').find('input[name="continue"]').val();
  if(SHONiR_Link_External_Fnc(redirect) == true){
    redirect = SHONiR_APANEL+"Dashboard";
  } 
  var remember =  d('#SHONiR_Login_Frm').find('input[type="checkbox"][name="remember"]').is(":checked");
  
  if(username == ''){

    alert('Username: required \n');
    return false;

    } 

    if(password == ''){
      alert('Password: required \n');  
      return false;

      }

if(username && password)

              SHONiR_Wait_Fnc('Processing your request...', 'Please wait while we process your request.');            

            var data = d("#SHONiR_Login_Frm").serialize();
                
            d("#SHONiR_Login_Frm :input").attr("disabled", true);     

            request = d.ajax({
              url: SHONiR_BASE+"Ajax/AP/Login",
              type: "post",
              data: 'SHONiR=SHONiR&'+data,
              cache: false
          });

          request.done(function (response, textStatus, jqXHR){ 
            if(response === 'success') {

              SHONiR_Wait_Fnc('Logged In Successfully', 'Please wait, you are being redirected ...');
                     
              SHONiR_Redirect_Fnc(redirect);

            } else{        
            SHONiR_Dialog_Fnc('Administrator Login', response)

            }
        });


            request.fail(function (jqXHR, textStatus, errorThrown){ 
              SHONiR_Close_Fnc();               
              alert("The following error occurred: "+
              textStatus, errorThrown);
          });

          request.always(function () {
            d("#SHONiR_Login_Frm :input").attr("disabled", false);
            
        });      

  }
  

