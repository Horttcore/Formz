<?php
$path = '../';
$title = '&raquo; Database';
require_once( '../class.formz.php' );
mysql_connect('localhost', 'root', 'root');
mysql_select_db( 'test' );
?>

<?php require_once('../include/header.php'); ?>

<h2>Autosave</h2>
<?php
$form = new formz;
$form->id = 'autosave';
$form->sendform = FALSE;
$form->save_form = TRUE;
$form->save_table = 'posts';
$form->success_message = 'Post saved';

$form->input('name=title&label=Headline:');
$form->select('name=author_id&label=Author:&value=1::Luke,2::Darth Vader,3::Han Solo&default=- Select Author-');
$form->textarea('name=content&label=Content:');
$form->button('label=Save to database&type=submit');

$form->render();
?>

<pre><code><?php highlight_string('<?php
$form = new formz;
$form->id = "autosave";
$form->sendform = FALSE;
$form->save_form = TRUE;
$form->save_table = "posts";
$form->success_message = "Post saved";

$form->input("name=title&label=Headline:");
$form->select("name=author_id&label=Author:&value=1::Luke,2::Darth Vader,3::Han Solo&default=- Select Author-");
$form->textarea("name=content&label=Content:");
$form->button("label=Save to database&type=submit");

$form->render();
?>') ?>
</code></pre>



<h2>Mapping fields</h2>
<?php
$form = new formz;
$form->id = 'map';
$form->sendform = FALSE;
$form->save_form = TRUE;

$form->save_table = 'posts';
$form->save_key = 'ID'; # Primary Key
$form->save_map = array(
	'title' => 'headline',
	'author_id' => 'author',
	'content' => 'text' 
);

$form->input('name=headline&label=Headline:');
$form->select('name=author&label=Author:&value=1::Luke,2::Darth Vader,3::Han Solo&default=- Select Author-');
$form->textarea('name=text&label=Content:');
$form->button('label=Save to database&type=submit');

$form->render();
?>

<pre><code><?php highlight_string('<?php
$form = new formz;
$form->id = "map";
$form->sendform = FALSE;
$form->save_form = TRUE;

$form->save_table = "posts";
$form->save_key = "ID"; # Primary Key
$form->save_map = array(
	"title" => "headline",
	"author_id" => "author",
	"content" => "text" 
);

$form->input("name=headline&label=Headline:");
$form->select("name=author&label=Author:&value=1::Luke,2::Darth Vader,3::Han Solo&default=- Select Author-");
$form->textarea("name=text&label=Content:");
$form->button("label=Save to database&type=submit");

$form->render();'); ?>
</code></pre>


<?php require_once('../include/footer.php') ?>