<?php
get_header();
global $post;
?>
    <div class="page_intro single_nitem">
 <div class="container">
                    <div class="row">
                        <div class="col-md-12 preffix_2">
                            <div class="heading1 heading1__inset1 wow flipInX" data-wow-delay="0.1s" data-wow-duration="1s">
                                <h2><?php the_title(); ?></h2>
                                <span class="secondary"><?php the_content(); ?></span>
                            </div>
                        </div>
                    </div>               
        </div>
 </div>

<?php
get_footer();
?>

