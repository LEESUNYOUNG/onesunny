<?php

$keyword = $_POST['searchword'];
//$sql = "SELECT Id,NAME,Symptom FROM SnuDisease WHERE NAME LIKE '%".$keyword."%' LIMIT 0,10";
$sql = "SELECT Id,Symptom AS NAME,DiseaseId,SymptomIndex FROM SnuDiseaseSymptom WHERE Symptom LIKE '%".$keyword."%' LIMIT 0,10";

$servername = "onesunny3.cafe24.com";
$username = "onesunny3";
$password = "gana8338";
$dbname = "onesunny3";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

$myArr = array();

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		//crawl($row["Name"]);
		array_push($myArr,$row["NAME"]);
    }
} else {
		 array_push($myArr,"");
}

$myJSON = json_encode($myArr);

echo $myJSON;
?>