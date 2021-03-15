
<?php
$subpage2 = "kontakt";
if ($db != null and isset($subpage)) {

    //Change table
    $table2 = "article";

    //Get table data from db.
    $res = getWholeTable($db, $table2);

    //create a html formatted article
    $article = createArticle($res, $subpage2);

    //print article
    echo $article;
}
