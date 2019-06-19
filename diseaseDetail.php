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
  
	/*
   curl_setopt($ch2, CURLOPT_URL,  $url2);
   curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 10);
   curl_setopt($ch2, CURLOPT_TIMEOUT, 10);
   curl_setopt($ch2, CURLOPT_HEADER, false);
   curl_setopt($ch2, CURLOPT_REFERER,  $url2);
   curl_setopt($ch2, CURLOPT_USERAGENT, $agent);
   $content2 = curl_exec($ch2);
   curl_close($ch2);
	*/


   // content 뿌려지면 가져오기 성공

   //echo $content;



   // html dom parser

   $dom = new simple_html_dom();
   //$dom2 = new simple_html_dom();
	
   $dom->load($content);
   //$dom2->load($content2);

   // body 태그의 내용을 담는다 (body 태그 포함)

   //$A_sitebody = $dom->find('span.mw-headline',0)->plaintext;
   $define = $dom->find('p',0)->plaintext;
	echo '<h1>정의</h1>'.$define;
	//$symptom = $dom->find("h2",1)->find('span',1)->id;
	$symptom = $dom->find("h2",1)->next_sibling('p')->plaintext;
	echo '<h1>증상</h1>';
	echo $symptom;
	echo '<br>';
	//$test = $dom->find("span#징후와_증상",0)->plaintext;
	
	$jbexplode = explode( '증상은', $symptom );
	$jbexplode =$jbexplode[1];
	$jbexplode =explode( '이다.', $jbexplode);
	$jbexplode =$jbexplode[0];
	$jbexplode =explode( ',', $jbexplode);
	//첫번 째 것은 space 기준으로 끊고 
	//단 , space 기준으로 끊은게 2글자 보다 작으면 앞에 배열이랑 합쳐버리고 저장
	//마지막 것은 마침표  기준으로 자르기
	//가능하면 '이다'라는 텍스트는 제거할 것.
	$size = sizeof($jbexplode);
	
	for($j=0;$j<$size;$j++)
	{
		echo 'symptom'.$j.':<br>';
		if($j==0)
		{
			$string = explode(' ',$jbexplode[$j]);
			$length = mb_strlen( end($string), 'utf-8' );//문자의 길이
			$jbexplode[$j] ='';
			if($length<3)
			{
				$index = sizeof($string);
				$index -=2;
				$jbexplode[$j].=$string[$index];
			}

			$jbexplode[$j].=end($string);
			echo $jbexplode[$j].'<br>';
		}
		else if($j==($size-1))
		{
			$string = explode('이다',$jbexplode[$j]);
			$jbexplode[$j] = $string[0];
			echo $jbexplode[$j].'<br>';
		}
		else
		{
			echo $jbexplode[$j].'<br>';
		}
	}

   //$A_sitebody2 = $dom->find('ol li a');
   //$A_sitebody3 = $dom->find('dl li a');

   //$A_sitebody2 = $dom2->find('h1#firstHeading',0)->plaintext;
	
/*	
	$cnt =  sizeof($A_sitebody);
	echo $cnt;

	$string = '<ol>';
	$count = 0;
	for($i=0;$i<$cnt;$i++)
	{
		$first = substr($A_sitebody[$i]->href,0,1);
		if($A_sitebody[$i]->class=='mw-redirect'||$A_sitebody[$i]->class=='mw-disambig'||$first=='#'||$count>137)
		{
		}
		else
		{
			$string .= '<li>'.$A_sitebody[$i]->plaintext.'</li>';
			$count++;

		}
	}

	$string .= '</ol>';
	echo $string;
*/

   //echo $A_sitebody2;

?>