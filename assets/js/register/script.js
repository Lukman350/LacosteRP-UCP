$(document).ready(function(){
    $("#form-register").submit(function(e){
        const btn = document.getElementById('submit');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        $.ajax({
            url: "scripts/register.php",
            type: "POST",
            data: $("#form-register").serialize(),
            dataType: "JSON",
            success: function(data) {
                if (parseInt(data.status) == 0) {
                    swal('Registration Failed', data.message, 'error').then(function(){
                        btn.disabled = false;
                        btn.innerHTML = 'Register';
                    });
                } else if (parseInt(data.status) == 1) {
                    btn.disabled = true;
                    swal('Registration Success', data.message, 'success').then(function(){
                        window.location.href = "./login";
                    });
                }
            }
        });
        e.preventDefault();
    });
});