<!doctype html>
<html>
	<head>
		<style>
			ul{border:1px solid #333;padding:50px;width:50%;min-width:900px;margin:10px auto;}
			li{margin:20px;}
			a{text-decoration:none;background:#ffff7c;font-size:16px;}
			.plot{background:powderblue;}
			.plot li{background:white;border-radius:5px;padding:10px;}
			span{background:yellow;}
		</style>
	</head>
	<body>
		<ul>
			<li><a href="http://onesunny3.cafe24.com/crawler/diseaseDetail.php?dis=%EB%8B%B9%EB%87%A8">diseaseDetail.php</a><br>
				wiki에서 dis로 정의된 질환에 대한 정의와 증상 가져오기(*** 잘 작동 못함)
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/diseaseDetail2.php?dis=%EB%8B%B9%EB%87%A8">diseaseDetail2.php</a><br>
				wiki에서 dis로 정의된 질환에 대한 정의와 증상 가져오기(*** 잘 작동 못함)<br>
				space 로 구분된 내용에 대해서 / 질병으로 구분하는것이 아닌<br>
				<b>글자수에 따라 내용을 더 가져오도록 만듬(** 잘 작동 못함)</b>
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/diseaseDetail3.php?dis=%EB%8B%B9%EB%87%A8">diseaseDetail2.php</a><br>
				wiki에서 dis로 정의된 질환에 대한 정의와 증상 가져오기(*** 잘 작동 못함)<br>
				space 로 구분된 내용에 대해서 / 질병으로 구분하는것이 아닌<br>
				글자수에 따라 내용을 더 가져오도록 만듬(** 잘 작동 못함)<br>
				<b>위와 같음. 뭘 한건지 모르겠음.;;</b>
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/diseaseInsert.php">diseaseInsert.php</a><br>
				wiki에서 지정한 병 목록을 DB Disease table 에 insert 하는 php<br>
				새로고침시 데이터가 들어가므로 유의
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/diseaseInsert2.php">diseaseInsert2.php</a><br>
				wiki에서 지정한 병 목록을 DB Disease table 에 insert 하는 php<br>
				새로고침시 데이터가 들어가므로 유의<br>
				이전보다 발전된 형태. 클래스명이 달라서 들어가지 않던 내용들 까지 포함할 수 있도록 코드 수정.
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/diseaseInsert2_dump.php">diseaseInsert2_dump.php</a><br>
				크롤링 insert 없음 -시연
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/diseaseList.php">diseaseList.php</a><br>
				wiki에서 지정한 병 목록을 크롤링해서 리스트 업 하는 페이지<br>
				클래스명이 달라서 들어가지 않던 내용들 까지 포함할 수 있도록 코드 수정.
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/diseaseRead.php">diseaseRead.php</a><br>
				DB의 Disease table 에 들어있는 병 리스트를 읽어와서 보여주는 페이지
			</li>
		</ul>
		<ul>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuDiseaseDetail.php?dis=%EA%B0%90%EA%B8%B0">snuDiseaseDetail.php</a><br>
				서울대병원 페이지에서/ 검색창에서/ dis에 해당하는 병명을 검색(1)/병명 select 페이지(2)/ 병에 대한 detail 정보 페이지 (3)/ 의 순서로 3depth 로 들어감. 들어가서 병의 증상을 보여줌.<br>
				증상에 대한 링크가 중간에 누락된 경우 오류가 발생할 수 있음.
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuDiseaseDetail2.php?dis=%EA%B0%90%EA%B8%B0">snuDiseaseDetail2.php</a><br>
				서울대병원 페이지에서/ 검색창에서/ dis에 해당하는 병명을 검색(1)/병명 select 페이지(2)/ 병에 대한 detail 정보 페이지 (3)/ 의 순서로 3depth 로 들어감. 들어가서 병의 증상을 보여줌.<br>
				<b>병명이 없거나 /증상에 대한 링크가 없는 경우/ 에 대한 exception 처리를 해둠</b>
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuDiseaseInsert.php?" target="blank">snuDiseaseInsert.php</a><br>
				서울대병원 페이지에서/ 검색창에서/<br>
				가/나/다... 와 같은 순서로 정리된 병명 리스트를 모두 DB SnuDisease에 넣음<br>
				이때, 병명/ url / 카테고리 &nbsp;순서로 내용물을 넣는다.<br>
				여기서 말하는 url 은 병에 대해 detail 하게 설명한 페이지를 의미<br>
				insert 기능은 해지해두었으므로 새로고침하면 링크만 조회가 되고 insert 안됨.
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuDiseaseList.php">snuDiseaseList.php</a><br>
				서울대병원 페이지에서/ 검색창에서/<br>
				가/와 같은 특정 word 에 대한 병명 리스트/url 까지 조회하는 기초적인 화면
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuDiseaseList.php">snuDiseaseList.php</a><br>
				서울대병원 페이지에서/ 검색창에서/<br>
				가/나/다... 와 같은 순서로 정리된 병명 리스트를 모두 <br>
				병명 리스트/url 까지 조회하는 발전된 조회 화면
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuDiseaseMingle.php">snuDiseaseMingle.php</a><br>
				DB에 이미 입력한 / 병명/url /symptom 20개 에 대해서 /<br>
				20개의 증상을 종합해서 뭉쳐둘 symptom 이라는 열이 필요하다. <br>
				따라서 symptom 이 null이 아닌 병의 행들만 골라내서 <br>
				data를 모두 string으로 붙여버리고 / <br>symptom이라는 열에 추가해버린다.<br>
				이때 insert 쿼리는 주석처리해서 작동하지 않으므로 새로고침을 해도 문제가 되지 않으며<br>
				db에 있는 내용만을 갖고 작업하므로 crawl함수는 필요하지 않음.
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuDiseaseRead.php">snuDiseaseRead.php</a><br>
				DB에 이미 입력한 / 병명/url 에 대해서 <br>
				각 증상들을 crawl해온다. 즉 crawl함수가 필요하며 현재DB 의 SnuDisease안에 있는 800여개의 항목에 대해서
				모두 실행하게 될 경우 과부하가 오므로 30개씩만 조회할 수 있도록 되어있다.<Br>
				현재 60번째 부터 30개 조회하도록 되어있음.<br>
				증상이 없을 경우 '증상이 없습니다.'라고 표현되도록 함.
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuDiseaseSymptomInsert.php">snuDiseaseSymptomInsert.php</a><br>
				DB에 이미 입력한 / 병명/url 에 대해서 <br>
				각 증상들을 crawl해온다. 즉 crawl함수가 필요하며 현재DB 의 SnuDisease안에 있는 800여개의 항목에 대해서
				모두 실행하게 될 경우 과부하가 오므로 30개씩만 조회할 수 있도록 되어있다.<Br>
				crawl한 상세 증상들을 db에 30개씩 넣는다.<br>
				증상이 없는 경우 넣지 않게 되어있음.<br>
				<b>가장 발전된 형태의 crawl 함수</b>
				30개의 수행이 끝나면 redirect 할 수 있도록 함. 기본으로 id값을 붙이지 않으면 0~30이고 <br>
				끝나면 숫자를 30씩 추가해가면서 850이상의 숫자가 되면 <br>
				finish alert를 보내고 자동으로 stop하게 되어있다.
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuKeyup.php">snuKeyup.php</a><br>
				아주 기초적인 형태의 내용.쓸모없음. 
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuKeyup2.php">snuKeyup2.php</a><br>
				<span>현재 DB의 SnuDisease 테이블에 추가된 항목들에 대해서 <br>
				내가 input 창에 내용을 칠때마다 조회해서 관련된 내용을 아래에 띄워준다.</span>
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuDiseaseSymptomUp.php">snuDiseaseSymptomUp.php</a><br>
				DB의 SnuDiseaseSymptom 테이블에 /<br>
				SnuDisease 테이블의 각 Symptom들을 구분하여 모조리 넣는다./<br>
				Id/Symptom/DiseaseId(원래 병명 아이디)/SymptomIndex(원래 병명에서 몇번째 Symptom인지 ex.Symptom1)
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuKeyup3.php">snuKeyup3.php</a><br>
				현재 DB의 SnuDisease 테이블에 추가된 항목들에 대해서 <br>
				내가 input 창에 내용을 칠때마다 조회해서 관련된 내용을 아래에 띄워준다.<br>
				------------<br>
				<span>내가 select 하는 내용이 data 배열에 담겨서 나열되어 보여진다.</span>
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuKeyup4.php">snuKeyup4.php</a><br>
				현재 DB의 SnuDisease 테이블에 추가된 항목들에 대해서 <br>
				내가 input 창에 내용을 칠때마다 조회해서 관련된 내용을 아래에 띄워준다.<br>
				------------<br>
				내가 select 하는 내용이 data 배열에 담겨서 나열되어 보여진다.<br>
				------------<br>
				<span>countData라는 배열을 생성하여 / 같은 diseaseIndex가 중복 추가 되지 않게 하고 counting 할 수 있도록 구분<br>
				name 의 경우에는 배열에 추가되지 않게 ,즉, 한개씩만 선택되게함<br>
				symptom 의 경우에는 배열에 추가가되고 / 반복되는 내용에 대해서는 count 만 올려주게 만듬<br>
				그 외에 자잘한 기능들 ( check box 새로 선택시 박스 두개 내용 비우기)</span>
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuKeyup6.php">snuKeyup6.php</a><br>
				현재 DB의 SnuDisease 테이블에 추가된 항목들에 대해서 <br>
				내가 input 창에 내용을 칠때마다 조회해서 관련된 내용을 아래에 띄워준다.<br>
				------------<br>
				내가 select 하는 내용이 data 배열에 담겨서 나열되어 보여진다.<br>
				------------<br>
				countData라는 배열을 생성하여 / 같은 diseaseIndex가 중복 추가 되지 않게 하고 counting 할 수 있도록 구분<br>
				name 의 경우에는 배열에 추가되지 않게 ,즉, 한개씩만 선택되게함<br>
				symptom 의 경우에는 배열에 추가가되고 / 반복되는 내용에 대해서는 count 만 올려주게 만듬<br>
				그 외에 자잘한 기능들 ( check box 새로 선택시 박스 두개 내용 비우기)<br>
				------------<br>
				<span>countData에 있는 내용 ajax로 조회하여 병명 가져오고 우선순위에 따라 출력해주기[실패]</span>
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuKeyup7.php">snuKeyup7.php</a><br>
				현재 DB의 SnuDisease 테이블에 추가된 항목들에 대해서 <br>
				내가 input 창에 내용을 칠때마다 조회해서 관련된 내용을 아래에 띄워준다.<br>
				------------<br>
				내가 select 하는 내용이 data 배열에 담겨서 나열되어 보여진다.<br>
				------------<br>
				countData라는 배열을 생성하여 / 같은 diseaseIndex가 중복 추가 되지 않게 하고 counting 할 수 있도록 구분<br>
				name 의 경우에는 배열에 추가되지 않게 ,즉, 한개씩만 선택되게함<br>
				symptom 의 경우에는 배열에 추가가되고 / 반복되는 내용에 대해서는 count 만 올려주게 만듬<br>
				그 외에 자잘한 기능들 ( check box 새로 선택시 박스 두개 내용 비우기)<br>
				------------<br>
				<span>countData에 있는 내용 ajax로 조회하여 병명을 가져오기 위해, countData자체를 Proc2페이지로 전달했음. 성공적으로 countData의 count와 id등의 내용을 다룰 수 있게 됨.[미완이지만 핵심 기술이 들어있음<br>매우매우 소중함</span>
			</li>
			<li><a href="http://onesunny3.cafe24.com/crawler/snuKeyup8.php">snuKeyup8.php</a><br>
				현재 DB의 SnuDisease 테이블에 추가된 항목들에 대해서 <br>
				내가 input 창에 내용을 칠때마다 조회해서 관련된 내용을 아래에 띄워준다.<br>
				------------<br>
				내가 select 하는 내용이 data 배열에 담겨서 나열되어 보여진다.<br>
				------------<br>
				countData라는 배열을 생성하여 / 같은 diseaseIndex가 중복 추가 되지 않게 하고 counting 할 수 있도록 구분<br>
				name 의 경우에는 배열에 추가되지 않게 ,즉, 한개씩만 선택되게함<br>
				symptom 의 경우에는 배열에 추가가되고 / 반복되는 내용에 대해서는 count 만 올려주게 만듬<br>
				그 외에 자잘한 기능들 ( check box 새로 선택시 박스 두개 내용 비우기)<br>
				------------<br>
				<span>countData에 있는 내용 ajax로 조회하여 병명 가져오고 우선순위에 따라 출력해주기[미완이지만 핵심 기술이 들어있음<br>매우매우 소중함</span><br>
				----------------------------------------<br>
				완성,,countData에 있는 내용을 ajax로 조회하여 병명을 가져왔고 우선순위에 따라 배열 정리 완료.<br>
				그 내용을 다시 client의 출력페이지로 전송하여 script 로 json 배열로 정리했다. <br>
			</li>
			<li>
				<a href="Content/1.png">병명입력 테이블</a><br>
				<a href="Content/2.png">병명 및 증상 테이블</a><br>
				<a href="Content/3.png">병명개수</a><br>
				<a href="Content/4.png">병명과 증상간에 외래키로 병명 id 사용</a><br>
				<a href="Content/5.png">총 증상의 개수</a><br><br>
				<a href="Eloud/main.php">Eloud Main</a><br><br>
				경막하 출혈 => 기면상태,혼란상태,만성 경막하 출혈의 증상은 다음과 같다.<br>
				뇌종양 => 균형 감각을 상실한다,발음이 분명치 않다.,시각 장애가 나타난다.,구역과 구토를 한다.<br>
				두부손상 => 복시, 구토를 동반하는 두통, 의식이 혼미해지며 졸음이 온다.<br><br>

				의식이 혼미해지며 졸음이 온다./기면 상태/발음이 분명치않다/복시/혼란 상태/구역과 구토를 한다/구토를 동반하는 두통
			</li>


		</ul>
		<ul class="plot">
			<h1>plot twist</h1>
			<li>
				병명 검색하기
				<ul>
					<li>병명이 있는 경우 클릭하기</li>
					<li>병명이 없는 경우 비슷한 이름의 병 + 검색결과 보기</li>
				</ul>
			</li>
			<li>
				증상 입력하기
			</li>
		</ul>
	</body>
</html>