(function( $ ) {
 
    // Add Color Picker to all inputs that have 'color-field' class
    jQuery(function() {
        jQuery('.gmpqcw-color-field').wpColorPicker();
        jQuery('.gmpqcw-select').select2();
    });
     
    

})( jQuery );


 jQuery( document ).ready(function() {

 		jQuery(".sourfocheck").change(function(){
			if(jQuery(this).is(":checked")){
				jQuery("."+jQuery(this).attr("target")).show();
			}else{
				jQuery("."+jQuery(this).attr("target")).hide();
			}
			
		  return false;
		});	
		jQuery(".includexdfocheck").change(function(){
			if(jQuery(this).val()=="include"){
				jQuery(".gmpqcw_include_div").show();
				jQuery(".gmpqcw_exclude_div").hide();
			}else if(jQuery(this).val()=="exclude"){
				jQuery(".gmpqcw_include_div").hide();
				jQuery(".gmpqcw_exclude_div").show();
			}else{
				jQuery(".gmpqcw_include_div").hide();
				jQuery(".gmpqcw_exclude_div").hide();
			}
			
		//  return false;
		});

		
		jQuery(".addnew_customizer_form").click(function(){
			
			jQuery(".showpopmain").show();
		  return false;
		});	
		jQuery(".editfield_pop").click(function(){
			jQuery(".showpopmain").show();
		  return false;
		});	
		jQuery(".closeicond").click(function(){
			jQuery(".showpopmain").hide();
		  return false;
		});	
		jQuery(".field_type_gmpqcw").change(function(){
			
			var field_type_cfwjm = jQuery(this).val();
			if (field_type_cfwjm=='select' || field_type_cfwjm=='radio' || field_type_cfwjm=='multiselect' || field_type_cfwjm=='checkbox') {
				jQuery(".gmpqcw_option").show();
			}else{
				jQuery(".gmpqcw_option").hide();
			}
		  return false;
		});	

});
