<?php

//https://www.php.net/manual/en/function.ksort.php
//array sort

$servername = "onesunny3.cafe24.com";
$username = "onesunny3";
$password = "gana8338";
$dbname = "onesunny3";

$str="";

$test = json_decode($_POST['test']);
//$test2 = (array)$test[0];

//--- 질병 id 와 count넘버 '배열'을 받아온다

//---빈 배열을 생성한다. 
$disease = [];

// Create connection

// Check connection

//echo "Connected successfully"

// --- 가져온 [질병,count] 배열에 대해서 / DB접근을 통해 병명을 가져온다
for($i=0;$i<count((array)$test);$i++)
{
	$dump = (array)$test[$i];
	//$str.=$dump['DiseaseId'];
	$sql = "SELECT Name FROM SnuDisease WHERE Id = ".$dump['DiseaseId'];
	//$sql = "SELECT Name FROM SnuDisease WHERE Id = 155";
	
	$conn = new mysqli($servername, $username, $password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		 //output data of each row
		while($row = $result->fetch_assoc()) {
			$str.=$row['Name'].',';

			$arr1 = Array(
			"Name" => $row['Name'],
			"DiseaseId" => $dump['DiseaseId'],
			"Count" => $dump['count']
			);
			//---기존에 가져온 배열의 [병명id,count]값과 새로 알아낸 [병명]을 조합하여 / 미니배열 array1을 만든다
			array_push($disease,$arr1);
			//---이 미니배열 array1을 /아까 생성한 엄마 배열 disease1에 넣는다.
			//---즉 이중 배열 생성 
			}
	}
}

//print_r($disease);
//--- 새로운 병명 데이터까지 포함된 /엄마배열/이중배열 /disease를 key value 인 count 값에 따라 정렬한다. 

$sortArray = array(); 

foreach($disease as $dis){ 
    foreach($dis as $key=>$value){ 
        if(!isset($sortArray[$key])){ 
            $sortArray[$key] = array(); 
        } 
        $sortArray[$key][] = $value; 
    } 
} 

$orderby = "Count"; //change this to whatever key you want from the array 

array_multisort($sortArray[$orderby],SORT_DESC,$disease); 
//---count 순으로 정렬되어 [병명id, 병명,count]을 갖고 있는 배열 $disease
//print_r($disease); 

$myJSON = json_encode($disease);

echo $myJSON;

exit;
//print_r($test2['count']);
//print_r($test2);

//echo sizeof($test);

// 190329 작업 시작
//받아온 CountData 배열에 대해서 DIseaseId를 갖고 count 된 넘버순으로 정렬하여 '병명'을 찾아서 배열을 돌려 보내주는 것이다. 
//실시간으로 현재 우선순위로 추천되는 병명을 확인할 수 있음
?>