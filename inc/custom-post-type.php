<?php
// Experts Custom Post Type
function iag_expert_cpt_init() {

	$labels = array(
		'name'                => __( 'Experts', '_iag' ),
		'singular_name'       => __( 'Expert', '_iag' ),
        'menu_name'           => __( 'Experts' ),
        'all_items'           => __( 'All Experts' ),
        'view_item'           => __( 'Show Expert' ),
        'add_new_item'        => __( 'Add New Expert' ),
        'add_new'             => __( 'Add New Expert' ),
        'edit_item'           => __( 'Edit Expert' ),
        'update_item'         => __( 'Update Expert' ),
        'search_items'        => __( 'Search Expert' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not Found in Trash' ),
	);

	$args = array(
		'label'               => __( 'Expert', '_iag' ),
		'labels'              => $labels,
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'rest_base'           => '',
		'has_cases'           => false,
        'has_archive'         => false,
		'menu_icon'           => 'dashicons-groups',
		'menu_position'       => 5,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug' => 'experts', 'with_front' => true ),
		'query_var'           => true,
		'supports'            => array( 'title', 'custom-fields', 'revisions' ),
	);

	register_post_type( 'expert', $args );

	// taxonomy: Expertise
	register_taxonomy( 'expertise',
		array( 'expert' ),
		array(
			'labels'            => array(
				'name'          => __( 'Expertise Areas', '_iag' ),
				'singular_name' => __( 'Expertise Area', '_iag' ),
				'add_new_item'  => __( 'Add New Expertise Area', '_iag' ),
			),
			'hierarchical'      => false,
			'show_admin_column' => true,
			'show_ui'           => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'expertise' )
		)
	);

    // taxonomy: Therapeutic Area
    register_taxonomy( 'therapeutic-area',
        array( 'expert' ),
        array(
            'labels' => array(
                'name'          => __( 'Therapeutic Areas', '_iag' ),
                'singular_name' => __( 'Therapeutic Area', '_iag' ),
                'add_new_item'  => __( 'Add New Therapeutic Area', '_iag' ),
            ),
            'hierarchical'      => true,
            'show_admin_column' => true,
            'show_ui'           => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'therapeutic-area' )
        )
    );

    // taxonomy: Indicator Area
    register_taxonomy( 'indicator-area',
        array( 'expert' ),
        array(
            'labels' => array(
                'name'          => __( 'Key Indicator Areas', '_iag' ),
                'singular_name' => __( 'Indicator Area', '_iag' ),
                'add_new_item'  => __( 'Add New Indicator Area', '_iag' ),
            ),
            'hierarchical'      => false,
            'show_admin_column' => true,
            'show_ui'           => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'indicator-area' )
        )
    );
}
add_action( 'init', 'iag_expert_cpt_init' );

function iag_leadership_cpt_init() {

	$labels = array(
		'name'                     => __( 'Leadership', '_iag' ),
		'singular_name'            => __( 'Leadership Member', '_iag' ),
		'menu_name'                => __( 'Leadership', '_iag' ),
		'all_items'                => __( 'All Leadership Members', '_iag' ),
		'view_item'                => __( 'View Leadership Member', '_iag' ),
		'add_new_item'             => __( 'Add New Leadership Member', '_iag' ),
		'add_new'                  => __( 'Add New', '_iag' ),
		'edit_item'                => __( 'Edit Leadership Member', '_iag' ),
		'update_item'              => __( 'Update Leadership Member', '_iag' ),
		'search_items'             => __( 'Search Leadership', '_iag' ),
		'not_found'                => __( 'No leadership members found', '_iag' ),
		'not_found_in_trash'       => __( 'No leadership members found in Trash', '_iag' ),
	);

	$args = array(
		'label'               => __( 'Leadership Member', '_iag' ),
		'labels'              => $labels,
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'rest_base'           => '',
		'has_cases'           => false,
        'has_archive'         => false,
		'menu_icon'           => 'dashicons-businessperson',
		'menu_position'       => 5,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug' => 'leadership', 'with_front' => true ),
		'query_var'           => true,
		'supports'            => array( 'title', 'custom-fields', 'revisions' ),
	);

	register_post_type( 'leadership', $args );
}
add_action( 'init', 'iag_leadership_cpt_init' );

function iag_resource_cpt_init() {

	$labels = array(
		'name'                => __( 'Resources', '_iag' ),
		'singular_name'       => __( 'Resource', '_iag' ),
        'menu_name'           => __( 'Resources' ),
        'all_items'           => __( 'All Resources' ),
        'view_item'           => __( 'Show Resource' ),
        'add_new_item'        => __( 'Add New Resource' ),
        'add_new'             => __( 'Add New Resource' ),
        'edit_item'           => __( 'Edit Resource' ),
        'update_item'         => __( 'Update Resource' ),
        'search_items'        => __( 'Search Resource' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not Found in Trash' ),
	);

	$args = array(
		'label'               => __( 'Resource', '_iag' ),
		'labels'              => $labels,
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'rest_base'           => '',
		'has_cases'           => false,
        'has_archive'         => false,
		'menu_icon'           => 'dashicons-groups',
		'menu_position'       => 5,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug' => 'resources', 'with_front' => true ),
		'query_var'           => true,
		'supports'            => array( 'title', 'custom-fields', 'revisions' ),
	);

	register_post_type( 'resource', $args );

	// taxonomy: Source
	register_taxonomy( 'source',
		array( 'resource' ),
		array(
			'labels'            => array(
				'name'          => __( 'Resource Type', '_iag' ),
				'singular_name' => __( 'Resource Type', '_iag' ),
				'add_new_item'  => __( 'Add New Resource Type', '_iag' ),
			),
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_ui'           => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'source' ),
		)
	);

}
add_action( 'init', 'iag_resource_cpt_init' );


function iag_case_studies_cpt_init() {

	$labels = array(
		'name'                => __( 'Case Studies', '_iag' ),
		'singular_name'       => __( 'Case Study', '_iag' ),
        'menu_name'           => __( 'Case Studies' ),
        'all_items'           => __( 'All Case Studies' ),
        'view_item'           => __( 'Show Case Study' ),
        'add_new_item'        => __( 'Add New Case Study' ),
        'add_new'             => __( 'Add New Case Study' ),
        'edit_item'           => __( 'Edit Case Study' ),
        'update_item'         => __( 'Update Case Study' ),
        'search_items'        => __( 'Search Case Study' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not Found in Trash' ),
	);

	$args = array(
		'label'               => __( 'Case Study', '_iag' ),
		'labels'              => $labels,
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'rest_base'           => '',
		'has_cases'           => false,
        'has_archive'         => false,
		'menu_icon'           => 'dashicons-groups',
		'menu_position'       => 6,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug' => 'case-studies', 'with_front' => true ),
		'query_var'           => true,
		'supports'            => array( 'title', 'custom-fields', 'revisions' ),
	);

	register_post_type( 'case-study', $args );
}
add_action( 'init', 'iag_case_studies_cpt_init' );