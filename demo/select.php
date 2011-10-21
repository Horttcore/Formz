<?php
$path = '../';
$title = '&raquo; Select';
require_once('../include/header.php');
?>

<h2>Arguments</h2>

<dl class="clearfix">
	<dt>label</dt>
	<dd>Label text</dd>
	<dt>HTML attributes</dt>
	<dd>You can pass any valid HTML attriubte in the string, even data- attributes!</dd>
	<dt>default</dt>
	<dd>empty value options label</dd>
	<dt>selected</dt>
	<dd>Comma seperated values of selected values</dd>
	<dt>wrap</dt>
	<dd>Possible values: both (default), before, after or none; Should the wrapping element included?<br>You can pass any html attribute of input with a value, even data-attributes</dd>
	<dt><small>note:</small></dt>
	<dd><small>If you use ',', '&amp;' or '=' in an attribute you have to escape them</small></dd>
</dl>

<h2>Default</h2>
<?php
# Add the Class
require_once( '../class.formz.php' );
# Init
$form = new formz();
# Fields
$form->select('label=Select&value=one,two,three,four,five,six');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->select(\'label=Select&value=one,two,three,four,five,six\');
?>') ?></code></pre>

<h2>Label ≠ Value</h2>
<?php
# Init
$form = new formz();
# Fields
$form->select('label=Select&value=1::one,2::two,3::three');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->select(\'label=Select&value=1::one,2::two,3::three\');
?>') ?></code></pre>

<h2>Default Value</h2>
<?php
# Init
$form = new formz();
# Fields
$form->select('label=Default value&value=one,two,three&default=Please select something');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->select(\'label=Default value&value=one,two,three&default=Please select something\');
?>') ?></code></pre>

<h2>Preselected</h2>
<?php
# Init
$form = new formz();
# Fields
$form->select('label=Default value&value=one,two,three&selected=two');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->select(\'label=Default value&value=one,two,three&selected=two\');
?>') ?></code></pre>

<h2>Multiselect</h2>
<?php
# Init
$form = new formz();
# Fields
$form->select('label=Multiselect&value=one,two,three&multiple=multiple');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->select(\'label=Multiselect&value=one,two,three&multiple=multiple\');
?>') ?></code></pre>

<h2>Multiselect preselected</h2>
<?php
# Init
$form = new formz();
# Fields
$form->select('label=Multiselect&value=one,two,three&multiple=multiple&selected=two,three');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->select(\'label=Multiselect&value=one,two,three&multiple=multiple&selected=two,three\');
?>') ?></code></pre>

<?php require_once('../include/footer.php'); ?>