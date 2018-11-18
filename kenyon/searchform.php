<?php $sq = get_search_query() ? get_search_query() : ''; ?>
<form action="<?php echo home_url(); ?>" class="search-form" method="get">
    <fieldset>
        <input type="search" placeholder="Search" name="s" value="<?php echo $sq; ?>">
        <input type="submit" value="Submit">
    </fieldset>
</form>
