<div id="downloads">
    <ul class="download-list">
        <?php foreach ($downloads as $item) : ?>
        <li>
            <?php wc_get_template(
                'single-product/tabs/downloads-'.$item['type'].'.php',
                array(
                    'item' => $item,
                )
            ) ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>