$(document).ready(function(){
    const btn = document.getElementById("submit");
    $("#form-login").submit(function(e){
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
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
                    btn.disabled = false;
                    btn.innerHTML = "Login";
                }
            }
        });
        e.preventDefault();
    });
});