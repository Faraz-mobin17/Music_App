<?php include("includes/includedFiles.php"); ?>

<?php
if (isset($_GET['id'])) {
    $playlistId = $_GET['id'];
} else {
    header("Location: index.php");
}

$playlist = new Playlist($con, $playlistId);
$owner =  new User($con, $playlist->getOwner());
?>
<div class="entityInfo">
    <div class="leftSection">
        <img src="assets/images/icons/music.jpg" alt="image">
    </div>
    <div class="rightSection">
        <h2 style="text-transform: capitalize;"><?php echo $playlist->getName(); ?></h2>
        <p>By <?php echo $playlist->getOwner(); ?></p>
        <p><?php echo $playlist->getNumberOfSongs();  ?>&nbsp;Songs</p>
        <button class="button" onclick="deletePlaylist()">DELETE PLAYLIST</button>
    </div>
</div>
<div class="trackListContainer">
    <ul class="trackList">
        <?php
        $songIdArray = $playlist->getSongIds();
        // $songsIdArray = array();
        $i = 0;
        foreach ($songIdArray as $songId) {
            $playlistSong = new Song($con, $songId);
            $songArtist = $playlistSong->getArtist();
        ?>
            <li class="trackListRow">
                <div class="trackCount">
                    <img class="play" src="<?php echo 'assets/images/icons/play-white.png'; ?>" alt="play icon image" onclick="setTrack('$playlistSong->getId()',tempPlayList,true);">
                    <span class="trackNumber"><?php echo $i ?></span>
                </div>

                <div class="trackInfo">
                    <span class="trackName"><?php echo $playlistSong->getTitle(); ?></span>
                    <span class="ArtistName"><?php echo $songArtist->getName(); ?></span>
                </div>
                <div class="trackOptions">
                    <img src="<?php echo 'assets/images/icons/more.png' ?>" alt="dot icon" class="optionsButton">
                </div>
                <div class="trackDuration">
                    <span class="duration"><?php $playlistSong->getDuration(); ?></span>
                </div>
            </li>
        <?php $i++;
        } ?>
        <script>
            var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlayList = JSON.parse(tempSongIds);
        </script>

    </ul>
</div>