<?php
    //Save input from search field in a variable if there is any.
    $search = isset($_GET['search-field']) ? strip_tags($_GET['search-field']) : null;
?>

<!-- Form for searching in travel db table country -->
<form id=search_form method="get">
    <fieldset>
        <input type="text" name="search-field" id="search-field" value="<?=$search?>">

        <input type=submit name="send" value=Sök>
    </fieldset>
</form>


<!-- Wrapper for result content -->
<div class="searchResult">

    <?php
    //set columns to import from db
    $column1 = 'title';
    $column2 = 'preview';

    if (is_null($search) or $search == "") {

        //Prints table with all rows
        if ($db != null) {
            //Get table data from db.
            $res = getWholeTable($db, $table);

            //Create small previews of content in a html format
            $previews = createPreviews($res, $type);

            //Print previews
            echo $previews;
        }
    } else {

        if ($db != null) {
            //Search for previews that match.
            $res = searchPreview($db, $table, $search);

            //Create small previews of content in a html format
            $previews = createPreviews($res, $type);

            //Print previews
            echo $previews;

        }
    }
    ?>
</div>
