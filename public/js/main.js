var postId = 0;
var postBodyElement = null;
//console.log('PostId =' + postId);

// The function actually applying the offset
/* function offsetAnchor() {
    if (location.hash.length !== 0) {
        window.scrollTo(window.scrollX, window.scrollY - 80);
    }
}

// This will capture hash changes while on the page
$(window).on("hashchange", function () {
    offsetAnchor();
});

// Let the page finish loading.
$(document).ready(function() {
    offsetAnchor();
}); */

$(document).ready(function(){
	$('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();

	    var target = this.hash;
	    var $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top-110
	    }, 900, 'swing', function () {
	        window.location.hash = target-120;
	    });
	});
});


function isUrlJs(value)
{
    var validation = new RegExp('^((http|https|ftp)?:\\/\\/){1}?'+ // protocol
  '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)*[a-z]{2,}|'+ // domain name and extension
  '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
  '(\\:\\d+)?'+ // port
  '(\\/[-a-z\\d%@_.~+&:]*)*'+ // path
  '(\\?[;&a-z\\d%@_.,~+&:=-]*)?'+ // query string
  '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    return validation.test(value);
}

/*
*Clear Modal
*/

function clearEditFields()
{
    $('#app_name').val('');
    $('#app_file').val('');
    $('#app_manual').val('');
    $('#app_readme').val('');
    $('#edit_name').val('');
    $('#edit_file').val('');
    $('#edit_manual').val('');
    $('#edit_readme').val('');
    $('#edit_name').attr('data-text','');
    $('#edit_file').attr('data-text','');
    $('#edit_manual').attr('data-text','');
    $('#edit_readme').attr('data-text','');
    $('#edit_files').attr('data-text','');
    $('#edit_manuals').attr('data-text','');
    $('#edit_readmes').attr('data-text','');
    $('.success').removeClass('success');
    $('.editcheckbox').each(function(){
        if($(this).is(':checked'))
        {
            $(this).trigger('click');
        }
    });
    $('.checkbox').each(function(){
        if($(this).is(':checked'))
        {
            $(this).trigger('click');
        }
    });
}

/**
Load Info Into Edit Modal
**/
$('.post').find('.interaction').find('.edit').on('click', function (event) {
    event.preventDefault();
    clearEditFields();
    
    /*
    Need to check if values being supplied to Modal are url and have Modal updated accordingly
    */
    
    //Get App Name
    postBodyElement =event.target.parentNode.parentNode; //Posted Article Element
    //console.log(postBodyElement);
    var postName = postBodyElement.childNodes[1].textContent.trim(); //The posted App Name from html
    postId = event.target.parentNode.parentNode.dataset['postid'];//Posted Article Element data-attribute called postid
    //console.log(event.target.parentNode.parentNode);
    $('#edit_name').val(postName); //Set the Edit Modals Name Field To posted App Name from html
    $('#edit_name').attr('data-text',postName);
    
    //Get App File
    if(event.target.parentNode.parentNode.childNodes[3].childNodes[0]) //Check if the App Exe file Link exists in the htmlw
    {
        //console.log(event.target.parentNode.parentNode.childNodes[3].childNodes[0]);
        //Get the data-name element value and assign the it to the edit modal's file name text dummy field
        var postFile = event.target.parentNode.parentNode.childNodes[3].childNodes[0].getAttribute('data-name');
         //console.log(postFile);
        //if the value is a link
        if(isUrlJs(postFile))
        {
            //issue check box click event for current Input field section on edit modal
            document.getElementById('edit_files').parentNode.childNodes[5].childNodes[3].childNodes[1].childNodes[1].click();
            
            
       // console.log(document.getElementById('edit_files').parentNode.childNodes[5].childNodes[3].childNodes[3].childNodes[1]);
            //Set Actually Input Field To data attibute value
            $('#edit_files').val(postFile);
            $('#edit_files').attr('data-text',postFile);
        }
        else
        {
            postFile = postFile.substr(postFile.indexOf("/") + 1, postFile.length - 1);
            postFile = postFile.substr(postFile.indexOf("/") + 1, postFile.length - 1);
            $('#edit_file').val(postFile);
            $('#edit_file').attr('data-text',postFile);
        }        
        
    }
    
    
    //Get App Manual
    
    if(event.target.parentNode.parentNode.childNodes[3].childNodes[2] && event.target.parentNode.parentNode.childNodes[3].childNodes[2].dataset.title=="manual") //Check if the Manual file Link exists in the htmlw
    {
        //Get the data-name element value and assign the it to the edit modal's Manual text dummy field
        //console.log(event.target.parentNode.parentNode.childNodes[3].childNodes[2]);
        var postMan = event.target.parentNode.parentNode.childNodes[3].childNodes[2].getAttribute('data-name');
       
        
        console.log(postMan);
        //if the value is a link
        if(isUrlJs(postMan))
        {
            //issue check box click event for current Input field section on edit modal
            document.getElementById('edit_manuals').parentNode.childNodes[5].childNodes[3].childNodes[1].childNodes[1].click();
            
            //Set Actually Input Field To data attibute value
            $('#edit_manuals').val(postMan);
            $('#edit_manuals').attr('data-text',postMan);
        }
        else{
            postMan = postMan.substr(postMan.indexOf("/") + 1, postMan.length - 1);
            postMan = postMan.substr(postMan.indexOf("/") + 1, postMan.length - 1);
            $('#edit_manual').val(postMan);
            $('#edit_manual').attr('data-text',postMan);
        }    
    }
    
    
    //Get App Readme
    var postyr = event.target.parentNode.parentNode.childNodes[3].childNodes[4] ? event.target.parentNode.parentNode.childNodes[3].childNodes[4] : event.target.parentNode.parentNode.childNodes[3].childNodes[2]
                       

    if( postyr && postyr.dataset.title =="readme")
    {
        //Get the data-name element value and assign the it to the edit modal's Readme text dummy field Link 
        var postRead = postyr.getAttribute('data-name');
        //if the value is a link
        if(isUrlJs(postRead))
        {
            //issue check box click event for current Input field section on edit modal
            document.getElementById('edit_readmes').parentNode.childNodes[5].childNodes[3].childNodes[1].childNodes[1].click();
            
            
            //Set Actually Input Field To data attibute value
            $('#edit_readmes').val(postRead);
            $('#edit_readmes').attr('data-text',postRead);
        }
        else{
            postRead = postRead.substr(postRead.indexOf("/") + 1, postRead.length - 1);
            postRead = postRead.substr(postRead.indexOf("/") + 1, postRead.length - 1);
            $('#edit_readme').val(postRead);
            $('#edit_readme').attr('data-text',postRead);
        }
    }
    //Get App All
    
    //Re enable the save edit button and show the modal
    $('#modal-save').prop('disabled',false);
    $('#edit-modal').modal();
    
});

$('.checkbox').on('click', function (event) {
    if(this.checked)
    {
        //change the edit fields source input type to text and set a placeholder to accept url for the ADD Modal
        this.parentNode.parentNode.parentNode.childNodes[1].type = 'text'; 
        this.parentNode.parentNode.parentNode.childNodes[1].placeholder = 'Enter Url | http://intranet';
    }
    else
    {
        //change the edit fields source input text to file  for the ADD Modal
        this.parentNode.parentNode.parentNode.childNodes[1].type = 'file';
    }
});

$('.editcheckbox').on('click', function (event) {
    if(this.checked)
    {
        //file upload input - changes to the current app exe/rar (make it visible, give it form-control styling and make it type text)
        $(this.parentNode.parentNode.parentNode.parentNode.childNodes[1]).removeClass('custom-file-upload-hidden');
        $(this.parentNode.parentNode.parentNode.parentNode.childNodes[1]).addClass('form-control');
          this.parentNode.parentNode.parentNode.parentNode.childNodes[1].type="text";
        this.parentNode.parentNode.parentNode.parentNode.childNodes[1].value = this.parentNode.parentNode.parentNode.parentNode.childNodes[1].dataset.text;
        $(this.parentNode.parentNode.parentNode.parentNode.childNodes[1]).removeClass('success');
        $(this.parentNode.parentNode.parentNode.parentNode.childNodes[1]).removeClass('error');
        
        //file upload select input
        $(this.parentNode.parentNode.parentNode.parentNode.childNodes[3]).addClass('custom-file-upload-hidden');
        $(this.parentNode.parentNode.parentNode.parentNode.childNodes[3]).removeClass('success');
        
        //file upload dummy button input
        $(this.parentNode.parentNode.parentNode.childNodes[1]).addClass('custom-file-upload-hidden');
        
    }
    else
    {
        //file upload input
        $(this.parentNode.parentNode.parentNode.parentNode.childNodes[1]).addClass('custom-file-upload-hidden');
        $(this.parentNode.parentNode.parentNode.parentNode.childNodes[1]).removeClass('form-control');
        this.parentNode.parentNode.parentNode.parentNode.childNodes[1].type="file";
        
        //file upload dummy field
        $(this.parentNode.parentNode.parentNode.parentNode.childNodes[3]).removeClass('custom-file-upload-hidden');
        //$(this.parentNode.parentNode.parentNode.parentNode.childNodes[3]).val($(this.parentNode.parentNode.parentNode.parentNode.childNodes[3]).data('text'));
        
        //file upload button
        $(this.parentNode.parentNode.parentNode.childNodes[1]).removeClass('custom-file-upload-hidden');
       
       
       
    }
});


$('#addNew').on('click', function (event) {
    event.preventDefault();
    clearEditFields();
    
    $('#add-modal').modal();//open dialog
});


/**
Prevent dummy field editing
**/
$('.dummy').keydown(function (e) {
    e.preventDefault();
});

/**
set dummy field after 
**/
$('.custom-file-upload-hidden').change(function (e) {
    if(!$(e.target.parentNode.childNodes[5].childNodes[3].childNodes[1].childNodes[1]).is(':checked'))
    {  //check that the is url option is not set and that the file input has the field being submitted
        //and prevent request for file
        e.target.parentNode.childNodes[3].value = e.target.files[0].name;
        $(e.target.parentNode.childNodes[3]).addClass("success");
    }
    else if($(e.target).attr('type') =='text' && $(this).val().length>0)//checks if the input field has a value entered
    {
        if(isUrlJs($(this).val()) )//checks if the input value is a valid url
        {
            $(e.target).addClass('success');  
            $(e.target).removeClass('error');
        }
        else
        {
            $(e.target).addClass('error'); 
            $(e.target).removeClass('success'); 
        }  
    }
                                   
                                       
});

/*$('.add').change(function (e){
    console.log(this.type);
    
});*/

/**
Trigger file input when button is clicked
**/
$('.select-butn').on('click', function (event) {
    var $inpt = event.target.parentNode.parentNode.childNodes[1];
    $inpt.click();//open dialog
});

$('#modal-save').on('click', function () {
    
    if($('.error').length >0)
    {
        $('.myerror').text('Error In Input Format! Please Update And Resubmit');
        $('.myerror').addClass('error');
        return;
    }
    
    
    /*
        CHECK IF VALUE BEING SUPPLIED IS INPUT TEXT OR INPUT FILE AND UPDATE DATAM CORRECTLY
    */
    
    
    $('#modal-save').prop('disabled',true);
    var datam = new FormData($('#uploaders'));
    datam.append('edit_name', $('#edit_name').val());
    datam.append('edit_files', $('#edit_files').attr('type') == 'file' ? $('#edit_files')[0].files[0] : $('#edit_files').val());
    datam.append('edit_manuals', $('#edit_manuals').attr('type') == 'file' ? $('#edit_manuals')[0].files[0] : $('#edit_manuals').val());
    datam.append('edit_readmes', $('#edit_readmes').attr('type') == 'file' ? $('#edit_readmes')[0].files[0] : $('#edit_readmes').val());
    datam.append('is_url', false);
    datam.append('postId', postId);
    datam.append('_token', token);
    console.log('all formvalues sent');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        type: 'POST',
        url: url,
        data :datam,
        processData: false,
        contentType: false,
        dataType: 'json'
        
    }).done(function (msg) {
        console.log('ano values sent');
        //console.log('hi');
        //console.log($(postBodyElement));
        var resp = JSON.parse(JSON.stringify(msg));//JSON.parse(msg);
        console.log(JSON.stringify(msg));
        
        if(resp.errstatus==0)
        {
            console.log($(postBodyElement.childNodes[3].childNodes[4]));
            $('#modal-save').prop('disabled',false);
            $('.myerror').text(resp.message);
        }
        else{        
            //assigning when json is returned
            $(postBodyElement.childNodes[1]).text(resp.post_updated.app_nm);

            
            /*
                APP FILE DETAILS HANDLING
            */
            console.log( $(postBodyElement.childNodes[3].childNodes[0]));
            if(isUrlJs(resp.post_updated.app_path))
            {
                $(postBodyElement.childNodes[3].childNodes[0]).removeAttr('download');
                $(postBodyElement.childNodes[3].childNodes[0]).attr('target','_blank');
            }
            $(postBodyElement.childNodes[3].childNodes[0]).attr("href",resp.post_updated.app_path );

            $(postBodyElement.childNodes[3].childNodes[0]).attr("data-name",resp.post_updated.app_path) ;

            /*
                README FILE DETAILS HANDLING
            */
           console.log($(postBodyElement.childNodes[3].childNodes[4]).length);
            //check if the readme already exists. if not then add it
            
            
            if(isUrlJs(resp.post_updated.app_readme_path))
            {
                if($(postBodyElement.childNodes[3].childNodes[4]).length<1)
                {
                    $(postBodyElement.childNodes[3]).append('<a class="btn btn-info btn-sm" href="'+resp.post_updated.app_readme_path + '" data-title="readme" target="_blank" data-name="'+resp.post_updated.app_readme_path+'">Read Me</a> |');
                }
                $(postBodyElement.childNodes[3].childNodes[4]).removeAttr('download');
                $(postBodyElement.childNodes[3].childNodes[4]).attr('target','_blank');
            }
            else if($(postBodyElement.childNodes[3].childNodes[4]).length<1 && resp.post_updated.app_readme_path !==null)
            {
                $(postBodyElement.childNodes[3]).append('<a class="btn btn-info btn-sm" href="'+resp.post_updated.app_readme_path + '" data-title="readme" download data-name="'+resp.post_updated.app_readme_path+'">Read Me</a> |');
            }
            $(postBodyElement.childNodes[3].childNodes[4]).attr("href",resp.post_updated.app_readme_path );

            $(postBodyElement.childNodes[3].childNodes[4]).attr("data-name",resp.post_updated.app_readme_path) ;
            
           
           /*
                MANUAL FILE DETAILS HANDLING
            */
           if(isUrlJs(resp.post_updated.app_manual_path))
           {
               if($(postBodyElement.childNodes[3].childNodes[2]).length<1)
                {
                    $(postBodyElement.childNodes[3]).append('<a class="btn btn-info btn-sm" href="'+resp.post_updated.app_manual_path + '" data-title="manual" target="_blank" data-name="'+resp.post_updated.app_manual_path+'">Manual</a> |');
                }
               
               $(postBodyElement.childNodes[3].childNodes[2]).removeAttr('download');
               $(postBodyElement.childNodes[3].childNodes[2]).attr('target','_blank');
           }
           else if($(postBodyElement.childNodes[3].childNodes[2]).length<1 && resp.post_updated.app_manual_path !==null)
           {
               $(postBodyElement.childNodes[3]).append('<a class="btn btn-info btn-sm" href="'+resp.post_updated.app_manual_path + '" data-title="manual" download data-name="'+resp.post_updated.app_manual_path+'">Manual</a> |');
           }
           
           $(postBodyElement.childNodes[3].childNodes[2]).attr("href",resp.post_updated.app_manual_path );
           $(postBodyElement.childNodes[3].childNodes[2]).attr("data-name", resp.post_updated.app_manual_path) ;
           $('#modal-save').prop('disabled',false);
           $('#edit-modal').modal('hide');
        }
    });
    
});


$('#uploaders').on('click', function() {
    $('.myerror').text("");
    $('.myerror').removeClass("error");
});

//Update value displayed in drop downdown menu
$('.dropdown-item').on('click', function(event) {
   $('#dropdownMenuButton').text( $(event.target).text() );
    $('#dropdownMenuButton').attr("data-selected",$(event.target).data('selected'));
    $('#app_uploader').attr("value",$(event.target).data('selected'));
});


$('.slideout').on('click', function(){
	//WHEN CLICKED CHECK IF PANEL HAS ACTIVE CLASS
	
	//IF IT DOES NOT HAVE ACTIVE THEN
	
	//REMOVE ACTIVE FROM THE PANEL THAT HAS IT AND INITIATE A CHANGE IN ITS LEFT VALUE AND  HAVE IT SLIDE OUT OF VIEW
	
	//ADD ACTIVE TO THE CURRENT SELECTION AND HAVE IT SLIDE INTO VIEW BY SETTING LEFT VALUE TO 0
	if(!$(this).hasClass(".active"))
	{
		console.log($('.active').attr("data-name"));
		$('#' + $('.active').attr("data-name")).css({
			'left':'-3750px',
		});
		$('.active').removeClass('active');
		
		$('#'+$(this).attr("data-name")).css({
			'left':'-21px',
			});
			console.log('hi');
			console.log($(this).attr("data-name"));
			
		$(this).addClass("active");
	}
});

// $('.slideout').on('mouseleave', function(){
	// $('#'+$(this).attr("data-name")).css({
		// 'left':'-450px'
		// });
// });






















//7 of april gk general an clifford 4827 HG 
//Lindsay addEventListener