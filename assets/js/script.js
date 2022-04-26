var currentPlayList = [];
var shufflePlayList = [];
var tempPlayList = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userloggedin;
let timer;
$(document).click((click) => {
	let target = $(click.target);
	if (!target.hasClass("item") && !target.hasClass("optionsButton")) {
		hideOptionsMenu();
	}
});
$(window).scroll(() => hideOptionsMenu());
function updateEmail(emailClass) {
	let emailValue = $("." + emailClass).val();
	$.post("includes/handlers/ajax/updateEmail.php",{email: emailValue,username: un}).done((response) => {
		$("." + emailClass).nextAll(".message").text(response);
	});
}

function updatePassword(oldPasswordClass,newPasswordClass1,newPasswordClass2) {
	let oldPassword = $("." + oldPasswordClass).val();
	let newPassword1 = $("." + newPasswordClass1).val();
	let newPassword2 = $("." + newPasswordClass2).val();
	$.post("includes/handlers/ajax/updatePassword.php",
	{
		oldPassword: oldPassword,
		newPassword1: newPassword1,
		newPassword2: newPassword2,
		username: un
	}).done((response) => {
		$("." + oldPasswordClass).nextAll(".message").text(response);
	});
}
function openPage(url)
{
	if (timer != null) clearTimeout(timer);
	if (url.indexOf("?") == -1)
	{
		url += "?";
	}
	var encodeUrl = encodeURI(url + "&userloggedin=" + userloggedin);
	$("#mainContent").load(encodeUrl);
	$("body").scrollTop(0);
	history.pushState(null,null,url);
}
function createPlaylist()
{
	let popup = prompt("Enter the Name of Your Playlist");
	if (popup != null)
	{
		console.log(popup);
		console.log(userloggedin);
		$.post("includes/handlers/ajax/createPlaylist.php",{
			name: popup,
			username: userloggedin
		}).done((err) => {openPage('yourMusic.php'); if (err != "") alert(err); return;});
	}
}
const deletePlaylist = () => {
	let popup = prompt("Enter the Name of Playlist you want to remove");
	if (popup != null || popup != "") {
		$.post("includes/handlers/ajax/deletePlaylist.php", {
			name: popup,
			username: userloggedin
		}).done(err => {openPage('yourMusic.php'); if (err != "") alert(err); return;});
	}
}
const showOptionsMenu = (button) => {
	let menu = $(".optionsMenu");
	let menuWidth = menu.width();
	let scrollTop = $(window).scrollTop(); // distance from the top of the window to top of the document
	let elementOffset = $(button).offset().top; // distance from the top of the document
	let top = elementOffset - scrollTop;
	let left = $(button).position().left;
	menu.css({
		"top": top + "px",
		"left": left - menuWidth + "px",
		"display": "inline"
	});
}
const hideOptionsMenu = () => {
	let menu = $(".optionsMenu");
	menu.css("display") != "none" ? menu.css("display","none") : "";
}
function formatTime(seconds) {
	var time = Math.round(seconds);
	var minutes = Math.floor(time / 60); //Rounds down
	var seconds = time - (minutes * 60);

	var extraZero = (seconds < 10) ? "0" : "";

	return minutes + ":" + extraZero + seconds;
}

function updateTimeProgressBar(audio) {
	$(".progressTime.current").text(formatTime(audio.currentTime));
	$(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

	var progress = (audio.currentTime / audio.duration) * 100;
	$(".playbackBar .progress").css("width", progress + "%");
}

function updateVolumeProgressBar(audio) {
	var volume = audio.volume * 100;
	$(".volumeBar .progress").css("width", volume + "%");
}
function playFirstSong()
{
	setTrack(tempPlayList[0],tempPlayList,true);
}
function Audio() {

	this.currentlyPlaying;
	this.audio = document.createElement('audio');

	this.audio.addEventListener("ended", function() {
		nextSong();
	});
	this.audio.addEventListener("canplay", function() {
		//'this' refers to the object that the event was called on
		var duration = formatTime(this.duration);
		$(".progressTime.remaining").text(duration);
	});

	this.audio.addEventListener("timeupdate", function(){
		if(this.duration) {
			updateTimeProgressBar(this);
		}
	});

	this.audio.addEventListener("volumechange", function() {
		updateVolumeProgressBar(this);
	});

	this.setTrack = function(track) {
		this.currentlyPlaying = track;
		this.audio.src = track.path;
	}

	this.play = function() {
		this.audio.play();
	}

	this.pause = function() {
		this.audio.pause();
	}

	this.setTime = function(seconds) {
		this.audio.currentTime = seconds;
	}

}