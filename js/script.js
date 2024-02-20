jQuery(document).ready(function ($) {
	var form = $('#form');

	$('#form input, #form textarea').on('blur', function () {
			$('#form input, #form textarea').removeClass('error');
			$('.notification').remove();
			$('#form_submit').val('Submit');
	});

	var options = {
			url: ajax_form_object.url,
			data: {
					action: 'ajax_form_action',
					nonce: ajax_form_object.nonce
			},
			type: 'POST',
			dataType: 'json',
			beforeSubmit: function (xhr) {
					$('#form_submit').val('Sending...');
			},
			success: function (response) {
					if (response.success === true) {
							form.after('<div class="notification notification_accept">' + response.data + '</div>').slideDown();
							$('#form_submit').val('Submit');
							$('#form')[0].reset();
					} else {
							$.each(response.data, function (key, val) {
									$('.form_' + key).addClass('error');
									$('.form_' + key).after('<div class="notification notification_warning notification_warning_' + key + '">' + val + '</div>');
							});
							$('#form_submit').val('Something went wrong...');
					}
			},
			error: function () {
					$('#form_submit').val('Something went wrong...');
			}
	};

	form.submit(function () {
			$(this).ajaxSubmit(options);
			return false;
	});
});

