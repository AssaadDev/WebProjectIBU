class RestClient{

static  request(endpoint, method, body, success, error){


    $.ajax({
           url: endpoint,
           type: method,
           data: JSON.stringify(body),
         contentType: "application/json",
           beforeSend: function(xhr){
             if (localStorage.getItem("token")){

             xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
           }
           },
           success: function(data) {
             success(data);





            },

               error:function(jqXHR, textStatus, errorThrown){
                 if (error){

                   error(jqXHR, textStatus, errorThrown);
                 }
                 else{
                   toastr.error("Process failed");
                 }


               }
        });
      }

  static    post (endpoint, body, success, error){

        this.request(endpoint, "POST", body, success, error);
      }









static put(endpoint, body,success,error){

      this.request(endpoint,"PUT",body,success,error);


      }


static get(endpoint,success,error){

        this.request(endpoint,"GET", null, success, error);


        }


        static delete (endpoint,success,error){

          this.request(endpoint,"DELETE", null, success, error);


          }

    }
