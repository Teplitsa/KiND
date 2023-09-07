jQuery( document ).ready( function( $ ) {

	const { __, _x, _n, _nx } = wp.i18n;

	// allow remove content checkbox behaviour
	$('.kind-may-remove-my-content').prop('checked', false);
	$('.kind-may-remove-my-content').change(function(e){
		if($(this).prop('checked')) {
			if(!confirm(kindAdminUpdateTheme.lang_are_you_sure_may_remove_your_content)) {
				$(this).prop('checked', false);
			}
		}
	});

	// if(kindAdminUpdateTheme.update_action_nonce) {
	// 	kindDoUpdateThemeAction('kind_download_theme_update');
	// }

	function kindDoUpdateThemeAction(action) {
		
		var actionIndex = kindAdminUpdateTheme.theme_update_steps.indexOf(action);
		var nextAction = kindAdminUpdateTheme.theme_update_steps[actionIndex + 1];
		
		$.ajax({
			type: "POST",
			url: window.kindAdminUpdateTheme.ajax_url,
			data: {
				'action' : 'kind_download_theme_update',
				'kind-action': action,
				'kind-update-action-nonce': kindAdminUpdateTheme.update_action_nonce
			},
		})
		.done(function(json){
			
			if(json.status === 'ok') {
				$('.kind-updating-theme-steps p:last').append(kindGetUpdateResultIcon('ok', kindAdminUpdateTheme.lang_success));
			}
			else {
				if(json.message) {
					$('.kind-updating-theme-steps p:last').append(kindGetUpdateResultIcon('error', json.message));
				}
				else {
					$('.kind-updating-theme-steps p:last').append(kindGetUpdateResultIcon('error', kindAdminUpdateTheme.lang_failed));
				}
			}
			
			if(nextAction) {
				$('.kind-updating-theme-steps').append('<p>'+kindAdminUpdateTheme['lang_doing_' + nextAction]+'</p>');
				kindDoUpdateThemeAction(nextAction);
			}
			else {
				$('.kind-updating-theme-steps').append('<p class="kind-updated-successfully">'+kindAdminUpdateTheme['lang_doing_kind_update_complete']+'</p>');
				$('.kind-updating-theme-steps').append('<p><a href="'+kindAdminUpdateTheme.home_url+'">' + kindAdminUpdateTheme.lang_visit_site + '</a></p>');
			}
		})
		.fail(function(){
		})
		.always(function(){
		});
	}

	/**
	 * Disable kirki notice on click dismiss
	 */
	$('.kind-kirki-notice-dismiss').on('click', function(e){
		e.preventDefault();
		var $el = $( this ).parents('.kind-kirki-notice');
		$el.fadeTo( 100, 0, function() {
			$el.slideUp( 100, function() {
				$el.remove();
			});
		});

		var data = {
			action: 'kind_dismiss_notice',
			nonce: _kind.nonce,
		};

		$.post( _kind.ajaxurl, data, function( response ) {
			// do nothing.
		});

	});

	$( document ).on( 'wp-theme-update-success', function( event, response ) {
		$('.kind-update-notice').fadeOut();
	} );

	/** Events */
	$(document).on('click', '.kind-event-remove-item', function(e){
		e.preventDefault();
		$(this).parents('.kind-event-admin-schedule-item').remove();
	});

	$(document).on('click','.kind-event-remove-group', function(e){
		e.preventDefault();
		$(this).parents('.kind-event-admin-schedule-group').remove();
	});

	$(document).on('click','.kind-event-add-time', function(e){
		e.preventDefault();

		var itemKey = 0;
		var itemId = 0;

		var scheduleGroup = $(this).parents('.kind-event-admin-schedule-group');

		var scheduleList = scheduleGroup.find( '.kind-event-admin-schedule-list' );

		var itemKey = scheduleGroup.prevAll().length;
		var itemId = scheduleList.find( '.kind-event-admin-schedule-item').length;

		var scheduleItemHtml = '<div class="kind-event-admin-schedule-item">' +
		'<div class="kind-event-admin-schedule-times">' +
		'<input type="text" name="_schedule[' + itemKey + '][list][' + itemId + '][hour_start]" class="em-time-input ui-em_timepicker-input" maxlength="8" size="8" value="0:00" autocomplete="off">' +
		'<input type="text" name="_schedule[' + itemKey + '][list][' + itemId + '][hour_end]" class="em-time-input ui-em_timepicker-input" maxlength="8" size="8" value="0:00" autocomplete="off">' +
		'<a href="#" class="button button-link button-link-delete button-small kind-event-remove-item">' + __( 'Remove time', 'kind' )  + '</a>' +
				'</div>' +
			'<textarea class="large-text" name="_schedule[' + itemKey + '][list][' + itemId + '][desc]" cols="2"></textarea>' +
		'</div>';

		scheduleList.append( scheduleItemHtml );
		em_setup_timepicker('body');

	});

	$(document).on('click','.kind-event-add-schedule', function(e){
		e.preventDefault();

		var itemKey = $('.kind-event-admin-schedule-group').length;

		var scheduleItemHtml = '<div class="kind-event-admin-schedule-group">' +
			'<div class="kind-event-admin-schedule-name"><input type="text" name="_schedule[' + itemKey + '][title]" value="" class="regular-text"><a href="#" class="button button-link button-link-delete kind-event-remove-group">' + __( 'Delete schedule', 'kind' ) + '</a></div>' +
				'<div class="kind-event-admin-schedule-list">' + 
				'</div>' +
				'<a href="#" class="button button-secondary kind-event-add-time">' + __( 'Add time', 'kind' )  + '</a>' +
			'</div>';

		$('.kind-event-admin-schedule').append( scheduleItemHtml );
	});

	$(document).on('click', '.kind-booking-fields-remove', function(e){
		e.preventDefault();
		$(this).parents('.dbem-kookings-fields-group').remove();
		var fieldsGroup = $('.dbem-kookings-fields .dbem-kookings-fields-group');
		fieldsGroup.each(function( index ) {
			$(this).find('.bookings-custom-field-order').val( index ).attr('name','dbem_bookings_custom_fields[' + index + '][order]');
			$(this).find('.bookings-custom-field-label').attr('name','dbem_bookings_custom_fields[' + index + '][label]');
			$(this).find('.bookings-custom-field-slug').attr('name','dbem_bookings_custom_fields[' + index + '][slug]');
		});
	});

	$(document).on('click','.kind-booking-add-field', function(e){
		e.preventDefault();

		var itemKey = $('.dbem-kookings-fields .dbem-kookings-fields-group').length;

		var fieldHtml = '<div class="dbem-kookings-fields-group">' +
			'<div class="drag-icons-group"><i class="dashicons dashicons-ellipsis"></i><i class="dashicons dashicons-ellipsis"></i></div>' +
			'<input name="dbem_bookings_custom_fields[' + itemKey + '][order]" class="bookings-custom-field-order" type="hidden" value="' + itemKey + '">' +
			'<input name="dbem_bookings_custom_fields[' + itemKey + '][label]" class="bookings-custom-field-label"  type="text" value="" placeholder="' + __( 'Label', 'kind' ) + '">' +
			'<input name="dbem_bookings_custom_fields[' + itemKey + '][slug]" class="bookings-custom-field-slug" type="text" value="" placeholder="' + __( 'slug', 'kind' ) + '">' +
			'<a href="#" class="button button-link button-link-delete kind-booking-fields-remove">' + __( 'Delete', 'kind' ) + '</a>' + 
		'</div>';

		$('.dbem-kookings-fields').append( fieldHtml );
	});

	/**
	 * Sortable
	 */
	 $('.dbem-kookings-fields').sortable({
		axis: 'y',
		cursor: 'move',
		placeholder: 'ui-state-highlight',
		update: function( event, ui ) {
			var bookingFields = $('.dbem-kookings-fields .dbem-kookings-fields-group');
			bookingFields.each(function( index ) {
				$(this).find('.bookings-custom-field-order').val( index ).attr('name','dbem_bookings_custom_fields[' + index + '][order]');
				$(this).find('.bookings-custom-field-label').attr('name','dbem_bookings_custom_fields[' + index + '][label]');
				$(this).find('.bookings-custom-field-slug').attr('name','dbem_bookings_custom_fields[' + index + '][slug]');
			});
		}
	});


	//dbem-kookings-fields-group


} );

function kindGetUpdateResultIcon(status, message) {
	var iconClass;
	if(status == 'error') {
		iconClass = 'dashicons-warning';
	}
	else {
		iconClass = 'dashicons-yes';
	}
		
	return '<span class="dashicons '+iconClass+'" title="'+message+'"></span>';
}
