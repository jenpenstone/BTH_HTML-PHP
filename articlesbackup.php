<!-- Multipage controller -->
<?php
// Pagecontoller
include(__DIR__ . "/src/functions.php");
include(__DIR__ . "/config.php");

// Get pointer to what page to show
$pageReference = $_GET["page"] ?? "start";

//Get the filename for this multipage, excluding the suffix of .php
$base = basename(__FILE__, ".php");

//Create an array with data from db for the subpages


//The collection of valid subpages, first page is default
$pages = [
    "start" => [
        "title" => "Nättraby Vägmuseum1",
        "file" => "start",
    ],
    "nattraby-vagmuseum" => [
        "title" => "Om Nättraby Vägmuseum2",
        "file" => "nattraby-vagmuseum",
    ],
    "kartor" => [
        "title" => "Kartor3",
        "file" => "kartor",
    ],
    "blekinges-vaghistoria" => [
        "title" => "Blekinges väghistoria4",
        "file" => "blekinges-vaghistoria",
    ],
    "sveriges-vaghistoria" => [
        "title" => "Sveriges väghistoria5",
        "file" => "sveriges-vaghistoria",
    ],
    "start2" => [
        "title" => "Nättraby Vägmuseum6",
        "file" => "start",
    ],
    "a" => [
        "title" => "Om Nättraby Vägmuseum7",
        "file" => "a",
    ],
    "b" => [
        "title" => "Kartor8",
        "file" => "b",
    ],
    "c" => [
        "title" => "Blekinges väghistoria9",
        "file" => "c",
    ],
    "d" => [
        "title" => "Sveriges väghistori10",
        "file" => "d",
    ],
    "e" => [
        "title" => "Om Nättraby Vägmuseum11",
        "file" => "e",
    ],
    "f" => [
        "title" => "Kartor12",
        "file" => "f",
    ],
    "g" => [
        "title" => "Blekinges väghistoria13",
        "file" => "g",
    ],
    "h" => [
        "title" => "Sveriges väghistoria14",
        "file" => "h",
    ],
];


//Get the current page from the $pages collection if its a match, otherwise set to null. Controll of incoming/safety check.
$page = $pages[$pageReference] ?? null;

//Set the file path.
$file = null;
if ($page) {
    $file = __DIR__ . "/${base}/{$page["file"]}.php";
}

//Set title
$title = "Om";

//Render page

//Include header
include(__DIR__ . "/view/header.php");

//Include navbar
include(__DIR__ . "/view/navbar.php");

// Include the main multipage content through the view template file
include(__DIR__ . "/view/articles-main.php");

//Include footer
include(__DIR__ . "/view/footer.php");
