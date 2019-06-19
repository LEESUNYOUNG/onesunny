<?php
//DB의 disease table data 읽어오기
//db 연결 완료
//include('lib/cMysql.php');
include('simple_html_dom.php');

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

	echo "<ol>";
$symptomIndex = 1;
for($symptomIndex = 1;$symptomIndex <=20;$symptomIndex ++)
{
	$symptom = "Symptom".$symptomIndex;

	$sql = "SELECT * FROM SnuDisease WHERE Symptom".$symptomIndex." IS NOT NULL LIMIT 0,1000";
	echo $sql.'<br>';
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			
			//DATA 읽어오기
			echo "<li><span  style='background:yellow'>id: " . $row["Id"]. "</span> - Name: " . $row["Name"]. "Symptom".$symptomIndex."-".$row[$symptom]."<br>";

			//DB에 mingle한 데이터 Symptom열에 넣기
			
			$sqlstring = "INSERT INTO SnuDiseaseSymptom (Symptom,DiseaseId, SymptomIndex) VALUES ('".trim($row[$symptom])."','".$row["Id"]."','".$symptomIndex."')";
			echo $sqlstring;
			if ($conn->query($sqlstring) === TRUE) {
				//echo "New record created successfully";
			} else {
				echo "Error: " .$insertString. "<br>" . $conn->error;
			}
			

			//crawl($row["Name"]);
			echo '</li><br>';
		}
	} else {
		echo "0 results";
	}

}
	echo "</ol>";
$conn->close();


?>