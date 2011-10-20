<?php
$path = '../';
$title = '&raquo; Sanitize';
# Add the Class
require_once( '../class.formz.php' );

function sanitize( $data ) {
	echo '<p><strong>Sanitized Value:</strong>' . $data['float'] . '</p>';
}
?>

<?php require_once('../include/header.php'); ?>


<h2>Arguments</h2>

<dl class="clearfix">
	<dt>sanitize</dt><dd>Santize filter name</dd>
	<dt>sanitize_flag</dt><dd>Santize filter flag name</dd>
</dl>

<h2>Sanitize</h2>

<?php
# Init
$form = new formz('id=second&callback=sanitize&success_message=');
$form->sendform = false;
$form->error_position = 'after';
# Fields
$form->input('name=float&label=Float:&value=Hello Word 123.345 Foo Bar&sanitize=FILTER_SANITIZE_NUMBER_FLOAT&sanitize_flag=FILTER_FLAG_ALLOW_FRACTION');
$form->button('label=Sanitize&type=submit&name=send');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->input(\'name=float&label=Float:&value=Hello Word 123.345 Foo Bar&sanitize=FILTER_SANITIZE_NUMBER_FLOAT&sanitize_flag=FILTER_FLAG_ALLOW_FRACTION\');
?>') ?></code></pre>

<?php require_once('../include/footer.php'); ?>
