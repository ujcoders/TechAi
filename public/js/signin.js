$(function(){
	// alert(siteurl);
	$("#signInBtn").click(function(){
		$.ajax({
			headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') //TODO: Find a better way to send CSRF token
            },
			type:"post",
			data:$("#signIn").serialize(),
			url: siteurl+"/signinaction",
			success:function(data){
				 $(".alert").remove();
                 if (data.status) {
                 	toastr['success']('Welcome !!!', 'Success!!!');
                    // window.location = data.redirect;
                    setTimeout(function() {
                    	window.location.href = data.redirect;
                	}, 2500);
                   
                }else{
                    $(".alert").remove();
                    $.each(data.errors, function (key, val) {
                        $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
                    });
                } 

			}
		})
	})
})