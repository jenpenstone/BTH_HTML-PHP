<?php
/**
* Funtions
**/




/**
 * Start a named session.
 *
 * @return void
 */
function startSession()
{
    // Start the named session,
    // the name is based on the path to this file.
    $name = preg_replace("/[^a-z\d]/i", "", __DIR__);
    session_name($name);
    session_start();
}


/**
 * Destroy a session, the session must be started.
 *
 * @return void
 */
function destroySession()
{
    // Unset all of the session variables.
    $_SESSION = [];

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
}

/* ---- Database functions ----- */

/**
* Creating a connection to a database. Returns $db with the link to the database.
* @return PDO $db
*/
function connectToDatabase($dsn)
{
    $db = null;
    // Open the database file with $dns and catch the exception if it fails.
    try {
        $db = new PDO($dsn);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Failed to connect to the database using DSN:<br>$dsn<br>";
        throw $e;
    }
    return $db;
}



/**
*Get all content from a table in the database as an array.
*/
function getWholeTable($db, $table)
{
    // Prepare and execute the SQL statement
    $stmt = $db->prepare("SELECT * FROM $table");
    $stmt->execute();

    // Get the results as an array with column names as array keys
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $res;
}



/**
*Get all content from a table in the database as an array.
*/
function getTableHead($db, $table)
{

    //Gets array of table in database.
    $resArray = getWholeTable($db, $table);

    //Takes out column names(keys) from array and stores in a new array.
    $columns = array_keys($resArray[0]);

    return $columns;
}


/**
* Takes out a list with all values from a column in the specified table
*
* @return array $articleNames
*/
function getColumnValues($db, $table, $column)
{
    //Select row
    $sql = "SELECT $column FROM $table";

    // Prepare and execute the SQL statement
    $stmt = $db->prepare($sql);
    $stmt->execute();

    // Get the results as an array with column names as array keys
    $res = $stmt->fetchAll(PDO::FETCH_COLUMN);

    return $res;
}

/**
* Takes out a list with all values from a column in the specified table
* @return array $articleNames
*/
function get2Columns($db, $table, $column1, $column2)
{
    //Select row
    $sql = "SELECT $column1, $column2 FROM $table";

    // Prepare and execute the SQL statement
    $stmt = $db->prepare($sql);
    $stmt->execute();

    // Get the results as an array with column names as array keys
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $res;
}

/**
*Search for rows in a table in db that has the requested input. Take only two columns.
*/
function searchPreview($db, $table, $search)
{

    // Create select row.
    $sql = "SELECT * FROM $table WHERE title LIKE ? OR data LIKE ?;";

    // Prepare the SQL statement
    $stmt = $db->prepare($sql);

    $param = "%{$search}%";
    $params = [$param, $param];

    // Execute the SQL statement
    $stmt->execute($params);

    // Get the results as an array with column names as array keys
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $res;
}

/**
*Create thumbnails with pictures. takes a res as input and returns a string
*/
function getImages($db)
{
    $table = "image";

    // Create select row.
    $sql = "SELECT * FROM $table;";

    // Prepare the SQL statement
    $stmt = $db->prepare($sql);

    // Execute the SQL statement
    $stmt->execute();

    // Get the results as an array with column names as array keys
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $res;
}


/* ---- Handling data from database / Create HTML code of it ----- */

/**
* Find a specified article in an array and return it
* @return array $article
*/
function findArticle($res, $articleName)
{
    $article = null;
    foreach ($res as $value) {
        //Checks if it is the specified article
        if (in_array($articleName, $value)) {
            $article = $value;
            return $article;
        }
    }
    return $article;
}



/**
* Use an array with sub-arrays to create an article in html format.
* @return string $page
*/
function createPage($res, $pageName)
{
    //Find and get specified page
    $pageArray = findArticle($res, $pageName);

    //Create varable with data
    $data = $pageArray["data"] ?? "";

    //Create HTML string for article
    $page = "";
    $page .= "<div>$data</div>";

    return $page;
}



/**
*Create thumbnails with pictures. takes a res as input and returns a string
*/
function createThumbnails($res)
{
    $htmlString = "";
    $htmlString .= "<div class='gallery'>";

    foreach ($res as $image) {
        $name = $image["imageAdress"];
        $alt = $image["imageAlt"];

        $htmlString .= "<div class='thumbnails'>";
        $htmlString .= "<a target='_blank' href='img/orig/$name'>";
        $htmlString .= "<img src='img/150x150/$name' alt='$alt'>";
        $htmlString .= "</a></div>";
    }

    $htmlString .= "</div>";

    return $htmlString;
}




/**
* Use an array with sub-arrays to create an article in html format.
* @return string $article
*/
function createArticle($res, $articleName)
{
    //Find and get specified article
    $articleArray = findArticle($res, $articleName);

    //Create varables with data from article string
    $articleTitle = $articleArray["title"] ?? "";
    $data = $articleArray["data"] ?? "";
    $author = $articleArray["author"] ?? "";

    $gps = $articleArray["gps"] ?? "";

    $image1 = $articleArray["image1"] ?? null;
    $image1Alt = $articleArray["image1Alt"] ?? "";
    $image1Text = $articleArray["image1Text"] ?? "";
    $image2 = $articleArray["image2"] ?? null;
    $image2Alt = $articleArray["image2Alt"] ?? "";
    $image2Text = $articleArray["image2Text"] ?? "";

    //Create HTML string for article
    $article = "";
    $article .= "<article class='artiklar'>";
    $article .= "<header><h2>$articleTitle</h2></header>";
    $article .= "<p>$gps</p>";

    //If there is an image, add it together with imagetext.
    if ($image1) {
        $article .= "<p class=align-center><img src='img/orig/$image1' alt=$image1Alt /></p>";
        $article .= "<p class='imagetext'>$image1Text</p>";
    }

    $article .= "<div>$data</div>";

    //If there is an image, add it together with imagetext.
    if ($image2) {
        $article .= "<p class=align-center><img src='img/orig/$image2' alt=$image2Alt /></p>";
        $article .= "<p class='imagetext'>$image2Text</p>";
    }

    $article .= "<footer class='byline'><p>Artikel skriven av: $author</p></footer>";
    $article .= "</article>";

    return $article;
}



/**
* Use an array with sub-arrays to create an article in html format.
* @return string $object
*/
function createObject($res, $objectName)
{
    //Find and get specified article
    $objectArray = findArticle($res, $objectName);

    //Create varables with data from object string
    $objectTitle = $objectArray["title"] ?? "";
    $data = $objectArray["data"] ?? "";
    $author = $objectArray["author"] ?? "";

    $gps = $objectArray["gps"] ?? "";

    $mapImage = $objectArray["mapImage"] ?? null;

    $image1 = $objectArray["image1"] ?? null;
    $image1Alt = $objectArray["image1Alt"] ?? "";
    $image1Text = $objectArray["image1Text"] ?? "";
    $image2 = $objectArray["image2"] ?? null;
    $image2Alt = $objectArray["image2Alt"] ?? "";
    $image2Text = $objectArray["image2Text"] ?? "";

    //Create HTML string for article
    $object = "";
    $object .= "<article class='artiklar'>";
    $object .= "<header><h2>$objectTitle</h2></header>";
    $object .= "<p>$gps</p>";

    if ($mapImage) {
        $object .= "<p><img src='img/250/{$mapImage}_karta.jpg' alt='Karta $objectTitle' /></p>";
        $object .= "<p>Karta över besöksmålet. Ni finner en samlad bild över alla vägar på översikts-sidan för besöksmålen.</p>";
    }

    //If there is an image, add it together with imagetext.
    if ($image1) {
        $object .= "<p class=align-center><img src='img/orig/$image1' alt=$image1Alt /></p>";
        $object .= "<p class='imagetext'>$image1Text</p>";
    }

    $object .= "<div>$data</div>";

    //If there is an image, add it together with imagetext.
    if ($image2) {
        $object .= "<p class=align-center><img src='img/orig/$image2' alt=$image2Alt /></p>";
        $object .= "<p class='imagetext'>$image2Text</p>";
    }

    $object .= "<footer class='byline'><p>Artikel skriven av: $author</p></footer>";
    $object .= "</article>";

    return $object;
}




/**
* Use an array $res to create previews of content in array in html format.
* @return string $previws
*/
function createPreviews($res, $type)
{
    //check if preview is for roads or articles and sets href according to it
    $href = "?page=";
    if ($type == 'article') {
        $href .= 'articles-subpage&subpage=';
    } else {
        $href .= 'roads-subpage&subpage=';
    }

    //Create HTML string for article
    $previews = "";
    $previews .= "<div class='previews'>";

    foreach ($res as $value) {
        //wrapper around single preview
        $previews .= "<div class='preview'>";

        //Create varable with the title and add to preview string
        $header = $value["title"] ?? "";
        $previews .= "<h3>$header</h3>";

        //Create varable with data and shorten it down. Add to preview string
        $data = $value["preview"] ?? "";
        $data = trim($data);
        $previews .= "<div class='previewText'>$data</div>";

        //Create variable for subpage.
        $name = $value["name"] ?? "";
        $subpage = $href . $name;
        $previews .= "<a href='$subpage'>Läs mer</a>";

        //end single preview wrapper
        $previews .= "</div>";

    }
    //end previews
    $previews .= "</div>";

    return $previews;
}
