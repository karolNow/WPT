<?php
/**
 * Extend Recent Posts Widget 
 *
 * Adds different formatting to the default WordPress Recent Posts Widget
 */

Class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {

	function widget($args, $instance) {
	
		extract( $args );
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
				
		if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = 1;
            $pt = get_post_type();
            

        ?><ul class="rp-wrap"><?php 

        $rp_so = new WP_Query( apply_filters( 'widget_posts_args', array( 'post_type'=> 'cat1', 'posts_per_page' => 1, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'order'=> 'DESC', 'orderby'=> 'date' ) ) );
        
        if( $title ) echo $before_title . $title . $after_title; 
            if( $rp_so->have_posts() ) :
                
                echo $before_widget;
                    
                    while( $rp_so->have_posts() ) : $rp_so->the_post(); 
                    
                        $cat= get_the_category();
                        foreach($cat as $cd){
                            $catslug = $cd->slug;
                        }?>	    
                        
                        <li class="rp-item <?php echo 'rp-'.$catslug; ?>">
                            <div class="recent-post">
                                <div class="rp-bg" style="background-image:url(<?php the_post_thumbnail_url('medium'); ?>)"></div>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                <?php the_excerpt()?>

                            <div>
                        </li><?php
                    
                    endwhile;    
            endif;
        
        wp_reset_postdata();

        $rp_do = new WP_Query( apply_filters( 'widget_posts_args', array( 'post_type'=> 'cat2' , 'posts_per_page' => 1, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'order'=> 'DESC', 'orderby' => 'date' ) ) );
        
  
            if( $rp_do->have_posts() ) :
                
                echo $before_widget;    
                    while( $rp_do->have_posts() ) : $rp_do->the_post(); 
                    
                        $cat= get_the_category();
                        foreach($cat as $cd){
                            $catslug = $cd->slug;
                        }?>	    
                        
                        <li class="rp-item <?php echo 'rp-'.$catslug; ?>">
                            <div class="recent-post">
                                <div class="rp-bg" style="background-image:url(<?php the_post_thumbnail_url('medium'); ?>)"></div>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                <?php the_excerpt()?>

                            <div>
                        </li><?php
                    
                    endwhile;    
            endif;
        
        wp_reset_postdata();

        $rp_pp = new WP_Query( apply_filters( 'widget_posts_args', array( 'post_type'=> 'cat3' , 'posts_per_page' => 1, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'order'=> 'DESC', 'orderby'=> 'date' ) ) );
        
        
            if( $rp_pp->have_posts() ) :
                
                echo $before_widget;                    
                    while( $rp_pp->have_posts() ) : $rp_pp->the_post(); 
                    
                        $cat= get_the_category();
                        foreach($cat as $cd){
                            $catslug = $cd->slug;
                        }?>	    
                        
                        <li class="rp-item <?php echo 'rp-'.$catslug; ?>">
                            <div class="recent-post">
                                <div class="rp-bg" style="background-image:url(<?php the_post_thumbnail_url('medium'); ?>)"></div>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                <?php the_excerpt()?>

                            <div>
                        </li><?php
                    
                    endwhile;    
            endif;
        
        wp_reset_postdata();

			?></ul><?php 
	echo $after_widget;        
		
	}
}
function my_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'my_recent_widget_registration');

function set_widget_tag_cloud_args($args) {
  $my_args = array('smallest' => 14, 'largest' => 24 );
  $args = wp_parse_args( $args, $my_args );
return $args;
}
add_filter('widget_tag_cloud_args','set_widget_tag_cloud_args');
