<!-- Page for presenting articles. -->

<?php

if ($db != null and isset($subpage)) {
    //Get table data from db.
    $res = getWholeTable($db, $table);

    //create a html formatted article
    $article = createArticle($res, $subpage);

    //print article
    echo $article;

    //set variables for previous and next article. If it reaches the first one, it stays there. Same for the highest one but the reverse.
    $prevArticle = null;
    $nextArticle = null;

    if ($subpagePos ==  0) {
        $nextArticle = $subpages[$subpagePos + 1];
    } else if ($subpagePos == (count($subpages)-1)) {
        $prevArticle = $subpages[$subpagePos-1];
    } else {
        $prevArticle = $subpages[$subpagePos-1];
        $nextArticle = $subpages[$subpagePos + 1];
    }

    //Create html for the previous and next buttons
    $navButtons = "<div class='navButtons'>";

    if ($prevArticle != null) {
        $navButtons .= "<a href='?page=articles-subpage&subpage=$prevArticle'>Föregående</a>";
    }
    if ($nextArticle != null) {
        $navButtons .= "<a href='?page=articles-subpage&subpage=$nextArticle'>Nästa</a>";
    }

    $navButtons .= "</div>";

    echo $navButtons;

} else {
    //Create startpage for articles
    $startarticle = "";

    $startarticle .= "<article class='artiklar'>";
    $startarticle .= "<header><h1>Artiklar om Nättraby vägmuseum</h1></header>";
    $startarticle .= "<p class=align-center><img src='img/orig/skylt-vagmuseum.jpg' alt='Skylt vägmuseum' /></p>";
    $startarticle .= "<p>Här finner ni artiklar med information om Nättraby vägmusum, dess uppkomst och utvecklingen till att finnas på webben. Här finns även information om väghistoria samt kontaktuppgifter och källor. Klicka runt bland sidorna och lär er mer!</p>";
    $startarticle .= "</article>";

    echo $startarticle;

    $type = "article";

    ?>

    <!-- Search function -->
    <article class=' artiklar'>
        <?php include(__DIR__ . "/../view/search-view.php"); ?>
    </article>

    <?php

}
