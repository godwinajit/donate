<?php

/* Template Name: Blog Page */

get_header();

?>
<div class="page-header text-center bg-red">
  <div class="container">
    <div class="breadcrumbs">
      <a href="<?php echo network_site_url();?>" class="go-back d-md-none"><i class="icon-back"></i>Home</a>
      <ul class="d-none d-md-block">
        <?php if(function_exists('bcn_display'))
				{
					bcn_display();
				}
		?>
      </ul>
    </div>
    <h1>Santa Energy latest news lorem ipsum dolor sit amet</h1>
  </div>
</div>
<div class="main-cols">
  <div class="container container-wider">
    <div class="row">
      <div class="col-md-7 col-lg-8">
        <div class="blog single-blog">
          <div class="blog-pic">
            <div class="bg-stretch">
              <span data-srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img03.jpg, <?php echo get_template_directory_uri(); ?>/img/product-page/img03-2x.jpg 2x"></span>
              <span data-srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img03-m.jpg, <?php echo get_template_directory_uri(); ?>/img/product-page/img03-m-2x.jpg 2x" data-media="(max-width: 480px)"></span>
            </div>
          </div>
          <h2>Lorem Ipsum dolor Sit Amet</h2>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
          <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum nihil molestiae consequatur.</p>
          <p>Vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugi magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipi, nisi ut aliquid ex ea commodi consequatur?</p>
          <p>Quis autem vel eum iure reprehenderit qu voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</p>
          <p>Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
          <h2>Lorem Ipsum dolor Sit Amet</h2>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
          <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum nihil molestiae consequatur.</p>
          <div class="caption">
            <img src="<?php echo get_template_directory_uri(); ?>/img/product-page/img-blog04.jpg" srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img-blog04-2x.jpg 2x" alt="description">
            <p>Image Description</p>
          </div>
          <h2>1. Lorem Ipsum dolor Sit Amet</h2>
          <p>Aed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
          <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum nihil molestiae consequatur.</p>
          <ul>
            <li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi</li>
            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</li>
            <li>Lorem ipsum dolor sit amet, consectetur adipisici.</li>
            <li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea</li>
          </ul>
          <p>GALLERY WILL BE HERE</p>
          <h2>2. Lorem Ipsum dolor Sit Amet</h2>
          <p>Wed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
          <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum nihil molestiae consequatur.</p>
          <ol>
            <li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi</li>
            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</li>
            <li>Lorem ipsum dolor sit amet, consectetur adipisici.</li>
            <li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea</li>
          </ol>
          <p>Video will be here</p>
          <blockquote cite="#">
            <div class="cite">
              <img src="<?php echo get_template_directory_uri(); ?>/img/product-page/ava-00.jpg" alt="Sophie Garza"> <span><strong>Sophie Garza</strong> Lake Krystinafurt</span>
            </div>
            <p>Lorem ipsum mattis torquent metus non Vestibulum vitae tincidunt metus sit ultrices semper. Risus. At lacus erat, quis.</p>
          </blockquote>
          <h2>Lorem Ipsum dolor Sit Amet</h2>
          <p>Ped ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
          <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum nihil molestiae consequatur.</p>
        </div>
        <section class="recommended">
          <h2>Recommended Posts</h2>
          <div class="blog-grid">
            <div class="row mobile-slider">
              <div class="col-md-6">
                <article class="blog">
                  <a href="#" class="blog-link">
                    <div class="blog-pic">
                      <div class="bg-stretch">
                        <span data-srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img-blog01.jpg, <?php echo get_template_directory_uri(); ?>/img/product-page/img-blog01-2x.jpg 2x"></span>
                      </div>
                      <span class="blog-tag">Tag ipsum</span>
                    </div>
                    <div class="blog-content">
                      <h3>Lorem ipsum dolor sit amet</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididuntullamco laboris</p>
                      <i class="icon-next"></i>
                    </div>
                  </a>
                </article>
              </div>
              <div class="col-md-6">
                <article class="blog">
                  <a href="#" class="blog-link">
                    <div class="blog-pic">
                      <div class="bg-stretch">
                        <span data-srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img-blog02.jpg, <?php echo get_template_directory_uri(); ?>/img/product-page/img-blog02-2x.jpg 2x"></span>
                      </div>
                      <span class="blog-tag">Tag ipsum</span>
                    </div>
                    <div class="blog-content">
                      <h3>Lorem ipsum dolor sit amet</h3>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididuntullamco laboris</p>
                      <i class="icon-next"></i>
                    </div>
                  </a>
                </article>
              </div>
            </div>
          </div>
        </section>
      </div>
      <aside class="col-md-5 col-lg-4 aside">
        <?php dynamic_sidebar('blog-details');?>
      </aside>
    </div>
  </div>
</div>
<?php get_footer();
