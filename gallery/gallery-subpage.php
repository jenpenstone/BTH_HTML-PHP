
<?php
//Save input from search field in a variable if there is any.
$imagepos = isset($_GET['image']) ? htmlentities($_GET['image']) : 0;

//Get images from db
$res = getImages($db);

//nbr images per page
$nbrImages = 6;

//set position for first image and last
$first = $imagepos;
if ($first < 0) {
    $first = 0;
}

$last = $nbrImages + $first;

if ($last >= count($res)) {
    $nbrImages = count($res) - $first;
}

//Create html for the previous and next buttons
$navButtons = "<div class='navButtons'>";

//Checks if there are previous images to show
$prevPos = $first - $nbrImages;
if ($prevPos >= 0) {
    //Calculates new first position
    $newPos = $first - $nbrImages;
    $navButtons .= "<a href='?page=gallery-subpage&image=$newPos'>Föregående</a>";
}
//Checks if there are more images to show
if ($last < count($res)) {
    $navButtons .= "<a href='?page=gallery-subpage&image=$last'>Nästa</a>";
}

$navButtons .= "</div>";
?>

<!-- Render of page content -->
<article class="artiklar">
    <header>
        <h2><?=$page["title"]?></h2>
    </header>

<?php
$images = array_slice($res, $first, $nbrImages);

$gallery = createThumbnails($images);

echo $gallery;

echo $navButtons;

?>
</article>
