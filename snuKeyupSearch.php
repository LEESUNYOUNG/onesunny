<!doctype html>
<html>
	<head>
	</head>
	<body>
		<div id="search" clas="tab_content">
			<form id="frm" method="POST" enctype="multipart/form-data">
				<input name="searchword" type="text" id="searchword" style="width:300px">
				<!--div style="border:1px solid red;width:200px;padding:10px 20px;cursor:pointer;" onclick="setMode(1)">submit</div-->
			</form>
		</div>
		<!--div id="results"></div-->
		<!--div 태그는 html 스크립트가 잘 먹지 않음-->
		<p id="results2">

		</p>
		<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
		<script>
			$(document).ready(function(){
				searchajax();
			});
			function searchajax(){
				$('#searchword').keyup(function(){
					var words = $(this).val();
					
					var formData = new FormData($('#frm'));
				
					if(words!='')
					{	
						setMode(1);
					}else{$("#results2").html("검색어를 입력해주세요");}
				
					
					
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
					alert('검색 중입니다. 잠시만 기다려 주세요');
					return false;
				}

				var formData = new FormData(this);

				isUploading = true;
				$.ajax({
					type: 'POST',
					url: 'snuKeyupProc2.php',
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
									//console.log(myObj);
									//console.log(myObj.length);
									//var myObj = jQuery.parseJSON(myObj);

									var str ='';

									for(var i=0;i<myObj.length;i++){
										str +='<span>'+myObj[i]+'</span><br/>';
									}
									//$("#results").html(str);//똑같은 코드인데 애만 잘 작동을 안한다.
									$("#results2").html(str);

								}
								else{
									//console.log('response length'+response.length);
									//$("#results").html("결과가 없습니다");
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
		</script>
	</body>
</html>