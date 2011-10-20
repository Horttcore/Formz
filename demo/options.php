<?php
$path = '../';
$title = '&raquo; Options';
require_once('../include/header.php');
?>

<h2>Options</h2>

<dl class="clearfix">
	<dt>action</dt>
	<dd><em>string</em> - URL</dd>

	<dt>callback</dt>
	<dd><em>function</em> - a callback function, has to return true or false</dd>

	<dt>copy</dt>
	<dd><em>string</em> - a field name to check if a copy mail should be send</dd>

	<dt>copy_to</dt>
	<dd><em>string</em> - a field name with an email address</dd>

	<dt>error_position</dt>
	<dd><em>string</em> - 'before' (default) or 'after', where the field error should be included</dd>

	<dt>from</dt>
	<dd><em>string</em> - From mail header</dd>

	<dt>from_email</dt>
	<dd><em>string</em> - From email mail header</dd>

	<dt>global_error_message</dt>
	<dd><em>string</em> - Global error message</dd>

	<dt>header</dt>
	<dd><em>string</em> - Mail header</dd>

	<dt>html</dt>
	<dd><em>boolean</em> - if the form mail is html or plain text</dd>
	
	<dt>html_body_after</dt>
	<dd><em>string</em> - Inject code in the html email template before the body closing tag</dd>

	<dt>html_body_before</dt>
	<dd><em>string</em> - Inject code in the html email template after the body opening tag</dd>

	<dt>html_body_head</dt>
	<dd><em>string</em> - Inject code in the html email template between the head tag</dd>

	<dt>id</dt>
	<dd><em>string</em> - Form ID (must be set if there are more then one form on a page)</dd>

	<dt>label_enclose</dt>
	<dd><em>boolean</e> - Should the form elements be enclosed by the label tag?</dd>

	<dt>method</dt>
	<dd><em>string</em> - Form method</dd>

	<dt>require_symbol</dt>
	<dd><em>string</em> - Required symbole; default '*'</dd>

	<dt>sendform</dt>
	<dd><em>boolean</em> - If the form should be send by email</dd>

	<dt>subject</dt>
	<dd><em>string</em> - E-Mail Subject</dd>
	
	<dt>success_message</dt>
	<dd><em>string</em> - Success Message</dd>

	<dt>to</dt>
	<dd><em>string</em> - E-Mail Address</dd>

</dl>
<?php require_once('../include/footer.php'); ?>