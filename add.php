<?php
require_once "connect.php";
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $reaponse = array(
        "code" => 424, 
        "msg" => "Method not found",
        "errors" => ["method"=>"Method must be post"]
    );
    echo json_encode($reaponse);
    exit();
}
$name= $_POST['name'];
$mobile= $_POST['mobile'];
$img= $_POST['img'];

$errors = array();
if(empty($name)){
    $errors['name'] = "Empty";
}
if(empty($mobile)){
    $errors['mobile'] = "Empty";
}else if(strlen($mobile) != 10){
    $errors['mobile'] = "Must be 10 digit long";
}
if(empty($img)){
    $errors['img'] = "Empty";
}

if(empty($errors)){
    $q = "INSERT INTO `persons`(`name`, `mobile`, `img`) VALUES ('$name','$mobile','$img')";
    $qr = mysqli_query($conn, $q) or die($q.mysqli_error($conn));
    
    $person = array(
        "code" => 200, 
        "msg" => "Saved successfully",
        "data" => array(        
        "id" => mysqli_insert_id($conn),
        "name" => $name,
        "mobile" => $mobile,
         ),

    );
}else{
    $person = array(
        "code" => 400, 
        "msg" => "Validation error",
        "errors"=> json_encode($errors) 
    );
}

echo json_encode($person);
