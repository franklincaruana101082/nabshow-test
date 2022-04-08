(function ($) {

	$(document).ready(function(){

		$(document).on('click', '.acf-field-migration-form #migrate-btn', function(){
			
			if ( 0 < $(this).parents('.acf-field-migration-form').find('#post_type')[0].selectedIndex ) {
				migrateAcfField( $(this).parents('.acf-field-migration-form').find('#post_type').val(), $(this) );
				$(this).prop('disabled', true);
				$(this).parents('.acf-field-migration-form').find('.migration-msg').text('The field migration process continues please wait a few seconds.');
			}

			return false;
		});
	});

	function migrateAcfField( post_type, _this ) {

		$.ajax({
			url: amplifyObj.ajax_url,
			type: 'GET',
			data: {
				action: 'nab_acf_field_migration',
				post_type: post_type
			},
			success: function ( response ) {

				if ( response.success ) {
					if ( response.data.remaining ) {
						migrateAcfField( post_type, _this );
					} else {
						_this.parents('.acf-field-migration-form').find('.migration-msg').text('The field migration process is completed for the ' + _this.parents('.acf-field-migration-form').find( '#post_type option:selected' ).text() + ' post type.');	
						_this.removeAttr('disabled');
					}
				} else {
					_this.parents('.acf-field-migration-form').find('.migration-msg').text('Something went wrong! Please try again.');
					_this.removeAttr('disabled');
				}
			}
		});
	}
})(jQuery);