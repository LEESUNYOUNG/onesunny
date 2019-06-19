<?
//질병목록
//https://ko.wikipedia.org/wiki/%EC%A7%88%EB%B3%91_%EB%AA%A9%EB%A1%9D
//위의 링크에서 data 불러오기 
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
   $A_sitebody = $dom->find('ul li a');
   $A_sitebody2 = $dom->find('ol li a');
   $A_sitebody3 = $dom->find('dl li a');

   //$A_sitebody2 = $dom2->find('h1#firstHeading',0)->plaintext;
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


	$cnt =  sizeof($A_sitebody2);
	echo $cnt;

	$count = 0;
	for($i=0;$i<$cnt;$i++)
	{
		$first = substr($A_sitebody2[$i]->href,0,1);
		if($A_sitebody2[$i]->class=='mw-redirect'||$A_sitebody2[$i]->class=='mw-disambig'||$first=='#')
		{
		}
		else
		{
			$string .= '<li>'.$A_sitebody2[$i]->plaintext.'</li>';
			$count++;

		}
	}

	$cnt =  sizeof($A_sitebody3);
	echo $cnt;

	$count = 0;
	for($i=0;$i<$cnt;$i++)
	{
		$first = substr($A_sitebody3[$i]->href,0,1);
		if($A_sitebody3[$i]->class=='mw-redirect'||$A_sitebody3[$i]->class=='mw-disambig'||$first=='#')
		{
		}
		else
		{
			$string .= '<li>'.$A_sitebody3[$i]->plaintext.'</li>';
			$count++;

		}
	}



	$string .= '</ol>';
	echo $string;

   //echo $A_sitebody2;

?>