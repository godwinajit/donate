<?php

/*
Template Name: Button Template
*/

if(is_user_logged_in()): 

theme_wrapper_class('contacts');

get_header();

?>
<?php if (have_posts()) : the_post(); ?>

<?php get_template_part('blocks/header/header-image') ?>
<div class="main-holder">
    <div class="container">
        <div class="row">
            <section class="contact-section">
                <div class="col-sm-12">
                    <div class="boxes">
                        <?php
						if(isset($_REQUEST['runcron']))
						{
							$TicketSocketImport = new classTicketSocketImportPlugin();
							if($TicketSocketImport->fetch_events())
							{
								echo "<h1> Events Successfully Imported </h1>" ;
							}
							else
							{
								echo "<h1> Events Successfully Imported </h1>" ;
							}
						}
						else
						{
							the_content();
						}
						?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php endif; ?>

<?php get_footer(); ?>
<?php endif; ?>