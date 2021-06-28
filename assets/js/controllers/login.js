class Login {

static init(){
  if(window.localStorage.getItem("token")){

    window.location="index.html";
  }else{
    $('body').show();
  }

  var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('token')){
      $("#change-password-token").val(urlParams.get('token'));
      Login.show_Change_Password_Form();
    }

}


static show_Register_Form(){
    $("#login-form-container").addClass("hidden");
    $("#register-form-container").removeClass("hidden");
  }

  static show_Login_Form(){
      $("#login-form-container").removeClass("hidden");
      $("#register-form-container").addClass("hidden");
      $("#forgot-form-container").addClass("hidden");

    }


    static show_Forgot_Form(){
      $("#login-form-container").addClass("hidden");
      $("#forgot-form-container").removeClass("hidden");



    }

    static do_Forgot_Password(){

      var forgot_info={

        "Email":$("#forgot-email").val()
      };
      $("#forgot-link").prop('disabled',true);


      $.post("http://localhost/cv19assistant/api/forgot",forgot_info).done(function( data ){



        $("#forgot-form-container").addClass("hidden");

        $("#form-alert").removeClass("hidden");

        toastr.success("Recovery token has been sent to your email. Please check it. You will be redirected to the main page in 6 seconds");

        setTimeout(function(){
          window.location.replace("http://localhost/cv19assistant/login.html");
        }, 6000);
      }).fail(function(error){
        $("#forgot-link").prop('disabled',false);

        $("#forgot-form-container").addClass("hidden");

        $("#form-alert").removeClass("hidden");

        toastr.error("Recovery token has not been sent to your email due to a failure. Please check if your email is correct. You will be redirected to the main page in 6 seconds");
        setTimeout(function(){
   window.location.replace("http://localhost/cv19assistant/login.html");
}, 6000);

      });

    }




    static do_Register(){



                var register_info={
                  "Name":$("#register-name").val(),
                  "Email":$("#register-email").val(),
                  "DateOfBirth":$("#register-dateofbirth").val(),
                  "PhoneNumber":$("#register-phonenumber").val(),
                  "City":$("#register-city").val(),
                  "pass":$("#register-pw").val(),
        
                };
                $("#register-link").prop('disabled',true);



              $.post("api/register",register_info).done(function( data ){
                console.log(data);
                //$("#register-form-container").addClass("hidden");

                //$("#form-alert").removeClass("hidden")




                toastr.success("Registration successful, check your mail");


              }).fail(function( error ){
                $("#login-link").prop('disabled',false);
                toastr.error("Registration failed");

              });

    }



static do_Login(){



  var login_info={
    "Email":$("#email").val(),
    "password":$("#password").val()


  };
  $("#login-link").prop('disabled',true);



$.post("api/login",login_info).done(function( data ){

  window.localStorage.setItem("token",data.token)


  window.location="index.html";
}).fail(function( error ){
  $("#login-link").prop('disabled',false);
  toastr.error("Login failed");
});




}

static show_Change_Password_Form(){

  $("#change-password-form-container").removeClass("hidden");
  $("#login-form-container").addClass("hidden");
  $("#register-form-container").addClass("hidden");
  $("#forgot-form-container").addClass("hidden");

}




static do_Change_Password(){
    var change_info = {
      "token" : $("#change-password-token").val(),
      "password" : $("#change-password").val(),
    };

    $("#change-link").prop('disabled',true);
    $.post( "api/reset", change_info).done(function(data) {
      window.localStorage.setItem("token", data.token);
      window.location = "index.html";
    }).fail(function(error) {
      $("#change-link").prop('disabled',false);
      toastr.error("Password change failed");
    });

  }






}
function receiveVaccine(){
  var vaccine = $("#register-vaccine").val();
  return vaccine;
}

function receiveVaccinationPlace(){
  var place = $("#register-vaccination-place").val();
  return place;
}
