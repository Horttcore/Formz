<?php
# Path Fix
$path = '../';

# Title
$title = '&raquo; Filtering';

# Add the Class
require_once( '../class.formz.php' );

# Demo function
function validate() {
	return true;
}

# Include Header
require_once('../include/header.php');

?>

<h2>Arguments</h2>

<dl class="clearfix">
	<dt>validate</dt>
	<dd>Validate name</dd>
	<dt>validate_flag</dt>
	<dd>Validate flag</dd>
	<dt>validate_message</dt>
	<dd>Error message if filter can't validate</dd>
</dl>

<h2>Filtering</h2>

<?php
# Init
$form = new formz('id=first&callback=validate&success_message=Test passed');
$form->sendform = false;
$form->error_position = 'after';
# Fields
$form->input('name=email&label=E-Mail:');
$form->button('label=Validate&type=submit&name=send');
# Validation
$form->required('name=email&error_message=Please enter something&validate=FILTER_VALIDATE_EMAIL&validate_message=Falsches Format');
# Output
$form->render();
?>

<pre><code><?php highlight_string('<?php
?>') ?></code></pre>



<?php
# Include footer
require_once('../include/footer.php');
?>
