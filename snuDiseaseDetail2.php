<?
//특정 병명
//에 대해서 정의와 증상
//https://ko.wikipedia.org/wiki/당뇨병
//위의 링크에서 data 불러오기 
?>
<?php
	
	include('simple_html_dom.php');
	$dis = $_GET['dis'];

	echo $dis."<br>";

	$urlArray = explode(' ',$dis);
	$dis='';
	var_dump($urlArray);
	$index = 0 ;
	foreach($urlArray as $ua)
	{
		
		if($index==0)
		{
			$dis.=$ua;
		}
		else
		{	;
			$dis.='+';
			$dis.=$ua;
		}
		$index++;
	}
	echo '<br>'.$dis.'<br>';

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

   echo $url.'first url<br>';

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

		echo '<br>';
		$define = explode('*' ,$define);
		for($i=1;$i<sizeof($define);$i++)
		{	
			if($i==(sizeof($define)-1))
			{
				$cont = explode('.',$define[$i]);
				$define[$i] = $cont[0];
			}
			echo $define[$i].'<br>';
		}

	}

?>