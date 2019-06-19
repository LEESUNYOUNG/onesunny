<?php

include('simple_html_dom.php');

   $ch = curl_init();

   $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/5';
   curl_setopt($ch, CURLOPT_URL, 'https://en.wikipedia.org/wiki/Diabetes_mellitus');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
   curl_setopt($ch, CURLOPT_TIMEOUT, 10);
   curl_setopt($ch, CURLOPT_HEADER, false);
   curl_setopt($ch, CURLOPT_REFERER, 'https://en.wikipedia.org/wiki/Diabetes_mellitus');
   curl_setopt($ch, CURLOPT_USERAGENT, $agent);
   $content = curl_exec($ch);
   curl_close($ch);



   // content 뿌려지면 가져오기 성공

   //echo $content;



   // html dom parser

   $dom = new simple_html_dom();

   $dom->load($content);

   // body 태그의 내용을 담는다 (body 태그 포함)

   $A_sitebody = $dom->find('div#siteSub',0);

   echo $A_sitebody

?>