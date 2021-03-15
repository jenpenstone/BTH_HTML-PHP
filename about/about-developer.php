<?php
if ($db != null and isset($subpage)) {
    //Get table data from db.
    $res = getWholeTable($db, $table);

    //create a html formatted article
    $pageContent = createPage($res, $subpage);
}

?>


<article class=' artiklar'>
    <header>
        <h2><?=$page["title"]?></h2>
    </header>
    <div class="smallImage"><img class="smallImage" src="./img/developer.jpg" alt="Bild på utvecklaren"></div>
    <?php
    //print article
    echo $pageContent;
    ?>

</article>
