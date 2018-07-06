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
		$('.edit').unbind('click');		
		$('.checkbox').unbind('click');	
		$('.edit').click( function(){
			$('#edit-modal').addClass('show');
		});	
		
		$('.checkbox').on('click', function (event) {
			if(this.checked)
			{
				console.log(this.parentNode.parentNode.parentNode.childNodes[2]);
				//change the edit fields source input type to text and set a placeholder to accept url for the ADD Modal
				$(this.parentNode.parentNode.parentNode.childNodes[0]).addClass('hide'); 
				$(this.parentNode.parentNode.parentNode.childNodes[2]).removeClass('hide'); 
				
				//swap names
				$(this.parentNode.parentNode.parentNode.childNodes[2]).attr('name',$(this.parentNode.parentNode.parentNode.childNodes[0]).attr('name') ); //set input name for link input 
				
				$(this.parentNode.parentNode.parentNode.childNodes[0]).attr('name',$(this.parentNode.parentNode.parentNode.childNodes[2]).attr('id') ); //set the input name for file input
				
				$(this.parentNode.parentNode.parentNode.childNodes[2]).attr('id',$(this.parentNode.parentNode.parentNode.childNodes[0]).attr('id') ); //set input id for link input 
				
				$(this.parentNode.parentNode.parentNode.childNodes[0]).attr('id',$(this.parentNode.parentNode.parentNode.childNodes[0]).attr('name') );//set the input id for file input
				console.log(this.parentNode.parentNode.parentNode.childNodes[2]);
				//this.parentNode.parentNode.parentNode.childNodes[0].placeholder = 'Enter Url | http://intranet';
			}
			else
			{
				//change the edit fields source input text to file  for the ADD Modal
				$(this.parentNode.parentNode.parentNode.childNodes[0]).removeClass('hide'); 
				$(this.parentNode.parentNode.parentNode.childNodes[2]).addClass('hide'); 
				
				//swap names
				$(this.parentNode.parentNode.parentNode.childNodes[2]).attr('name',$(this.parentNode.parentNode.parentNode.childNodes[0]).attr('name') ); //set input name for link input 
				
				$(this.parentNode.parentNode.parentNode.childNodes[0]).attr('name',$(this.parentNode.parentNode.parentNode.childNodes[2]).attr('id') ); //set the input name for file input
				
				$(this.parentNode.parentNode.parentNode.childNodes[2]).attr('id',$(this.parentNode.parentNode.parentNode.childNodes[0]).attr('id') ); //set input id for link input 
				
				$(this.parentNode.parentNode.parentNode.childNodes[0]).attr('id',$(this.parentNode.parentNode.parentNode.childNodes[0]).attr('name') );//set the input id for file input
			}
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




