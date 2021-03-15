<!-- Navigation for subpages -->
<aside>
    <!-- Side navigation -->
    <nav class='sub-nav'>
        <ul>
            <?php foreach ($pages as $key => $value) : ?>
            <li class="article-nav">
                <a class="<?= $value["file"] == $page["file"] ? "subpage-selected" : ""; ?>" href="?page=<?= $key ?>"><?= $value["title"] ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>

</aside>
