<?php $products = array('cat1','cat2','cat3'); 
    
foreach($products as $product) {
    ?>


  <article class="<?php echo $product; ?>">
    <h1 class="main-product-title"><?php echo $product; ?></h1>
    <div class="container-fluid products-wrap products-wrap-<?php echo $product; ?>">
    
        <?php
            $custom_query = new WP_Query( 
                array(
                    'post_type' => 'Produkty', 
                    'category_name'=> $product,
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order'=> 'ASC'
                ) 
            );
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
            $terms = get_the_terms( get_the_ID(), 'on-draught' );
            $count =0;
        ?>


        <?php if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post();
          $categories = get_the_category();
          $category = $categories[0]->slug ;
          $term = $categories[0]->taxonomy ;
          $exc = get_the_excerpt();
          $perm = get_permalink();
          $col= '#e88b1a';

          if($category == 'cat1'){
              $color='#e88b1a';
              $but='btn-art-so';
          }

          if($category == 'cat2'){    
              $color = '#00a2b9';
              $but = 'btn-art-dm';
          } 

          if($category == 'cat3'){
              $color = '#e49ba4';
              $but = 'btn-art-pp';
          }
        ?>

        <div href="<?php echo $perm ?>" class="partners_prod  <?php echo $category.$count ?> ">
              <div class=" <?php echo $category ?> prod-border">
                <div class="si-img"> <?php the_post_thumbnail('medium');?></div> 
                <div class="si-info"> 
                    <h1 class="si-title"> <?php echo get_the_title() ?></h1> 
                    <p class="si-exerp"> <?php the_field('prod-exc'); echo' (...)' ?></p>
                    <div class="but-sld"><a class="btn <? echo $but ?>" href="<? echo $perm ?>">więcej</a></div>
                </div> 
              </div> 
        </div> 

        <?php
          $count = $count+1;    
          endwhile; 
          endif;
          wp_reset_query();
        ?>

    </div>        
  </article>
                  
        <?php } ?>