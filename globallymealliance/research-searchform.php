<?php
$my_postid = 10140;//This is page id or post id
$content_post = get_post($my_postid);
$title = $content_post->post_title;
$title = apply_filters('the_content', $title);
$title = str_replace(']]>', ']]&gt;', $title);

$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
?>
<h1><?php echo get_the_title($my_postid); ?></h1>
<?php echo $content;?>
<div class="form-optional">
	<form action="/search-the-research/" method="post" accept-charset="utf-8">
		<div class="filter-form">
			<input type="hidden" name="post_types" value="research" >
			<div class="row flex-wrap custom-odering" id="research-topics-select-id">
				<div class="col-xs-12 col-sm-9 col-lg">
					<div class="input-holder">
						<input type="text" name="search-research" placeholder="Search by keywords" value="<?php echo trim($_POST['search-research']) != "" ? trim($_POST['search-research']) : '';?>">
					</div>
				</div>
				<div class="col-xs-6 col-sm-4">
					<div class="input-holder">
						<?php echo getCategoryMultiSelect( array( 'taxonomy' => 'research_topics' ), 'research_topics', 'Topic',$_POST['research_topics'] );?>
					</div>
				</div>
				<div class="col-xs-6 col-sm-4">
					<div class="input-holder">
						<?php echo getCategoryMultiSelect( array( 'taxonomy' => 'research_year' ), 'research_year', 'Year', $_POST['research_year']);?>
					</div>
				</div>
				<div class="col-xs-6 col-sm-4">
					<div class="input-holder">
						<?php echo getCategoryMultiSelect( array( 'taxonomy' => 'research_author' ), 'research_author', 'Researcher', $_POST['research_author']);?>
					</div>
				</div>
				<div class="col-xs-6 col-sm-3 col-sm actions">
					<input type="submit" name="Search">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<div class="link-holder">
						<p><a href="<?php echo site_url('/the-research/notable-articles/'); ?>">Clear search and show all results</a></p>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="input-holder">
						<select name="research-search-sort">
							<option <?php echo (isset($_POST['research-search-sort']) && ( $_POST['research-search-sort'] == 'relevance' )) ? 'selected' : '';?> value="relevance">Sort by Relevance</option>
							<option <?php echo (isset($_POST['research-search-sort']) && ( $_POST['research-search-sort'] == 'post_date' )) ? 'selected' : '';?> value="post_date">Sort by Date</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>