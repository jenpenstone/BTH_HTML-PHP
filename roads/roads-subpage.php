<!-- Page for presenting roads. -->

<?php

if ($db != null and isset($subpage)) {
    //Get table data from db.
    $res = getWholeTable($db, $table);

    //create a html formatted article
    $article = createObject($res, $subpage);

    //print article
    echo $article;

    //set variables for previous and next article. If it reaches the first one, it stays there. Same for the highest one but the reverse.
    $prevRoad = null;
    $nextRoad = null;

    if ($subpagePos ==  0) {
        $nextRoad = $subpages[$subpagePos + 1];
    } else if ($subpagePos == (count($subpages)-1)) {
        $prevRoad = $subpages[$subpagePos-1];
    } else {
        $prevRoad = $subpages[$subpagePos-1];
        $nextRoad = $subpages[$subpagePos + 1];
    }

    //Create html for the previous and next buttons
    $navButtons = "<div class='navButtons'>";

    if ($prevRoad != null) {
        $navButtons .= "<a href='?page=roads-subpage&subpage=$prevRoad'>Föregående</a>";
    }
    if ($nextRoad != null) {
        $navButtons .= "<a href='?page=roads-subpage&subpage=$nextRoad'>Nästa</a>";
    }

    $navButtons .= "</div>";

    echo $navButtons;

} else {
    //Create startpage for articles
    $startarticle = "";

    $startarticle .= "<article class='artiklar'>";
    $startarticle .= "<header><h1>Besöksmål - Nättraby vägmuseum</h1></header>";
    $startarticle .= "<a href='https://www.google.com/maps/d/u/0/viewer?mid=15wiPV93Cj3Pyz9M8YXQiIoxZ3CcSaaVH&ll=56.20236552266793%2C15.544420300000036&z=14' target=_blank><img class='mapImage' src='img/map-all-roads.jpg' alt='Skylt vägmuseum' /></a>";
    $startarticle .= "<p>Nättraby vägmuseum består av ett flertal vägar som går att besöka. Bland vägarna finns allt från cykelväg till båtväg. Kolla in vilka vägar just du är intresserad av att besöka och lägg upp en planering för hur din 'roadtrip' ska se ut. Sen är det bara till att ge sig ut och uppleva Nättraby.</p>";
    $startarticle .= "</article>";

    echo $startarticle;

    $type = "roads";

    ?>
    <!-- Search function -->
    <article class=' artiklar'>
        <?php include(__DIR__ . "/../view/search-view.php"); ?>
    </article>

    <?php

}
