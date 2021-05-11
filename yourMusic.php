<?php
include("includes/includedFiles.php");
?>

<div class="playlistsContainer" style="padding: 10px 0;">
    <div class="gridViewContainer" style="
    display: block;
    margin: 0 auto;
    width: 50%;
    text-align: center;
">
        <h2>PLAYLISTS</h2>
        <div class="buttonItems">
            <button class="button " onclick="createPlaylist()">NEW PLAYLIST</button>
        </div>
    </div>

    <?php
    $username = $userloggedin->getUsername();

    $playlistQuery = mysqli_query($con, "SELECT * FROM playlists WHERE owner='$username'");
    if (mysqli_num_rows($playlistQuery) == 0)
        echo "<span>No Playlist Found" . "</span>";
    while ($row = mysqli_fetch_array($playlistQuery)) :
        $playlist = new Playlist($con, $row);
    ?>
        <div class="gridViewItem">
            <div class="playlistImage" style="  box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.1);border-radius: 20px;">
                <img src="assets/images/icons/music.jpg" alt="">
            </div>
            <div class="gridViewInfo" role="link" tabindex="0" onclick="openPage('playlist.php?id=<?php echo $playlist->getId(); ?>')">
                <span style="text-transform: capitalize;"> <?php echo $playlist->getName(); ?></span>
            </div>
        </div>
    <?php
    endwhile;
    ?>
</div>