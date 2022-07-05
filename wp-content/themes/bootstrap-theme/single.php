<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bootstrap-theme
 */

get_header();


?>

<?php 

$post_type = get_post_type();


if( $post_type == 'product'){
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
<main>
<div class="container">
    <div class="row justify-content-between">
        <div class="col-lg-2 col-12">
        <div class="slider-product">
            <?php foreach($product_img as $slider_item){?>
         <div class="slider-product__item">
           <img src="<?php echo wp_get_attachment_image_url($slider_item);?>">
         </div>
       
         <?php }
            ?>
             </div>
        </div>
        <div class="col-lg-10 col-12">
         <h1> <?php echo $product_title; ?></h1>
         <div class="product-block__descr">
         <p>Описание:</p>
         <?php echo $product_decr; ?>
         </div>
         <div class="product-block__eq"><p>Комплектация: <?php echo $product_eq; ?></p></div>
         <div class="product-block__select" ><p>Производитель: <?php echo  $text_select; ?></p></div>
        <div class="product-block__price" ><p>Цена: <?php  echo $product_price; ?>р</p> </div> 
        </div>
    </div>
    </div>
   </main>
<?php 
}
?>
<?php 
 if($post_type == 'news'){
    $post_id = get_the_ID();
    $news_title = carbon_get_post_meta($post_id, 'news_h1');
    $news_decr = carbon_get_post_meta($post_id, 'news_decr');
    $news_img = carbon_get_post_meta($post_id, 'news_img'); 
    $news_date = carbon_get_post_meta($post_id, 'news_date'); 
 ?>

<main>
 <div class="container">
    <div class="row justify-content-between">
        <div class="col-12 news-block">
        <div class="news-block__title">
           <h1> <?php echo $news_title;?></h1>
           <div class="news-block__img"><img src="<?php echo $news_img ;?>"></div>
           <div class="news-block__date">Дата публикации: <?php echo $news_date;?></div>
           <div class="news-block__descr">
                <?php echo  $news_decr;?>
           </div>
        </div>
        </div>
    </div>
 </div>
</main>
<?php
 }
?>
<?php get_footer();
