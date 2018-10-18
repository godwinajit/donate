		<footer id="footer">
			<div class="container footer-block">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<?php dynamic_sidebar( 'sidebar-footer' );?>	
					</div>			
					<?php dynamic_sidebar( 'sidebar-news' );?>	  
					<div class="clearfix visible-sm"></div>
					<div class="col-md-3 col-sm-6">
					<?php dynamic_sidebar( 'sidebar-featured' );?>	
					</div>	
					<div class="clearfix visible-sm"></div>	
					<div class="col-md-3 col-sm-6">
					
					
						<?php dynamic_sidebar( 'sidebar-contactinfo' );?>	
						
						
					</div>
				</div>
			</div>
			<div class="footer-bar">
				<div class="container">
					<div class="row">
						<div class="col-sm-8"><p class="copyright">&copy; Copyright <?php echo date('Y'); ?> - Airpot Corp. All Right Reserved.</p></div>
						<div class="col-sm-8"><p class="copyright">Airpot<sup>&reg;</sup>, Airpel<sup>&reg;</sup>,  Airpel Plus<sup>&reg;</sup> , Airpel-AB<sup>&reg;</sup>, and Gramforce<sup>&reg;</sup> are registered trademarks of Airpot Corp.</p></div>
						<div class="col-sm-4 text-right">
							<a href="#header" class="backtotop">Back To Top <span class="fa fa-chevron-up"></span></a>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<?php wp_footer();?>
	<script>window.jQuery || document.write('<script src="js/jquery-1.8.3.min.js"><\/script>')</script>
	
</body>
</html>