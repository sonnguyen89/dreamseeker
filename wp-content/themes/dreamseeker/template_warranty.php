 <?php
/*
  Template Name: warranty
 */
get_header();
global $post;
?> 

 <!--===================================================================Second Navigation===========================================================================================-->
    <nav class="navbar navbar-inverse navbar-top second-navbar hidden-xs navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div id="navbar" class="navbar-collapse collapse navbar-second">
          <?php wp_nav_menu(array(
                'theme_location' => 'sub-menu-warranty',
                'menu_class'     => 'nav navbar-nav navbar-right'
            )); ?>
        </div>
      </div>
    </nav>
    
  <!--======================================================================Warranty hero image======================================================================================-->
    
    <div class="range-heroimg" style="background-image:url('<?php echo get_template_directory_uri() ?>/img/range-heroimg.jpg');">
        <div class="container ">
            <div class="row">
                <h1>Warranty & assistance</h1>
            </div>
        </div> 
    </div>
    
    <div class="warranty-main">
        <div class="container ">
            <div class="row">
                <div class="col-md-12 ">
                    <h2>We have you covered</h2>
                    <img class="img-responsive" src="<?php echo get_template_directory_uri() ?>/img/warranty-map.png">
                </div>
             </div>
        </div>
    </div>
    
    <div class="warranty-sub">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-8 warranty-oneyear EqHeightDiv">
                    <div class="pull-left"><img src="<?php echo get_template_directory_uri() ?>/img/warranty-oneyear.png"> <h4 class="uppercase">1 year</br>warranty</h4></div>
                    <div class="pom">
                        <h2>Peace of Mind</h2>
                        <p><?php 
                         $txt1 = get_field('peace_of_mind_text',$post->ID);
                         $txt2 = get_field('make_a_claim_text',$post->ID);
                         echo $txt1;
                        ?>
                            </br>
                        </p>
                        <a href="<?php echo get_permalink(cedo_get_option('cedo_tcp_id')); ?>" class="ftc">See full Terms & Conditions</a>
                    </div>
                </div>
                 <div class="col-md-4  warranty-claim EqHeightDiv">
                    <h2>Make a Claim</h2>
                     <p><?php  echo $txt2; ?></p>
                     <!--<button type="submit" class="btn btn-default btn-lg">Make a Claim</button>-->
                     <?php  $claim_id = cedo_get_option('cedo_claim_id');
                     ?>
                     <a class="btn btn-default btn-lg" target="_blank" href="<?php echo get_permalink($claim_id);?>">Make a Claim</a>
                </div>
             </div>
        </div>
    </div>
       
<?php
get_footer();
?>