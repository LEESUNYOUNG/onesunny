<?
//질병목록
//https://ko.wikipedia.org/wiki/%EC%A7%88%EB%B3%91_%EB%AA%A9%EB%A1%9D

?>
<?php
	
	include('simple_html_dom.php');
   $ch = curl_init();
   //$ch2 = curl_init();

   $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/5';
   //질병목록
   $url ='https://ko.wikipedia.org/wiki/%EC%A7%88%EB%B3%91_%EB%AA%A9%EB%A1%9D';

   curl_setopt($ch, CURLOPT_URL,  $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
   curl_setopt($ch, CURLOPT_TIMEOUT, 10);
   curl_setopt($ch, CURLOPT_HEADER, false);
   curl_setopt($ch, CURLOPT_REFERER,  $url);
   curl_setopt($ch, CURLOPT_USERAGENT, $agent);
   $content = curl_exec($ch);
   curl_close($ch);
  

   $dom = new simple_html_dom();
   $dom->load($content);

	//db 연결 시작   
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

	//html 에서 객체 찾기
   $A_sitebody = $dom->find('a.mw-redirect');
	$cnt =  sizeof($A_sitebody);

	for($i=0;$i<$cnt;$i++)
	{
		 $sql = "INSERT INTO Disease (NAME) VALUES ('".$A_sitebody[$i]->plaintext."');";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

	}
	
	$conn->close();
	echo 'finish';

?>