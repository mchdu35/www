<?php
get_header();
?>


<div class="row align-items-start">
    <div class="row">
        <div class="col-3">
            <?php include('menu-lateral.php') ?>
        </div>
        <div class="col-7">
            <?php if (have_posts()): ?>
                <?php while (have_posts()): the_post(); ?>

                    <?php if (the_post_thumbnail()): ?>
                        <img src="<? the_post_thumbnail() ?>" class="card-img-top thumbnail rounded" style="width:60px; height:auto;">
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"> <?php the_title(); ?></h5>
                        <p class="card-text"> <?php the_content(); ?></p>
                    </div>


                    <?php if (is_front_page() && is_main_site()) : ?>
                        <div class="container text-center">
                            <div class="row">
                                <div class="col">
                                    <a class="navbar-brand" href="javascript:;"><img src="<?php echo get_template_directory_uri() . '/images/logo-i.png'; ?>" style="width:200px; height:auto;"></a>
                                </div>
                                <div class="col">
                                    <a class="navbar-brand" href="javascript:;"><img src="<?php echo get_template_directory_uri() . '/images/logo-ch.png'; ?>" style="width:200px; height:auto;"></a>
                                </div>
                                <div class="col">
                                    <a class="navbar-brand" href="javascript:;"><img src="<?php echo get_template_directory_uri() . '/images/logo-nai.png'; ?>" style="width:200px; height:auto;"></a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <a class="navbar-brand" href="javascript:;"><img src="<?php echo get_template_directory_uri() . '/images/logo-pm.png'; ?>" style="width:200px; height:auto;"></a>
                                </div>
                                <div class="col">
                                    <a class="navbar-brand" href="/dermatomyosite-juvenile"><img src="<?php echo get_template_directory_uri() . '/images/logo-dmj.png'; ?>" style="width:200px; height:auto;"></a>
                                </div>
                            </div>

                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php
    get_footer();
