<div class="wrap-main">
    <?php
    //Include navbar for subpages
    include(__DIR__ . "/sub-nav.php"); 
    ?>

    <main class="multi-main">
        <article>
            <header>
                <h1><?=$title?></h1>
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
