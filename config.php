<?php
/**
*Configuration file for webpage
**/

//Handling errors
error_reporting(-1);              // Report all type of errors
ini_set("display_errors", 1);     // Display all errors

//Starting session
startSession();

//End of the site title, the same for every page.
$siteTitle = " | Nättraby vägmuseum";

// Create a DSN for the database
$fileName = __DIR__ . "/db/nvm2.sqlite";
$dsn = "sqlite:$fileName";
