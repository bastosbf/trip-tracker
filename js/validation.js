$(document).ready(
		function() {			
			jQuery.validator.addMethod("date", function(value, element) { 
				return value.match(/^\d\d\d\d?\-\d\d?\-\d\d$/);
			});
			jQuery.validator.addMethod("valueNotEquals", function(value, element, param) {
			    return $("#"+element.id+ " option:selected").val() != param; 
			});
			$('#login-form').validate(
					{
						errorPlacement : function(error, element) {
							$(element).closest('div').after(error);
						},
						rules : {
							login_email : {
								required : true,
								email : true,
							},
							login_password : {
								required : true,
							},
						},
						highlight : function(element) {
							$(element).closest('.form-group').removeClass(
									'has-success').addClass('has-error');
						},
						success : function(element) {
							$(element).closest('.form-group').removeClass(
									'has-error').addClass('has-success');
						},
						submitHandler : function(form) {
							$.ajax({
								type : "POST",
								url : "ajax/login-user.php",
								data : $(form).serialize(),
								success : function(data) {
									BootstrapDialog.show({
										type : BootstrapDialog.TYPE_SUCCESS,
										message : 'Successfully logged in!'
									});
									$("#login-modal").modal('hide');
									window.setTimeout(function() {
										location.reload()
									}, 1000)
								},
								error : function(data) {
									BootstrapDialog.show({
										type : BootstrapDialog.TYPE_DANGER,
										message : 'Wrong username or password!'
									});
								}
							});
						},
					});
			$('#register-form').validate(
					{
						errorPlacement : function(error, element) {
							$(element).closest('div').after(error);
						},
						rules : {
							register_name : {
								required : true,
							},
							register_email : {
								required : true,
								email : true
							},
							register_password : {
								required : true,
								minlength : 6,
								maxlength : 10,
							},
							register_repassword : {
								equalTo : "#register_password"
							}
						},						
						highlight : function(element) {
							$(element).closest('.form-group').removeClass(
									'has-success').addClass('has-error');
						},
						success : function(element) {
							$(element).closest('.form-group').removeClass(
									'has-error').addClass('has-success');
						},
						submitHandler : function(form) {
							$.ajax({
								type : "POST",
								url : "ajax/register-user.php",
								data : $(form).serialize(),
								success : function(data) {
									BootstrapDialog.show({
										type : BootstrapDialog.TYPE_SUCCESS,
										message : 'New user registered!'
									});
									$("#registerModal").modal('hide');
									window.setTimeout(function() {
										location.reload()
									}, 1000)
								},
								error : function(data) {
									BootstrapDialog.show({
										type : BootstrapDialog.TYPE_DANGER,
										message : 'User is already registered!'
									});
								}
							});
						},
					});
			$('#trip-form').validate(
					{
						errorPlacement : function(error, element) {
							$(element).closest('div').after(error);
						},
						rules : {
							trip_country : {
								required : true,
								valueNotEquals: "0",
							},
							trip_state : {
								required : true,
								valueNotEquals: "0",
							},
							trip_latitude : {
								required : true,
								number: true,
							},
							trip_longitude : {
								required : true,
								number: true,
							},
							trip_date : {
								required : true,
								date : true,
							},
							trip_photo : {
								required : true,
							},
						},	
						messages: {
							trip_country: "Please select a country",
							trip_state: "Please select a state",
							trip_photo: "Please select a photo with maximum size of 5Mb",
						},
						highlight : function(element) {
							$(element).closest('.form-group').removeClass(
									'has-success').addClass('has-error');
						},
						success : function(element) {
							$(element).closest('.form-group').removeClass(
									'has-error').addClass('has-success');
						},
						submitHandler : function(form) {
							$.ajax({
							   type : "POST",
							   url : "ajax/add-trip.php",
							   data: new FormData(form),
							   cache:false,
							   contentType: false,
							   processData: false,
							   success : function(data) {
							    BootstrapDialog.show({
							           type: BootstrapDialog.TYPE_SUCCESS,
							           message: 'Trip added!'
							       });
							       $("#addTripModal").modal('hide');
							       window.setTimeout(function(){location.reload()},1000)       
							   },
							   error : function(data) {    
							    BootstrapDialog.show({
							     type: BootstrapDialog.TYPE_DANGER,
							     message: 'There is already a trip added for this place!'
							       });    
							   }
							});
						},
					});
		});