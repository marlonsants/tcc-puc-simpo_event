function FazerUploadDaLogo(){	
	$(document).on('change','#logoEvento',function(){
		
		var imagem = this.files[0];
		var formData = new FormData();
		formData.append('logoEvento',this.files[0],'file.jpg');

		var CSRF_TOKEN = $("input[type=hidden][name=_token]").val();
		
		$.ajax({
            /* the route pointing to the post function */
            url: '/Evento/uploadLogo',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': CSRF_TOKEN },
            /* send the csrf-token and the input to the controller */
            data: {formData},
            processData: false, 
			contentType: false,

			/* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                console.log("succsess");
                console.log(data);
				
				console.log(imagem);
				console.log("passou do submit");
            }
        }); 
		
		
	});
}