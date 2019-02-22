<?php

/* Template Name: Blog HP */

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

<div class="blogs border-btm">
  <div class="container container-wider">
    <article class="blog featured-blog">
      <a href="#" class="blog-link">
        <div class="blog-pic">
          <div class="bg-stretch">
            <span data-srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img03.jpg, <?php echo get_template_directory_uri(); ?>/img/product-page/img03-2x.jpg 2x"></span>
            <span data-srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img03-m.jpg, <?php echo get_template_directory_uri(); ?>/img/product-page/img03-m-2x.jpg 2x" data-media="(max-width: 480px)"></span>
          </div>
          <span class="blog-tag">Tag ipsum</span>
        </div>
        <div class="blog-content">
          <h2>Lorem ipsum dolor sit amet</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          <i class="icon-next"></i>
        </div>
      </a>
    </article>
    <section class="blog-grid">
      <div class="row">
        <div class="col-xs-6 col-lg-4">
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
        <div class="col-xs-6 col-lg-4">
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
        <div class="col-xs-6 col-lg-4">
          <article class="blog">
            <a href="#" class="blog-link">
              <div class="blog-pic">
                <div class="bg-stretch">
                  <span data-srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img-blog03.jpg, <?php echo get_template_directory_uri(); ?>/img/product-page/img-blog03-2x.jpg 2x"></span>
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
        <div class="col-xs-6 col-lg-4">
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
        <div class="col-xs-6 col-lg-4">
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
        <div class="col-xs-6 col-lg-4">
          <article class="blog">
            <a href="#" class="blog-link">
              <div class="blog-pic">
                <div class="bg-stretch">
                  <span data-srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img-blog03.jpg, <?php echo get_template_directory_uri(); ?>/img/product-page/img-blog03-2x.jpg 2x"></span>
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
        <div class="col-xs-6 col-lg-4">
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
        <div class="col-xs-6 col-lg-4">
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
        <div class="col-xs-6 col-lg-4">
          <article class="blog">
            <a href="#" class="blog-link">
              <div class="blog-pic">
                <div class="bg-stretch">
                  <span data-srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img-blog03.jpg, <?php echo get_template_directory_uri(); ?>/img/product-page/img-blog03-2x.jpg 2x"></span>
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
        <div class="col-xs-6 col-lg-4">
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
        <div class="col-xs-6 col-lg-4">
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
        <div class="col-xs-6 col-lg-4">
          <article class="blog">
            <a href="#" class="blog-link">
              <div class="blog-pic">
                <div class="bg-stretch">
                  <span data-srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img-blog03.jpg, <?php echo get_template_directory_uri(); ?>/img/product-page/img-blog03-2x.jpg 2x"></span>
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
    </section>
    <div class="pager">
      <div class="pager-frame">
        <!-- <a href="#" class="prev"><i class="icon-arrow-back"></i></a> -->
        <ul>
          <li><strong>1</strong></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li>...</li>
          <li><a href="#">10</a></li>
        </ul>
        <a href="#" class="next"><i class="icon-arrow-next"></i></a>
      </div>
    </div>
  </div>
</div>

<?php get_footer();
