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
                    <div class="mf-post">
                        <h5 class="mf-post-title"> <?php the_title(); ?></h5>
                        <p class="mf-post-content">
                            <?php the_post_thumbnail('post-thumbnail', ['style' => 'width:160px; height:auto', 'class' => 'img-fluid rounded float-start mf-thumbnail']) ?>
                            <?php the_content(); ?>
                        </p>
                        <p class="mf-post-infos">
                            <?php $dateArticle = get_the_date('', '', '', false); ?>
                            Publié <?php if ($dateArticle): ?>le <?php endif; ?> <?php echo $dateArticle; ?> par <?php the_author(); ?>
                        </p>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>

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

        </div>
    </div>

    <?php
    get_footer();
