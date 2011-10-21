<?php 
$path = '../';
$title = '&raquo; Input Types';
# Add the Class
require_once( '../class.formz.php' );

function validate() {
	return true;
}

?>
<?php require_once('../include/header.php'); ?>


<h2>Arguments</h2>

<dl class="clearfix">
	<dt>label</dt>
	<dd>Label text</dd>
	<dt>HTML attributes</dt>
	<dd>You can pass any valid HTML attriubte in the string, even data- attributes!</dd>
	<dt>wrap</dt>
	<dd>Possible values: both (default), before, after or none; Should the wrapping element included?</dd>
	<dt><small>note:</small></dt>
	<dd><small>If you use ',', '&amp;' or '=' in an attribute you have to escape them</small></dd>
</dl>

<h2>Input</h2>

<?php
# Init
$form = new formz();
$form->id = 'default';
$form->sendform = false;
$form->error_position = 'after';
# Fields
$form->input('name=input&label=Input:');
$form->html('<pre><code>' . highlight_string('<?php $form->input(\'name=user&label=User:\'); ?>',true) . '</code></pre>');

$form->password('name=password&label=Password:');
$form->html('<pre><code>' . highlight_string('<?php $form->password(\'name=password&label=Password:\'); ?>',true) . '</code></pre>');

$form->search('name=search&label=Search:');
$form->html('<pre><code>' . highlight_string('<?php $form->search(\'name=search&label=Search:\'); ?>',true) . '</code></pre>');

$form->url('name=url&label=URL:');
$form->html('<pre><code>' . highlight_string('<?php $form->url(\'name=url&label=URL:\'); ?>',true) . '</code></pre>');

$form->range('name=range&label=Range:&min=0&max=100&value=50&step=20');
$form->html('<pre><code>' . highlight_string('<?php $form->range(\'name=range&label=Range:&min=0&max=100&value=50&step=20\'); ?>',true) . '</code></pre>');

$form->number('name=number&label=Number:');
$form->html('<pre><code>' . highlight_string('<?php $form->number(\'name=number&label=Number:\'); ?>',true) . '</code></pre>');

$form->tel('name=tel&label=Tel:');
$form->html('<pre><code>' . highlight_string('<?php $form->tel(\'name=tel&label=Tel:\'); ?>',true) . '</code></pre>');

$form->date('label=Date:&name=date');
$form->html('<pre><code>' . highlight_string('<?php $form->date(\'label=Date:&name=date\'); ?>',true) . '</code></pre>');

$form->datetime('label=Datetime:&name=datetime');
$form->html('<pre><code>' . highlight_string('<?php $form->datetime(\'label=Datetime:&name=datetime\'); ?>',true) . '</code></pre>');

$form->datetimelocal('label=Datetimelocal:&name=datetimelocal');
$form->html('<pre><code>' . highlight_string('<?php $form->datetimelocal(\'label=Datetimelocal:&name=datetimelocal\'); ?>',true) . '</code></pre>');

$form->time('label=Time:&name=time');
$form->html('<pre><code>' . highlight_string('<?php $form->time(\'label=Time:&name=time\'); ?>',true) . '</code></pre>');

$form->week('label=Week:&name=week');
$form->html('<pre><code>' . highlight_string('<?php $form->week(\'label=Week:&name=week\'); ?>',true) . '</code></pre>');

$form->month('label=Month:&name=month');
$form->html('<pre><code>' . highlight_string('<?php $form->month(\'label=Month:&name=month\'); ?>',true) . '</code></pre>');

$form->color('label=Color:&name=color');
$form->html('<pre><code>' . highlight_string('<?php $form->color(\'label=Color:&name=color\'); ?>',true) . '</code></pre>');

$form->file('label=File:&name=file');
$form->html('<pre><code>' . highlight_string('<?php $form->file(\'label=File:&name=file\'); ?>',true) . '</code></pre>');
# Output
$form->render();
?>

<h2>Placeholder</h2>

<?php
$form = new formz();
$form->id = 'placeholder';
$form->input('name=placeholdervalue&label=Input:&placeholder=This is a Placeholder');
$form->html('<pre><code>' . highlight_string('<?php $form->input(\'name=input&label=Input:&placeholder=This is a Placeholder\'); ?>',true) . '</code></pre>');
$form->render();
?>

<h2>Default value</h2>

<?php
$form = new formz();
$form->id = 'default';
$form->input('name=defaultvalue&label=Input:&value=This is a default value');
$form->html('<pre><code>' . highlight_string('<?php $form->input(\'name=input&label=Input:&value=This is a default value\'); ?>',true) . '</code></pre>');
$form->render();
?>

<?php require_once('../include/footer.php'); ?>
