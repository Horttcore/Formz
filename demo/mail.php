<?php
$path = '../';
$title = '&raquo; Mail';
require_once( '../class.formz.php' );
mysql_connect('localhost', 'root', 'root');
mysql_select_db( 'test' );
?>

<?php require_once('../include/header.php'); ?>

<h2>Mail</h2>
<?php
$form = new formz;
$form->from = 'My Website';
$form->from_email = 'noreply@example.com';
$form->to = 'test@example.com';
$form->subject = 'Look I got spam!!!';
$form->textarea('name=content&title=Content');
$form->button('label=Send&type=submit');
?>

<pre><code><?php highlight_string('<?php
$form = new formz;
$form->from = \'My Website\';
$form->from_email = \'noreply@example.com\';
$form->to = \'test@example.com\';
$form->subject = \'Look I got spam!!!\';
$form->textarea(\'name=content&title=Content\');
$form->button(\'label=Send&type=submit\');
?>') ?>
</code></pre>



<?php require_once('../include/footer.php') ?>