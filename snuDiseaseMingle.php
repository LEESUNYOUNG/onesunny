<?php
//DB의 disease table data 읽어오기
//db 연결 완료
//그리고 crawl web 에서 해오기
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

$sql = "SELECT * FROM SnuDisease WHERE Symptom1 IS NOT NULL LIMIT 0,1000";
$result = $conn->query($sql);


echo "<ol>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		//DATA 읽어오기
        echo "<li><span  style='background:yellow'>id: " . $row["Id"]. "</span> - Name: " . $row["Name"]. " -Url: <a href='".$row["Url"]."'>". $row["Url"]."</a><br>";
		echo '<ol>';

		$insertString='';
		for($i=1;$i<=20;$i++)
		{
			$SymptomIndex = "Symptom".$i;
			if($row[$SymptomIndex]!=null)
			{
				echo "<li>".$row[$SymptomIndex]."</li>";
				$insertString.=$row[$SymptomIndex];
			}

		}
		echo '</ol>';
		echo $insertString;
		//DB에 mingle한 데이터 Symptom열에 넣기
		/*
		
		$sqlstring = "UPDATE SnuDisease SET Symptom = '".$insertString."' WHERE Id =".$row["Id"];
		if ($conn->query($sqlstring) === TRUE) {
			//echo "New record created successfully";
		} else {
			echo "Error: " .$insertString. "<br>" . $conn->error;
		}
		*/

		//crawl($row["Name"]);
		echo '</li><br>';
    }
} else {
    echo "0 results";
}
//https://ko.wikipedia.org/wiki/%EC%A7%88%EB%B3%91_%EB%AA%A9%EB%A1%9D
echo "</ol>";
$conn->close();


//이 페이지에서 crawl함수 필요 없음

//크롤링 함수
function crawl($dis){

	$urlArray = explode(' ',$dis);
	$dis='';
	//var_dump($urlArray);
	$index = 0 ;
	foreach($urlArray as $ua)
	{
		
		if($index==0)
		{
			$dis.=$ua;
		}
		else
		{	
			$dis.='+';
			$dis.=$ua;
		}
		$index++;
	}

   $ch = curl_init();
   $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/5';
   //질병목록
   $url ='http://www.snuh.org/health/encyclo/search.do?searchKey=W&searchWord='.$dis;
   //echo '다음 링크에서 병명에 대한 검색결과 확인 <br>'.$url.'<br>';

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
   //원하는 keyword 
   //$dis 에 대한 검색 주소 가져오기
   $define = $dom->find('div.boxInner',0)->find('li',0);
   if($define==null)
   {
		echo '병명을 찾을 수 없습니다.';
		exit;
   }
   $define = $dom->find('div.boxInner',0)->find('li',0)->find('a',0)->href;

   $define = substr($define,1);
   $define = explode(' ' ,$define);
   $string='';
  
   for($i=0;$i<sizeof($define);$i++)
   {
	   if($define[$i]=='')
	   {
	   }
	   else
	   {
		   $string.=trim($define[$i]);
	   }
   }
	//문제가 있으면 CLOSE
   $newHref = "http://www.snuh.org/health/encyclo".$string;
   $url = $newHref;


   //---------------------------


	$ch = curl_init();

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
	$define = $dom->find('a.btnType02');
	$newHref='';
	for($i=0;$i<sizeof($define);$i++)
	{
		if(strpos($define[$i]->plaintext,'증상')){
			$newHref = $define[$i]->href;
		}
	}
	if($newHref=='')
	{
		echo '증상을 찾을 수 없습니다.';
	}
	else
	{
		//echo $newHref;
	
  //--------------------------

	   $newHref = "http://www.snuh.org/".$newHref;
	   $url = $newHref;

		$ch = curl_init();

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
		$define = $dom->find('div.contTextWrap',0)->next_sibling('.encView')->plaintext;

		$define = explode('*' ,$define);
		echo '<ol>';
		for($i=1;$i<sizeof($define);$i++)
		{	
			if($i==(sizeof($define)-1))
			{
				$cont = explode('.',$define[$i]);
				$define[$i] = $cont[0];
			}
			echo '<li>'.$define[$i].'</li>';
		}
		echo '</ol>';

	}
}

?>