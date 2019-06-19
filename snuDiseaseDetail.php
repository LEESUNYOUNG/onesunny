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
   $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/5';
   //질병목록
   $url ='http://www.snuh.org/health/encyclo/search.do?searchKey=W&searchWord='.$dis;

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

   $newHref = "http://www.snuh.org/health/encyclo".$string;
   $url = $newHref;

   echo $url.'<br>';

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
		echo $newHref;
	
  //--------------------------

	   $newHref = "http://www.snuh.org/".$newHref;
	   $url = $newHref;

	   echo '<br>'.$url;

	   
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


		echo '<br>'.$define;


	}

?>