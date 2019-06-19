<?
//질병목록
//DB에 INSERT 완료
//리스트 뽑는 화면 ,총 885개
//위의 링크에서 data 불러오기 
?>
<?php
	
	include('simple_html_dom.php');
	
	//db 연결 시작   
	

	
	$count = 0;
	
	$linkList = array('가','나','다','라','마','바','사','아','자','차','카','타','파','하');

	foreach ($linkList as $el)
	{
		$count = ($count+ListUp($el));
	}

   function ListUp($val){
	   $cate = $val; //카데고리는 가 나 다 이런식으로
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
		//db연결 끝

	   $url ='http://www.snuh.org/health/encyclo/search.do?searchKey=S&searchWord='.$val;
	   echo $url;
	   $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/5';
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

	   $A_sitebody = $dom->find('div.boxInner',0)->find('a');
	   $cnt =  sizeof($A_sitebody);

	   $string = '<ol>';
	
		for($i=0;$i<$cnt;$i++)
		{	
			$url='';
			$first = substr($A_sitebody[$i]->href,1);
			$define = explode(' ' ,$first);
			for($k=0;$k<sizeof($define);$k++)
			{
				$url.= trim($define[$k]);
			}
			
			$first =("http://www.snuh.org/health/encyclo".$url);
		
			$string .= '<li>'.$A_sitebody[$i]->plaintext.'>>> '.$first.'</li>';
			
			//data db 에 insert
			/*
			$sql = "INSERT INTO SnuDisease (NAME,Url,Cate) VALUES ('".$A_sitebody[$i]->plaintext."','".$first."','".$cate."');";
			if ($conn->query($sql) === TRUE) {
				//echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			//data db 에 insert 끝
			*/

			$count++;

			
		}
		echo $string.'</ol>';

		return $cnt;
				
	  }

	  echo $count;
	  

?>