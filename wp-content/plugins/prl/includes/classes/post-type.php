<?php
if ( ! class_exists( 'PRL_Post_Types' ) ) {
	class PRL_Post_Types {

		public $post_types;

		function __construct( $args = null ) {
			$this->post_types = $args;
			$this->register_post_type();
		}

		public function register_post_type(){
			foreach ( $this->post_types as $key => $var ) {
				$labels = array(
					'name'               => ucfirst( $key ),
					'singular_name'      => ucfirst( $var['singular_name'] ),
					'menu_name'          => ucfirst( $key ),
					'name_admin_bar'     => ucfirst( $var['singular_name'] ),
					'add_new'            => prl_lbl( 'Add New' ) . ' ' . ucfirst( $var['singular_name'] ),
					'add_new_item'       => prl_lbl( 'Add New' ) . ' ' . ucfirst( $var['singular_name'] ),
					'new_item'           => prl_lbl( 'New' ) . ' ' . ucfirst( $var['singular_name'] ),
					'edit_item'          => prl_lbl( 'Edit' ) . ' ' . ucfirst( $var['singular_name'] ),
					'view_item'          => prl_lbl( 'View' ) . ' ' . ucfirst( $var['singular_name'] ),
					'all_items'          => prl_lbl( 'All' ) . ' ' . ucfirst( $var['plural_name'] ),
					'search_items'       => prl_lbl( 'Search' ) . ' ' . ucfirst( $var['plural_name'] ),
					'parent_item_colon'  => prl_lbl( 'Parent' ) . ' ' . ucfirst( $var['plural_name'] ),
					'not_found'          => prl_lbl( 'No' ) . ' ' . strtolower( $var['plural_name'] ) . ' ' . prl_lbl( 'found' ) . '.',
					'not_found_in_trash' => prl_lbl( 'No' ) . ' ' . strtolower( $var['plural_name'] ) . ' ' . prl_lbl( 'found in Trash' ) . '.',
				);

				$args = array(
					'labels'             => $labels,
					'description'        => ucfirst( $var['description'] ),
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'rewrite'            => array( 'slug' => 'prl_' . $key ),
					'capability_type'    => 'post',
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => null,
					'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
				);

				register_post_type( 'prl_' . $key, $args );
			}
		}
	}
}

if ( ! function_exists( 'prl_post_types' ) ) {
	function prl_post_types( $args ){
		return new PRL_Post_Types( $args );
	}
}
