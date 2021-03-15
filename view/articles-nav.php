<!-- Navigation for subpages -->
<aside>
    <!-- Side navigation -->
    <nav class='in-subpage'>
        <ul>
            <?php
            $name = "name";
            $aTitle = "title";
            $articles = get2Columns($db, $table, $name, $aTitle);
            foreach ($articles as $article) : ?>
            <li>
                <a class="<?= $article[$name] == $subpage ? "in-subpage-selected" : ""; ?>" href="?page=articles-subpage&subpage=<?= $article[$name] ?>"><?= $article[$aTitle] ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>

</aside>
