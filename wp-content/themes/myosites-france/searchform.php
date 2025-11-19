<form class="d-flex" role="search" action="<?php echo esc_url(home_url('/')); ?>">
    <input class="form-control me-2" type="search" placeholder="Chercher" aria-label="Champ de recherche" value="<?php get_search_query(); ?>">
    <button class="btn btn-outline-success" type="submit">Chercher</button>
</form>