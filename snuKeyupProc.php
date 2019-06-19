<?php
$obj = json_decode($_POST['searchwords']);

$myArr = array($obj, "Mary", "Peter", "Sally");

$myJSON = json_encode($myArr);

echo $myJSON;
?>