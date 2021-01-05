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
        btnPass.disabled = true;
        btnPass.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
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
                    btnPass.innerHTML = 'Submit';
                }
            }
        });
        e.preventDefault();
    });

    $("#form-forgotuser").submit(function(e){
        const btnUser = document.getElementById('btnuser');
        btnUser.disabled = true;
        btnUser.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
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
                    btnUser.innerHTML = 'Submit';
                }
            }
        });
        e.preventDefault();
    });

    $("#reset-password").submit(function(e){
        const btnReset = document.getElementById('reset-pass');
        btnReset.disabled = true;
        btnReset.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
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
                    btnReset.disabled = false;
                    btnReset.innerHTML = 'Reset';
                }
            }
        });
        e.preventDefault();
    });
});
