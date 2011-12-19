<?php
$path = '../';
$title = '&raquo; Debug';
require_once('../include/header.php');

function customcallback(){
	return true;
}

?>
<h2>Debug</h2>
<?php

# Add the Class
require_once( '../class.formz.php' );
# Init
$form = new formz('callback=customcallback&success_message=Form Send!&id=all');
$form->debug();
$form->sendform = false;
$form->error_position = 'after';
# Fields
$form->fieldset_open('label=Fieldset');
$form->fieldset_close();

$form->color('label=Color:&name=color');
$form->file('label=File:&name=file');
$form->input('name=user&label=User:');
$form->password('name=password&label=Password:');
$form->search('name=search&label=Search:');
$form->url('name=url&label=URL:');
$form->textarea('name=textarea&label=Textarea:');
$form->range('name=range&label=Range&min=0&max=100&value=50&step=20');
$form->number('name=number&label=Number:');
$form->tel('name=tel&label=Tel:');
$form->date('label=Date:&name=date');
$form->datetime('label=Datetime:&name=datetime');
$form->datetimelocal('label=Datetimelocal:&name=datetimelocal');
$form->month('label=Month:&name=month');
$form->time('label=Time:&name=time');
$form->week('label=Week:&name=week');

$form->checkbox('label=Checkbox&value=one,two,three,four,five,six');
$form->radio('label=Checkbox&value=one,two,three,four,five,six');
$form->select('label=Select:&value=one,two,three,four,five,six&default=Auswahl');
$form->html('This is plain HTML!');
$form->reset('label=reset');
$form->button('label=login&type=submit&name=send');
$form->hidden('name=hidden&value=Secret Stuff');
# Output
$form->render();
?>
<pre>
<code><?php highlight_string('<?php
$form = new formz("callback=customcallback&success_message=Form Send!&id=all");
# … Some form elements
$form->debug();
# … Some Form elements
$form->render();
?>'); ?>
</code>
</pre>
<?php require_once('../include/footer.php'); ?>
