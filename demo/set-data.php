<?php
$path = '../';
$title = '&raquo; Set Data';
# Add the Class
require_once( '../class.formz.php' );

function sanitize( $data ) {
	return true;
}
?>

<?php require_once('../include/header.php'); ?>

<h2>Set Data</h2>

<?php
# Init
$form = new formz('id=second&callback=sanitize&success_message=');
$form->sendform = false;
$form->error_position = 'after';
# Fields
$form->input('name=input&label=Input:');
$form->checkbox('name=checkbox&label=Checkbox:&value=one,two,three&checked=two,three');
$form->radio('name=radio&label=Radio:&value=one,two,three');
$form->select('name=select&label=Select:&value=one,two,three');
$form->textarea('name=textarea&label=Textarea:');
$form->button('label=Sanitize&type=submit&name=send');
# Set Data  (before $form->render() )
$form->set_data(array(
	'input' => 'This is an input Field',
	'checkbox' => array('two', 'three'),
	'radio' => 'three',
	'select' => 'two',
	'textarea' => 'Lorem Ipsum!'
));

# Output
$form->render();


?>
<pre><code><?php highlight_string('<?php
# Set Data  (before $form->render() )
$form->set_data(array(
	\'input\' => \'This is an input Field\',
	\'checkbox\' => array(\'two\', \'three\'),
	\'radio\' => \'three\',
	\'select\' => \'two\',
	\'textarea\' => \'Lorem Ipsum!\'
));
?>') ?></code></pre>

<?php require_once('../include/footer.php'); ?>
