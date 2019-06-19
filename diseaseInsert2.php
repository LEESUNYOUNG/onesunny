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

   //$url2='https://ko.wikipedia.org/wiki/%EA%B3%A0%ED%98%88%EC%95%95';
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

	//객체 찾기

   $A_sitebody = $dom->find('ul li a');
   $A_sitebody2 = $dom->find('ol li a');
   $A_sitebody3 = $dom->find('dl li a');

	$cnt =  sizeof($A_sitebody);

	$count = 0;
	for($i=0;$i<$cnt;$i++)
	{
		$first = substr($A_sitebody[$i]->href,0,1);
		if($A_sitebody[$i]->class=='mw-redirect'||$A_sitebody[$i]->class=='mw-disambig'||$first=='#'||$count>137)
		{
		}
		else
		{
			 $sql = "INSERT INTO Disease (NAME) VALUES ('".$A_sitebody[$i]->plaintext."');";
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$count++;

		}
	}


	$cnt =  sizeof($A_sitebody2);

	$count = 0;
	for($i=0;$i<$cnt;$i++)
	{
		$first = substr($A_sitebody2[$i]->href,0,1);
		if($A_sitebody2[$i]->class=='mw-redirect'||$A_sitebody2[$i]->class=='mw-disambig'||$first=='#')
		{
		}
		else
		{
			 $sql = "INSERT INTO Disease (NAME) VALUES ('".$A_sitebody2[$i]->plaintext."');";
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$count++;

		}
	}

	$cnt =  sizeof($A_sitebody3);

	$count = 0;
	for($i=0;$i<$cnt;$i++)
	{
		$first = substr($A_sitebody3[$i]->href,0,1);
		if($A_sitebody3[$i]->class=='mw-redirect'||$A_sitebody3[$i]->class=='mw-disambig'||$first=='#')
		{
		}
		else
		{
			 $sql = "INSERT INTO Disease (NAME) VALUES ('".$A_sitebody3[$i]->plaintext."');";
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$count++;

		}
	}

	
	$conn->close();
	echo 'finish';


   //echo $A_sitebody2;

?>