<div class="col-12 jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-8">
    <h1 class="display-4 font-italic"><?php the_title(); ?></h1>
    <?php the_excerpt(); ?>
    <p class="lead mb-8"><a href="<?php esc_url( the_permalink() );?>" class="text-white font-weight-bold">Continue Reading...</a></p>
    </div>
</div>
