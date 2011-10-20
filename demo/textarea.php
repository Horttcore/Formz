<?php
$path = '../';
$title = '&raquo; Textarea';
require_once('../include/header.php');
?>

<h2>Arguments</h2>

<dl class="clearfix">
	<dt>Arguments</dt>
	<dt>label</dt>
	<dd>Label text</dd>
	<dt>value</dt>
	<dd>Comma seperated values; Use realvalue::Labelvalue style, if the label and values are different</dd>
	<dt>wrap</dt>
	<dd>Possible values: both (default), before, after or none; Should the wrapping element included?<br>You can pass any html attribute of input with a value, even data-attributes</dd>
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
$form->textarea('label=Textarea&name=textarea');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->textarea(\'label=Textarea&name=textarea\');
?>') ?></code></pre>

<h2>Cols &amp; Rows</h2>
<?php
# Add the Class
require_once( '../class.formz.php' );
# Init
$form = new formz();
# Fields
$form->textarea('label=Textarea&name=textarea&cols=50&rows=20');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->textarea(\'label=Textarea&name=textarea&cols=50&rows=20\');
?>') ?></code></pre>

<h2>Placeholder</h2>
<?php
# Add the Class
require_once( '../class.formz.php' );
# Init
$form = new formz();
# Fields
$form->textarea('label=Textarea&name=textarea&placeholder=This is a placeholder');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->textarea(\'label=Textarea&name=textarea&placeholder=This is a placeholder\');
?>') ?></code></pre>

<h2>Prefilled</h2>
<?php
# Add the Class
require_once( '../class.formz.php' );
# Init
$form = new formz();
# Fields
$form->textarea('label=Textarea&name=textarea&value=This is a Text');
# Output
$form->render();
?>
<pre><code><?php highlight_string('<?php
$form->textarea(\'label=Textarea&name=textarea&value=This is a Text\');
?>') ?></code></pre>

<?php require_once('../include/footer.php') ?>