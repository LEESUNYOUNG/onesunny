<?php

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

$sql = "INSERT INTO Disease (NAME,subCate,mainCate) VALUES ('b33ye','1','2');";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
exit;


$rs		= $oMysql->excute($arSQL);

$DATA = $oMysql->fetch("array");
echo $DATA['id'];


   $ch = curl_init();
   $ch2 = curl_init();

   $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/5';
   $url ='https://ko.wikipedia.org/wiki/뇌출혈';

   $url2='https://ko.wikipedia.org/wiki/%EA%B3%A0%ED%98%88%EC%95%95';
   curl_setopt($ch, CURLOPT_URL,  $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
   curl_setopt($ch, CURLOPT_TIMEOUT, 10);
   curl_setopt($ch, CURLOPT_HEADER, false);
   curl_setopt($ch, CURLOPT_REFERER,  $url);
   curl_setopt($ch, CURLOPT_USERAGENT, $agent);
   $content = curl_exec($ch);
   curl_close($ch);

   curl_setopt($ch2, CURLOPT_URL,  $url2);
   curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 10);
   curl_setopt($ch2, CURLOPT_TIMEOUT, 10);
   curl_setopt($ch2, CURLOPT_HEADER, false);
   curl_setopt($ch2, CURLOPT_REFERER,  $url2);
   curl_setopt($ch2, CURLOPT_USERAGENT, $agent);
   $content2 = curl_exec($ch2);
   curl_close($ch2);



   // content 뿌려지면 가져오기 성공

   //echo $content;



   // html dom parser

   $dom = new simple_html_dom();
   $dom2 = new simple_html_dom();

   $dom->load($content);
   $dom2->load($content2);

   // body 태그의 내용을 담는다 (body 태그 포함)

   $A_sitebody = $dom->find('h1#firstHeading',0)->plaintext;
   $A_sitebody2 = $dom2->find('h1#firstHeading',0)->plaintext;

   echo $A_sitebody;

   echo $A_sitebody2;

?>