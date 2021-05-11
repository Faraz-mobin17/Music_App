<?php
include("includes/includedFiles.php");

if (isset($_GET['term'])) {
    $term = urldecode($_GET['term']);
} else {
    $term = "";
}
?>
<div class="searchContainer">
    <h4>Search for an Artist Album or Song</h4>
    <input type="search" name="search" id="search" class="searchInput" value="<?php echo $term; ?>" placeholder="Start Typing..." onfocus="console.log(this.value = this.value)">
</div>

<script>
    $('.searchInput').focus();
    $(function() {

        $(".searchInput").keyup(() => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                // console.log("hi");
                let value = $(".searchInput").val();
                openPage('search.php?term=' + value);
            }, 1000);
        });
    });
</script>
<?php if ($term == "") exit(); ?>
<div class="trackListContainer">

    <ul class="trackList">
        <?php
        $songsQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10");
        if (mysqli_num_rows($songsQuery) == 0)
            echo "<span>No Songs Found" . $term . "</span>";
        $songIdArray = array();
        $i = 0;
        while ($row = mysqli_fetch_array($songsQuery)) {
            if ($i > 15) break;
            array_push($songIdArray, $row['id']);
            $albumSong = new Song($con, $row['id']);
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

<div class="artistsContainer">
    <h2>ARTISTS</h2>
    <?php
    $artistQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '$term%' LIMIT 10");
    if (mysqli_num_rows($artistQuery) == 0)
        echo "<span>No Artist Found" . $term . "</span>";

    while ($row = mysqli_fetch_array($artistQuery)) :
        $artistFound = new Artist($con, $row['id']);
    ?>
        <div class="searchResultRow">
            <div class="artistName">
                <span role="link" tabindex="0" onclick="openPage('artist.php?id='<?php $artistFound->getId(); ?>)">
                    <?php $artistFound->getName(); ?>
                </span>
            </div>
        </div>
    <?php endwhile; ?>


</div>

<div class="gridViewContainer">
    <h2>ALBUMS</h2>
    <?php
    $albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE title LIKE '$term%' LIMIT 10");
    if (mysqli_num_rows($albumQuery) == 0)
        echo "<span>No Album Found" . $term . "</span>";
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