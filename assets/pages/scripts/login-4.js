var Login = function () {

	// Password RE
    $.validator.addMethod("pass_chker", function(value, element){
        return this.optional(element) || /^(?=.*[.~!@#\$%^&*+()_|\[\]-])(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9.~!@#\$%^&*+()_|\[\]-]{8,})$/.test(value);
    }, "Password has at least 8 characters including 1 number, 1 uppercase character, 1 lowercase character and 1 special character");

    // Email RE
    $.validator.addMethod("email_regex", function(value, element){
        return this.optional(element) || /^([\w-\.]+@([\w-]+\.)+[\w-]{2,3})?$/.test(value);
	}, "Please enter valid email id");

    /* Start cookie for complete url */
	function completeURL(url)
	{
	    try
	    {
	        var target= getCookie('new_invoice')+url;
	        target=replaceurl(target);
	        return replaceurl(target);      
	    }
	    catch(e)
	    {
	        alert(e);
	    }
	}

	function getCookie(key) 
	{  
	    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');  
	    return keyValue ? keyValue[2] : null;  
	} 

	function replaceurl(url)
	{
	    var url1=url.replace("%3A",":");
	    var url2=url1.replace(/%2F/g,"/");  
	    return url2;
	}
	/* End cookie for complete url */

	/* Start block UI loading */
    function divBlockUi()
    {
        App.blockUI({
            boxed: true,
            message: 'Loading...'
        });
    }

    function divUnblockUi()
    {
        App.unblockUI();
    }
    /* End block UI loading */

	var handleLogin = function() {
		$('.login-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                username: {
	                    required: true
	                },
	                password: {
	                    required: true
	                },
	                remember: {
	                    required: false
	                }
	            },

	            messages: {
	                username: {
	                    required: "Username is required."
	                },
	                password: {
	                    required: "Password is required."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-danger', $('.login-form')).show();
	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
					// get the hash 
   					var csrf_test_name = $("input[name=csrf_test_name]").val();
					var login = $('#username').val();           
					var pass = $('#password').val();			        
					var md5 = $().crypt({method:"md5",source:pass});
					
					if($('#remember_me').is(":checked")){
						var remember_me = 1;
					}
					else
					{
						var remember_me = 0;
					}
					
					if(login!='' && pass!='')
					{
						var submitBt = $('.login-form').find('button[type=submit]');
						submitBt.attr('disabled','disabled');              
						var target = $('.login-form').attr('action');			                      
						
						if (!target || target == '')
						{                        
							target = document.location.href.match(/^([^#]+)/)[1];
						}
									
						var data = {
							key: $('#keyValue').val(),
							username: login,
							password: md5, 
							csrf_test_name : csrf_test_name       
						};
						
						var sendTimer = new Date().getTime();			            
						try
						{  
							$.ajax({
								url: target,
								dataType: 'json',
								type: 'POST',
								data: data,
								success: function(data, textStatus, XMLHttpRequest)
								{
									if (data.valid)
									{
										var receiveTimer = new Date().getTime();			                                
										if (receiveTimer-sendTimer < 500)
										{
											setTimeout(function()
											{
												document.location.href = data.redirect;
											}, 500-(receiveTimer-sendTimer));
										}
										else
										{		                                
											document.location.href = data.redirect;
										}
									}
									else
									{
										// Message
										$('.alert-success', $('.login-form')).hide();
										$('.alert-wrong-user', $('.login-form')).show();                   
									}	  		                           
									submitBt.removeAttr('disabled');
								},
								error: function(XMLHttpRequest, textStatus, errorThrown)
								{
									// Message
									$('#').css('display','block').html('<div class="alert alert-error">Error while contacting server, please try again</div>').fadeOut(5000);                    
									//resetForm($this);
									submitBt.removeAttr("disabled");
								},
								complete: function(data)
								{                 
									setTimeout(function(){                   
										$('#password').val('');
										$('#username').val('');
									},2000);
								}  
							});
						}
						catch(e)
						{
							alert(e)
						}   
						
						//$('#adminMsg').css('display','block').html('<div class="alert alert-block">Please wait, checking login...</div>');                    
						$('.alert-wrong-user', $('.login-form')).hide(); 
						$('.alert-success', $('.login-form')).show();
					}
	            }
	        });

	        $('.login-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.login-form').validate().form()) {
	                    $('.login-form').submit();
	                }
	                return false;
	            }
	        });
	}

	var handleForgetPassword = function () {
		$('.forget-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "",
	            rules: {
	                email: {
	                    required: true,
	                    email: true
	                }
	            },

	            messages: {
	                email: {
	                    required: "Email is required."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   

	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                error.insertAfter(element.closest('.input-icon'));
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });

	        $('.forget-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.forget-form').validate().form()) {
	                    $('.forget-form').submit();
	                }
	                return false;
	            }
	        });

	        jQuery('#forget-password').click(function () {
	            jQuery('.login-form').hide();
	            jQuery('.forget-form').show();
	        });

	        jQuery('#back-btn').click(function () {
	            jQuery('.login-form').show();
	            jQuery('.forget-form').hide();
	        });

	}

	var handleRegister = function () {

		        function format(state) {
            if (!state.id) { return state.text; }
            var $state = $(
             '<span><img src="../assets/global/img/flags/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
            );
            
            return $state;
        }

        if (jQuery().select2 && $('#country_list').size() > 0) {
            $("#country_list").select2({
	            placeholder: '<i class="fa fa-map-marker"></i>&nbsp;Select a Country',
	            templateResult: format,
                templateSelection: format,
                width: 'auto', 
	            escapeMarkup: function(m) {
	                return m;
	            }
	        });


	        $('#country_list').change(function() {
	            $('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
	        });
    	}


         $('.register-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            ignore: "",
	            rules: {
	                
	                fullname: {
	                    required: true
	                },
	                email: {
	                    required: true,
	                    email: true
	                },
	                address: {
	                    required: true
	                },
	                city: {
	                    required: true
	                },
	                country: {
	                    required: true
	                },

	                username: {
	                    required: true
	                },
	                password: {
	                    required: true
	                },
	                rpassword: {
	                    equalTo: "#register_password"
	                },

	                tnc: {
	                    required: true
	                }
	            },

	            messages: { // custom messages for radio buttons and checkboxes
	                tnc: {
	                    required: "Please accept TNC first."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit   

	            },

	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.form-group').addClass('has-error'); // set error class to the control group
	            },

	            success: function (label) {
	                label.closest('.form-group').removeClass('has-error');
	                label.remove();
	            },

	            errorPlacement: function (error, element) {
	                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
	                    error.insertAfter($('#register_tnc_error'));
	                } else if (element.closest('.input-icon').size() === 1) {
	                    error.insertAfter(element.closest('.input-icon'));
	                } else {
	                	error.insertAfter(element);
	                }
	            },

	            submitHandler: function (form) {
	                form.submit();
	            }
	        });

			$('.register-form input').keypress(function (e) {
	            if (e.which == 13) {
	                if ($('.register-form').validate().form()) {
	                    $('.register-form').submit();
	                }
	                return false;
	            }
	        });

	        jQuery('#register-btn').click(function () {
	            jQuery('.login-form').hide();
	            jQuery('.register-form').show();
	        });

	        jQuery('#register-back-btn').click(function () {
	            jQuery('.login-form').show();
	            jQuery('.register-form').hide();
	        });
	}
    
    return {
        //main function to initiate the module
        init: function () {
        	
            handleLogin();
            handleForgetPassword();
            handleRegister();    

            // init background slide images
		    $.backstretch([
		        "assets/pages/media/bg/1.jpg",
		        "assets/pages/media/bg/2.jpg",
		        "assets/pages/media/bg/3.jpg",
		        "assets/pages/media/bg/4.jpg"
		        ], {
		          fade: 1000,
		          duration: 8000
		    	}
        	);
        }
    };

}();

jQuery(document).ready(function() {
    Login.init();
});