<?php 
# Add the Class
$path = '../';
require_once( '../class.formz.php' );

function validate() {
	return true;
}

?>
<?php require_once('../include/header.php'); ?>

<h2>Arguments</h2>

<dl class="clearfix">
	<dt>name</dt>
	<dd>Field name</dd>
	<dt>error_message</dt>
	<dd>Error message that should be displayed when the field is empty</dd>
	<dt>regex</dt>
	<dd>Regex pattern with '/' delimiters</dd>
	<dt>regex_message</dt>
	<dd>Error message that should be displayed when the regex don't match</dd>
	<dt>callback</dt>
	<dd>A callback function to validate the field; must return true or false; passed argument is the field value</dd>
	<dt>callback_message</dt>
	<dd>Error message that should be displayed when the callback function returns false</dd>
	<dt>require</dt>
	<dd>Field names that has to be filled to pass validation: i.e. postal code and city name</dd>
</dl>

<h2>Required</h2>

<?php
# Init
$form = new formz('id=first&callback=validate&success_message=Test passed');
$form->sendform = false;
$form->error_position = 'after';
# Fields
$form->input('name=input&label=Input:');
$form->button('label=Validate&type=submit&name=send');
# Validation
$form->required('name=input&error_message=Please enter something');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->required(\'name=input&error_message=Please enter something\');
?>') ?></code></pre>


<h2>Regex</h2>
<?php
# Init
$form = new formz('id=second&callback=validate&success_message=Test passed');
$form->sendform = false;
$form->error_position = 'after';
# Fields
$form->input('name=alphanumeric&label=Alphanumeric:');
$form->button('label=Validate&type=submit&name=send');
# Validation
$form->required('name=alphanumeric&error_message=Alphanumeric values only&regex=/[a-z0-9]{10}+/i&regex_message=10 characters at least(only alphanumeric)');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->required(\'name=alphanumeric&error_message=Alphanumeric values only&regex=/[a-z0-9]{10}+/i&regex_message=10 characters at least(only alphanumeric)\');
?>') ?></code></pre>


<h2>Callback</h2>
<?php
# Init
$form = new formz('id=third&callback=validate&success_message=Test passed');
$form->sendform = false;
$form->error_position = 'after';
# Fields
$form->input('name=number&label=Number:');
$form->button('label=Validate&type=submit&name=send');
# Validation
$form->required('name=number&error_message=Please tell us your password&callback=is_numeric&callback_message=Only numeric characters');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->required(\'name=number&error_message=Please tell us your password&callback=is_numeric&callback_message=Only numeric characters\');
?>') ?></code></pre>


<h2>Custom Callback</h2>
<?php
function my_function( $val ) {
	return ( 'ABC' == $val ) ? true : false;
}
# Init
$form = new formz('id=forth&callback=validate&success_message=Test passed');
$form->sendform = false;
$form->error_position = 'after';
# Fields
$form->input('name=custom&label=Custom:');
$form->button('label=Validate&type=submit&name=send');
# Validation
$form->required('name=custom&error_message=Please put something in here&callback=my_function&callback_message=Only ABC will pass this');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->required(\'name=custom&error_message=Please put something in here&callback=my_function&callback_message=Only ABC will pass this\');
?>') ?></code></pre>


<hr />

<h2>Require other fields</h2>
<?php
# Init
$form = new formz('id=fourth&callback=validate&success_message=Test passed');
$form->sendform = false;
$form->error_position = 'after';
# Fields
$form->input('name=zip&label=Zip Code:');
$form->input('name=city&label=City:');
$form->button('label=Validate&type=submit&name=send');
# Validation
$form->required('name=zip&error_message=Please enter your zip code and city name&require=city');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->required(\'name=zip&error_message=Please enter your zip code and city name&require=city\');
?>') ?></code></pre>

<?php require_once('../include/footer.php'); ?>
