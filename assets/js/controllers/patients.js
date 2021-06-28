class Patients{

static init(){
  $("#add-patient").validate({
  submitHandler: function(form,event) {


    event.preventDefault();
      var data = CSUtils.jsonize_form($(form));
    console.log(data);
     if (data.id){
       Patients.update(data);
     }else{
       Patients.add(data);
     }

  }
  });
  Patients.get_all();

}

static get_all(){
  $("#patients-table").DataTable({
    processing: true,
    serverSide: true,
    bDestroy: true,
  pagingType: "simple",

  responsive:false,

"language": {
         "zeroRecords": "Nothing found - sorry",
         "info": "Showing page _PAGE_ of many",
         "infoEmpty": "No records available",
         "infoFiltered": "(filtered from _MAX_ total records)"
     },


  "ajax":{
    url: "http://localhost/cv19assistant/api/doctors/patients?offset=0&limit=1000000000&order="+encodeURIComponent("+id"),
    type: "GET",
    beforeSend: function(xhr){
         xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
       },
       dataSrc: function(resp){
         console.log(resp);
         return resp;
       },


    data:function(d){

      d.offset=d.start;
      d.limit=d.length;
      d.search=d.search.value;
      d.order = encodeURIComponent((d.order[0].dir == 'asc' ? "-" : "+")+d.columns[d.order[0].column].data);

      delete d.start;
      delete d.length;
      delete d.columns;
      delete d.draw;

      console.log(d);
    }
  },

  preDrawCallback: function( settings ) {

  if (settings.aoData.length < settings._iDisplayLength){
     //disable pagination
     settings._iRecordsTotal=0;
     settings._iRecordsDisplay=0;
   }else{
     //enable pagination
     settings._iRecordsTotal=100000000;
     settings._iRecordsDisplay=1000000000;
   }
 },

  columns:[

  { "data": "id",
            "render": function ( data, type, row, meta ) {
              return '<div style="min-width:60px;"> <span class="badge">'+data+'</span><a class="pull-right" style="font-size: 15px; cursor: pointer;" onclick="Patients.pre_edit('+data+')"><i class="fa fa-edit"></i></a> </div>';
            }
          },
  {"data": "accounts_id"},
  {"data": "Name"},
  {"data": "DateOfBirth"},
  {"data": "PhoneNumber"},
  {"data": "Email"},
  {"data": "City"},
  {"data": "Address"},
  {"data": "Country"},
  {"data": "JMBG"},
  {"data": "MedicalInsuranceNO"},
  {"data": "NumberOfDoses"},
  {"data": "Vaccine"},
  {"data": "VaccinationPlace"},
  {"data": "VaccinationDate"},
  {"data": "Status"}

],
});

}


static add (patient){

  RestClient.post("http://localhost/cv19assistant/api/register", patient, function(data){

    toastr.success("Patient has been successfully added");
    this.get_all();
    $("#add-patient").trigger("reset");
    $("#add-patient-modal").modal("hide");


  });


}

static update(patient){
  RestClient.put("http://localhost/cv19assistant/api/doctors/patients/"+patient.id,patient, function(data){
    toastr.success("Patient info has been updated");

    Patients.get_all();

    $("#add-patient").trigger("reset");
    $("#add-patient *[name='id']").val("");
    $('#add-patient-modal').modal("hide");


});

}

static pre_edit(id){
  RestClient.get("http://localhost/cv19assistant/api/doctors/patients/"+id, function(data){
    CSUtils.json2form("#add-patient", data);
    $("#add-patient-modal").modal("show");
});


}


}
