$(document).ready(function(){
  $("#form-changepass").submit(function(e){
    $.ajax({
      url: "../scripts/settings.php",
      type: "POST",
      data: $("#form-changepass").serialize(),
      dataType: "JSON",
      success: (data) => {
        $("#btn-changepass").prop('disabled', true);
        if (parseInt(data.status) == 1) {
          swal('Change Password Successfully',data.message,'success').then(function(){
            window.location.reload();
            $("#btn-changepass").prop('disabled', false);
          });
        } else if (parseInt(data.status) == 0) {
          swal('Change Password Failed',data.message,'error').then(function(){
            $("#btn-changepass").prop('disabled', false);
          });
        }
      }
    });
    e.preventDefault();
  });
  $("#form-changeemail").submit(function(e){
    $.ajax({
      url: "../scripts/settings.php",
      type: "POST",
      data: $("#form-changeemail").serialize(),
      dataType: "JSON",
      success: (data) => {
        $("#btn-changeemail").prop('disabled', true);
        if (parseInt(data.status) == 1) {
          swal('Change Email Successfully',data.message,'success').then(function(){
            window.location.reload();
            $("#btn-changeemail").prop('disabled', false);
          });
        } else if (parseInt(data.status) == 0) {
          swal('Change Email Failed',data.message,'error').then(function(){
            $("#btn-changeemail").prop('disabled', false);
          });
        }
      }
    });
    e.preventDefault();
  });
});