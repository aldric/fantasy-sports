<?php

/**
 * @package Fantasy_Sports
 * @version 0.1
 */
/*
Plugin Name: FantasyLeague plugin
Description: All we need to handle our site
Author: Aldric Gaudinot
Version: 0.1

 */
define('__ROOT__', realpath(dirname(__FILE__)));
require_once(__ROOT__ . '/class/Bookmaker_Repository.php');
require_once(__ROOT__ . '/class/Helpers.php');
require_once(__ROOT__ . '/class/ViewRenderer.php');
require_once(__ROOT__ . "/widgets/ranking.widget.php");
require_once(__ROOT__ . "/widgets/bk.offer.php");
require_once(__ROOT__ . "/widgets/dg.widget.php");
require_once(__ROOT__ . "/widgets/ff.widget.php");
require_once(__ROOT__ . "/shortcodes/bk-codes.php");
require_once(__ROOT__ . "/admin/odds.admin.php");



function fantasy_plugin_enqueue_styles()
{
	$template_directory = plugin_dir_url(__FILE__);
	wp_register_style('fantasy-css', $template_directory . 'fantasy-sports.css', false, '0.2', 'all');
	wp_enqueue_style('fantasy-css');
}

add_action('wp_enqueue_scripts', 'fantasy_plugin_enqueue_styles', 16);


function cptui_register_my_cpts_fiche_bookmaker()
{

	/**
	 * Post Type: Fiches Bookmaker.
	 */

	$labels = array(
		"name" => __("Fiches Bookmakers", "supermagpro-child"),
		"singular_name" => __("Fiche Bookmaker", "supermagpro-child"),
	);

	$args = array(
		"label" => __("Fiches Bookmakers", "supermagpro-child"),
		"labels" => $labels,
		"description" => "Fiche descriptive d\'un bookmaker, avec revue, etc ",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => false,
		"query_var" => true,
		"menu_icon" => "dashicons-awards",
		"supports" => array("title"),
	);

	register_post_type("fiche_bookmaker", $args);
}

add_action('init', 'cptui_register_my_cpts_fiche_bookmaker');


function cptui_register_my_cpts_fiche_highlighted_event()
{
	/**
	 * Post Type: Matchs a la une Bookmaker.
	 */

	$labels = array(
		"name" => __("Matchs", "supermagpro-child"),
		"singular_name" => __("Match", "supermagpro-child"),
	);

	$args = array(
		"label" => __("Match", "supermagpro-child"),
		"labels" => $labels,
		"description" => "Fiche descriptive d\'un match",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => false,
		"query_var" => true,
		"menu_icon" => "dashicons-megaphone",
		"supports" => array("title"),
	);
	register_post_type("highlighted_event", $args);
}

add_action('init', 'cptui_register_my_cpts_fiche_highlighted_event');




/*******************************
 * 
 *  JORDAN'S CHANGES DANGEROUS TO TOUCH
 * 
 **********************************/


add_action('init', 'dcc_rewrite_rules');
function dcc_rewrite_rules()
{
	$redirections_list = 'rugby,rugby;tennis,tennis;golf,golf;football,football;handball,handball;basketball,basketball;jeuxolympiques,jeux-olympiques;athletisme,athletisme';
	$redirections = explode(";", $redirections_list);
	foreach ($redirections as $redirection) {
		$redirection_split = explode(",", $redirection);
		$post_type = $redirection_split[0];
		$post_redirect = $redirection_split[1];

		add_rewrite_rule('^' . $post_redirect . '/fantasy$', 'index.php?category_name=fantasy&post_type=' . $post_type, 'top');
		add_rewrite_rule('^' . $post_redirect . '/univers-sportif$', 'index.php?category_name=univers-sportif&post_type=' . $post_type, 'top');
		add_rewrite_rule('^' . $post_redirect . '/paris-sportifs$', 'index.php?category_name=paris-sportifs&post_type=' . $post_type, 'top');
		add_rewrite_rule('^' . $post_redirect . '/esport$', 'index.php?category_name=esport&post_type=' . $post_type, 'top');
	}

}


$permalink_structure = get_option('permalink_structure');
if (!$permalink_structure || '/' === substr($permalink_structure, -1))
	return;
add_filter('user_trailingslashit', 'ajout_trailingslash', 10, 2);
function ajout_trailingslash($url, $type)
{
	if ('single' === $type)
		return $url;
	if ('page' === $type)
		return $url;
	return trailingslashit($url);
}

// Editer la query si aucune catégorie n'est sélectionnée on va sur la catégorie fantasy
function my_modify_main_query($query)
{
	if (is_admin()) return;
	if ($query->is_archive() && $query->is_main_query() && !$query->is_category()) {
		$query->query_vars['cat'] = 62;
	}
}
// Hook my above function to the pre_get_posts action
add_action('pre_get_posts', 'my_modify_main_query');

remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

function add_meta_tags()
{
	global $post;
	if (is_category()) {
		$post_type = get_post_type();
		$post_type_data = get_post_type_object($post_type);
		$post_type_slug = $post_type_data->rewrite['slug'];
		$queried_object = get_queried_object();
		$categories_desc = get_field('descriptions', $queried_object);
		foreach ($categories_desc as $categorie_desc) {
			if ($categorie_desc['post_type'] === $post_type_slug) {
				echo '<meta name="description" content="' . wp_strip_all_tags($categorie_desc['description']) . '" />' . "\n";
			}
		}
	}
}
add_action('wp_head', 'add_meta_tags', 2);

function my_post_queries($query)
{
  // do not alter the query on wp-admin pages and only alter it if it's the main query
	if (!is_admin() && $query->is_main_query()) {

    // alter the query for the home and category pages 
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if (is_category()) {
			$query->set('posts_per_page', 30);
			if ($paged) {
				$query->set('paged', $paged);
			}
		}

	}
}
add_action('pre_get_posts', 'my_post_queries');

function check_urls()
{
//	$screen = get_current_screen();
	if (true) {
		//$redirections_list = ot_get_option( 'redirections_list' );
		$redirections_list = 'rugby,rugby;tennis,tennis;golf,golf;football,football;handball,handball;basketball,basketball;jeuxolympiques,jeux-olympiques;athletisme,athletisme';
		$redirections = explode(";", $redirections_list);
		$homepageId = get_option('page_on_front');
		// POST TYPE
		global $post;
		$id = $post->ID;
		$current_setted_permalink = get_post_meta($post->ID, 'custom_permalink', true);
		if (!$current_setted_permalink && $post->post_status === 'publish') {
			$post_type = $post->post_type;
			$url = "";
			$result = array_filter($redirections, function ($item) use ($post_type) {
				if (stripos($item, $post_type) !== false) {
					return true;
				}
				return false;
			});
			// IF CUSTOM POST TYPE
			if ($result) {
				$result = array_values($result);
				$redirect = explode(",", $result[0]);
				$url = $redirect[1] . "/";

				// CATEGORY
				$term_list = wp_get_post_terms($post->ID, 'category', array("fields" => "all"));
				$url .= $term_list[0]->slug;
			    
			    // PARENTS
				$parent_id = wp_get_post_parent_id($post->ID);

				if (!$parent_id) {
					$permalink = str_replace(home_url() . "/" . $redirect[1], '', get_permalink($id));
					$url .= $permalink;
					$children = get_pages(array('child_of' => $post->ID, 'post_type' => $post_type));
					if (sizeof($children) === 0) {
						$url = rtrim($url, "/");
						$url .= ".html";
					}
					update_post_meta($post->ID, 'custom_permalink', $url);
				} else {
					$parent_setted_permalink = get_post_meta($parent_id, 'custom_permalink', true);
					$parent_url = "";
					if (substr($parent_setted_permalink, -5) === ".html") {
						$parent_url = substr($parent_setted_permalink, 0, -5) . "/";
						update_post_meta($parent_id, 'custom_permalink', $parent_url);
					} else {
						$parent_url = $parent_setted_permalink;
					}
					$url = $parent_url . $post->post_name . ".html";
					update_post_meta($post->ID, 'custom_permalink', $url);
				}
			    
			// IF PAGE
			} elseif ($post_type === "page" && $post->ID != $homepageId) {
				$parent_id = wp_get_post_parent_id($post->ID);
				if (!$parent_id) {
					$url = get_permalink($id) . '.html';
					update_post_meta($post->ID, 'custom_permalink', $url);
				} else {
					$parent_setted_permalink = get_post_meta($parent_id, 'custom_permalink', true);
					$parent_url = "";
					if (substr($parent_setted_permalink, -5) === ".html") {
						$parent_url = substr($parent_setted_permalink, 0, -5) . "/";
						update_post_meta($parent_id, 'custom_permalink', $parent_url);
					} else {
						$parent_url = $parent_setted_permalink;
					}
					$url = $parent_url . $post->post_name . ".html";
					var_dump("test des urls - test des urls - test des urls - test des urls - test des urls - " . $url);
					update_post_meta($post->ID, 'custom_permalink', $url);
				}
			}
		}
	}
}

//add_action( 'admin_footer', 'check_urls' );

function has_children($post_ID = null)
{
	if ($post_ID === null) {
		global $post;
		$post_ID = $post->ID;
	}
	$query = new WP_Query(array('post_parent' => $post_ID, 'post_type' => 'any'));

	return $query->have_posts();
}

