$(document).ready(function(){
  $(document).on('click', '#btn-accept', function(e) {
    const sender = $(this).data('id');
    action(1,sender);
    e.preventDefault();
  });
  $(document).on('click', '#btn-denied', function(e) {
    const id = $(this).data('id');
    action(0, id);
    e.preventDefault();
  });

  function action(type, id) {
    if (type == 0) {
      swal({
        title: 'Action Confirmation',
        text: "Kamu yakin ingin menolak request id "+id+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, tolak!',
        showLoaderOnConfirm: true,
          
        preConfirm: function() {
          return new Promise(function(resolve) {
               
             $.ajax({
              url: '../scripts/admin.php',
              type: 'POST',
              data: 'id='+id,
              dataType: 'json'
             })
             .done(function(data){
                 if (parseInt(data.status) == 1) {
                  document.getElementById('btn-denied').disabled = true;
                  swal('Action Successfully',data.message,'success').then(function(){
                    window.location.reload();
                    document.getElementById('btn-denied').disabled = false;
                  });
                 } else if (parseInt(data.status) == 0) {
                  document.getElementById('btn-denied').disabled = true;
                  swal('Action Failed',data.message,'error').then(function(){
                    document.getElementById('btn-denied').disabled = false;
                  });
                 }
             })
             .fail(function(){
               swal('Failed!', 'Request gagal ditolak!', 'error');
             });
          });
          },
        allowOutsideClick: false			  
      });
    } else if (type == 1) {
      swal({
        title: 'Action Confirmation',
        text: "Kamu yakin ingin menerima request id "+id+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, terima!',
        showLoaderOnConfirm: true,
          
        preConfirm: function() {
          return new Promise(function(resolve) {
               
             $.ajax({
              url: '../scripts/admin.php',
              type: 'POST',
              data: 'ids='+id,
              dataType: 'json'
             })
             .done(function(data){
                 if (parseInt(data.status) == 1) {
                  document.getElementById('btn-accept').disabled = true;
                  swal('Action Successfully',data.message,'success').then(function(){
                    window.location.reload();
                    document.getElementById('btn-accept').disabled = false;
                  });
                 } else if (parseInt(data.status) == 0) {
                  document.getElementById('btn-accept').disabled = true;
                  swal('Action Failed',data.message,'error').then(function(){
                    document.getElementById('btn-accept').disabled = false;
                  });
                 }
             })
             .fail(function(){
               swal('Failed!', 'Request gagal diterima!', 'error');
             });
          });
          },
        allowOutsideClick: false			  
      });
    }
  }
});