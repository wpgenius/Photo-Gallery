<?php


get_header();

?>



<!-- #Content -->

<div id="Content">

	<div class="content_wrapper clearfix">



		<!-- .sections_group -->

		<div class="sections_group">
			<?php   cm_show_breadcrumb(); ?>
			<div class="section">
                <div class="section_wrapper clearfix offers_wrap">
                    <div class="container">
                    	<div class="post-content clearfix">
                             <div class="single-photos-inner column one column_portfolio_grid">
                                <ul class="portfolio_grid">
							<?php
						        $ids = get_post_meta($post->ID, 'vdw_gallery_id', true);

						        foreach ($ids as $key => $value){
						         
						            $image = wp_get_attachment_image_src($value);
						            $image_full = wp_get_attachment_image_src($value, 'full' );
		                            $image_thumbnail = wp_get_attachment_image_src($value, 'news-thumbnail' ); ?>
						            <li>
			                            <a href="<?php echo $image_full[0] ;?>" rel="lightbox[gallery]" title="<?php echo get_the_title(); ?>" class="plus-arrow">
			                         		<img src="<?php echo $image_thumbnail[0]; ?>" itemprop="thumbnail" alt="<?php echo get_the_title() ?>" itemprop="image" />
			                            </a>				            
		                            </li>
						            
								<?php } ?>
						
                                    </ul>
                                </div>
                            </div>
				</div>
		</div>
	</div>
</div>


		<!-- .four-columns - sidebar -->
        <div class="sidebar four columns">
            <div class="widget-area clearfix lines-boxed" style="min-height: 1348px;">
                <?php dynamic_sidebar("sidebar-photo-gallery-left-sidebar"); ?>
            </div>
        </div>

			

	</div>

</div>
<?php 
get_footer();
