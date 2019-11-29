<?php
wp_reset_postdata();

foreach((get_the_category()) as $category) { 
    $category->cat_name; 
} 


$args = array(
    'post_type' => 'produkty',
    'post_status' => 'publish',
    'posts_per_page' =>  1,
    'category_name' => $category->cat_name,
    'orderby' => 'rand',
    'order' => 'ASC'
);

$color = $category->cat_name;
$but = 'phs-btn';

if($color == 'cat1'){
     $color='#e88b1a';
     $but='btn-art-so';
}

if($color == 'cat2'){    
     $color = '#00a2b9';
     $but = 'btn-art-dm';
} 

if($color == 'cat3'){
    $color = '#e49ba4';
     $but = 'btn-art-pp';
}

$loop = new WP_query($args);

while($loop -> have_posts()) : $loop -> the_post();

$per=get_permalink();

echo'<div style="border-color:'.$color.'" class="product row">';
    echo'<div style="border-color:'.$color.'" class="product-info">';
        echo'<h1 class="product-title">'.get_the_title().'</h1>';
        echo'<p class="product-exerp">'.get_the_excerpt().'</p>';
        echo'<div class="but"><a class="btn '.$but.'" href="'.$per.'">więcej</a></div>';
    echo'</div>';
    echo'<div class="product-img">';
        the_post_thumbnail('full');
    echo'</div>';
echo'</div>';

endwhile;

wp_reset_postdata();
?>
