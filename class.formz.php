<?php
/**
 * Formz another form Class
 *
 * @author Ralf Hortt
 */
class formz {



	/**
	 * Where should the form point to
	 *
	 * @var string URL
	 **/
	var $action = null;



	/**
	 * Plain text mail body
	 *
	 * @var string
	 **/
	protected $body;



	/**
	 * Name of a callback function if the form was succesfully send
	 *
	 * @var string $callback Function name
	 **/
	var $callback = false;



	/**
	 * Which field should handle if a copy mail should be send
	 *
	 * @var string
	 **/
	var $copy;



	/**
	 * Which field should handle the copy email address
	 *
	 * @var string
	 **/
	var $copy_to;



	/**
	 * Copy of $_POST/$_GET to check
	 *
	 * @var array $data Data
	 **/
	var $data = false;



	/**
	 * Debug all(true), none(false) or a specific field (str:name)
	 *
	 * @var string/bool $debug Debug mode
	 */
	protected $debug = false;



	/**
	 * Counting the added elements
	 *
	 * @access protected
	 * @var int $element_counter
	 **/
	protected $element_counter = 1;



	/**
	 * Form enctype
	 *
	 * @var string
	 **/
	# protected $enctype = 'text/plain';
	protected $enctype = null;



	/**
	 * The position of the error document
	 *
	 * @var string before/after
	 **/
	var $error_position = 'before';


	/**
	 * The form array
	 *
	 * @access protected
	 * @var array $form
	 **/
	protected $form = array();



	/**
	 * From mail header
	 *
	 * @var string
	 **/
	var $from;



	/**
	 * From E-Mail mail header
	 *
	 * @var string
	 **/
	var $from_email;



	/**
	 * Global error message for sending an email
	 *
	 * @var string
	 **/
	var $global_error_message = 'Sorry, something went wrong :-(';



	/**
	 * Mail header
	 *
	 * @var string
	 **/
	var $header;



	/**
	 * if the form mail is html or plain text
	 *
	 * @var bool
	 **/
	var $html = true;



	/**
	 * html mail body
	 *
	 * @var bool
	 **/
	var $html_body = null;



	/**
	 * Inject code in the html email template before the </body> tag
	 *
	 * @var string
	 **/
	var $html_body_after = null;



	/**
	 * Inject code in the html email template after the <body> tag
	 *
	 * @var string
	 **/
	var $html_body_before = null;


	
	/**
	 * Inject code in the html email template between the <head> tag
	 *
	 * @var string
	 **/
	var $html_body_head = null;



	/**
	 * Form ID
	 *
	 * @var string $id
	 **/
	var $id = 'formz';



	/**
	 * Should the form elements be enclosed by the label tag?
	 *
	 * @var bool $label_enclose
	 **/
	var $label_enclose = false;



	/**
	 * Form method
	 *
	 * @var string $method 'post' or 'get'
	 **/
	var $method = 'post';



	/**
	 * If set to true the form uses the novalidate attribute
	 *
	 * This value should stay on true, due a bug with required in checkboxes
	 *
	 * @var bool $novalidate
	 **/
	var $novalidate = true;



	/**
	 * The html form output
	 *
	 * @var string $output
	 **/
	protected $output;



	/**
	 * Required symbole
	 *
	 * @var string
	 **/
	var $require_symbol = '*';



	/**
	 * Should the form be send wie php mail() after validation
	 *
	 * @var bool
	 **/
	var $sendform = true;



	/**
	 * Status of the form
	 *
	 * @access protected
	 * @var string
	 **/
	protected $status = 'ok';



	/**
	 * E-Mail Subject
	 *
	 * @var string
	 **/
	var $subject;



	/**
	 * Callback information
	 *
	 * @var array
	 **/
	var $success = array();



	/**
	 * Success Message after send
	 *
	 * @var string $success_message
	 **/
	var $success_message = 'Vielen Dank für Ihre Mitteilung';



	/**
	 * E-Mail Address
	 *
	 * @var string
	 **/
	var $to = null;



	/**
	 * Constructor
	 *
	 * @access public
	 * @param str $callback Callback funtion
	 * @author Ralf Hortt
	 **/
	public function __construct( $args = '' ) {
		$this->action = $_SERVER['PHP_SELF'];

		$args = $this->_chop_string($args);

		if ( isset($args['header']) )
			$this->subject = $args['header'];

		if ( isset($args['to']) )
			$this->to = $args['to'];

		if ( isset($args['subject']) )
			$this->subject = $args['subject'];

		if ( isset($args['body']) )
			$this->subject = $args['body'];

		if ( isset($args['from']))
			$this->from = $args['from'];

		if ( isset($args['from_email']))
			$this->from_email = $args['from_email'];

		if ( isset($args['callback']))
			$this->callback = $args['callback'];

		if ( isset($args['copy']))
			$this->copy = $args['copy'];

		if ( isset($args['copy_to']))
			$this->copy_to = $args['copy_to'];
	}


	/**
	 * Creates the string for all input attributes
	 *
	 * @access protected
	 * @param $e Form element
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function _button_attributes( $e, $custom = array() )
	{
		$button_attributes = array(
			'disabled', 'name', 'type', 'value'
		);

		return $this->_render_attributes($e, $button_attributes, $custom);
	}



	/**
	 * Creates an array out of a string  with the format = , & :: these symbols can be escaped 
	 *
	 * @access public
	 * @param str $string String to convert
	 * @return array $return all 
	 * @author Ralf Hortt
	 **/
	public function _chop_string($string)
	{
		if ( !is_array($string) && !is_object($string)) :

			$array = preg_split('/(?<!\\\)&/i',$string); // Cut at '&'

			if (is_array($array))

				foreach($array as $str) :

						$arg = preg_split('/(?<!\\\)=/i',$str); // Cut at '='

						if (preg_match('/(?<!\\\),/i',$arg[1])) :
							$arg[1] = preg_split('/(?<!\\\),/i',$arg[1]); // Cut at ','

							if ( is_array($arg[1]) ) :
								foreach ( $arg[1] as $key => $val ) :
									if ( strpos($val, '::') ) : // Cut at '::'ß
										$v = explode('::', $val);
										$arg[1][$key] = array( 'key' => $v[0], 'value' => $v[1]);
									endif;
								endforeach;
							endif;
						endif;

						$return[$arg[0]] = $arg[1];

				endforeach; 

			return $return;

		else :
			return $string;
		endif;
	}



	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function _fieldset_attributes( $e, $custom = false)
	{
		$fieldset_attributes = array(
			'disabled', 'form', 'name'
		);

		return $this->_render_attributes($e, $fieldset_attributes, $custom);
	}


	/**
	 * Define global attributes
	 *
	 * @access protected
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function _global_attributes()
	{
		return array('accesskey', 'class', 'contenteditable', 'contextmenu', 'dir', 'draggable', 'dropzone', 'hidden', 'id', 'lang', 'spellcheck', 'style', 'tabindex', 'title');
	}



	/**
	 * Creates the string for all input attributes
	 *
	 * @access protected
	 * @param $e Form element
	 * @param array $custom
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function _input_attributes( $e, $custom = false )
	{
		// Prefil the field if an error occured
		if ( $this->data[$e['name']] )
			$custom['value'] = $this->data[$e['name']];
		elseif( isset($e['default']) ) 
			$custom['value'] = $e['default'];
		
		$input_attributes = array(
			'accept', 'alt', 'autocomplete', 'autofocus', 'checked', 'dirname', 'disabled', 'form', 'formaction', 'formenctype',
			'formmethod', 'formnovalidate', 'formtarget', 'height', 'list',  'max', 'maxlength', 'min', 'multiple', 'name',
			'pattern', 'placeholder', 'readonly', 'required', 'size', 'src', 'step', 'type', 'value','width'
		);

		return $this->_render_attributes($e, $input_attributes, $custom);
	}



	/**
	 * Creates an attribute string
	 *
	 * @access protected
	 * @param array $element_attributes
	 * @param array $custom
	 * @return void
	 * @author Ralf Hortt
	 ***/
	protected function _render_attributes( $e, $element_attributes, $custom = array() )
	{
		$global_attributes = $this->_global_attributes();

		$merged_attributes = array_merge ( $global_attributes, $element_attributes );
		sort($merged_attributes);

		# Add data- attributes
		foreach ( $e as $key => $value ) :
			
			if ( 'data-' == substr( $key, 0, 5) ) :
				$merged_attributes[] = $key;

			endif;

		endforeach;

		if ( isset( $merged_attributes ) && is_array( $merged_attributes ) ) :

			$attributes = array();

			foreach ( $merged_attributes as $attr ) :
				if ( isset($e[$attr]) )
					$attributes[$attr] = $e[$attr];
			endforeach;

			if ( isset($custom) && is_array($custom) )
				$attributes = array_merge( $attributes, $custom );

			$attribute_string = null;

			foreach ( $attributes as $key => $val ) :

				if ( 'checkbox' == $e['type'] && 'name' == $key )
					$attribute_string .= $key . '="' . $val . '[]" ';
				else 
					$attribute_string .= $key . '="' . $val . '" ';

			endforeach;

		endif;

		return $attribute_string;
	}



	/**
	 * Render the error element
	 *
	 * @access protected
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function _render_error( $message )
	{
		return '<span class="message error">' . stripslashes( $message ) . '</span>';
	}



	/**
	 * Sanitize a string
	 *
	 * @access protected
	 * @param str $string String to convert
	 * @author Ralf Hortt
	 **/
	 protected function _sanitize( $string )
	 {
	 	$string = strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $string));
		return $string;
	 }



	/**
	 * Attributes for select
	 *
	 * @access protected
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function _select_attributes( array $e, $custom = array() )
	{
		$select_attributes = array(
			'disabled', 'multiple', 'name', 'size'
		);

		return $this->_render_attributes($e, $select_attributes, $custom);
	}



	/**
	 * Creates the string for all textarea attributes
	 *
	 * @access protected
	 * @param $e Form element
	 * @param array $custom
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function _textarea_attributes( $e, $custom = array() )
	{
		$textarea_attributes = array(
			'rows', 'cols', 'placeholder', 'name', 'required'
		);

		return $this->_render_attributes($e, $textarea_attributes, $custom);
	}



	/**
	 * Wrap the Element
	 *
	 * @access protected
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function _wrap_after( array $e )
	{
		if ( !isset($e['wrap']) || isset($e['wrap']) && 'after' == $e['wrap'] )
			return '</p>';
	}



	/**
	 * Wrap the Element
	 *
	 * @access protected
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function _wrap_before( array $e )
	{
		$class = ( 'submit' == $e['type'] ) ? 'submit' : '';
		$class2 = ( isset($e['align']) && 'vertical' == $e['align'] ) ? 'vertical-options' : '';
		$class3 = ( isset($e['wrap_class']) ) ? $e['wrap_class'] : '';

		if ( !isset($e['wrap']) || isset($e['wrap']) && 'before' == $e['wrap'] )
			return '<p class="element-wrap element-wrap-' . $this->_sanitize($e['name']) . ' '. $class .' ' . $class2 . ' ' . $class3 . '">';
	}



	/**
	* Perform XSS clean to prevent cross site scripting
	*
	* @static
	* @access public
	* @param array $data
	* @return array $data
	*/
	public static function _xss_clean( array $data )
	{
		if ( is_array($data) ) :
			foreach($data as $key => $value) :
				$data[$key] = filter_var($value, FILTER_SANITIZE_STRING);
			endforeach;
		endif;
		return $data;
	}



	/**
	 * Button
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function add_element( $args )
	{
		// Build config array
		$e = $this->_chop_string( $args );

		// implode HTML text node
		if ( 'html' == $e['type'] && is_array($e['text']) ) 
			$e['text'] = implode(',', $e['text']);

		// Checks if name is present; sets name to '$element_counter' if it isn't present
		if ( !isset($e['name']) )
			$e['name'] = 'element-' . $this->element_counter++;

		// Checks if id is present; sets id to 'name' if it isn't present
		if ( !isset($e['id']) )
			$e['id'] = $e['name'];

		// Pushs the element into the form
		$this->form[$e['name']] = $e;
	}



	/**
	 * Button
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function button( $args )
	{
		$this->add_element( 'type=button&' . $args );
	}



	/**
	 * Checkbox
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function checkbox( $args )
	{
		$this->add_element( 'type=checkbox&' . $args );
	}



	/**
	 * Validate a Field
	 *
	 * @access protected
	 * @param array $e Element to check
	 * @param bool $return_error_message Set to true the return the error message
	 * @return bool/str Errormessage
	 * @author Ralf Hortt
	 **/
	protected function checkfield( $e, $return_error_message = false )
	{
		$error = false;

		if ( false !== $this->data ) :
			// Field is empty
			if ( isset($e['required']) && !$this->data[$e['name']] ) :

				if ( true === $return_error_message )
					return $this->_render_error( $e['data-error-message'] );
				else 
					$error = true;

			endif;

			// Callback is false or not callable
			if ( isset($e['callback']) && '' != $e['callback'] && ( !is_callable($e['callback']) || !call_user_func($e['callback'], $this->data[$e['name']]) ) ) :

				if ( true === $return_error_message )
					return $this->_render_error( $e['data-callback-message'] );
				else
					$error = true;

			endif;

			// Dependency on other fields
			if ( isset($e['require']) ) :

				if ( is_array($e['require'])) :

					foreach ( $e['require'] as $require ) :

						if ( '' == $this->data[$require] ) :
							if ( true === $return_error_message )
								return $this->_render_error( $e['data-error-message'] );
							else
								$error = true;
						endif;

					endforeach;

				else :

					if ( !isset($this->data[$e['require']]) ) :
						if ( true === $return_error_message )
							return $this->_render_error( $e['data-error-message'] );
						else
							$error = true;
					endif;

				endif;

			endif;

			if ( isset($e['regex']) && !preg_match($e['regex'], $this->data[$e['name']]) ) :

				if ( true === $return_error_message ) :
					return $this->_render_error( $e['data-regex-message'] );
				else :
					$error = true;
				endif;

			endif;

			if ( true === $error )
				return false;

		endif;
	}



	/**
	 * Validate the form
	 *
	 * @access protected
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function checkform()
	{
		if ( 'post' == $this->method && isset($_POST['formz-' . $this->id ]) ) :
			$this->data = $_POST;
		elseif ( 'get' == $this->method && isset($_GET['formz-' . $this->id ]) ) :
			$this->data = $_GET;
		endif;

		if ( $this->form ) :

			foreach ( $this->form as $element ) :

				if ( false === $this->checkfield( $element) ) :
					return false;
				endif;

			endforeach;

			if ( !empty($this->data) )
				return true;
			else
				return false;

		endif;
	}



	/**
	 * Color
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function color( $args )
	{
		$this->add_element( 'type=color&' . $args );
	}



	/**
	 * E-Mail
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function date( $args )
	{
		$this->add_element( 'type=date&' . $args );
	}



	/**
	 * Datetime
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function datetime( $args )
	{
		$this->add_element( 'type=datetime&' . $args );
	}



	/**
	 * Datetime
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function datetimelocal( $args )
	{
		$this->add_element( 'type=datetime-local&' . $args );
	}



	/**
	 * Debug
	 *
	 * @access public
	 * @param bool/str Boolean value for complete Debug; String to debug a special field
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function debug( $debug = true )
	{
		$this->debug = $debug;
	}



	/**
	 * E-Mail
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function email( $args )
	{
		$this->add_element( 'type=email&' . $args );
	}



	/**
	 * Fieldset closeing tag
	 *
	 * @return void
	 * @author 
	 **/
	function fieldset_close()
	{
		$this->html('</fieldset>');
	}



	/**
	 * Fieldset opening tag
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	function fieldset_open( $args = '' )
	{
		$e = $this->_chop_string( $args );
		$this->html( $this->render_fieldset($e) );
	}



	/**
	 * File
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function file( $args )
	{
		if ( 'multipart/form-data' != $this->enctype )
			$this->enctype = 'multipart/form-data';

		$this->add_element( 'type=file&' . $args );
	}



	/**
	 * Input
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function input( $args ) {
		$this->add_element( 'type=text&' . $args );
	}



	/**
	 * Label
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function label( $args ) {
		$this->add_element( 'type=label&' . $args );
	}



	/**
	 * Image
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function image( $args ) {
		$this->add_element( 'type=input&' . $args );
	}



	/**
	 * Input
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function hidden( $args ) {
		$this->add_element( 'type=hidden&' . $args );
	}



	/**
	 * HTML
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function html( $text, $mailtext = true ) {
		$text = str_replace( array('=', ',', '&', '::'), array('\=', '\,', '\&', '\::'), $text ); # Escape internal splitting characters
		$this->add_element( 'type=html&text=' . $text . '&mailtext=' . $mailtext );
	}




	/**
	 * Mail Template
	 *
	 * @param str $key Field key
	 * @param str $label Field label
	 * @param str/array $value Field value
	 * @return str
	 * @author Ralf Hortt
	 **/
	function mail_template( $key, $label, $value )
	{
		$output = '<dl id="' . $key . '">
					<dt>' . $label . '</dt>';
					if ( is_array($value) ) :
						foreach ( $value as $val ) :
							$output .= '<dd>' . $val . '</dd>';
						endforeach;
					else :
						$output .= '<dd>' . $value . '</dd>';
					endif;
					$output .= '
				</dl>';
		
		return $output;
	}


	/**
	 * Month
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function month( $args ) {
		$this->add_element( 'type=month&' . $args );
	}



	/**
	 * Number
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function number( $args ) {
		$this->add_element( 'type=number&' . $args );
	}



	/**
	 * Password
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function password( $args ) {
		$this->add_element( 'type=password&' . $args );
	}



	/**
	 * Radiobutton
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function radio( $args ) {
		$this->add_element( 'type=radio&' . $args );
	}



	/**
	 * Range
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function range( $args ) {
		$this->add_element( 'type=range&' . $args );
	}



	/**
	 * Render the form
	 *
	 * @access public
	 * @param string $return 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function render( $return = false ) {

		if ( $this->checkform() ) :

			if ( $this->sendform ) :
				if ( $this->sendform() ) :
					if ( is_callable( $this->callback ) ) call_user_func( $this->callback );
					$output = '<div id="' . $this->id . '"><p class="message success">' . $this->success_message . '</p></div>';
				else :
					$output = '<div id="' . $this->id . '"><p class="message error">' . $this->global_error_message . '</p></div>';
				endif;
			else :
				if ( is_callable( $this->callback ) ) :
					 call_user_func($this->callback);
					$output = '<div id="' . $this->id . '"><p class="message success">' . $this->success_message . '</p></div>';
				else :
					$output = '<div id="' . $this->id . '"><p class="message error">' . $this->global_error_message . '</p></div>';
				endif;
			endif;

		else :
			/* Print debug */
			if ( true === $this->debug ) : $output = '<pre>' . print_r($this->form, true) . '</pre>'; endif;

			if ( $this->form ) :

				$output = $this->render_formhead() . "\n";

				foreach( $this->form as $e ) :

					// Debug a specific field
					if ( $e['name'] == $this->debug )
						$output .= '<pre>' . print_r($e, true) . '</pre>';

					// Wrap before
					if ( 'html' != $e['type'])
						$output .= $this->_wrap_before( $e ) . "\n";

					// Shows the error message if needed
					if ( 'before' == $this->error_position )
						$output .= $this->checkfield( $e, true ) . "\n";

					// Render the Element
					switch( $e['type'] ) :
						// Input
						case 'hidden' : case 'text' : case 'search' : case 'tel' : case 'url ' : case 'email' : case 'password' :
						case 'date' : case 'month' : case 'week' : case 'datetime-local' : case 'range' : case 'color' : case 'password' : case 'datetime' :
						case 'file' : case 'image ' : $output .= $this->render_input( $e ) . "\n"; break;
						// Checkbox | Radiobutton
						case 'checkbox' : case 'radio' : $output .= $this->render_option( $e ) . "\n"; break;
						// Select
						case 'select' : $output .= $this->render_select( $e ) . "\n"; break;
						// Buttons
						case 'button' : case 'reset' : case 'submit' : case 'reset' : $output .= $this->render_button( $e ) . "\n"; break;
						// Textarea
						case 'textarea' : $output .= $this->render_textarea( $e ) . "\n"; break;
						// HTML
						case 'html' : $output .= $this->render_html($e) . "\n";
					endswitch;

					// Shows the error message if needed
					if ( 'after' == $this->error_position )
						$output .= $this->checkfield( $e, true ) . "\n";


					// Wrap after
					if ( 'html' != $e['type'])
						$output .= $this->_wrap_after( $e );

				endforeach;

				$output .= $this->render_formfooter();

			endif;

		endif;

		if ( $return )
			return $output;
		else
			echo $output;
	}



	/**
	 * Renders button
	 *
	 * @access protected
	 * @return str
	 * @author Ralf Hortt
	 **/
	protected function render_button( $e )
	{
		return '<button ' . $this->_button_attributes( $e ) . '>' . $e['label'] .'</button>';
	}



	/**
	 * Render Fieldset
	 *
	 * @access protected
	 * @return str
	 * @author Ralf Hortt
	 **/
	protected function render_fieldset( $e )
	{
		$output = '<fieldset ' . $this->_fieldset_attributes( $e ) . ' >';
		if ( isset($e['label']) )
			$output .= '<legend>' . $e['label'] . '</legend>';
		
		return $output;
	}



	/**
	 * Form header
	 *
	 * @access protected
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function render_formhead()
	{
		$novalidate = ( $this->novalidate ) ? 'novalidate="novalidate"' : '';
		$enctype = ( '' != $this->enctype ) ? 'enctype="' . $this->enctype . '"' : '';
		return '<form ' . $novalidate . ' method="' . $this->method . '" action="' . $this->action . '" id="' . $this->id . '" ' . $enctype . ' >';
	}



	/**
	 * Form footer
	 *
	 * @access protected
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function render_formfooter()
	{
		$output = '
			<input type="text" class="hidden" value="" name="honeypot" id="honeypot">
			<input type="hidden" value="' . time() . '" name="timestamp" id="timestamp">
			<input type="hidden" value="formz-' . $this->id . '" name="formz-' . $this->id . '" id="formz-' . $this->id . '">
		</form>
		';
		return $output;
	}



	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	protected function render_html( $e )
	{
		$e['text'] = str_replace( array('\=', '\&', '\,', '\::'), array('=', '&', ',', '::'), $e['text']); # Remove escapes
		return $e['text'];
	}


	/**
	 * Renders an input field
	 *
	 * @access protected
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function render_input( $e )
	{
		$output = '';

		// Label
		if ( isset($e['label']) )
			$output = '<label for="' . $e['id'] . '">' . stripslashes( $e['label'] ) . ' ';

		if ( isset($e['label']) && false === $this->label_enclose  )
			$output .= '</label>';

		// Input Element
		$output .= '<input ' . $this->_input_attributes( $e ) . ' />';

		// Label enclose
		if ( isset($e['label']) && true === $this->label_enclose )
			$output .= '</label>';

		return $output;
	}



	/**
	 * Renders a checkbox or radiobutton
	 *
	 * @access protected
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function render_option( $e )
	{
		$output = null;

		// Label
		if ( $e['label'] ) :
			$attr_for = ( is_array($e['value'][0]) ) ? $e['value'][0]['value'] : $e['value'][0];
			$output .= '<label class="option-group-label" for="' . $e['name'] . '-' . $this->_sanitize($attr_for) . '">' . stripslashes( $e['label'] ) . '</label>';
		endif;

		if ( $e['value'] ) :

			if ( !is_array($e['value']) ) :
				$e['value'] = array($e['value']);
			endif;

			$i = 0;

			foreach ( $e['value'] as $key => $label ) :

				if ( is_array($label) ) :
					$val = $label['key'];
				 	$label = $label['value'];
				else :
					$val = $label;
				endif;

				$args = array( 'id' => $e['name'] . '-' . $this->_sanitize($label), 'value' => $val );

				if ( isset($this->data[$e['name']]) && $val == $this->data[$e['name']] || ( isset($this->data[$e['name']]) &&  is_array($this->data[$e['name']]) && in_array($val, $this->data[$e['name']]) ) ) :
					$args['checked'] = 'checked';
				elseif ( 'radio' == $e['type'] && !isset( $this->data['name'] ) && 0 == $i && !isset($e['default']) ) :
					$args['checked'] = 'checked';
				elseif ( isset( $e['default']) && $val == $e['default'] ) :
					$args['checked'] = 'checked';
				endif;

				# Reset input value from $ to label
				if ( '$' == $val )
					$args['value'] = $label;

				// Label enclose
				if ( $this->label_enclose )
					$output .= '<label class="options-label" for="' . $e['name'] . '-' . $this->_sanitize($label) . '">';			

				$output .= '<input ' . $this->_input_attributes( $e, $args ) . ' /> ';

				if ( !$this->label_enclose )
					$output .= '<label class="options-label" for="' . $e['name'] . '-' . $this->_sanitize($label) . '">';

				$output .= stripslashes( $label ) . '</label>';

				// Checkbox value
				if ( '$' == $val ) :
					$output .= ' <input name="' . $this->_sanitize($label) . '-value" id="' . $this->_sanitize($label) . '-value" class="options-value" value="' . $this->data[$this->_sanitize($label) . '-value'] . '" type="text" />';
				endif;

				if ( isset($e['align']) && 'vertical' == $e['align'] ) 
					$output .= '<br />';
			
				$i++;

			endforeach;

		endif;

		return $output;
	}



	/**
	 * Renders a select box
	 *
	 * @access protected
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function render_select( $e )
	{
		// Label
		if ( isset($e['label']) )
			$output = '<label for="' . $e['id'] . '">' . stripslashes( $e['label'] ) . ' ';

		if ( isset($e['label']) && false === $this->label_enclose  )
			$output .= '</label>';

		if ( isset($e['value']) ) :

			$output .= '<select ' . $this->_select_attributes( $e ) . '>';

			if ( isset($e['default']) ) 
				$output .= '<option value="">' . $e['default'] . '</option>';

			// Options
			foreach ( $e['value'] as $label ) :

				if ( is_array($label) ) :
					$val = $label['key'];
				 	$label = $label['value'];
				else :
					$val = $label;
				endif;

				$selected = ( isset($e['selected']) && $val == $e['selected'] && !isset($this->data[$e['name']]) ) ? 'selected=selected' : '';
				$selected = ( $val == $this->data[$e['name']] || ( is_array($this->data[$e['name']]) && in_array($val, $this->data[$e['name']]) ) ) ? 'selected="selected"' : $selected;

				$output .= '<option value="' . $val . '" ' . $selected . '>' . $label . '</option>';

			endforeach;

			$output .= '</select>';

		endif;

		// Label enclose
		if ( isset($e['label']) && true === $this->label_enclose )
			$output .= '</label>';

		return $output;

	}



	/**
	 * Renders an textarea
	 *
	 * @access protected
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function render_textarea( $e )
	{
		// Prefil the field if an error occured
		$args = ( $this->data ) ? array('value' => $this->data[$e['name']]) : array();

		$output = '';

		// Label
		if ( isset($e['label']) )
			$output = '<label class="textarea-label" for="' . $e['id'] . '">' . stripslashes( $e['label'] ) . ' ';

		if ( isset($e['label']) && false === $this->label_enclose  )
			$output .= '</label>';

		// Input Element
		$val = ( isset($e['default']) ) ? $e['default'] : '';
		$val = ( isset($this->data[$e['name']]) ) ? $this->data[$e['name']] : $val;
		$output .= '<textarea ' . $this->_textarea_attributes( $e, $args ) . '>' . $val . '</textarea>';

		// Label enclose
		if ( isset($e['label']) && true === $this->label_enclose )
			$output .= '</label>';

		return $output;
	}



	/**
	 * Reset
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function reset( $args ) {
		$this->add_element( 'type=reset&' . $args );
	}



	/**
	 * Require
	 *
	 * @access public
	 * @param str/array $args Arguments: required are name, error_message, optional: require [other field names], callback, callback_message, regex, regex_message
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function required( $args ) {
		$args = $this->_chop_string( $args );

		# Field is required
		$this->form[$args['name']]['required'] = 'required';

		# Default error message for this field
		if ( isset($args['error_message']) )
			$this->form[$args['name']]['data-error-message'] = $args['error_message'];

		# Check the field with a callback
		if ( isset($args['callback']) )
			$this->form[$args['name']]['callback'] = $args['callback'];
		
		# Add regex validation
		if ( isset($args['regex']) ) :
			$this->form[$args['name']]['regex'] = $args['regex'];
			$this->form[$args['name']]['data-regex'] = $args['regex'];
		endif;

		# Regex error message
		if ( isset($args['regex_message']) )
			$this->form[$args['name']]['data-regex-message'] = $args['regex_message'];

		# Callback error message
		if ( isset($args['callback_message']) )
			$this->form[$args['name']]['data-callback-message'] = $args['callback_message'];

		# This field require different fields to be not empty
		if ( isset($args['require']) )
			$this->form[$args['name']]['require'] = $args['require'];

		# Add * to show that field is required
		if ( isset($this->form[$args['name']]['label']) ) 
			$this->form[$args['name']]['label'] .= $this->require_symbol;

		# Add * to the other fields that field depends on
		if ( isset($this->form[$args['name']]['require']) ) :
			if ( is_array($this->form[$args['name']]['require']) ) :
				foreach( $this->form[$args['name']]['require'] as $key ) :
					if ( isset($this->form[$key]['label']) ) 
						$this->form[$key]['label'] .= $this->require_symbol;
				endforeach;
			else :
				if ( isset($this->form[$args['require']]['label']) ) 
					$this->form[$args['require']]['label'] .= $this->require_symbol;
			endif;
		endif;
	}



	/**
	 * Search
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function search( $args ) {
		$this->add_element( 'type=search&' . $args );
	}



	/**
	 * Select
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function select( $args ) {
		$this->add_element( 'type=select&' . $args );
	}



	/**
	 * Send the form
	 *
	 * @access protected
	 * @return bool
	 * @author Ralf Hortt
	 **/
	protected function sendform()
	{
		$ignore = array( 'timestamp', 'formz', 'honeypot', $this->copy );

		// HTML E-Mail
		if ( isset($this->data) && $this->html ) :

			// Headers
			$headers = "From: " . $this->from . "<" . $this->from_email . ">\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=utf-8\r\n";
			$headers .= "Content-Transfer-Encoding: quoted-printable\r\n";

			$this->html_body = '<html>';
			$this->html_body .= '<head>';
			$this->html_body .= $this->html_body_head;
			$this->html_body .= '</head>';
			$this->html_body .= '<body>';
			$this->html_body .= $this->html_body_before;

			// Content
			foreach ( $this->data as $key => $value ) :

				if ( !in_array($key, $ignore) && '' != $value ) :

					$label = ( isset($this->form[$key]['label']) && '' != $this->form[$key]['label'] ) ? $this->form[$key]['label'] : $this->form[$key]['placeholder'];
					$label = ( '' != $label ) ? $label : $key;

					$this->html_body .= $this->mail_template( $key, $label, $value );

				endif;

			endforeach;

			$this->html_body .= $this->html_body_after;
			$this->html_body .= '</body>';
			$this->html_body .= '</html>';

		// Text E-Mail
		else :

			// Headers
			$headers = "From: " . $this->from . "<" . $this->from_email . ">\r\n";
			$headers .= "Mime-Version: 1.0\r\n";
			$headers .= "Content-type: text/plain; charset=utf-8\r\n";
			$headers .= "Content-Transfer-Encoding: quoted-printable\r\n";

			// Content
			foreach ( $this->data as $key => $value ) :

				$label = ( isset($this->form[$key]['label']) && '' != $this->form[$key]['label'] ) ? $this->form[$key]['label'] : $this->form[$key]['placeholder'];
				$label = ( '' != $label ) ? $label : $key;

				if ( is_array($value) ) :
					$this->body .= $label . ': '. implode(',', $value) . "\n";
				else :
					$this->body .= $label . ': '. $value. "\n";
				endif;

			endforeach;

		endif;

		// Inject Custom E-Mail Headers
		if ( $this->headers) :
			$headers .= $this->header;
		endif;

		$body = ( $this->html ) ? $this->html_body : $this->body;

		if ( mail( $this->to, $this->subject, $body, $headers ) ) :
			
			// Send Copy E-Mail
			if ( isset($this->data[$this->copy]) && isset($this->data[$this->copy_to]) ) :
				mail($this->data[$this->copy_to], '[KOPIE]' . $this->subject, $body, $headers);
			endif;

			return true;
		else :
			return false;
		endif;
	}



	/**
	 * Submit
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function submit( $args ) {
		$this->add_element( 'type=submit&' . $args );
	}



	/**
	 * Textarea
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function textarea( $args ) {
		$this->add_element( 'type=textarea&' . $args );
	}



	/**
	 * Time
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function time( $args ) {
		$this->add_element( 'type=time&' . $args );
	}



	/**
	 * URL
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function url( $args ) {
		$this->add_element( 'type=url&' . $args );
	}



	/**
	 * Week
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function week( $args ) {
		$this->add_element( 'type=week&' . $args );
	}



}