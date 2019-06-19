<?php

	$test = json_decode($_POST['test']);
	$test2 = (array)$test[0];

	$servername = "onesunny3.cafe24.com";
	$username = "onesunny3";
	$password = "gana8338";
	$dbname = "onesunny3";

	$sql = "SELECT Url FROM SnuDisease WHERE Id = ".$test2['DiseaseId'];

	$str = ''; 

	$conn = new mysqli($servername, $username, $password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		 //output data of each row
		while($row = $result->fetch_assoc()) {
		/*	$str.=$row['Url'].',';

			$arr1 = Array(
			"Name" => $row['Name'],
			"DiseaseId" => $dump['DiseaseId'],
			"Count" => $dump['count']

			"Url" => $row['Url']

			);*/
			//---기존에 가져온 배열의 [병명id,count]값과 새로 알아낸 [병명]을 조합하여 / 미니배열 array1을 만든다
			//array_push($disease,$arr1);
			//---이 미니배열 array1을 /아까 생성한 엄마 배열 disease1에 넣는다.
			//---즉 이중 배열 생성
			
			$str.=$row['Url'];
			}
	}

//print_r($str);

//url 가져왔으면  크롤링 시작
	include('simple_html_dom.php');

   $ch = curl_init();
   //$ch2 = curl_init();

   $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/5';
   //질병목록
   $url =$str;

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


   // content 뿌려지면 가져오기 성공

   //echo $content;



   // html dom parser

   $dom = new simple_html_dom();

   $dom->load($content);

   // body 태그의 내용을 담는다 (body 태그 포함)

   //$A_sitebody = $dom->find('span.mw-headline',0)->plaintext;
   //$define = $dom->find('.encView',0)->plaintext;
   $define = $dom->find('.encView',0);
	echo $define;
?>