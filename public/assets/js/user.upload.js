var contents = null;

$.get('/content/Contents.json',function(data,status){
	init(data);
});

function notify(type,text,title)
{
	if(type=='simple') 
		swal.fire(text);
	else
		swal.fire({icon:type,title:title,text:text})
}

function init(contents)
{
	$.each(contents,function(ctype,cobj){
		$.each(cobj, function(key,values){
			$.each(values, function(i,v){
				$('#'+ctype+' #'+key).append(`<option value="${v}">${v}</option>`);
				// console.log(ctype,key)
			});
		});
	});
}

function updateprogressbar(percent)
{
	$('#status').fadeIn();
	$('#prog-status').text(percent+'%').css('width',percent+'%');
	if(percent >= 100)
	{
		updateprogressbar(0); 
		$('#status').fadeOut();
	} 
}

function startupload(formid)
{
	var formobj = $('#'+formid),
		fd = new FormData(formobj[0]),
		url = formobj.data('url');

	fd.append('_token',csrf);

    $.ajax({
        xhr:function(){
            var xhr = $.ajaxSettings.xhr();
            updateprogressbar(0);
            xhr.upload.onprogress = function(e){
                if(e.lengthComputable){
                    var percentComplete = parseInt((e.loaded/e.total)*100);
                    updateprogressbar(percentComplete);
                    if (percentComplete === 100){
                        // console.log('complete')
                    }
                }
            };
            return xhr;
        },
        url: url,
        type: 'POST',
        data: fd,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data, status, xhr) {
            // notify('success','Upload Has Been Completed.','Finished');
            if(!data.status) notify('error',data.msg);
            else
            {
            	notify('success',data.msg);
            	formobj[0].reset();
            } 
        },
        error: function(xhr, status, error) {
            console.log(status,xhr)
        }
    });
}

function submit(formid)
{
	startupload(formid);
}



