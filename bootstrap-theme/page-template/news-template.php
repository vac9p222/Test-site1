<?php
/*
Template Name: Шаблон страницы новостей

*/
?>
<?php get_header();


?>

<main>
<div class="container">
 <div class="row justify-content-between">
 <div class="title col-12"><h1>Новости</h1></div>
<?php 

$args = array(
    'post_type' => 'news', 
	'posts_per_page' => -1,
    'order'     => 'ASC',
    'orderby' => 'meta_value',
    'meta_key' => '_news_date',
);

$q = new WP_Query( $args );
if( $q->have_posts() ) :
	while( $q->have_posts() ) : $q->the_post(); 
    $post_id = get_the_ID();
    $news_title = carbon_get_post_meta($post_id, 'news_h1');
    $news_decr = carbon_get_post_meta($post_id, 'news_decr');
    $news_img = carbon_get_post_meta($post_id, 'news_img'); 
    $news_date = carbon_get_post_meta($post_id, 'news_date'); 
    ?>  

     <div class="col-lg-3 col-12 post-block">
       <div class="post-block__title"><h3><?php echo $news_title;?></h3></div>
       <div class="post-block__img"><img src="<?php echo $news_img ;?>"></div>
       <div class="post-block__date"><p>Дата публикации: <?php echo $news_date;?></p></div>
       <div class="post-block__descr"><p><?php echo $news_decr;?></p></div>
       <div class="post-block__more"><a class="orange-btn" href="<?php echo get_permalink();?>">Читать далее</a></div>
     </div>
     <?php   
	endwhile;
endif;
wp_reset_postdata();
?>

 </div>
 </div>
</main>


<?php get_footer(); ?>