<!doctype html>
<html>
	<head>
	</head>
	<body>
		<div id="search" clas="tab_content">
			<input type="text" id="searchword" style="width:300px">
		</div>
		<div id="results"></div>
		<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
		<script>
			$(document).ready(function(){
				searchajax();
			});
			function searchajax(){
				$('#searchword').keyup(function(){
					var words = $(this).val();
					if(words!=''){
						//console.log(words);
						//$('#results').html(words);
						$.ajax({
							type:'POST',
							url:'snuKeyupProc.php',
							data:{searchwords:words},
							contentData: false,//이거 안넣어주면 에러남!! 
							processData: false,
							//dataType:'json',
							success:function(result){
								if(result.length>0){
									var myObj = JSON.parse(result);

									var str ='';
									for(var i=0;i<myObj.length;i++){
										str +='<span>'+myObj[i]+'</span><br/>';
									}
									$("#results").html(str);
									
									//$('#results').html(myObj[1]);

								}
								else{$("#results").html("");}
							},
							error:function(e){console.log('error:'+e.status);}
						});
						
						}else{$("#results").html("");}
				
				});
			}
		</script>
	</body>
</html>