<?php
$path = '../';
$title = '&raquo; Replace';
# Add the Class
require_once( '../class.formz.php' );

function replace ( $data ) {
	echo '<p><strong>Replaced to:</strong> ' . $data['string'] . '</p>';
}

?>
<?php require_once('../include/header.php'); ?>

<h2>Arguments</h2>

<dl class="clearfix">
	<dt>pattern</dt><dd>Regex</dd>
	<dt>replace</dt><dd>Replacement</dd>
</dl>

<h2>Replace</h2>

<?php
# Init
$form = new formz('id=forth&callback=replace&success_message=');
$form->sendform = false;
$form->error_position = 'after';
# Fields
$form->input('name=string&label=String:&value=April 15\, 2003&pattern=/(\w+) (\d+), (\d+)/i&replace=${1}1,$3');
$form->button('label=Replace&type=submit&name=send');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->input(\'name=string&label=String:&value=April 15\, 2003&pattern=/(\w+) (\d+), (\d+)/i&replace=${1}1,$3\');
?>') ?></code></pre>

<?php require_once('../include/footer.php'); ?>
