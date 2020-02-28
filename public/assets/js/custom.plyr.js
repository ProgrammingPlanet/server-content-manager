function on(selector, type, callback)
{
    document.querySelector(selector).addEventListener(type, callback, false);
}

$(document).ready(function() { 

    const player = new Plyr('#player');
    window.player = player;             // Expose
    // return player;

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

    player.source = AudioSource;

    // player.play();


});