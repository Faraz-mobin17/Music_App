<?php
include("includes/includedFiles.php");

if (isset($_GET['id'])) {
    $artistId = $_GET['id'];
}

$artist = new Artist($con, $artistId);
?>
<div class="entityInfo">
    <div class="centerSection">
        <div class="artistInfo">

            <h1 class="artistName"><?php echo $artist->getName(); ?></h1>
            <div class="headerButton">
                <button class="button" onclick="playFirstSong()">Play</button>
            </div>

        </div>
    </div>
</div>
<h2>SONGS</h2>
<div class="trackListContainer">

    <ul class="trackList">
        <?php
        $songIdArray = $artist->getSongIds();
        $i = 0;
        foreach ($songIdArray as $songId) {
            if ($i > 5) break;
            $albumSong = new Song($con, $songId);
            $albumArtist = $albumSong->getArtist();
        ?>
            <li class="trackListRow">
                <div class="trackCount">
                    <img class="play" src="<?php echo 'assets/images/icons/play-white.png'; ?>" alt="play icon image" onclick="setTrack('$albumSong->getId()',tempPlayList,true)">
                    <span class="trackNumber"><?php echo $i ?></span>
                </div>

                <div class="trackInfo">
                    <span class="trackName"><?php echo $albumSong->getTitle(); ?></span>
                    <span class="ArtistName"><?php echo $albumArtist->getName(); ?></span>
                </div>
                <div class="trackOptions">
                    <img src="<?php echo 'assets/images/icons/more.png' ?>" alt="dot icon" class="optionsButton">
                </div>
                <div class="trackDuration">
                    <span class="duration"><?php $albumSong->getDuration(); ?></span>
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

<div class="gridViewContainer">
    <h2>ALBUMS</h2>
    <?php
    $albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE artist = '$artistId'");

    while ($row = mysqli_fetch_array($albumQuery)) :
    ?>
        <div class="gridViewItem">
            <span onclick="openPage('album.php?id=<?php echo $row['id']; ?>')" role="link" tabindex="0" style="color: #222;">
                <img src="<?php echo $row['artworkPath']; ?>" alt="album image">
                <div class="gridViewInfo">
                    <?php echo $row['title']; ?>
                </div>
            </span>
        </div>
    <?php
    endwhile;
    ?>
</div>