<?php
/**
 * Formz another form Class
 *
 * @package Formz
 * @author Ralf Hortt
 */
class formz {



	/**
	 * Where should the form point to
	 *
	 * It' set to PHPSELF in the constuctor
	 *
	 * @access public
	 * @var string URL
	 **/
	public $action = null;



	/**
	 * Append ´autocomplete="off"´ as form attribute if is set to FALSE
	 * 
	 * @access public
	 * @var bool
	 **/
	public $autocomplete = TRUE;



	/**
	 * Plain text mail body
	 *
	 * @access protected
	 * @var string
	 **/
	protected $body = null;



	/**
	 * Name of a callback function if the form was succesfully send
	 *
	 * @access public
	 * @var string $callback Function name
	 **/
	public $callback = FALSE;



	/**
	 * Which field should handle if a copy mail should be send
	 *
	 * @access public
	 * @var string Form field name
	 **/
	public $copy;



	/**
	 * Error message if to copy field is checked but copy_to isn't filled out
	 *
	 * @access public
	 * @var string Form field name
	 **/
	public $copy_message;



	/**
	 * Which field should handle the copy email address
	 *
	 * @access public
	 * @var string Form field name
	 **/
	public $copy_to;



	/**
	 * Copy of $_POST/$_GET to check
	 *
	 * @access public
	 * @var array $data Data
	 **/
	public $data = FALSE;



	/**
	 * Debug all(TRUE), none(FALSE) or a specific field (str:name)
	 *
	 * @access protected
	 * @var string/bool $debug Debug mode
	 */
	protected $debug = FALSE;



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
	 * @access protected
	 * @var string
	 **/
	protected $enctype;



	/**
	 * The position of the error document
	 *
	 * @access public
	 * @var string before/after
	 **/
	public $error_position = 'after';



	/**
	 * Error message are using this tag
	 *
	 * @access public
	 * @var string
	 **/
	public $error_tag = 'span';



	/**
	 * Global filter callback
	 *
	 * @var mixed Callback function or Array with callback functions
	 **/
	public $filter;



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
	 * @access public
	 * @var string
	 **/
	public $from;



	/**
	 * From E-Mail mail header
	 *
	 * @access public
	 * @var string
	 **/
	public $from_email;



	/**
	 * Global error message
	 *
	 * @access public
	 * @var string
	 **/
	public $global_error_message = 'Sorry, something went wrong :-(';



	/**
	 * Mail header
	 *
	 * @access public
	 * @var string
	 **/
	public $header;



	/**
	 * If the form mail is html or plain text
	 *
	 * @access public
	 * @var bool
	 **/
	public $html = TRUE;



	/**
	 * html mail body
	 *
	 * @access protected
	 * @var bool
	 **/
	protected $html_body = null;



	/**
	 * Inject code in the html email template before the </body> tag
	 *
	 * @access public
	 * @var string
	 **/
	public $html_body_after = null;



	/**
	 * Inject code in the html email template after the <body> tag
	 *
	 * @access public
	 * @var string
	 **/
	public $html_body_before = null;


	
	/**
	 * Inject code in the html email template between the <head> tag
	 *
	 * @access public
	 * @var string
	 **/
	public $html_body_head = null;



	/**
	 * Form ID
	 *
	 * @access public
	 * @var string $id
	 **/
	public $id = 'formz';



	/**
	 * Should the form elements be enclosed by the label tag?
	 *
	 * @access public
	 * @var bool $label_enclose
	 **/
	public $label_enclose = FALSE;



	/**
	 * Form method
	 *
	 * @access public
	 * @var string $method 'post' or 'get'
	 **/
	public $method = 'post';



	/**
	 * If set to TRUE the form uses the novalidate attribute
	 *
	 * This value should stay on TRUE, due a bug with required in checkboxes
	 *
	 * @access public
	 * @var bool $novalidate
	 **/
	public $novalidate = TRUE;



	/**
	 * The html form output
	 *
	 * @access protected
	 * @var string $output
	 **/
	protected $output;



	/**
	 * Required symbole
	 *
	 * @access public
	 * @var string
	 **/
	public $require_symbol = '*';



	/**
	 * Sanitize Dictonary
	 *
	 * @access protected
	 * @var array
	 */
	protected $sanitize = array(
		'FILTER_SANITIZE_EMAIL' => 517,
		'FILTER_SANITIZE_ENCODED' => 514,
		'FILTER_SANITIZE_MAGIC_QUOTES' => 521,
		'FILTER_SANITIZE_NUMBER_FLOAT' => 520,
		'FILTER_SANITIZE_NUMBER_INT' => 519,
		'FILTER_SANITIZE_SPECIAL_CHARS' => 515,
		'FILTER_SANITIZE_FULL_SPECIAL_CHARS' => 515,
		'FILTER_SANITIZE_STRING' => 513,
		'FILTER_SANITIZE_STRIPPED' => 513,
		'FILTER_SANITIZE_URL' => 518,
		'FILTER_UNSAFE_RAW' => 516
	);



	/**
	 * Sanitize Flags Dictonary
	 *
	 * @access protected
	 * @var arra
	 **/
	protected $sanitize_flags = array(
		'FILTER_FLAG_ALLOW_FRACTION' => 4096,
		'FILTER_FLAG_ALLOW_THOUSAND' => 8192,
		'FILTER_FLAG_ALLOW_SCIENTIFIC' => 16384,
		'FILTER_FLAG_ENCODE_AMP' => 64,
		'FILTER_FLAG_ENCODE_HIGH' => 32,
		'FILTER_FLAG_ENCODE_LOW' => 16,
		'FILTER_FLAG_NO_ENCODE_QUOTES' => 128,
		'FILTER_FLAG_STRIP_HIGH' => 8,
		'FILTER_FLAG_STRIP_LOW' => 4
	);



	/**
	 * Should the form saved in a database?
	 *
	 * @access public
	 * @var string
	 **/
	var $save_form = FALSE;



	/**
	 * Primary key for $save_table
	 *
	 * @access public
	 * @var string
	 **/
	public $save_key;



	/**
	 * How to map data to table
	 *
	 * If is set to false, the script will try to map the fields by his own 
	 * Format array( 'table-row' => 'form-field-name' );
	 *
	 * @access public
	 * @var string
	 **/
	public $save_map = FALSE;



	/**
	 * Table name
	 *
	 * @access public
	 * @var string
	 **/
	public $save_table = FALSE;



	/**
	 * Should the form be send with php mail() after validation
	 *
	 * @access public
	 * @var bool
	 **/
	public $sendform = TRUE;



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
	public $subject;



	/**
	 * Success Message after send
	 *
	 * @var string $success_message
	 **/
	public $success_message = 'Thank you for your message!';



	/**
	 * E-Mail Address
	 *
	 * @var string
	 **/
	public $to = null;



	/**
	 * Filter Dictonary
	 *
	 * @access protected
	 * @var array
	 **/
	protected $validate_dictonary = array(
		'FILTER_VALIDATE_BOOLEAN' => 258,
		'FILTER_VALIDATE_EMAIL' => 274,
		'FILTER_VALIDATE_FLOAT' => 259,
		'FILTER_VALIDATE_INT' => 257,
		'FILTER_VALIDATE_IP' => 275,
		'FILTER_VALIDATE_REGEXP' => 272,
		'FILTER_VALIDATE_URL' => 273
	);



	/**
	 * Filter flags
	 *
	 * @access protected
	 * @var array
	 **/
	protected $validate_dictonary_flags = array(
		'FILTER_NULL_ON_FAILURE' => 134217728,
		'FILTER_FLAG_ALLOW_THOUSAND' => 8192,
		'FILTER_FLAG_ALLOW_OCTAL' => 1,
		'FILTER_FLAG_ALLOW_HEX' => 2,
		'FILTER_FLAG_IPV4' => 1048576,
		'FILTER_FLAG_IPV6' => 2097152,
		'FILTER_FLAG_NO_PRIV_RANGE' => 8388608,
		'FILTER_FLAG_NO_RES_RANGE' => 4194304,
		'FILTER_FLAG_PATH_REQUIRED' => 262144,
		'FILTER_FLAG_QUERY_REQUIRED' => 524288
	);



	/**
	 * Input and labels are wrapped in this tag
	 *
	 * @var string
	 **/
	public $wrap_tag = 'p';



	/**
	 * Constructor
	 *
	 * @param str $callback Callback funtion
	 * @author Ralf Hortt
	 **/
	function __construct( $args = '' ) {
		$this->action = $_SERVER['PHP_SELF'];
		$args = $this->_chop_string($args);

		if ( $args ) :

			foreach ( $args as $key => $val ) :

				if ( isset($this->$key) )
					$this->$key = $val;

			endforeach;

		endif;
	}



	/**
	 * Add Slashes
	 *
	 * @access protected
	 * @param string $value
	 * @return void
	 * @author Ralf Hortt
	 **/
	protected function _add_slashes( $value )
	{
		return str_replace( array(',', '=', '&'), array('\,', '\=', '\&'), $value );
	}



	/**
	 * Creates the string for all input attributes
	 *
	 * @access protected
	 * @param $e Form element
	 * @return string Attributes as HTML string
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
		
			$ignore = array( 'pattern', 'regex', 'replace' );

			$array = preg_split('/(?<!\\\)&/i',$string); // Cut at '&'

			if (is_array($array))

				foreach($array as $str) :

						$arg = preg_split('/(?<!\\\)=/i',$str); // Cut at '='

						if (preg_match('/(?<!\\\),/i',$arg[1])) :
						
							if ( !in_array($arg[0], $ignore) ) :
						
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
							
						endif;

						$return[$arg[0]] = $arg[1];

				endforeach; 

			return $return;

		else :
			return $string;
		endif;
	}



	/**
	 * Fieldset attributes
	 *
	 * @access protected
	 * @return string Attributes as HTML string
	 * @author Ralf Hortt
	 **/
	protected function _fieldset_attributes( $e, $custom = FALSE)
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
	 * @return array
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
	 * @return string Attributes as HTML string
	 * @author Ralf Hortt
	 **/
	protected function _input_attributes( $e, $custom = FALSE )
	{
		// Prefil the field if an error occured
		if ( $this->data[$e['name']] && 'checkbox' != $e['type'] && 'radio' != $e['type'] )
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
	 * MySQL Autosave function
	 *
	 * @return bool TRUE/FALSE
	 * @author Ralf Hortt
	 **/
	protected function _mysql_autosave()
	{
		// Create own map
		if ( FALSE === $this->save_map ) :
			$this->save_map = array();
			$res = mysql_query("SHOW COLUMNS FROM $this->save_table");
			while ($row = mysql_fetch_assoc($res)) :
				if ( FALSE === $this->save_key && 'PRI' == $row['Key'] )
					$this->save_key = $row['Field'];
				$this->save_map[$row['Field']] = $row['Field'];
			endwhile;
			$this->save_map = array_intersect_key( $this->save_map, $this->data );
		endif;
		
		// Merge
		foreach ( $this->save_map as $key => $value ) :
			$this->save_map[$key] = $this->data[$value];
		endforeach;
		
		// Build query
		if ( array_key_exists($this->save_key, $this->data) ) :
			$vars = '';
			foreach ( $this->save_map as $key => $value ) :
				$vars .= ', '.$key . '=\'' . $value . '\'';
			endforeach;
			$vars = substr( $vars, 2);
			$sql = "UPDATE $this->save_table SET $vars WHERE $this->save_key = '{$this->data[$this->save_key]}'";
		else :
			$sql = "INSERT INTO $this->save_table (" . implode( ',', array_keys($this->save_map) ) . ") VALUES ( '" . implode( '\',\'', $this->save_map ) . "')";
		endif;
		
		// Run query and return
		if ( mysql_query($sql) ) :
			return TRUE;
		else :
			echo mysql_error();
			return FALSE;
		endif;
	}



	/**
	 * Creates an attribute string
	 *
	 * @access protected
	 * @param array $element_attributes
	 * @param array $custom
	 * @return string Attributes as HTML string
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
				// Checkbox name is suffixed with []
				if ( 'checkbox' == $e['type'] && 'name' == $key ) :
					$attribute_string .= $key . '="' . $val . '[]" ';
				// Checked
				elseif ( 'checked' == $key && 'checked' != $val ) :
					null;
				// all other
				else :
					$attribute_string .= trim( $key ) . '="' . trim( $this->_remove_slashes( $val ) ) . '" ';
				endif;

			endforeach;

		endif;

		return $attribute_string;
	}



	/**
	 * Render the error element
	 *
	 * @access protected
	 * @return string
	 * @author Ralf Hortt
	 **/
	protected function _render_error( $message )
	{
		return '<' . $this->error_tag . ' class="message error">' . stripslashes( $message ) . '</' . $this->error_tag . '>';
	}



	/**
	 * Remove Slashes
	 *
	 * @param string $value 
	 * @return string
	 * @author Ralf Hortt
	 */
	protected function _remove_slashes( $value )
	{
		return str_replace( array('\,', '\=', '\&'), array(',', '=', '&'), $value );
	}


	/**
	 * Sanitize a string
	 *
	 * @access protected
	 * @param string $string String to convert
	 * @return string Converted string
	 * @author Ralf Hortt
	 **/
	 protected function _sanitize( $string )
	 {
	 	$string = strtolower(preg_replace("/[^a-zA-Z0-9_-]/", "", $string));
		return $string;
	 }



	/**
	 * Attributes for select
	 *
	 * @access protected
	 * @return string Attributes as HTML string
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
	 * @return string Attributes as HTML string
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
	 * @return string
	 * @author Ralf Hortt
	 **/
	protected function _wrap_after( array $e )
	{
		if ( ( !isset($e['wrap']) || isset($e['wrap']) && 'after' == $e['wrap'] ) && $e['type'] != 'hidden' ) :
			return '</' . $this->wrap_tag . '>';
		endif;
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
		if ( ( !isset($e['wrap']) || isset($e['wrap']) && 'before' == $e['wrap'] ) && $e['type'] != 'hidden' ) :
			$class = ( 'submit' == $e['type'] ) ? 'submit' : '';
			$class2 = ( isset($e['align']) && 'vertical' == $e['align'] ) ? 'vertical-options' : '';
			$class3 = ( isset($e['wrap_class']) ) ? $e['wrap_class'] : '';
			return '<' . $this->wrap_tag . ' class="element-wrap element-wrap-' . $this->_sanitize($e['name']) . ' '. $class .' ' . $class2 . ' ' . $class3 . '">';
		endif;
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
	 * @param string $args - defined by class
	 * @param string $arguments - defined by user
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function add_element( $args, $arguments = array() )
	{
		// Combine arguments
		if ( is_array( $arguments ) )
			$args = array_merge( $this->_chop_string( $args ), $arguments );
		else
			$args = $args . $arguments;
		
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

		// Checks if multiple has [] in name
		if ( isset($e['multiple']) && FALSE === strpos($e['name'], '[') )
			$e['name'] .= '[]';

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
		$this->add_element( 'type=button&', $args );
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
		$this->add_element( 'type=checkbox&', $args );
	}



	/**
	 * Validate a Field
	 *
	 * @access protected
	 * @param array $e Element to check
	 * @param bool $return_error_message Set to TRUE the return the error message
	 * @return bool/str Errormessage
	 * @author Ralf Hortt
	 **/
	protected function checkfield( $e, $return_error_message = FALSE )
	{
		$error = FALSE;

		if ( FALSE !== $this->data ) :

			// Sanitize Field
			if ( isset($e['sanitize']) ) :

				$this->data[$e['name']] = filter_var( $this->data[$e['name']], $this->sanitize[$e['sanitize']], $this->sanitize_flags[$e['sanitize_flag']] );

			endif;

			// Replace
			if ( isset($e['pattern']) && isset($e['replace']) ) :

				$this->data[$e['name']] = preg_replace( $e['pattern'], $e['replace'], $this->data[$e['name']] );

			endif;
			
			// Filter
			if ( isset($e['filter']) && is_callable($e['filter']) ) :

				$this->data[$e['name']] = call_user_func( $e['filter'], $this->data[$e['name']], $e['name'] );

			endif;
			
			// Global filter 
			if ( isset($this->filter) ) :

				if ( is_array($this->filter) ) :
					foreach ( $this->filter as $filter ) :
						if ( is_callable($filter) ) :
							$this->data[$e['name']] = call_user_func( $filter, $this->data[$e['name']], $e['name'] );
						endif;
					endforeach;
				else :
					if ( is_callable($this->filter) ) :
						$this->data[$e['name']] = call_user_func( $this->filter, $this->data[$e['name']], $e['name'] );
					endif;
				endif;

			endif;
			

			// Field is empty
			if ( isset($e['required']) && !$this->data[$e['name']] ) :

				if ( TRUE === $return_error_message )
					return $this->_render_error( $e['data-error-message'] );
				else 
					$error = TRUE;

			endif;

			// Callback is FALSE or not callable
			if ( isset($e['callback']) && '' != $e['callback'] && ( !is_callable($e['callback']) || !call_user_func($e['callback'], $this->data[$e['name']]) ) ) :

				if ( TRUE === $return_error_message )
					return $this->_render_error( $e['data-callback-message'] );
				else
					$error = TRUE;

			endif;

			// Dependency on other fields
			if ( isset($e['require']) ) :
				
				if ( is_array($e['require'])) :

					foreach ( $e['require'] as $require ) :

						if ( '' == $this->data[$require] ) :
							if ( TRUE === $return_error_message )
								return $this->_render_error( $e['data-error-message'] );
							else
								$error = TRUE;
						endif;

					endforeach;

				else :

					if ( !isset($this->data[$e['require']]) || '' == $this->data[$e['require']] ) :
					
						if ( TRUE === $return_error_message ) :
							return $this->_render_error( $e['data-error-message'] );
						else :
							$error = TRUE;
						endif;
						
					endif;

				endif;

			endif;

			// Regex Validation
			if ( isset($e['regex']) && 0 == preg_match($e['regex'], $this->data[$e['name']]) ) :

				if ( TRUE === $return_error_message ) :
					return $this->_render_error( $e['data-regex-message'] );
				else :
					$error = TRUE;
				endif;

			endif;
			
			// PHP Validation
			if ( isset($e['validate']) ) :

				if ( is_array($e['validate'])) :

					foreach ( $e['validate'] as $filter ) :
						
						if ( FALSE === filter_var($this->data[$e['name']], $this->validate_dictonary[$e['validate']], $this->validate_dictonary_flags[$e['validate_flag']]) ) :
							if ( TRUE === $return_error_message ) :
								return $this->_render_error( $e['data-validate-message'] );
							else :
								$error = TRUE;
							endif;
						endif;
					
					endforeach;

				else :
					$this->filter[$filter];
					if ( FALSE === filter_var($this->data[$e['name']], $this->validate_dictonary[$e['validate']], $this->validate_flag[$e['validate_flag']]) ) :
						if ( TRUE === $return_error_message ) :
							return $this->_render_error( $e['data-validate-message'] );
						else :
							$error = TRUE;
						endif;
					endif;
				
				endif;
				
			endif;

			if ( TRUE === $error )
				return FALSE;

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
		// Get submitted form data
		if ( 'post' == $this->method && isset($_POST['formz-' . $this->id ]) ) :
			$this->data = $_POST;
		elseif ( 'get' == $this->method && isset($_GET['formz-' . $this->id ]) ) :
			$this->data = $_GET;
		endif;
		
		// Copy to validation
		if ( $this->copy && $this->copy_to && isset($this->data['copy']) ) :
			$this->required('name=' . $this->copy_to . '&error_message=' .  $this->copy_message);
		endif;
		
		// Check the form
		if ( $this->form ) :

			foreach ( $this->form as $element ) :

				if ( FALSE === $this->checkfield( $element) ) :
					return FALSE;
				endif;

			endforeach;

			if ( !empty($this->data) )
				return TRUE;
			else
				return FALSE;

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
		$this->add_element( 'type=color&', $args );
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
		$this->add_element( 'type=date&', $args );
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
		$this->add_element( 'type=datetime&', $args );
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
		$this->add_element( 'type=datetime-local&', $args );
	}



	/**
	 * Debug
	 *
	 * @access public
	 * @param bool/str Boolean value for complete Debug; String to debug a special field
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function debug( $debug = TRUE )
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
		$this->add_element( 'type=email&', $args );
	}



	/**
	 * Fieldset closeing tag
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function fieldset_close()
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
	public function fieldset_open( $args = '' )
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

		$this->add_element( 'type=file&', $args );
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
		$this->add_element( 'type=text&', $args );
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
		$this->add_element( 'type=label&', $args );
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
		$this->add_element( 'type=image&', $args );
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
		$this->add_element( 'type=hidden&', $args );
	}



	/**
	 * HTML
	 *
	 * @access public
	 * @param string $args 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function html( $text, $mailtext = TRUE ) {
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
		$this->add_element( 'type=month&' , $args );
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
		$this->add_element( 'type=number&', $args );
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
		$this->add_element( 'type=password&', $args );
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
		$this->add_element( 'type=radio&' , $args );
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
		$this->add_element( 'type=range&' , $args );
	}



	/**
	 * Render the form
	 *
	 * @access public
	 * @param string $return 
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function render( $return = FALSE ) {

		if ( $this->checkform() ) :

			if ( $this->sendform ) :
				if ( $this->sendform() ) :
					if ( is_callable( $this->callback ) )
						call_user_func( $this->callback, $this->data );
					$output = '<div id="' . $this->id . '"><p class="message success">' . $this->success_message . '</p></div>';
				else :
					$output = '<div id="' . $this->id . '"><p class="message error">' . $this->global_error_message . '</p></div>';
				endif;
			elseif ( $this->save_form && $this->save_table ) :
				if ( $this->_mysql_autosave() ) :
					if ( is_callable( $this->callback ) )
						call_user_func( $this->callback, $this->data );
					$output = '<div id="' . $this->id . '"><p class="message success">' . $this->success_message . '</p></div>';
				else :
					$output = '<div id="' . $this->id . '"><p class="message error">' . $this->global_error_message . '</p></div>';
				endif;
			else :
				if ( is_callable( $this->callback ) ) :
					 call_user_func($this->callback, $this->data);
					$output = '<div id="' . $this->id . '"><p class="message success">' . $this->success_message . '</p></div>';
				else :
					$output = '<div id="' . $this->id . '"><p class="message error">' . $this->global_error_message . '</p></div>';
				endif;
			endif;

		else :
			/* Print debug */
			if ( TRUE === $this->debug ) : $output = '<pre>' . print_r($this->form, TRUE) . '</pre>'; endif;

			if ( $this->form ) :

				$output = $this->render_formhead() . "\n";

				foreach( $this->form as $e ) :

					// Debug a specific field
					if ( $e['name'] == $this->debug )
						$output .= '<pre>' . print_r($e, TRUE) . '</pre>';

					// Wrap before
					if ( 'html' != $e['type'])
						$output .= $this->_wrap_before( $e ) . "\n";

					// Shows the error message if needed
					if ( ( 'before' == $this->error_position && !isset( $e['error_position'] ) ) || 'before' == $e['error_position'] )
						$output .= $this->checkfield( $e, TRUE ) . "\n";

					// Render the Element
					switch( $e['type'] ) :
						// Input
						case 'hidden' : case 'text' : case 'search' : case 'tel' : case 'url' : case 'email' : case 'password' : case 'time' :
						case 'date' : case 'month' : case 'week' : case 'datetime-local' : case 'range' : case 'color' : case 'password' : case 'datetime' : case 'number' :
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
					if ( ( 'after' == $this->error_position && !isset($e['error_position'] ) ) || 'after' == $e['error_position'] )
						$output .= $this->checkfield( $e, TRUE ) . "\n";


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
		$autocomplete = ( FALSE === $this->autocomplete ) ? 'off' : 'on';

		return '<form ' . $novalidate . ' method="' . $this->method . '" action="' . $this->action . '" id="' . $this->id . '" ' . $enctype . ' autocomplete="' . $autocomplete . '">';
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

		if ( isset($e['label']) && FALSE === $this->label_enclose  )
			$output .= '</label>';

		// Input Element
		$output .= '<input ' . $this->_input_attributes( $e ) . ' />';

		// Label enclose
		if ( isset($e['label']) && TRUE === $this->label_enclose )
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
					$checked = 'checked="checked"';
				elseif ( isset( $e['checked']) && ( $val == $e['checked'] || ( is_array($e['checked']) && in_array($val, $e['checked']) ) ) ) : # Prefilled
					$checked = 'checked="checked"';
				elseif ( 'radio' == $e['type'] && !isset( $this->data['name'] ) && 0 == $i && !isset($e['checked']) ) : # in $_POST/$_GET
					$checked = 'checked="checked"';
				else :	
					unset($checked);
				endif;

				# Reset input value from $ to label
				if ( '$' == $val )
					$args['value'] = $label;

				// Label enclose
				if ( $this->label_enclose )
					$output .= '<label class="options-label" for="' . $e['name'] . '-' . $this->_sanitize($label) . '">';

				$output .= '<input ' . $this->_input_attributes( $e, $args ) . ' ' . $checked . ' /> ';

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

		if ( isset($e['label']) && FALSE === $this->label_enclose  )
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

				$selected = ( isset($e['selected']) && ( $val == $e['selected'] || ( is_array($e['selected']) && in_array($val, $e['selected']) ) ) && !isset($this->data[$e['name']]) ) ? 'selected=selected' : '';
				$selected = ( $val == $this->data[$e['name']] || ( is_array($this->data[$e['name']]) && in_array($val, $this->data[$e['name']]) ) ) ? 'selected="selected"' : $selected;

				$output .= '<option value="' . $val . '" ' . $selected . '>' . $label . '</option>';

			endforeach;

			$output .= '</select>';

		endif;

		// Label enclose
		if ( isset($e['label']) && TRUE === $this->label_enclose )
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

		if ( isset($e['label']) && FALSE === $this->label_enclose  )
			$output .= '</label>';

		// Input Element
		$val = ( isset($e['value']) ) ? $e['value'] : '';
		$val = ( isset($this->data[$e['name']]) ) ? $this->data[$e['name']] : $val;
		$output .= '<textarea ' . $this->_textarea_attributes( $e, $args ) . '>' . $val . '</textarea>';

		// Label enclose
		if ( isset($e['label']) && TRUE === $this->label_enclose )
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
		$this->add_element( 'type=reset&' , $args );
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
		
		# Filter
		if ( isset($args['validate']) )
			$this->form[$args['name']]['validate'] = $args['validate'];
		
		# Filter flag
		if ( isset($args['validate_flag']) )
			$this->form[$args['name']]['validate_flag'] = $args['validate_flag'];
		
		# Filter error message
		if ( isset($args['validate_message']) )
			$this->form[$args['name']]['data-validate-message'] = $args['validate_message'];

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
		$this->add_element( 'type=search&' , $args );
	}



	/**
	 * Select
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function select( $args ) {
		$this->add_element( 'type=select&' , $args );
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

			return TRUE;
		else :
			return FALSE;
		endif;
	}



	/**
	 * Set Form Values
	 *
	 * @access public
	 * @param array $data Data array ( ´fieldname´ => ´value´ )
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function set_data( array $data )
	{
		foreach ( $data as $key => $value ) :
			switch ( $this->form[$key]['type'] ) :
				case 'checkbox' : case 'radio' :
					$this->form[$key]['checked'] = $value;
				break;
				case 'select' : 
					$this->form[$key]['selected'] = $value;
				break;
				default :
					$this->form[$key]['value'] = $value;
				break;
			endswitch;
		endforeach;
	}


	/**
	 * Submit
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function submit( $args ) {
		$this->add_element( 'type=submit&' , $args );
	}



	/**
	 * Tel
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function tel( $args ) {
		$this->add_element( 'type=tel&' , $args );
	}



	/**
	 * Textarea
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function textarea( $args ) {
		$this->add_element( 'type=textarea&' , $args );
	}



	/**
	 * Time
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function time( $args ) {
		$this->add_element( 'type=time&' , $args );
	}



	/**
	 * URL
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function url( $args ) {
		$this->add_element( 'type=url&' , $args );
	}



	/**
	 * Week
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 **/
	public function week( $args ) {
		$this->add_element( 'type=week&' , $args );
	}



}