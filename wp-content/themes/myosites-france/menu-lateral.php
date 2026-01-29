<?php if (wp_nav_menu(['theme_location' => 'lateralmenu', 'echo' => false])) : ?>
    <div id="menu-lateral">
        <?php
        wp_nav_menu([
            'theme_location' => 'lateralmenu',
            'container' => false,
            'menu_class' => 'nav flex-column',
            'walker' => new Walker_Nav_Menu_MF()
        ]);
        ?>
    </div>
<?php endif; ?>