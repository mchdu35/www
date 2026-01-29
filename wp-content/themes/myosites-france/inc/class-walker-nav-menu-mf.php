<?php

/**
 * Walker Nav Menu Bootstrap 5
 *
 * Génère des menus compatibles Bootstrap 5 avec dropdowns
 *
 * @package Myosites_France
 */

class Walker_Nav_Menu_MF extends Walker_Nav_Menu
{
    /**
     * Démarre un nouveau niveau de sous-menu
     */
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);

        // Premier niveau = dropdown-menu, niveaux suivants = dropdown-menu dropdown-submenu
        $submenu_class = ($depth === 0) ? 'dropdown-menu' : 'dropdown-menu dropdown-submenu';

        $output .= "\n{$indent}<ul class=\"{$submenu_class}\">\n";
    }

    /**
     * Démarre un élément de menu
     */
    public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0)
    {
        $menu_item = $data_object;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        // Classes de base pour le <li>
        $classes = empty($menu_item->classes) ? array() : (array) $menu_item->classes;
        $classes[] = 'nav-item';
        $classes[] = 'menu-item-' . $menu_item->ID;

        // Vérifier si l'élément a des enfants (sous-menu)
        $has_children = in_array('menu-item-has-children', $classes);

        if ($has_children) {
            $classes[] = 'dropdown';  // Toujours ajouter dropdown pour le JS
            if ($depth > 0) {
                $classes[] = 'dropend'; // Sous-sous-menu s'ouvre vers la droite
            }
        }

        // Filtrer les classes
        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $menu_item, $args, $depth));

        $li_atts = array();
        $li_atts['id'] = 'menu-item-' . $menu_item->ID;
        $li_atts['class'] = $class_names;

        $li_attributes = $this->build_atts($li_atts);
        $output .= $indent . '<li' . $li_attributes . '>';

        // Attributs du lien <a>
        $atts = array();
        $atts['target'] = !empty($menu_item->target) ? $menu_item->target : '';
        $atts['rel'] = !empty($menu_item->xfn) ? $menu_item->xfn : '';
        $atts['href'] = !empty($menu_item->url) ? $menu_item->url : '';
        $atts['aria-current'] = $menu_item->current ? 'page' : '';

        // Classes du lien
        if ($depth === 0) {
            // Niveau principal (navbar)
            $link_classes = array('nav-link');
            if ($has_children) {
                $link_classes[] = 'dropdown-toggle';
                // Pas de data-bs-toggle pour permettre le hover CSS
                // Le clic reste fonctionnel sur mobile via CSS
                $atts['aria-expanded'] = 'false';
                $atts['role'] = 'button';
            }
        } else {
            // Sous-menus (niveau 2, 3, etc.)
            $link_classes = array('dropdown-item');
            if ($has_children) {
                $link_classes[] = 'dropdown-toggle';
                // Pas de data-bs-toggle pour les sous-menus imbriqués
                $atts['aria-expanded'] = 'false';
            }
        }

        // Ajouter classe active si élément courant
        if ($menu_item->current || $menu_item->current_item_ancestor) {
            $link_classes[] = 'active';
        }

        $atts['class'] = implode(' ', $link_classes);

        // Appliquer les filtres WordPress
        $atts = apply_filters('nav_menu_link_attributes', $atts, $menu_item, $args, $depth);
        $attributes = $this->build_atts($atts);

        // Titre du lien
        $title = apply_filters('the_title', $menu_item->title, $menu_item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $menu_item, $args, $depth);

        // Construire le HTML
        $item_output = $args->before ?? '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= ($args->link_before ?? '') . $title . ($args->link_after ?? '');
        $item_output .= '</a>';
        $item_output .= $args->after ?? '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args);
    }

    /**
     * Construit une chaîne d'attributs HTML
     */
    protected function build_atts($atts = array())
    {
        $attribute_string = '';
        foreach ($atts as $attr => $value) {
            if (false !== $value && '' !== $value && is_scalar($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attribute_string .= ' ' . $attr . '="' . $value . '"';
            }
        }
        return $attribute_string;
    }
}
