jQuery( document ).ready(function() {
	jQuery( ".gmpqcw_inq" ).click(function( event ) {
		var product_enquiry_title = jQuery(this).attr("title");
		jQuery(".product_enquiry_title").html(product_enquiry_title);
		jQuery(".gmpqcw_product_vl").val(product_enquiry_title);
		jQuery(".gmpqcw_popup_op").bPopup({
            positionStyle : 'absolute',
           
        });
            
		//jQuery(".gmpqcw_popup_op").addClass("gmpqcw_active");
		return false;
	});
	jQuery( ".gmpqcw_inq_pp" ).click(function( event ) {
		jQuery(".gmpqcw_product_vl").val("gmpqcw_enquiry_cart");
		jQuery(".gmpqcw_popup_op").bPopup({
            positionStyle : 'absolute',
           
        });
		//jQuery(".gmpqcw_popup_op").addClass("gmpqcw_active");
		return false;
	});
	/*jQuery( ".gmpqcw_close" ).click(function( event ) {
		jQuery(".gmpqcw_popup_op").removeClass("gmpqcw_active");
		jQuery(".gmpqcw_popup_op").close();
		return false;
	});*/
	jQuery( ".gmpqcw_remove_op" ).click(function( event ) {
    	
    	var culms = jQuery(this);
    	jQuery.ajax({
				    type: "post",
				    //dataType: "json",
				    url: gmpqcw_ajax_object.ajax_url,
				    data: {'action':'gmpqcw_remove_cart','product_id':culms.attr('product_id')},
				    success: function(response){
				        culms.closest(".gmpqcw_cart_item").remove();
				        
				    }
				});
		return false;
    });

	jQuery( ".gmpqcw_inq_addtocart" ).click(function( event ) {
    	
    	var culms = jQuery(this);
    	culms.html('ADDING...');
    	jQuery.ajax({
				    type: "post",
				    dataType: "json",
				    url: gmpqcw_ajax_object.ajax_url,
				    data: {'action':'gmpqcw_add_tocart_enquiry','add_id':culms.attr('add_id')},
				    success: function(response){
				        culms.html('ADDED TO ENQUIRY CART');
				        culms.after(response.returnhtml);
				    }
				});
		return false;
    });
    jQuery( ".gmpqcw_popup_op_form" ).submit(function( event ) {
    	jQuery('body').addClass('gmpqcw_loader');
    	jQuery(".gmpqcwmsgc").remove();
    	var culms = jQuery(this);
    	jQuery.ajax({
				    type: "post",
				    dataType: "json",
				    url: gmpqcw_ajax_object.ajax_url,
				    data: jQuery(this).serialize(),
				    success: function(response){
				        if(response.msg=='error'){
				        	jQuery(".gmpqcw_popupcontant").append(response.returnhtml);
				        }else{
				        	culms[0].reset();
				        	jQuery(".gmpqcw_popupcontant").append(response.returnhtml);
				        }
				        if(response.redirect=='yes'){
				        	setTimeout(function(){ 
				        		window.location.replace(response.redirect_to);
				        	}, 1500);
				        }
				        jQuery('body').removeClass('gmpqcw_loader');
				        scrollSmoothToBottom('gmpqcw_popupcontant');
				    }
				});
		return false;
    });
    function scrollSmoothToBottom (id) {
	   var div = document.getElementById(id);
	   jQuery('#' + id).animate({
	      scrollTop: div.scrollHeight - div.clientHeight
	   }, 500);
	}
});