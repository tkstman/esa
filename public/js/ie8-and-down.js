//HANDLERS FOR ADD MODAL START
$(document).ready( function()
{
	if(typeof $('#addNew') != 'undefined'){
		$('#addNew').unbind('click');		
		$('#addNew').click( function(){
			$('#add-modal').addClass('show');
		});	
	}
	
	if(typeof $('.edit') != 'undefined'){
		console.log("edits");
		$('.edit').unbind('click');		
		$('.edit').click( function(){
			$('#edit-modal').addClass('show');
		});	
	}
	
	if(typeof $('#closeadd') != 'undefined'){
		$('#closeadd').click( function()
		{
			console.log("close add");
			$('#add-modal').removeClass('show');
		});
	}
	
	if(typeof $('#closeedit') != 'undefined'){
		$('#closeedit').click( function()
		{
			console.log("close edit");
			$('#edit-modal').removeClass('show');
		});
	}
});






//HANDLERS FOR ADD MODAL END





//HANDLER FOR KEY UP EVENT IN TEXT SEARCH FIELD
var timer;
function up(ev)
{
	
	timer= setTimeout(function()
	{
		
		if(ev.keyCode ==27)
		{

			$('#searchapp').val("");
		}
		var keywords = $.trim($('#searchapp').val());

		$("#search").remove();								//REMOVE THE OLD SEARCH RESULT FROM HTML
		if(keywords.length >0 && keywords.match(/^[a-zA-Z0-9 ]+/))
		{
			jQuery.ajaxSetup({
				xhr: function() {
						//return new window.XMLHttpRequest();
						try{
							if(window.ActiveXObject)
								return new window.ActiveXObject("Microsoft.XMLHTTP");
						} catch(e) { }

						return new window.XMLHttpRequest();
					}
			});
			
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			
			$('#searchapp').val = keywords;
			console.log(keywords);
			console.log($('#searcher').serialize());
			$('#searcher').ajaxForm({
				type: 'POST',
				url: url,
				data :$('#searcher').serialize(),
				// processData: false,
				// contentType: false,
				// dataType: 'json',
				success: function(responseText){
						$('#appscontainer').append(responseText.html);
						$("#searchslide").trigger("click");
					}
			});
			$('#searcher').submit();
			
			//console.log("end");
			
			// var datam = new FormData($('#searcher'));
			// datam.append('searchvalue', keywords);
			// datam.append('_token', token);
			
			// $.ajax({
			// type: 'POST',
			// url: url,
			// data :datam,
			// processData: false,
			// contentType: false,
			// dataType: 'json'
			
			// }).done(function (msg) {
				// $('#appscontainer').append(msg.html);
				
				// //get the currently selected slideout and have it slide away from view
				
				// //slideout the search container and add active to it
				// $("#searchslide").trigger("click");
			// });
		}
		return false;
	},500);
}

/*
	THESE WERE COMMENTED OUT AS THEY WERE PREVIOUSLY DEFINED IN MAIN.JS. ASSIGNING THESE EVENT LISTENERS DO NOT REMOVE THE ORIGINAL EVENT LISTENERS
	HOWEVER BY REDEFINING THE FUNCTIONS LIKE THE ABOVE; WE ARE ABLE TO CHANGE WHAT HAPPENS WHEN THAT EVENT IS TRIGGERED.
*/
// function down()
// {
	// clearTimeout(timer);
// };


// $('#searchapp').on('keyup', function(ev) {
	// console.log("end");
	// //up(ev);
// });


// $('#searchapp').on('keydown', function() {
	// down();
// });
