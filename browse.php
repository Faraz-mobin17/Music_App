<?php
include("includes/includedFiles.php");
?>

<h1 class="pageHeadingBig">Hello <span style="text-transform: capitalize;"><?php echo $_SESSION['userloggedin']; ?> </span> You might also like</h1>
<hr class="line">
<div class="gridViewContainer">
    <?php
    $albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");

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