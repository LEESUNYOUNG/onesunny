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

$sql = "SELECT * FROM Disease";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		//DATA 읽어오기
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}
//https://ko.wikipedia.org/wiki/%EC%A7%88%EB%B3%91_%EB%AA%A9%EB%A1%9D

$conn->close();

?>