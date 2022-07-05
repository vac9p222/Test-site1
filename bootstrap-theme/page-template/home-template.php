<?php
/*
Template Name: Шаблон главной страницы
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
	'posts_per_page' => 3,
    'order'     => 'DESC',
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


 <div class="container">
 <div class="row justify-content-between">
 <div class="title col-12"><h1>Каталог продукции</h1></div>
<?php 

$args = array(
    'post_type' => 'product', 
	'posts_per_page' => 3,
    'order'     => 'ASC',
    'orderby' => 'meta_value',
    'meta_key' => '_product_price',
);

$q = new WP_Query( $args );
if( $q->have_posts() ) :
	while( $q->have_posts() ) : $q->the_post(); 
    $post_id = get_the_ID();
    $product_title = carbon_get_post_meta($post_id, 'product_h1');
    $product_decr = carbon_get_post_meta($post_id, 'product_decr');
    $product_img = carbon_get_post_meta($post_id, 'product_images'); 
    $product_eq = carbon_get_post_meta($post_id, 'product_equipment');
    $product_select = carbon_get_post_meta($post_id, 'product_select_options');
    if( $product_select === false  )
    $text_select = '';
    if( $product_select == 2 )
    $text_select = 'Apple';
    if( $product_select == 3 )
    $text_select = 'Google';
    if( $product_select == 4 )
    $text_select = 'Xiaomi';

    $product_price = carbon_get_post_meta($post_id, 'product_price'); 
    ?>  

     <div class="col-lg-3 col-12 product-block">
     
        <div class="product-block__title">
            <h3> <?php echo $product_title; ?><h3>   </div>
            <div class="product-info">
            <?php // echo $product_decr; ?>
            <div class="product-block__img">
            <img src="<?php echo wp_get_attachment_image_url($product_img[0]) ?>" alt="Image"> </div>
            <div class="product-block__eq"><p>Комплектация: <?php echo $product_eq; ?></p></div>
            <div class="product-block__select" ><p>Производитель: <?php echo  $text_select; ?></p></div>
            <div class="product-block__price" ><p>Цена: <?php  echo $product_price; ?>р</p> </div>       
            <a class="product-block__link orange-btn" href="<?php echo get_permalink();?>">Подробнее</a>
            </div>
        
     
   
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