$(document).ready(function(){
  // Modals
  $("#btn-req").click((e) => {
    $("#modal-req").modal({backdop: true});
    e.preventDefault();
  });

  $("#form-req").submit(function(e){
    $.ajax({
      url: "../scripts/donation.php",
      type: "POST",
      data: $("#form-req").serialize(),
      dataType: "JSON",
      success: (data) => {
        if (parseInt(data.status) == 0) {
          swal('Request Failed', data.message, 'error');
        } else if (parseInt(data.status) == 1) {
          swal('Request Successfully', data.message, 'success').then(function(){
            window.location.reload();
          });
        }
      }
    });
    e.preventDefault();
  });
});