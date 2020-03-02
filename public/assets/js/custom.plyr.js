

function on(selector, type, callback)
{
    document.querySelector(selector).addEventListener(type, callback, false);
}

function formatBytes(bytes, decimals = 2)
{
    if (bytes === 0) return '0 Bytes';
    const   k = 1024,
            dm = decimals < 0 ? 0 : decimals;
            sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],

            i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

function ChangeUrl(url, title = '')
{
    if (typeof (history.pushState) != "undefined")
    {
        var obj = { Title: title, Url: url };
        history.pushState(obj, obj.Title, obj.Url);
        if(title != '') document.title = title; //manually change title
    } 
    else {console.error("Browser does not support HTML5.");}
}

function play_media(source)
{
    var path = location.href.split('?pl=');

    // console.log(path);

    ChangeUrl(path[0]+'?pl='+source.id, source.title);
    $('#mediatitle').text(source.title);
    $('#viewcount').text(source.views);
    $('#uploadtime').text(source.uploaded_at);

    player.source = source;

    player.play();

    // setTimeout(()=> {player.play()}, 1000);
    
}

function fetch_and_play_media(media_id)
{
    $.ajax({
        url: 'Media-Player/fetchmedia',
        type: 'POST',
        data: {id: media_id, _token: csrf},
        success:function(result){
            if(result.status){
                // console.log(result);
                // setTimeout(play_media, 3000, result.data);
                play_media(result.data);
            }
            else{
                console.log(result);
            }
        },
        error:function(responce){
            console.log(responce.responseJSON);
        }
    });
}

// <img class="avatar" src="img/one.jpg" alt="Not Found" onerror=this.src="img/undefined.jpg">

function show_all_media(medias)
{
    $('#allmedias').html('');
    $.each(medias,function(i,media){
        const type = media.content_type.split('/')[0];
        const el = `
            <div class="row my-2 border pointer" onclick="fetch_and_play_media('${media.id}')">
                <div class="col-3 p-2">
                    <img src="/assets/images/icons/${type}.png" class="img-thumbnail">
                </div>
                <div class="col-9 mt-2">
                    <div class="text-truncate">
                        <b>${media.title}</b><br>
                        <small>${media.owner}</small>
                    </div>
                    <small>
                        ${media.uploaded_at} &nbsp;•&nbsp; ${formatBytes(media.size)}
                    </small>
                </div>
            </div>`;
        $('#allmedias').append(el);
    });
        
}

function fetch_all_media()
{
    $.ajax({
        url: 'Media-Player/fetchallmedia',
        type: 'POST',
        data: {_token: csrf},
        success:function(result){
            if(result.status){
                // console.log(result);
                show_all_media(result.data);
            }
            else{
                console.log('Error: '+result.msg);
            }
        },
        error:function(responce){
            console.log(responce.responseJSON);
        }
    });
}

$(document).ready(function() { 

    const player = new Plyr('#player');
    window.player = player;             // Expose

    var def = location.href.split('?pl=')[1] || '';

    fetch_and_play_media(def);

    fetch_all_media();

/*

    const VideoSource = {
        type: 'video',
        title: 'view from blue moon',
        poster: '/content/v1.jpg',
        sources: [
            {
                src: '/content/v1-576p.mp4',
                type: 'video/mp4',
                size: 576,
            },
            {
                src: '/content/v1-240p.mp4',
                type: 'video/mp4',
                size: 240,
            }
        ],
        tracks: [
            {
                kind: 'captions',
                label: 'English',
                srclang: 'en',
                src: '/content/v1.en.vtt',
                default: true,
            },
            {
                kind: 'captions',
                label: 'French',
                srclang: 'fr',
                src: '/content/v1.fr.vtt',
            }
        ] 
    };

    const AudioSource = {
        type: 'video',
        title: 'hitman',
        poster: '/content/default.jpg',
        sources: [
            {
                src: '/content/a1.mp3',
                type: 'audio/mp3',
            }
        ],
    };

    // player.source = VideoSource;

    // player.play();
    
    */

});