<!doctype html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<style>
			body{opacity:0.3;}
			.contChoice{display:flex;width:50%;padding:5px;background:#f5f5f5;border-radius:5px;min-width:250px;}
			.contChoice .box{width:50%;background:white;border-radius:5px;padding:10px;margin:5px;}
			.contChoice .box label{width:22px;height:22px;background-image:url(Content/Images/ch.png);
			position:absolute;background-size:cover;background-position:center;margin-left:5px;margin-top:-0px;cursor:pointer;}
			.contChoice .box label.on{
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
		</style>
	</head>
	<body>
		<div class="contChoice">
			<div class="box"><span>Name</span><label text="Name" class="on"></label></div>
			<div class="box"><span>Symptom</span><label text="Symptom"></label></div>
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
	//------------ selected items embeded array print start ----------------
			var data = [];//증상 혹은 병명을 담을 배열 생성 

			function add(element){
				var text = $(element).html();
				data.push(text);//클릭한 내용을 배열에 담는다.
				console.log(data);

				//선택한 증상들을 담은 배열에서 가져와서 뿌려준다.
				$("#resultsChoice").html('');
				var str ='';

				for(var i=0;i<data.length;i++){
					str +='<div class="item">'+data[i]+'</div><br/>';
				}
				$("#resultsChoice").html(str);								
			}
	//------------ selected items embeded array print end ----------------
	//------------ Disease Name or Symptom choice box stsart ----------------

			$(function(){
				$('label').click(function(){
					var clicked = $(this);
					$(this).parent().parent().children('.box').children('label').removeClass('on');
					$(clicked).addClass('on');
					if($(clicked).attr('text')=='Name')
					{$('#content').val(0);}
					else
					{$('#content').val(1);}
					var plh = $(clicked).attr('text')+'을 조회합니다';
					$('#searchword').attr('placeholder',plh);
					$('#contentTitle').html($(clicked).attr('text'));
					data.splice(0,data.length);//배열을 삭제함
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
					url: 'snuKeyupProc3.php',
					contentType: false,
					data: formData,
					processData: false,
					success: function (response) {
						isUploading = false;			   
							//alert('가격 등록이 완료되었습니다.');
							//alert(response);
							if(Mode == 1)
							{	
								if(response.length>4){//한글로 나와서? response가 없을때 길이가 4이다.즉, 배열이 비어있을때.
									
									var myObj = JSON.parse(response);
									console.log(myObj);
									console.log(myObj.length);
									//var myObj = jQuery.parseJSON(myObj);

									var str ='';

									for(var i=0;i<myObj.length;i++){
										str +='<div class="item" onclick="add(this)">'+myObj[i]+'</div><br/>';
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