<?php
get_header();
global $post;
$pg_id = $post ->ID;
$pg_ttl = $post ->post_title;
$ab_pg = cedo_get_option('cedo_au_id');
$ac_pg = cedo_get_option('cedo_ac_id');

if($pg_id == $ab_pg || $pg_id == $ac_pg){
?>
 <nav class="navbar navbar-inverse navbar-top second-navbar hidden-xs navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div id="navbar" class="navbar-collapse collapse navbar-second">
            <?php wp_nav_menu(array(
                'theme_location' => 'sub-menu-dream',
                'menu_class'     => 'nav navbar-nav navbar-right'
            )); ?>
        </div>
      </div>
    </nav>
<?php }else{
    
} ?>
<?php if (($pg_id == 84) || ($pg_id == 124) || ($pg_id == 122)){?>
<!--    <div class="range-heroimg">
        <div class="container ">
            <div class="row">
                <h1><?php
//                $ttl_bnr = get_field('main_banner_title', $pg_id);
//                if(isset($ttl_bnr)){
//                    echo $ttl_bnr; 
//                }
                ?></h1>
            </div>
        </div> 
    </div>-->
<?php }else{ ?>
   <div class="range-heroimg" style="background-image:url('<?php echo get_template_directory_uri() ?>/img/range-heroimg.jpg');">
        <div class="container ">
            <div class="row">
                <h1><?php
                $ttl_bnr = get_field('main_banner_title', $pg_id);
                if(isset($ttl_bnr)){
                    echo $ttl_bnr; 
                }
                ?></h1>
            </div>
        </div> 
    </div> 
<?php } ?>

<?php if($pg_id == $ab_pg || $pg_id == $ac_pg){ ?>
    <div class="page_intro single_nitem single-column  back_bg all_pg_com">
<?php }else{ ?>
         <div class="page_intro single_nitem single-column">
<?php } ?>
 <div class="container">
      <div class="row">
                <div class="col-md-12 ">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="row">
                        <div class="col-md-12 preffix_2 all_p-wrp">
                            <div class="heading1 heading1__inset1 wow flipInX" data-wow-delay="0.1s" data-wow-duration="1s">
                                <h2><?php the_title(); ?></h2>
                                     <?php 
       if (has_post_thumbnail($pg_id)) {
          $url = wp_get_attachment_image_src(get_post_thumbnail_id($pg_id), 'full');
          ?>
     <img src="<?php echo $url[0]; ?>"/>
     <?php 
       }
     ?>
                                <span class="secondary sin_cont"><?php the_content(); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
            endif;
            ?>
        </div>
        </div>
 </div>
          <?php
                 $content = get_field('content',$pg_id);                       
                        if ($content) {
                            $i = 1;
                            foreach ($content as $contents) {  
                               $posi =  $contents['image_position'];
                               $colr =  $contents['blck_background_color'];
          ?>
          <div class="dyn_cont" style="background:<?php echo $colr; ?>"> 
              <?php if($posi =='left'){ ?>
              <div class="container">
              <div class="col-md-12">
              <div class="col-md-6 cont_col" style="float:left">
              <?php }else{ ?>
                   <div class="container">
                   <div class="col-md-12">
                  <div class="col-md-6 cont_col" style="float:right"> 
              <?php } ?>
                  <?php echo $contents['content_area']; ?>
              </div>
              <div class="col-md-6 image_col" style="float:<?php echo $contents['image_position']; ?>">
                    <?php 
                    $cnt_img = $contents['content_image']; 
                    ?>
                  <img src="<?php echo $cnt_img['url']; ?>" />
              </div>
          </div>
          </div>
          </div>
            <?php } } ?>
        </div> 

<?php
get_footer();
?>

