<?php
$songQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");
$resultArray = array();
while ($row = mysqli_fetch_array($songQuery)) {
	array_push($resultArray, $row['id']);
}
$jsonArray = json_encode($resultArray);
?>
<script>
	$(document).ready(function() {
		var newPlayList = <?php echo $jsonArray; ?>;
		audioElement = new Audio();
		setTrack(newPlayList[0], newPlayList, false);
		updateVolumeProgressBar(audioElement.audio);

		$("#nowPlayingBarContainer").on('mousedown touchstart mousemove touchmove', (e) => {
			e.preventDefault();
		});


		$(".playbackBar .progressBar").mousedown(() => {
			mouseDown = true;
		});
		$(".playbackBar .progressBar").mousemove((e) => {
			if (mouseDown) {
				timeFromOffset(e, this);
			}
		});
		$(".playbackBar .progressBar").mouseup((e) => {
			timeFromOffset(e, this);
		});

		$(".volumeBar .progressBar").mousedown(() => {
			mouseDown = true;
		});
		$(".volumeBar .progressBar").mousemove((e) => {
			if (mouseDown) {
				var percentage = e.offsetX / $(this).width();
				if (percentage >= 0 && percentage <= 1)
					audioElement.audio.volume = percentage;
			}
		});
		$(".volumeBar .progressBar").mouseup((e) => {
			var percentage = e.offsetX / $('.volumeBar .progressBar').width();
			if (percentage >= 0 && percentage <= 1)
				audioElement.audio.volume = percentage;
		});

		$(document).mouseup(() => {
			mouseDown = false;
		})

	});



	function timeFromOffset(mouse, progressBar) {
		var percentage = mouse.offsetX / $(progressBar).width() * 100; // $(".playbackBar .progressBar") is same as $(this)
		var seconds = audioElement.audio.duration * (percentage / 100);
		audioElement.setTime(seconds);
	}

	function prevSong() {
		if (audioElement.audio.currentTime >= 3 || currentIndex == 0)
			audioElement.setTime(0);
		else {
			currentIndex = currentIndex--;
			setTrack(currentPlayList[currentIndex], currentPlayList, true);
		}

	}

	function nextSong() {
		if (repeat == true) {
			audioElement.setTime(0);
			playSong();
			return;
		}

		(currentIndex == currentPlayList.length - 1) ? currentIndex = 0: currentIndex++;
		var trackToPlay = shuffle ? shufflePlayList[currentIndex] : currentPlayList[currentIndex];
		setTrack(trackToPlay, currentPlayList, true);
	}

	function previousSong() {
		if (repeat == true) {
			audioElement.setTime(0);
			playSong();
			return;
		}
		(currentIndex == 0) ? currentIndex = currentPlayList.length - 1: currentIndex--;
		var trackToPlay = currentPlayList[currentIndex];
		setTrack(trackToPlay, currentPlayList, true);
	}

	function setRepeat() {
		repeat = !repeat;
		var imageName = repeat ? 'repeat-active.png' : 'repeat.png';
		$('.controlButton.repeat img').attr('src', "assets/images/icons/" + imageName);
	}

	function setMute() {
		audioElement.audio.muted = !audioElement.audio.muted;
		var imageName = audioElement.audio.muted ? 'volume-mute.png' : 'volume.png';
		$('.controlButton.volume img').attr('src', "assets/images/icons/" + imageName);
	}

	function setShuffle() {
		shuffle = !shuffle;
		var imageName = shuffle ? 'shuffle-active.png' : 'shuffle.png';
		$('.controlButton.shuffle img').attr('src', "assets/images/icons/" + imageName);

		if (shuffle) {
			shuffleArray(shufflePlayList);
			currentIndex = shufflePlayList.indexOf(audioElement.currentlyPlaying.id);
		} else {
			currentIndex = currentPlayList.indexOf(audioElement.currentlyPlaying.id);
		}
	}

	function shuffleArray(a) {
		var x, j, i;
		for (i = a.length; i; i--) {
			j = Math.floor(Math.random() * i);
			x = a[i - 1];
			a[i - 1] = a[j];
			a[j] = x;
		}
	}

	function setTrack(trackId, newPlaylist, play) {

		if (newPlaylist != currentPlayList) {
			currentPlayList = newPlaylist;
			shufflePlayList = currentPlayList.slice();
			shuffleArray(shufflePlayList);
		}
		if (shuffle) {
			currentIndex = shufflePlayList.indexOf(trackId);
		} else {
			currentIndex = currentPlayList.indexOf(trackId);
		}

		pauseSong();
		//audioElement.setTrack("assets/music/bensound-acousticbreeze.mp3");
		$.post("includes/handlers/ajax/getSongsJson.php", {
			songId: trackId
		}, function(data) {


			var track = JSON.parse(data);
			$('.trackName span').text(track.title);

			$.post("includes/handlers/ajax/getArtistJson.php", {
				artistId: track.artist
			}, function(data) {
				var artist = JSON.parse(data);
				$('.trackInfo .artistName span').text(artist.name);
				$(".trackInfo .artistName span").attr("onclick", "openPage('artist.php?id=" + artist.id + "')");
			});

			$.post("includes/handlers/ajax/getAlbumJson.php", {
				albumId: track.album
			}, function(data) {
				var album = JSON.parse(data);
				$('.content .albumLink img').attr("src", album.artworkPath);
				$(".content .albumLink img").attr("onclick", "openPage('album.php?id=" + album.id + "')");
				$(".trackInfo .trackName span").attr("onclick", "openPage('album.php?id=" + album.id + "')");
			});
			audioElement.setTrack(track);
			// playSong();
			if (play)
				playSong();
		});
	}

	function playSong() {
		if (audioElement.audio.currentTime == 0) {
			$.post('includes/handlers/ajax/updatePlays.php', {
				songId: audioElement.currentlyPlaying.id
			});
		}
		$(".controlButton.play").hide();
		$(".controlButton.pause").show();
		audioElement.play();
	}

	function pauseSong() {
		$(".controlButton.play").show();
		$(".controlButton.pause").hide();
		audioElement.pause();
	}
</script>
<div id="nowPlayingBarContainer">
	<div id="nowPlayingBar">
		<div id="nowPlayingLeft">
			<div class="content">
				<span class="albumLink">
					<img role="" src="" alt="singer image" class="albumArtwork">
				</span>
				<div class="trackInfo">
					<span class="trackName">
						<span role="link" tabindex="0"></span>
					</span>
					<br>
					<span class="artistName">
						<span role="link" tabindex="0"></span>
					</span>
				</div>
			</div>
		</div>
		<div id="nowPlayingCenter">
			<div class="content playerControls">
				<div class="buttons">
					<button class="controlButton shuffle" title="shuffle button" onclick="setShuffle()">
						<img src="assets/images/icons/shuffle.png" alt="shuffle image">
					</button>
					<button class="controlButton previous" title="previous button" onclick="prevSong()" ondblclick="previousSong()">
						<img src="assets/images/icons/previous.png" alt="preivous image">
					</button>
					<button class="controlButton play" title="play button" onclick="playSong()">
						<img src="assets/images/icons/play.png" alt="play image">
					</button>
					<button class="controlButton pause" title="pause button" style="display: none;" onclick="pauseSong()">
						<img src="assets/images/icons/pause.png" alt="pause image">
					</button>
					<button class="controlButton next" title="next button" onclick="nextSong()">
						<img src="assets/images/icons/next.png" alt="next image">
					</button>
					<button class="controlButton repeat" title="repeat button" onclick="setRepeat()">
						<img src="assets/images/icons/repeat.png" alt="repeat image">
					</button>
				</div>
				<div class="playbackBar">
					<span class="progressTime current">0.00</span>
					<div class="progressBar">
						<div class="progressBarBg">
							<div class="progress" style="width: 0;"></div>
						</div>
					</div>
					<span class="progressTime remaining">0.00</span>
				</div>
			</div>
		</div>
		<div id="nowPlayingRight">
			<div class="volumeBar">
				<button class="controlButton volume" title="volume" onclick="setMute()">
					<img src="assets/images/icons/volume.png" alt="volume image">
				</button>
				<div class="progressBar">
					<div class="progressBarBg">
						<div class="progress"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>