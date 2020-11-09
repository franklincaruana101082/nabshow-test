jQuery(document).ready(function(){
		jQuery("#tabs").tabs();

		
			var color = jQuery( "#tabs li:first-child" ).data('color');
			var BorderSize = jQuery( "#tabs li:first-child" ).data('border');
			
			jQuery( "#tabs li:first-child" ).attr('style', 'background: '+color+' !important');
			jQuery('.amplify-tabs').attr('style', 'border: '+BorderSize+'px solid '+color+' !important');
			jQuery('.ui-tabs-nav').attr('style', 'border-bottom: 1px solid '+color+' !important');
	
		jQuery('#tabs li').click(function(){

			var color = jQuery(this).data('color');
			var BorderSize = jQuery(this).data('border');

			if(jQuery(this).hasClass('ui-tabs-active')){
				jQuery('#tabs li').removeAttr('style')
				jQuery(this).attr('style', 'background: '+color+' !important');
				jQuery('.amplify-tabs').attr('style', 'border: '+BorderSize+'px solid '+color+' !important');
				jQuery('.ui-tabs-nav').attr('style', 'border-bottom: 1px solid '+color+' !important');
			}
			
		})
			
			
		
})