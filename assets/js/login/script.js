$(document).ready(function(){
    $("#form-login").submit(function(e){
        $.ajax({
            url: "scripts/login.php",
            type: "POST",
            data: $("#form-login").serialize(),
            dataType: "JSON",
            success: (data) => {
                if (parseInt(data.status) == 1) {
                    swal('Login Successfully', data.message, 'success').then(function(){
                        window.location.href = "./dashboard/index";
                    });
                } else if (parseInt(data.status) == 0) {
                    swal('Login Failed', data.message, 'error');
                }
            }
        });
        e.preventDefault();
    });
});