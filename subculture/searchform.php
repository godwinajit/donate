<?php $sq = get_search_query() ? get_search_query() : __('', 'subculture'); ?>
<form method="get" class="form-search" action="<?php echo home_url(); ?>" >
	<fieldset>
    	<label for="search">SEARCH FOR YOUR QUESTION</label>
        <div class="wrap">
			<input type="search" id="search" name="s" value="<?php echo $sq; ?>" />
            <button type="submit" class="fa fa-search"> <span>search</span></button>
        </div>
	</fieldset>
</form>