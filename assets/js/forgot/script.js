$(document).ready(function(){
    $("#btn-pass").on('click', function(e){
        $("#modal-pass").modal({backdrop: true});
        e.preventDefault();
    });
    $("#btn-username").on('click', function(e){
        $("#modal-username").modal({backdrop: true});
        e.preventDefault();
    });
    $("#btn-email").on('click', function(e){
        $("#modal-email").modal({backdrop: true});
        e.preventDefault();
    });

    $("#form-forgotpass").submit(function(e){
        const btnPass = document.getElementById('btnpass');
        btnPass.disabled = 'disabled';
        $.ajax({
            url: "scripts/forgot.php",
            type: "POST",
            data: $("#form-forgotpass").serialize(),
            dataType: "JSON",
            success: (data) => {
                if (parseInt(data.status) == 1) {
                    swal('Forgot Password', data.message, 'success').then(function(){
                        window.location.reload();
                    });
                } else if (parseInt(data.status) == 0) {
                    swal('Forgot Password', data.message, 'error');
                    btnPass.disabled = false;
                }
            }
        });
        e.preventDefault();
    });

    $("#form-forgotuser").submit(function(e){
        const btnUser = document.getElementById('btnuser');
        btnUser.disabled = 'disabled';
        $.ajax({
            url: "scripts/forgot.php",
            type: "POST",
            data: $("#form-forgotuser").serialize(),
            dataType: "JSON",
            success: (data) => {
                if (parseInt(data.status) == 1) {
                    swal('Forgot Username', data.message, 'success').then(function(){
                        window.location.reload();
                    });
                } else if (parseInt(data.status) == 0) {
                    swal('Forgot Username', data.message, 'error');
                    btnUser.disabled = false;
                }
            }
        });
        e.preventDefault();
    });

    $("#reset-password").submit(function(e){
        $.ajax({
            url: "scripts/forgot.php",
            type: "POST",
            data: $("#reset-password").serialize(),
            dataType: "JSON",
            success: (data) => {
                if (parseInt(data.status) == 1) {
                    swal('Reset Password', data.message, 'success').then(function(){
                        window.location.href = "./login";
                    });
                } else if (parseInt(data.status) == 0) {
                    swal('Reset Password', data.message, 'error');
                }
            }
        });
        e.preventDefault();
    });
});