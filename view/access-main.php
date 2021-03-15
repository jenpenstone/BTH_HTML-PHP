<div class="wrap-main">

    <main class="">
        <article>
            <header>
                <h1><?=$title?></h1>
            </header>
            <!-- Main content -->


            <!-- If a valid page has been entered by the user, the file is included on webpage. -->
            <?php if ($page) : ?>
                <?php include $file ?>
            <?php else : ?>
                <p>You have requested a page that doesn't exist: '<?= htmlentities($pageReference) ?>' </p>
            <?php endif; ?>
        </article>
    </main>

</div>
