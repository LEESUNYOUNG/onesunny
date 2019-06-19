<?
//특정 병명
//에 대해서 정의와 증상
//https://ko.wikipedia.org/wiki/당뇨병
//위의 링크에서 data 불러오기 
?>
<?php
	
	include('simple_html_dom.php');
	$dis = $_GET['dis'];
   $ch = curl_init();
   //$ch2 = curl_init();

   $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/5';
   //질병목록
   $url ='https://ko.wikipedia.org/wiki/'.$dis;

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

   $define = $dom->find('p',0)->plaintext;
	echo '<h1>정의</h1>'.$define;

	//$symptom = $dom->find("h2",1)->next_sibling('p')->plaintext;
	$symptom = $dom->find(".mw-headline");

	for($i=0;$i<sizeof($symptom);$i++)
	{	
		echo $symptom[$i]->plaintext.'<br>';
		if(strpos($symptom[$i]->id,'증상')!=false)
		{
			$symptom = $symptom[$i]->parent()->next_sibling('p')->plaintext;
		}
	}

	echo '<h1>증상</h1>';
	echo $symptom;
	echo sizeof($symptom);
	echo '<br><br>';

	while(sizeof($jbexplode = explode( ',', $symptom ,2))>1)
	{
		$minedData = chkLength($jbexplode[0]);
		$symptom = $jbexplode [1];

		echo $minedData.'<br><br>';
	}

	$jbexplode = explode( ',', $symptom ,2);

	var_dump($jbexplode);
	echo '<br><br>';



	$test = chkLength($jbexplode[0]);
	echo "result :".$test;
	//$jbexplode =$jbexplode[1];
	//echo $jbexplode;

	function chkLength($string){//word 가 짧은지? 2글자 이하면 앞에 것 까지 돌려주기
		$ary = explode(' ',$string);
		$text = end($ary);
		$length = mb_strlen( end($ary), 'utf-8' );//문자의 길이
		if($length<=2)
		{
			$index = sizeof($ary);
			$index -=2;
			$text=($ary[$index].$text);
		}
		return $text;
	}


?>