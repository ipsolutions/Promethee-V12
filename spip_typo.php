<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<?php
	require "msg/typo.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_GET["lang"]."/typo.php");
?>

<head>
<title>Prométhée, <?php print($msg->read($TYPO_TITLE)); ?></title>

<style type="text/css">
/* <![CDATA[ */
hr {
	height: 1px;
	color: #008000;
	background-color: #008000;
	border: 0;
}

body {
	color: #000000;
	font-family: verdana, lucida, "comic sans ms", sans-serif;
	font-size: 13px;
	text-align: justify;
}

a:active {
	color: #ff0000;
	font-family: verdana, lucida, "comic sans ms", sans-serif;
	text-decoration: none;
}

a:visited {
	color: #ff0000;
	font-family: verdana, lucida, "comic sans ms", sans-serif;
	text-decoration: none;
}

a:link {
	color: #008000;
	font-family: verdana, lucida, "comic sans ms", sans-serif;
	text-decoration: none;
}

a:hover {
	color: #008000;
	font-family: verdana, lucida, "comic sans ms", sans-serif;
	text-decoration: underline;
	font-weight: lighter;
}

h1 {
	font-size: 19px;
}

h2 {
	font-size: 17px;
}

h1 {
	font-size: 15px;
}

.small {
	font-size: 11px;
}
/* ]]> */
</style>
</head>

<body style="background-color:#FFFFFF; margin:5px;">

<?php print($msg->read($TYPO_TEXT)); ?>

<div style="text-align:center">
[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($TYPO_CLOSEWINDOW)); ?></a>]
</div>

</body>
</html>
