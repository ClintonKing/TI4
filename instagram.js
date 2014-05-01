// JavaScript Document


//Use this url below to get your access token
//https://instagram.com/oauth/authorize/?display=touch&client_id=f75ff22c56a7444685521fb8bf9aa4d8&redirect_uri=http://www.clintonjking.com/instagram&response_type=token 

//if you need a user id for yourself or someone else use:
//http://jelled.com/instagram/lookup-user-id
	
						
$(function() {
	
	var apiurl = "https://api.instagram.com/v1/tags/dota2/media/recent?access_token=12122031.f75ff22.93e2730555f642829b702c6115f069ab&callback=?&count=14"
	var access_token = location.hash.split('=')[1];
	var html = ""
	
		$.ajax({
			type: "GET",
			dataType: "json",
			cache: false,
			url: apiurl,
			success: parseData
		});
				
		
		function parseData(json){
			console.log(json);
			
			$.each(json.data,function(i,data){
				
				html += "<img class='instas' src ='" + data.images.thumbnail.url +"'>"
			});
			
			console.log(html);
			$("#instagram").append(html);
			
		}
		
		
                
               
 });
		
		
		
		
	

		
