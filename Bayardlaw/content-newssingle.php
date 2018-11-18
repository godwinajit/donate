<?php
/**
 * The default template for displaying content *
 * Used for both single and index/archive/search.
 */
$category_detail = get_the_category( get_the_ID() );
$attroneyLists = get_field('attorneys_tag');
?>

		<header class="page-heading container-fluid text-center">
			<span class="pre-title"><?php echo $category_detail[0]->name; ?> / <time datetime="<?php the_time('m.j.Y') ?>">
				<?php the_time('m.j.Y') ?></time></span>
			<h1><?php the_title(); ?></h1>
		</header>
		<div class="container content-container">
			<div class="content-section">
				<article class="tab-article">
				<!--<h3><?php the_title(); ?></h3>-->
					<div class="content">
						<div class="article-box">
						<!--<p>
							<?php //if( $attroneyLists ): echo 'By ';
								//$attroneyCount = 0;
							?>
								<?php //foreach( $attroneyLists as $post ):
											//setup_postdata($post);
										 	//$term = get_term_by( 'id', $term_id, 'practices'); ?>
											<a href="<?php the_permalink(); ?>"><?php //if($attroneyCount != 0)echo ', ';the_title(); ?></a></li>
										<?php
											//wp_reset_postdata();
											//$attroneyCount++;
											//endforeach;
										?>
							<?php //endif;?>
						</p>-->
						<?php the_content();?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-xs-12">
						<?php $terms = get_field('practices_tag');
							if( $terms ): ?>
							<ul class="list-inline">
								<?php foreach( $terms as $term_id ):
								 $term = get_term_by( 'id', $term_id, 'practices'); ?>
								<li><a class="btn btn-link" href="<?php echo get_term_link( $term ); ?>">#<?php echo $term->name; ?></a></li>
								<?php endforeach; ?>
							</ul>
							<?php endif; ?>
						</div>
						<?php
								if( $attroneyLists ):
								/* if ($category_detail[0]->slug == 'publication'){
								?>
						<div class="col-sm-6 col-xs-12">
							<div class="media author-box pull-right">

							 <?php $i=1;foreach( $posts as $post): // variable must be called $post (IMPORTANT)?>
								<?php setup_postdata($post);  ?>
								<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post),'full');?>
								<div class="media-left">
									<a href="<?php the_permalink(); ?>"><img class="media-object" src="<?php echo  $large_image_url[0];?>" alt=""></a>
								</div>
								<div class="media-body">
									<div class="media-heading">
										<h4 class="media-heading">by <?php the_title(); ?></h4>

										<span class="post">– <?php echo the_field('designation',$post); ?> –</span>
									</div>
									<a href="<?php the_permalink(); ?>" class="link">Read Bio</a>
								</div>
								 <?php $i++; if($i==2) break; endforeach; ?>
							</div>
						</div>
						<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
						<?php
						}else{ */
							?>
							<div class="col-sm-6 col-xs-12">
								<div class="media author-box pull-right">
									<ul class="list-inline">
										<?php foreach( $attroneyLists as $post ):
											setup_postdata($post);
										 	$term = get_term_by( 'id', $term_id, 'practices'); ?>
											<li><a class="btn btn-link" href="<?php the_permalink(); ?>">#<?php the_title(); ?></a></li>
										<?php
											wp_reset_postdata();
											endforeach;
										?>
									</ul>
								</div>
							</div>
							<?php
						/*}*/
						endif; ?>
					</div>
				</article>
				<div class="share-row clearfix">
					<h3>Share this <?php echo $category_detail[0]->name; ?></h3>
					 <?php echo wpfai_social(); ?>

				</div>
			</div>
		</div>