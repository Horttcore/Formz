 jQuery(function(){

	var error_class = 'error';
	var error_tag = 'span';
	var has_error_class = 'has-error';
	var message_class = 'message';

	/**
	 *
	 * Validate all fields
	 *
	 */
	function formzValidate( elements ) {
		var error = false;
	
		elements.each(function(){
			obj = jQuery(this);
			if ( 'checkbox' == obj.attr('type') ) {
				if ( 0 == jQuery('input[name=' + obj.attr(name) + ']:checked').length ) {
					formzError(obj, obj.data('error-message'));
					error = true;
				}
			} else {
				// Check if empty
				if ( '' == obj.val() ) {
					formzError(obj, obj.data('error-message'));
					error = true;
				// Check regex
				} else if ( undefined != obj.data('regex') ) {
					// Build regex
					regex = obj.data('regex');
					first = regex.indexOf('/');
					last = regex.lastIndexOf('/');
					flags = regex.substr(last + 1, regex.length - last -1);
					regex = regex.substr(first + 1, last-first - 1);
					re = new RegExp(regex, flags);
					// Test regex
					if ( !re.test(obj.val()) ) {
						error = true;
						formzError(obj, obj.data('regex-message'));
					}
				}
			}
		});

		if ( true === error )
			return false;
		else
			return true;
	}



	/**
	 *
	 * Displays an error tooltip
	 *
	 */
	function formzError( element, message ) {
		element.parent().find('.' + message_class + '.' + error_class).remove(); // Remove previous error message {fixes a bug with checkboxes}
		if ( '' != message )
			element.parent().addClass(has_error_class).append('<' + error_tag + ' class="' + message_class + ' ' + error_class + '">' + message + '</' + error_tag + '>');
	}



	/**
	 *
	 * Blocks the submit button to validate on submit
	 *
	 */
	jQuery('form').each(function(){
		var obj = jQuery(this);
		obj.submit(function(){
			obj.find('.message.error').remove();
			if ( formzValidate( obj.find('[required]') ) ) {
				return true;
			} else {
				return false;
			}
		});
	});



	/**
	 *
	 * Remove error messages on click
	 *
	 */
	jQuery('.message.error').live('click', function(){
		obj = jQuery(this);
		obj.parent().removeClass(has_error_class);
		obj.remove();
	});

})