<?php
$path = '../';
$title = '&raquo; Radiobuttons and Checkboxes';
require_once('../include/header.php');
?>

<h2>Arguments</h2>

<dl class="clearfix">
	<dt>label</dt>
	<dd>Label text</dd>
	<dt>value</dt>
	<dd>Comma seperated values; Use realvalue::Labelvalue style, if the label and values are different</dd>
	<dt>align</dt>
	<dd>horizontal (default) or vertical</dd>
	<dt>checked</dt><dd>Comma seperated values of checked values</dd>
	<dt>wrap</dt><dd>Possible values: both (default), before, after or none; Should the wrapping element included?<br>You can pass any html attribute of input with a value, even data-attributes</dd>
	<dt>note:</dt>
	<dd>If you use ',', '&amp;' or '=' in an attribute you have to escape them</dd>
</dl>

<h2>Default</h2>

<?php
# Add the Class
require_once( '../class.formz.php' );
# Init
$form = new formz();
# Fields
$form->checkbox('label=Checkbox&value=one,two,three,four,five,six');
$form->radio('label=Radio&value=one,two,three,four,five,six');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->checkbox(\'label=Checkbox&value=one,two,three,four,five,six\');
$form->radio(\'label=Radio&value=one,two,three,four,five,six\');
?>') ?></code></pre>

<h2>Align</h2>
<?php
# Init
$form = new formz();
# Fields
$form->checkbox('label=Checkbox&value=one,two,three&align=vertical');
$form->radio('label=Radio&value=one,two,three&align=vertical');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->checkbox(\'label=Checkbox&value=one,two,three&align=vertical\');
$form->radio(\'label=Radio&value=one,two,three&align=vertical\');
?>') ?></code></pre>

<h2>Label ≠ Value</h2>
<?php
# Init
$form = new formz();
# Fields
$form->checkbox('label=Checkbox&value=1::one,2::two,3::three');
$form->radio('label=Radio&value=1::one,2::two,3::three');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->checkbox(\'label=Checkbox&value=1::one,2::two,3::three\');
$form->radio(\'label=Radio&value=1::one,2::two,3::three\');
?>') ?></code></pre>

<h2>Input Value</h2>
<?php
# Init
$form = new formz();
# Fields
$form->checkbox('label=Checkbox&value=one,two,three,$::any number');
$form->radio('label=Radio&value=one,two,three,$::any number');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->checkbox(\'label=Checkbox&value=one,two,three,$::any number\');
$form->radio(\'label=Radio&value=one,two,three,$::any number\');
?>') ?></code></pre>

<h2>Preselected</h2>
<?php
# Init
$form = new formz();
# Fields
$form->checkbox('label=Checkbox&value=one,two,three&checked=one,two');
$form->radio('label=Radio&value=one,two,three&checked=two');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->checkbox(\'label=Checkbox&value=one,two,three&checked=one,two\');
$form->radio(\'label=Radio&value=one,two,three&checked=two\');
?>') ?></code></pre>

<?php require_once('../include/footer.php'); ?>