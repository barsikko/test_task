<?php 

error_reporting(E_ALL);
ini_set('display_errors', 'On'); 

require_once 'autoload.php';

use Chap\Chapter;


$task = new Chapter();


if (isset($_POST['text']) && !empty($_POST['text'])){
	$task::insertText($_POST['text']);
	header('Location' . $_SERVER['HTTP_REFERER']);
}

$text = $task::getFromDB();

foreach ($text as $t){
print_r($t['TEXT_STR']."<br>");
}

?>

<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
	<input type="text" name="text">
	<input type="submit">
</form>