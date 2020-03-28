    
	function formatseconds(seconds)
	{
  		return (new Date(seconds * 1000)).toUTCString().match(/(\d\d:\d\d:\d\d)/)[0];
	}

	function changevolume(vol)
	{
		player.volume = vol;
	}

	function changeaudio(song)
	{
		$('#audiosrc1').attr(song.source);
        $('#captsrc1').attr(song.track);
		return player.load();
	}

  	function controls(cmd)
  	{
  		if(cmd=='play-pause')
  		{
        var btnobj = $('#ppbtn');
  			if(player.paused == true)
  			{
  				player.play();
  				btnobj.find('i').removeClass('fa-play').addClass('fa-pause');
          $('#'+playing+' td:nth-child(4) i:nth-child(1)').removeClass('fa-play-circle').addClass('fa-pause-circle');
  			}
  			else{
  				player.pause();
  				btnobj.find('i').removeClass('fa-pause').addClass('fa-play');
          $('#'+playing+' td:nth-child(4) i:nth-child(1)').removeClass('fa-pause-circle').addClass('fa-play-circle');
  			}
  		}
  		if(cmd=='fwd')
  		{
  			player.currentTime += 5;
  		}
  		if(cmd=='bwd')
  		{
  			player.currentTime -= 5;
  		}
  	}

  	function updateplayer(currenttime = -1)
  	{ 	
  		if(currenttime != -1)
  		{
  			player.currentTime = currenttime;
  		}
  		else{
  			currenttime = player.currentTime;
  		}
  		percent = (currenttime/player.duration)*100;
  		if(percent >= 100)
  		{
  			player.pause();
        $('#ppbtn').find('i').removeClass('fa-pause').addClass('fa-play');
        $('#'+playing+' td:nth-child(4) i:nth-child(1)').removeClass('fa-pause-circle').addClass('fa-play-circle');
  			player.currentTime = 0;
        playing = null;
  			progress.css('width','0%');
  		}
  		else{
  			curtime.text(formatseconds(currenttime));
  			progress.css('width',percent+'%');
  		}
  	}

    function fetch_and_play(musicid)
    {
        $.ajax({
            url: 'Music-Player/fetch',
            type: 'POST',
            data: {_token: csrf, id: musicid},
            success:function(result){
                if(result.status){
                    // console.log(result);
                    changeaudio(result.data);
                    controls('play-pause');
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

    function play(musicid)
    {
        if(playing==musicid) return controls('play-pause');
        $('#playlist tr').removeClass('bg-warning');
        $('#'+musicid).addClass('bg-warning');
        $('#playlist tr td:nth-child(4) i:nth-child(1)').removeClass('fa-pause-circle').addClass('fa-play-circle');
        $('#'+musicid+' td:nth-child(4) i:nth-child(1)').removeClass('fa-play-circle').addClass('fa-pause-circle');
        $('#ppbtn').find('i').removeClass('fa-play').addClass('fa-pause');
        fetch_and_play(musicid);
        playing = musicid;
    }

    function init(musicid)
    {
      play(musicid);
      setInterval(function(){
              updateplayer();
              tottime.text(formatseconds(player.duration));
        },1000);

    }


  	var player = $('#audio')[0];
  	var curtime = $('#curtime');
  	var tottime = $('#tottime');
  	var progress = $('#prgbar');
    var playing = null;
    var playlist = null;


    $(document).ready(function(){

        $('#prgcont').on('click', function(e) {
            var max = $(this).width(); //Get width element
            var pos = e.pageX - $(this).offset().left; //Position cursor
            var dual = Math.round(pos / max * 100); // Round %
            dual = dual > 100 ? 100 : dual;
            updateplayer(player.duration * (dual/100))
        });

        

        $('#songlist').DataTable({
            aoColumnDefs: [{
                bSortable: false, 
                aTargets: [1,3]
            }],
            processing: true,
            serverSide: true,
            ajax:{
                url: 'Music-Player/fetchall',
                type: 'POST',
                data:{ _token: csrf}
            },
            columns: [{'data':'Title'},{'data':'Duration'},{'data':'Upload Time'},{'data':'Options'}],
            rowId: function(a) {return a.id;},
            initComplete:function(settings,json){ //first time load
                if(json.data[0].id)
                  init(json.data[0].id);
            },
            drawCallback:function(settings){  //everytime table loads
                $('#'+playing).addClass('bg-warning');
                $('#'+playing+' td:nth-child(4) i:nth-child(1)').removeClass('fa-play-circle').addClass('fa-pause-circle');
            }
        });

        player.textTracks[0].oncuechange = function() {
            if(this.activeCues[0] != undefined)
            {
                var currentCue = this.activeCues[0].text || '';
                $('#curline').text(currentCue);
            }
        }

    });


        



