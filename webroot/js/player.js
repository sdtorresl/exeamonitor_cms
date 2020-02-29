var artist, title, previousArtist, previousTitle;
const metadataURI = source + '?metadata.php&tag=getTags';

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
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var json = JSON.parse(this.responseText);
            console.log(json);

            /*
            if (json[0] != artist && json[1] != title) {
                previousArtist = artist;

                previousTitle = title;

                artist = json[0];
                if (artist.length > 23) {
                    artist;
                }

                title = json[1];
                if (artist.length > 23) {
                    title;
                }

                $("#artist").text(artist);
            }*/
        }
    };
    xhttp.open("GET", metadataURI, true);
    xhttp.send();
    console.log(metadataURI);
}

function toHHMMSS(seconds) {
    var sec_num = parseInt(seconds, 10); // don't forget the second param
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    return hours+':'+minutes+':'+seconds;
}

document.addEventListener("DOMContentLoaded", function() {
    // Setup player
    const player = new Audio();
    player.src = source;
    player.autoplay = true;
    player.volume = 0.7;

    btnPlayPause = document.getElementById('btn-play-pause');
    btnMute = document.getElementById('btn-mute');
    progressBar = document.getElementById('progress-bar');
    volumeBar = document.getElementById('volume-bar');
    volumeValue = document.getElementById('volume-value');
    btnVolumeUp = document.getElementById('volume-up');
    btnVolumeDown = document.getElementById('volume-down');
    elapsedTime = document.getElementById('elapsed-time');
    playPauseIcon = document.getElementById('play-pause-icon');

    changeButtonType(changeButtonType);

    // Update the video volume
    volumeBar.addEventListener("change", function(evt) {
        function displayMessage(message, canPlay) {
            var element = document.querySelector('#message');
            element.innerHTML = message;
            element.className = canPlay ? 'info' : 'error';
        }
        player.volume = parseInt(evt.target.value) / 10;
    });

    // Add a listener for the timeupdate event so we can update the progress bar
    player.addEventListener('timeupdate', updateProgressBar, false);

    // Add a listener for the play and pause events so the buttons state can be updated
    player.addEventListener('play', function() {
        // Change the button to be a pause button
        changeButtonType(btnPlayPause);
    }, false);

    player.addEventListener('pause', function() {
        // Change the button to be a play button
        changeButtonType(btnPlayPause);
    }, false);

    player.addEventListener('ended', function() {
        this.pause();
    }, false);

    progressBar.addEventListener("click", seek);

    btnPlayPause.addEventListener("click", playPauseAudio);

    btnVolumeUp.addEventListener("click", function () {
        if (player.src) {
            if ((player.volume + 0.1) <= 1) {
                player.volume = player.volume + 0.1;
            } else {
                player.volume = 1;
            }
        }
    });

    btnVolumeDown.addEventListener("click", function () {
        if (player.src) {
            if ((player.volume-0.1) >= 0) {
                player.volume = player.volume - 0.1;
            } else {
                player.volume = 0;
            }
        }
    });

    player.addEventListener('volumechange', function(e) { 
        volumeValue.style.width = player.volume * 100 + '%';
    }, false);	

    function seek(e) {
        if (player.src) {
            var percent = e.offsetX / this.offsetWidth;
            player.currentTime = percent * player.duration;
            e.target.value = Math.floor(percent / 100);
            e.target.innerHTML = progressBar.value + '% played';
        }
    }

    function playPauseAudio() {
        if (player.src) {
            if (player.paused || player.ended) {
                // Change the button to a pause button
                changeButtonType(btnPlayPause);
                player.play();
            } else {
                // Change the button to a play button
                changeButtonType(btnPlayPause);
                player.pause();
            }

            volumeValue.style.width = player.volume * 100 + '%';
        }
    }

    // Stop the current media from playing, and return it to the start position
    function stopAudio() {
        if (player.src) {
            player.pause();
            if (player.currentTime) player.currentTime = 0;
        }
    }

    // Update the progress bar
    function updateProgressBar() {
        // Work out how much of the media has played via the duration and currentTime parameters
        var percentage = Math.floor((100 / player.duration) * player.currentTime);
        // Update the progress bar's value
        progressBar.value = percentage;

        elapsedTime.innerHTML = toHHMMSS(player.currentTime);
    }

    // Updates a button's title, innerHTML and CSS class
    function changeButtonType(btn) {
        if (!player.paused) {
            btn.className = "pause";
            playPauseIcon.className = "fas fa-pause";
        } else {
            btn.className = "play";
            playPauseIcon.className = "fas fa-play";
        }
    }

});

window.setInterval(updateMetadata, 1000);