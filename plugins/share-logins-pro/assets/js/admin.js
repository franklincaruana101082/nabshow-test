jQuery(function($){
	$("#export-users").submit(function(e){
		e.preventDefault()
		$('.cx-submit').attr('disabled',true)
		$('#cx-message').text('').hide()
		var $form = $(this)
		var $data = $form.serialize()
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: $data,
			dataType: 'JSON',
			success: function(ret) {
				$('.cx-submit').attr('disabled',false)
				if(ret.status==0) {
					$('#cx-message').removeClass('cx-alert-success').addClass('cx-alert-danger')
				} else {
					$('#cx-message').removeClass('cx-alert-success').addClass('cx-alert-success')
				}
				$('#cx-message').text(ret.message).show()

				if(ret.status==1){
					$('#download-file').remove()
					var a       = document.createElement('a');
					a.href      = ret.url;
					a.download  = ret.url.split(/[\/]+/).pop();
					a.innerHTML = 'Download';
					a.setAttribute('id', 'download-file');
					document.getElementById('export-users').appendChild(a);
					$('#download-file').hide()
					document.getElementById('download-file').click();
				}
			}
		})
	})
	$("#import-users").submit(function(e){
		e.preventDefault()
		$('#cx-message').text('').hide()
		$('.cx-submit').attr('disabled',true)
		var $form = $(this)
		var $data = new FormData($form[0]);
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: $data,
		    processData: false,
		    contentType: false,
			dataType: 'JSON',
			success: function(ret) {
				console.log(ret)
				$('.cx-submit').attr('disabled',false)
				if(ret.status==0) {
					$('#cx-message').removeClass('cx-alert-success').addClass('cx-alert-danger')
				} else {
					$('#cx-message').removeClass('cx-alert-danger').addClass('cx-alert-success')
				}
				$('#cx-message').text(ret.message).show()
			}
		})
	})
	$('#row-replace #replace').change(function(e){
		if($(this).is(':checked')) {
			$('#row-remove_role').show()
		} else {
			$('#row-remove_role').hide()
		}
	}).change()
})