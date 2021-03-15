<!-- Multipage controller -->
<?php
// Pagecontoller
include(__DIR__ . "/src/functions.php");
include(__DIR__ . "/config.php");

// Get pointer to what page to show
$pageReference = $_GET["page"] ?? "blekinges-vaghistoria";

//Get the filename for this multipage, excluding the suffix of .php
$base = basename(__FILE__, ".php");

//The collection of valid subpages, first page is default
$pages = [
    "blekinges-vaghistoria" => [
        "title" => "Blekinges väghistoria",
        "file" => "blekinges-vaghistoria",
    ],
    "sveriges-vaghistoria" => [
        "title" => "Sveriges väghistoria",
        "file" => "sveriges-vaghistoria",
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
$title = "Väghistoria";

//Render page

//Include header
include(__DIR__ . "/view/header.php");

//Include navbar
include(__DIR__ . "/view/navbar.php");

// Include the main multipage content through the view template file
include(__DIR__ . "/view/roadhistory-main.php");

//Include footer
include(__DIR__ . "/view/footer.php");
