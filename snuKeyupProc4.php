<?php

$keyword = $_POST['searchword'];
$sqlNumber = $_POST['content'];

$sql= array();
//0일때 병명 찾기
$sql[0] = "SELECT Id AS DiseaseId,NAME,Symptom FROM SnuDisease WHERE NAME LIKE '%".$keyword."%' LIMIT 0,10";
//1일때 증상 찾기
$sql[1] = "SELECT Id,Symptom AS NAME,DiseaseId,SymptomIndex FROM SnuDiseaseSymptom WHERE Symptom LIKE '%".$keyword."%' LIMIT 0,10";

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

$result = $conn->query($sql[$sqlNumber]);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		//crawl($row["Name"]);
		//array_push($myArr,$row["NAME"]);
		
		$arr1 = Array(
			"Name" => $row['NAME'],
			"DiseaseId" => $row['DiseaseId']
		);
		array_push($myArr,$arr1);
		
    }
} else {
		 array_push($myArr,"");
}

$myJSON = json_encode($myArr);

echo $myJSON;
?>