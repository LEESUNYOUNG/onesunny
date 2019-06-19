<!doctype html>
<html>
<!--진행 flow 
1.Name,Symptom선택
2.검색창에 내용입력
3.내용을 ajax 로 DB 에서 조회하여 data배열에 추가->data 배열 원소 목록으로 추출
4.증상 선택시 add함수 실행(countData 배열내 중복여부조회,count 증가,원소로 추가)
5.countData에 있는 내용 ajax로 조회하여 병명 가져오고 우선순위에 따라 출력해주기
-->
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="Content/textballoon.css">
		<script src="Content/controll.js"></script>
		<script src="Content/prototype.js"></script>
		<script src="Content/func.js"></script>
		<script src="Content/common.js"></script>
		<style>
			/*body{opacity:0.3;}*/
			.contChoice{display:flex;width:50%;padding:5px;background:#f5f5f5;border-radius:5px;min-width:250px;float:left;margin-top:30px;}
			.contChoice .box{width:50%;background:white;border-radius:5px;padding:10px;margin:5px;}
			.contChoice .box label{width:22px;height:22px;background-image:url(Content/Images/ch.png);
			position:absolute;background-size:cover;background-position:center;margin-left:5px;margin-top:-0px;cursor:pointer;}
			.contChoice .box.on label{
				background-image:url(Content/Images/ch_on.png);
			}
			#searchword{border:1px solid #eee;width:50%;margin:10px 2px;padding:5px;font-size:16px;border-radius:5px;}
			#searchword:focus{outline:none;}
			.item{border:1px solid #ccc;border-radius:5px;display:inline-block;padding:5px;overflow:hidden;margin:5px;}
			#results2, #resultsChoice{display:flex;flex-wrap:wrap}
			#results2 .item:hover{
				cursor:pointer;background:#23417c;color:white;opacity:0.8;
			}
			#resultsChoice .item{background:none;border:1px solid #23417c}
			h2{font-weight:500;color:#23417c}
			#info{width:14px;margin-left:34px;margin-top:4px;position:absolute;display:none;cursor:pointer;}
			.contChoice .box.on #info{display:initial;}
			#info:hover{opacity:0.8}
			.talk-bubble{position:absolute;margin-left:142px;margin-top:-66px;display:none;}
			.contChoice .box.on:hover .talk-bubble{display:block;}
		</style>
	</head>
	<body>
		<div style="overflow:hidden">
		<div class="contChoice">
			<div class="box on"><span>Name</span><label text="Name"></label></div>
			<div class="box" style="padding-right:5px">
				<span>Symptom</span><label text="Symptom"></label>
				<img id="info" src="Content/Images/mark50.png">
				<div class="talk-bubble tri-right left-in">
				  <div class="talktext">
					해당하는 증상을 모두 선택해주세요<br>
					ex,심각한 피로감을 느낀다.쉽게 피로해진다...
				  </div>
				</div>
			</div>
		</div>
		</div>
				
		
		<div id="search" clas="tab_content">
			<form id="frm" method="POST" enctype="multipart/form-data">
				<input name="searchword" type="text" id="searchword" style="width:300px" placeholder="Name을 조회합니다">
				<input type="hidden" id="content" name="content" value="0">
				<!--div style="border:1px solid red;width:200px;padding:10px 20px;cursor:pointer;" onclick="setMode(1)">submit</div-->
			</form>
		</div>
		<!--div id="results"></div-->
		<!--div 태그는 html 스크립트가 잘 먹지 않음-->
		<p id="results2">

		</p>
		<div style="border-top:5px dotted #23417c;opacity:0.7"></div>
		<h2>selected disease <font id="contentTitle">Name</font></h2>
		<p id="resultsChoice">

		</p>

		<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
		<script>
//------------ define array for Printing (disease or symptom) and Counting (diseaseIndex) ----------------	
			var data = [];//증상 혹은 병명을 담을 배열 생성
			var countData = [];//누적되는 symptom 을 병명 index 와 함께 count 

	//add함수 시작
	//------------ selected items embeded array print start ----------------
			function add(element){
				
				if($("#content").val()==0)//0,Name 상태면 다 비우고 하나만 추가
				{
					data.splice(0,data.length);//배열을 삭제함
					countData.splice(0,countData.length);//배열을 삭제함
				}
					
				var text = $(element).html();
				var diseaseId = $(element).attr('value');
				var symptomId = $(element).attr('symptomid');
				
				var item = {
					Name : text,
					DiseaseId : diseaseId,
					SymptomId : symptomId
				}
				var countItem = {
					DiseaseId : diseaseId,
					count : 1
				}
			//------------ %strat% data배열에 넣기 전에 중복되는 symptom을 또 선택했는지 체크한다.
			//체크해보고 없다면 data배열에 추가하고, count를 올려주는 countData에도 해주는게 의미가 있음
			//고유성은 병의 index가 아닌 symptom의 index로 하는 것이기 때문에 
			//걸리는 것을 제외하고 data와 countData배열에 넣어주면 됨.--------------------

				var check=true;
				for(var k=0; k<data.length;k++)
				{
					if(data[k]['SymptomId']==symptomId)
					{
						check = false;
					}
				}
				if(check)//선택한 증상중에 같은게 없다면,즉,중복이 없다면
				{
					data.push(item);//클릭한 내용(text,diseaseId) 을 배열에 담는다.
					countDataPush(countItem);//클릭한 내용의 diseaseId를 count 하기 위해 배열에 담는다.
				}
			//----------- %end% 중복성 체크 후 data, countData Insert 완료 --------------	
			
				//console.log('this is items: ' + item);
				console.log('this is count array: ' + countData);

				//선택한 증상들을 담은 배열에서 가져와서 뿌려준다.
				$("#resultsChoice").html('');
				var str ='';

				for(var i=0;i<data.length;i++){
					str +='<div class="item">'+data[i]['Name']+data[i]['DiseaseId']+'>>>'+data[i]['SymptomId']+'</div><br/>';
				}
				$("#resultsChoice").html(str);	
			//----------- countData개수에 따라서 관련 병 가져오기 -------------
				
				if($("#content").val())//1,Symptom 상태면 병명찾으러 다녀오기
				{
					setupList(countData);
				}
			}
	//------------ selected items embeded array print end ----------------
	//add 함수 종료
	
	//setupList함수 시작
			function setupList(dataArr){
				//var testArr = JSON.stringify(dataArr);
				
				//var pars = testArr.join('&');
				
				//console.log('testArr');
				var testArr = JSON.stringify(dataArr);

				test = {"test" : testArr};


				//var postData = ({dataArr});
				//console.log('testArr'+testArr);

				$.ajax({
					type: "POST",
					url: "snuKeyupProc7_2.php",
					data: test,
					success: function (response) {
						//var test =  JSON.parse(response);
						alert(response);

						//console.log('here'+test);
						//console.log(test);
					},
					error: function (msg) {
						alert('error'+msg.d);
					}
				});		
			}
	//setupList함수 종료

	//------------ check exist before push CountItem into Array start -----------
			function countDataPush(element)
			{
				var diseaseIndex = element['DiseaseId'];
				var check = true;
				for(var i=0;i<countData.length;i++)
				{
					//이미 countData array 에 있으면 / 배열에 원소로 /추가 안하고 count만 올려준다.
					if (diseaseIndex == countData[i]['DiseaseId']) 
					{
						countData[i]['count']++;
						console.log('here is '+countData[i]['count']);
						check = false;
					}
				}
				if(check)
				{
					countData.push(element);
				}
				
			}
	//------------ check exist before push CountItem into Array end -----------
	

	//------------ Disease Name or Symptom choice box start ----------------

			$(function(){
				$('label').click(function(){
					var clicked = $(this);
					$(this).parent().parent().children('.box').removeClass('on');
					$(clicked).parent().addClass('on');
					if($(clicked).attr('text')=='Name')
					{$('#content').val(0);}
					else
					{$('#content').val(1);}
					var plh = $(clicked).attr('text')+'을 조회합니다';
					$('#searchword').attr('placeholder',plh);
					document.getElementById('searchword').value='';
					$('#contentTitle').html($(clicked).attr('text'));
					data.splice(0,data.length);//배열을 삭제함
					countData.splice(0,countData.length);//배열을 삭제함
					$("#results2").html('');
					$("#resultsChoice").html('');
				});
			});
	//------------ Disease Name or Symptom choice box end ----------------
	//------------ Key up then start searching / start  ----------------

			$(document).ready(function(){
				searchajax();
			});

			function searchajax(){
				$('#searchword').keyup(function(){
					var words = $(this).val();
					var formData = new FormData($('#frm'));
					if(words!='')
					{
						//console.log(words);
						//$('#results').html(words);
			
						setMode(1);
					}
					else
					{
						$("#results2").html("검색어를 입력해주세요");
					}
				
				});
			}

			function setMode(val)
			{
				Mode = val;
				$('#frm').submit();
			}

			 var isUploading = false;

			 $('#frm').submit(function (e) {
				e.preventDefault();
				//if($('#Description').val() == '' ){ alert('별명을 입력하세요');$('#Description').focus();return false;}
				//if($('#Birth').val() == '' ){ alert('출생년도를 입력하세요');$('#Birth').focus();return false;}
				//if($('#Email').val() == '' ){ alert('출생년도를 입력하세요');$('#Email').focus();return false;}

				if(isUploading) {
					alert('업로드 중입니다. 잠시만 기다려 주세요');
					return false;
				}

				var formData = new FormData(this);

				isUploading = true;
				$.ajax({
					type: 'POST',
					url: 'snuKeyupProc7.php',
					contentType: false,
					data: formData,
					processData: false,
					success: function (response) {
						isUploading = false;			   
							//alert('가격 등록이 완료되었습니다.');
							//console.log(response);
							//console.log(response.length);
							if(Mode == 1)
							{	
								if(response.length>4){//배열을 가져오므로, 가져온 배열 원소가 1개 이상일때
									
									var myObj = JSON.parse(response);
									console.log(myObj);
									console.log(myObj.length);
									//var myObj = jQuery.parseJSON(myObj);

									var str ='';

									for(var i=0;i<myObj.length;i++){
										str +='<div class="item" onclick="add(this)" value="'+myObj[i]['DiseaseId']+'" symptomid="'+myObj[i]['SymptomId']+'">'+myObj[i]['Name']+'</div><br/>';
									}
									//$("#results").html(str);//똑같은 코드인데 애만 잘 작동을 안한다.

									//console.log('hi>>>'+str);
									$("#results2").html(str);
									
									//$('#results').html(myObj[1]);

								}
								else{
									console.log('response length'+response.length);
									$("#results").html("결과가 없습니다");
									$("#results2").html("결과가 없습니다");
									}
							}
							else
							{
								//location.reload();
							}
					},
					error: function(response) {
						isUploading = false;
					}
				});
				return false;
			});
			
	//------------ Key up then start searching / end  ----------------
		</script>
	</body>
</html>