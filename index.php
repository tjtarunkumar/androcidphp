<?php
require_once "connect.php";

$pageno = isset($_GET['pageno']) ? $_GET['pageno'] : 1;

$records_per_page = 10;
$offset = ($pageno-1) * $records_per_page;

$q = "select * from persons limit $offset, $records_per_page";
$qr = mysqli_query($conn, $q) or die($q);
$persons = array();
while($r = mysqli_fetch_array($qr)){
	$person = array();
	$person['id'] = $r[0];
	$person['name'] = $r[1];
	$person['mobile'] = $r[2];
	$person['img'] = $r[3];
	$persons[] = $person;
}

echo json_encode($persons, 1);
