(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	// ...
	// Submit product form
	// ...
	$("form#kinra_product_form").validate({
		submitHandler: function(form) {
			let urlParams = new URLSearchParams($(form).serialize());
			let unserializedData = {};

			for (let [key, value] of urlParams) {
				unserializedData[key] = value;
			}

			$.ajax({
				method: "POST",
				url: kinraVar.resturl + "wp/v2/kinra_product",
				beforeSend: function(xhr) {
					xhr.setRequestHeader('X-WP-Nonce', kinraVar.restnonce);
				},
				data: {
					title: unserializedData.title,
					content: unserializedData.content,
					featured_media: unserializedData.featured_media,
					status: 'pending',
					meta: {
						seller_name: unserializedData.seller_name,
						seller_phone_number: unserializedData.seller_phone_number,
						seller_email: unserializedData.seller_email,
					},
				},
				success: function(response) {
					window.location.href = response.guid.raw;
				},
			});

			return false;
		},
		onkeyup: false,
		errorElement: "span",
	});

	// ...
	// Submit vacancy form
	// ...
	$("form#kinra_vacancy_form").validate({
		submitHandler: function(form) {
			let urlParams = new URLSearchParams($(form).serialize());
			let unserializedData = {};

			for (let [key, value] of urlParams) {
				unserializedData[key] = value;
			}

			$.ajax({
				method: "POST",
				url: kinraVar.resturl + "wp/v2/kinra_vacancy",
				beforeSend: function(xhr) {
					xhr.setRequestHeader('X-WP-Nonce', kinraVar.restnonce);
				},
				data: {
					title: unserializedData.title,
					content: unserializedData.content,
					featured_media: unserializedData.featured_media,
					status: 'pending',
					meta: {
						employer_name: unserializedData.employer_name,
						employer_phone_number: unserializedData.employer_phone_number,
						employer_email: unserializedData.employer_email,
						company: unserializedData.company,
					},
				},
				success: function(response) {
					window.location.href = response.guid.raw;
				},
			});

			return false;
		},
		onkeyup: false,
		errorElement: "span",
	});

	// ...
	// Upload media
	// ...
	$(document).on('click', '.upload-image button#upload-image-button', function(e) {
		e.preventDefault();

		var container$ = $(this).closest('.upload-image');
		var fileInput$ = container$.find('input[type="file"]');

		// trigger select file
		fileInput$.trigger('click');
	});

	// file selected
	$(document).on('change', '.upload-image input[type="file"]', function(e) {
		var action = $(this).data('action');
		var formData = new FormData();
		formData.append('file', e.target.files[0]);

		$.ajax({
			method: "POST",
			url: kinraVar.resturl + "wp/v2/media",
			beforeSend: function(xhr) {
				xhr.setRequestHeader('X-WP-Nonce', kinraVar.restnonce);
			},
			processData: false,
			contentType: false,
			cache: false,
			data: formData,
			enctype: 'multipart/form-data',
			success: function(response) {
				if (action == 'featured') {
					$('#featured_media').val(response.id);
					var image = `<img src="${response.source_url}">`
					$('#featured_media-preview').html(image);
				}
			}
		});
	});
})( jQuery );
