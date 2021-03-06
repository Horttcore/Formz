<?php
$path = '../';
$title = '&raquo; Radiobuttons and Checkboxes';
require_once('../include/header.php');
?>

<h2>Arguments</h2>

<dl class="clearfix">
	<dt>label</dt>
	<dd>Label text</dd>
	<dt>HTML attributes</dt>
	<dd>You can pass any valid HTML attriubte in the string, even data- attributes!</dd>
	<dt>value</dt>
	<dd>Comma seperated values;<br>Use realvalue::Label style, if the label and values are different<br>Use $::Label for input field</dd>
	<dt>align</dt>
	<dd>horizontal (default) or vertical</dd>
	<dt>checked</dt><dd>Comma seperated values of checked values</dd>
	<dt>wrap</dt><dd>Possible values: both (default), before, after or none; Should the wrapping element included?<br>You can pass any html attribute of input with a value, even data-attributes</dd>
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
$form->checkbox('label=Checkbox&value=one,two,three,four,five,six&name=el1');
$form->radio('label=Radio&value=one,two,three,four,five,six&name=el2');

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
$form->checkbox('label=Checkbox&value=one,two,three&align=vertical&name=el3');
$form->radio('label=Radio&value=one,two,three&align=vertical&name=el4');
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
$form->checkbox('label=Checkbox&value=1::one,2::two,3::three&name=el5');
$form->radio('label=Radio&value=1::one,2::two,3::three&name=el6');
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
$form->checkbox('label=Checkbox&value=one,two,three,$::any number&name=el7');
$form->radio('label=Radio&value=one,two,three,$::any number&name=el8');
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
$form->checkbox('label=Checkbox&value=one,two,three&checked=one,two&name=el9');
$form->radio('label=Radio&value=one,two,three&checked=two&name=el10');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->checkbox(\'label=Checkbox&value=one,two,three&checked=one,two\');
$form->radio(\'label=Radio&value=one,two,three&checked=two\');
?>') ?></code></pre>

<?php require_once('../include/footer.php'); ?>