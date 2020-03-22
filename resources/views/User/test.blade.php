<!DOCTYPE html>

<html>
<head>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <style>
        .container{
            border: 2px solid black; 
            width: 80%; 
            margin: 80px auto; 
            padding: 20px
        }
    </style>
</head>
<body>

    <div class="container">
        
        <h1>jQuery Ajax file Upload with Progress</h1><br>
        <form id="form">
            File: <input type="file" id="file" name="file">
            <input type="button" value="upload" onclick="uploadfile('form','prog-perc')">
            &emsp;&emsp;&emsp;&emsp; Progress: <span id="prog-perc">0 %</span>
        </form>

    </div>
    
    
</body>
</html>

<script type="text/javascript">

    function uploadfile(formid,progressid)
    {
        var fd = new FormData($('#'+formid)[0]);
        var progressObj = $('#'+progressid);

        fd.append('_token','{{csrf_token()}}');

        $.ajax({
            xhr:function(){
                var xhr = $.ajaxSettings.xhr();
                progressObj.text('0 %');
                xhr.upload.onprogress = function(e){
                    if(e.lengthComputable){
                        var percentComplete = parseInt((e.loaded/e.total)*100);
                        progressObj.text(percentComplete+' %');
                        if (percentComplete === 100){
                            console.log('complete')
                        }
                    }
                };
                return xhr;
            },
            url: '/test',
            type: 'POST',
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data, status, xhr) {
                console.log(status,data)
            },
            error: function(xhr, status, error) {
                console.log(status)
            }
        });

    }

</script>