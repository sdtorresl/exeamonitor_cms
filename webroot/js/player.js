let artist, title, previousArtist, previousTitle;

/** Make an http request and return the
 *  results in a string
 */
function httpGet(URL) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", URL, false);
    xmlHttp.send(null);
    return xmlHttp.responseText;
}

/** Update metadata of actual song
 */
function updateMetadata() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);

            previousArtist = artist;
            previousTitle = title;

            title = response.metadata.title ?? '';
            artist = response.metadata.artist ?? '';
            artist = (title == null || artist == '') ? artist : ' - ' + artist;

            document.getElementById("song-title").innerHTML = title;
            document.getElementById("artist").innerHTML = artist;
        }
    };
    xhttp.open("GET", metadataURI, true);
    xhttp.send();
}

function toHHMMSS(seconds) {
    var sec_num = parseInt(seconds, 10); // don't forget the second param
    var hours = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours < 10) { hours = "0" + hours; }
    if (minutes < 10) { minutes = "0" + minutes; }
    if (seconds < 10) { seconds = "0" + seconds; }
    return hours + ':' + minutes + ':' + seconds;
}

document.addEventListener("DOMContentLoaded", function () {
    const onMetadata = (metadata) => {
        document.getElementById("song-title").innerHTML = metadata.TITLE;
    };
    const onError = (message, error) => {
        console.error(`error message: ${message}`);
        console.error(`error: ${error}`);
    };

    const icecastPlayer =
        new IcecastMetadataPlayer(source,
            { metadataTypes: [], onError }
        );


    // Setup player
    const player = icecastPlayer.audioElement

    btnPlay = document.getElementById('btn-play');
    btnPause = document.getElementById('btn-pause');
    btnMute = document.getElementById('btn-mute');
    elapsedTime = document.getElementById('elapsed-time');

    // Add a listener for the timeupdate event so we can update the progress bar
    player.addEventListener('timeupdate', updateProgressBar, false);

    btnPlay.addEventListener("click", play);
    btnPause.addEventListener("click", stop);

    function play() {
        console.log("playing...")
        icecastPlayer.play();
        sendStats();
        updateMetadata();
    }

    function stop() {
        console.log("stopping...")
        icecastPlayer.stop();
        sendStats();
        updateMetadata();
    }


    // Update the progress bar
    function updateProgressBar() {
        elapsedTime.innerHTML = toHHMMSS(player.currentTime);
    }

    async function sendStats() {
        data = {
            "csrfToken": csrfToken,
            "state": player.paused ? 'stopped' : 'playing',
            "pos_id": posId,
            "volume": Number.parseInt(player.volume * 100),
            "current_song": title + artist
        };

        await fetch(checksURI, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrfToken
            },
            body: JSON.stringify(data)
        });

    }

    updateMetadata()
    window.setInterval(sendStats, 15000);
    window.setInterval(updateMetadata, 30000);
});


