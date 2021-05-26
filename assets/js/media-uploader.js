jQuery(document).ready(function ($) {
	var custom_uploader;
	var target_input;

	$('.upload_image_button').click(function (e) {//the button class
		//grab the ID of the input field prior to the button where we want the url value stored
		target_input = $(this).prev().attr('id');

		e.preventDefault();

		//If the uploader object has already been created, reopen the dialog
		if (custom_uploader) {
			custom_uploader.open();
			return;
		}

		//Extend the wp.media object
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image ' + target_input,
			button: {
				text: 'Choose Image ' + target_input
			},
			multiple: false
		});

		//When a file is selected, grab the URL and set it as the text field's value
		custom_uploader.on('select', function () {
			attachment = custom_uploader.state().get('selection').first().toJSON();

			//Added target_input variable to grab ID
			$('#' + target_input).val(attachment.url);
			$('.thumbnail-preview-' + target_input).css('background-image', 'url(' + attachment.url + ')');
			$('.thumbnail-preview-' + target_input).css('height', '250px');
			$('.save_img_' + target_input).remove();
		});

		//Open the uploader dialog
		custom_uploader.open();
	});
});
