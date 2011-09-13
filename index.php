<!DOCTYPE HTML>
<html lang="de-DE">
<head>
	<meta charset="UTF-8">
	<title>Formz Demo</title>
	<script src="jquery-v1.6.3.js" type="text/javascript"></script>
	<script src="jquery.formz.js" type="text/javascript"></script>
	<style type="text/css">
	body {
			font: 14px/18px sans-serif
		}
		.error {
			color: #ff0000;
		}
		.hidden {
			display: none;
		}
	
		label {
			display: inline-block;
			width: 200px;
		}

		textarea {
			vertical-align: top;
		}

		.message {
			padding: 3px 5px;
		}

		.option-group-label {
			display: block;	
		}

		.options-label {
			width: auto;
		}

		input[type=checkbox], input[type=radio] {
			margin-left: 20px;
		}
	</style>
</head>
<body>

<h1>Formz Demo</h1>

<?php $mem_before = memory_get_usage() / 1048576 ?>
<?php require_once( 'class.formz.php' ); ?>
<?php $mem_loaded = memory_get_usage() / 1048576 ?>

<?php
# Init
$form = new formz();
$form->sendform = false;
$form->error_position = 'after';
$form->id = 'loginform';
# Fields
$form->input('name=user&label=User:');
$form->password('name=password&label=Password:');
$form->button('label=Send&type=submit&name=send');
# Validation
$form->required('name=user&error_message=Bitte Benutzernamen eingeben');
$form->required('name=password&error_message=Bitte geben Sie Ihr Passwort ein');
# Output
$form->render();

# Init
$form = new formz();
$form->sendform = false;
$form->error_position = 'after';
# Fields
$form->input('name=title&label=Title:');
$form->textarea('name=content&label=Content:');
$form->button('label=Send&type=submit&name=send');
# Validation
$form->required('name=title&error_message=Bitte geben Sie einen Titel für Ihren Beitrag an.');
# Output
$form->render();


$mem_rendered = memory_get_usage() / 1048576 ?>

<h1>Benchmark</h1>
<p>
	<strong>Before Load:</strong> <?php echo number_format($mem_before,2) ?> MB<br />
	<strong>After Load:</strong> <?php echo number_format($mem_loaded,2) ?> MB<br />
	<strong>After Render:</strong> <?php echo number_format($mem_rendered,2) ?> MB<br />
</p>

</body>
</html>