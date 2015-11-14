$(document).ready(function(){ 

// PRETTY PHOTO INIT
$("a[rel^='prettyPhoto']").prettyPhoto();						 

// AJAX CONTACT FORM INIT

 $('#contact').ajaxForm(function(data) {
		 if (data==1){
			 $('#success').fadeIn("slow");
			 $('#bademail').fadeOut("slow");
			 $('#badserver').fadeOut("slow");
			 $('#contact').resetForm();
			 }
		 else if (data==2){
				 $('#badserver').fadeIn("slow");
			  }
		 else if (data==3)
			{
			 $('#bademail').fadeIn("slow");
			}
			});

});