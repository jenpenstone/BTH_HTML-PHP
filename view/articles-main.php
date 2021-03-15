
<div class="wrap-main">
    <!-- Instead of subpage nav, en emty navbar -->
    <nav class='sub-nav'></nav>
    <?php

    //Connect to database.
    $db = connectToDatabase($dsn);

    //Set which table to search in.
    $table = 'article';

    // Get pointer to what road to show
    $subpageRef = $_GET["subpage"] ?? null;

    //The collection of valid subpages
    $subpages = [
        "start",
        "nattraby-vagmuseum",
        "kartor",
        "blekinges-vaghistoria",
        "sveriges-vaghistoria",
        "om-vagmuseum",
        "om-vagmuseum-natet",
        "om-projektet",
        "om-invigning",
        "kontakt",
        "kallor"
    ];

    //If subpageRef is in subpages, set subpage to subpageRef, otherwise keep it to null.
    $subpage = null;
    $subpagePos = null;
    foreach ($subpages as $key => $value) {
        if ($subpageRef == $value) {
            $subpage = $subpageRef;
            $subpagePos = $key;
        }
    }

    ?>

    <main class="multi-main">
        <article>
            <header>
                <h1><?=$title?></h1>
                <?php include(__DIR__ . "/articles-nav.php"); ?>
            </header>

            <!-- Main content included from subpage -->

            <!-- If a valid page has been entered by the user, the file is included on webpage. -->
            <?php if ($page) : ?>
                <?php include $file ?>
            <?php else : ?>
                <p>You have requested a page that doesn't exist: '<?= htmlentities($pageReference) ?>' </p>
            <?php endif; ?>

        </article>
    </main>

</div>
