<form class="d-flex" role="search" action="<?= esc_url(home_url('/')); ?>">
    <input class="form-control me-2" name="s" type="search" placeholder="Chercher" aria-label="Champ de recherche" value="<?php get_search_query(); ?>">
    <button class="btn btn-dark" type="submit">Chercher</button>
</form>