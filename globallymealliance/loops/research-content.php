<div class="post">
	<div class="post-title">
		<h2><a href="<?php the_field('research_url');?>" target="_blank"><?php the_title();?></a></h2>
		<p><?php the_field('additional_info');?></p>
		<p>
			<strong class="authors">
				<?php echo getCategoryNamesForPosts(get_the_ID(), 'research_author', ',', false);?>
			</strong>
		</p>
		<p class="info">
			<em class="published-year">
				<span class="title">YEAR:</span>
				<span class="year"><?php echo getCategoryNamesForPosts(get_the_ID(), 'research_year', ',', false);?></span>
			</em>
			<em class="topic-list">
				<span class="title">TOPICS:</span>
				<?php echo getCategoryNamesForPosts(get_the_ID(), 'research_topics', ',', true);?>.
			</em>
		</p>
	</div>
	<?php if(get_the_content()){?>
	<div class="open-close">
		<div class="slide">
			<div class="frame">
				<?php the_content();?>
			</div>
		</div>
		<a href="#" class="opener"><span>Read more</span><em>Read less</em></a>
	</div>
	<?php }?>
</div>