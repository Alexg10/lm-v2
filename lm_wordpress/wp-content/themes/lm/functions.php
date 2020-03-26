<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage lm
 * @since 1.0.0
 */


//VUE
add_image_size( post_size, 360, 200, true );
add_image_size( header_picture, 2200);
add_image_size( sketch_picture, 600);



remove_filter ('the_content',  'wpautop');
remove_filter ('acf_the_content', 'wpautop');
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

add_action( 'rest_api_init', 'add_thumbnail_to_JSON' );
function add_thumbnail_to_JSON() {
	//Add featured image
	register_rest_field( 
		array('post', 'projets'), // Where to add the field (Here, blog posts. Could be an array)
		'featured_image_src', // Name of new field (You can call this anything)
		array(
			'get_callback'    => 'get_image_src',
			'update_callback' => null,
			'schema'          => null,
        )
    );
}

function get_image_src( $object, $field_name, $request ) {
	$feat_img_array = wp_get_attachment_image_src(
		$object['featured_media'], // Image attachment ID
		'post_size',  // Size.  Ex. "thumbnail", "large", "full", etc..
		true // Whether the image should be treated as an icon.
	);
  	return $feat_img_array[0];
}


/*
* On utilise une fonction pour créer notre custom post type 'Projets'
*/

function wpm_custom_post_type() {

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x( 'Projets', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x( 'Projet', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __( 'Projets'),
		// Les différents libellés de l'administration
		'all_items'           => __( 'Tout les projets'),
		'view_item'           => __( 'Voir les projets'),
		'add_new_item'        => __( 'Ajouter un nouveau projets'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer le projet'),
		'update_item'         => __( 'Modifier le projet'),
		'search_items'        => __( 'Rechercher un projet'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
	);
	
	// On peut définir ici d'autres options pour notre custom post type
	
	$args = array(
		'label'               => __( 'Projets'),
		'description'         => __( 'Tous les projets'),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		/* 
		* Différentes options supplémentaires
		*/
		'show_in_rest' 		  => true,
		'show_in_graphql' 	  => true,
		'graphql_single_name' => 'Project',
		'graphql_plural_name' => 'Projects',
		
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 'slug' => 'projets'),
	);
	
	// On enregistre notre custom post type qu'on nomme ici "projets" et ses arguments
	register_post_type( 'projets', $args );

}

add_action( 'init', 'wpm_custom_post_type', 0 );


/* Autoriser les fichiers SVG */
function wpc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['mp4'] = 'video/mp4';

	return $mimes;
}
add_filter('upload_mimes', 'wpc_mime_types');

function register_acf_options_pages() {

    // check function exists
    if ( ! function_exists( 'acf_add_options_page' ) ) {
        return;
    }

    // register options page
    $my_options_page = acf_add_options_page(
        array(
            'page_title'      => __( 'Options' ),
            'menu_title'      => __( 'Options' ),
            'menu_slug'       => 'options-page',
            'capability'      => 'edit_posts',
            'show_in_graphql' => true,
        )
    );
}

add_action( 'acf/init', 'register_acf_options_pages' )

?>
