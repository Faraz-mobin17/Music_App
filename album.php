<?php include("includes/includedFiles.php"); ?>

<?php
if (isset($_GET['id'])) {
    $albumId = $_GET['id'];
} else {
    header("Location: index.php");
}

$album = new Album($con, $albumId);
$artist = $album->getArtist();
?>
<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath(); ?>" alt="image">
    </div>
    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p>By <?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getNumberOfSongs();  ?>&nbsp;Songs</p>
    </div>
</div>
<div class="trackListContainer">
    <ul class="trackList">
        <?php
        $songIdArray = $album->getSongIds();
        $i = 0;
        foreach ($songIdArray as $songId) {
            $albumSong = new Song($con, $songId);
            $albumArtist = $albumSong->getArtist();
        ?>
            <li class="trackListRow">
                <div class="trackCount">
                    <img class="play" src="assets/images/icons/play-solid.svg" alt="play icon image" onclick="setTrack('$albumSong->getId()',tempPlayList,true)">
                    <span class="trackNumber"><?php echo $i ?></span>
                </div>

                <div class="trackInfo">
                    <span class="trackName"><?php echo $albumSong->getTitle(); ?></span>
                    <span class="ArtistName"><?php echo $albumArtist->getName(); ?></span>
                </div>
                <div class="trackOptions">
                    <img src="assets/images/icons/ellipse.svg" alt="dot icon" class="optionsButton" onclick="showOptionsMenu(this)">
                </div>
                <div class="trackDuration">
                    <span class="duration"><?php echo $albumSong->getDuration(); ?></span>
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

<nav class="optionsMenu">
    <input type="hidden" name="" class="songId">
    <div class="item"><i class="fas fa-plus"></i>&nbsp;Add to Playlist</div>
    <div class="item"><i class="fas fa-share"></i>&nbsp;Share</div>
    <div class="item"><i class="far fa-thumbs-up"></i>&nbsp;Like</div>
    <div class="item"><i class="fas fa-user-plus"></i>&nbsp;Follow Artist</div>
</nav>