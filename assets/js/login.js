
$(document).ready(function() {
	
    /*
        Fullscreen background
    */
    $.backstretch("/assets/img/bg-koperasi.jpg");
    
    /*
        Form validation
    */
    $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    $('.login-form').on('submit', function(e) {
        e.preventDefault();
    	$("#btnsubmit").attr("disabled", true)
    	$(this).find('input[type="text"], input[type="password"], textarea').each(function(){
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
        });
        let username = $("#username").val();
        let password = $("#password").val();
        if (username != '' && password != '') {
            $.post("/login-auth", {
                username: username,
                password: password
            }, function(result) {
                console.log(result);
                Swal.fire(result)
                if (result.icon == 'success') {
                    setTimeout(function() {
                        window.location.replace("./")
                    }, 2000)
                }
            })
        } else {
            let params = {
                'type': 'error',
                'title': 'Login gagal',
                'text': 'Pastikan semua kolom sudah terisi'
            }
            Swal.fire(params)
        }
        $("#btnsubmit").attr('disabled', false)
    });
    
    
});
