<?php
# Path Fix
$path = '../';

# Title
$title = '&raquo; Filtering';

# Add the Class
require_once( '../class.formz.php' );

# Demo function
function filter( $data ) {
	echo $data['string'];
}

function filter_function( $str) {
	return str_replace(' 123', '', $str );
}

# Include Header
require_once('../include/header.php');

?>

<h2>Arguments</h2>

<dl class="clearfix">
	<dt>filter</dt>
	<dd>callback function</dd>
</dl>

<h2>Filtering</h2>

<?php
# Init
$form = new formz('id=first&callback=filter&success_message=');
$form->sendform = false;
$form->error_position = 'after';
# Fields
$form->input('name=string&value=Hello World 123!&label=Filter&filter=filter_function');
$form->button('label=Remove \'123\'&type=submit&name=send');
# Output
$form->render();
?>

<pre><code><?php highlight_string('<?php
function filter_function( $str) {
	return str_replace(\' 123\', \'\', $str );
}
	
$form->input(\'name=string&value=Hello World 123!&label=Filter&filter=filter_function\');
?>') ?></code></pre>



<?php
# Include footer
require_once('../include/footer.php');
?>
