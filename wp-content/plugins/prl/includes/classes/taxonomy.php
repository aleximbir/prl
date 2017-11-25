<?php
if ( ! class_exists( 'PRL_Taxonomies' ) ) {
	class PRL_Taxonomies {

		public $taxonomies;

		function __construct( $args = null ) {
			$this->taxonomies = $args;
			$this->register_taxonomy();
		}

		public function register_taxonomy(){
			foreach ( $this->taxonomies as $key => $var ) {
				$labels = array(
					'name'                       => $var['plural_name'],
					'singular_name'              => $var['singular_name'],
					'search_items'               => prl_lbl( 'Search' ) . ' ' . ucfirst( $var['plural_name'] ),
					'all_items'                  => prl_lbl( 'All' ) . ' ' . ucfirst( $var['plural_name'] ),
					'parent_item'                => prl_lbl( 'Parent' ) . ' ' . ucfirst( $var['singular_name'] ),
					'parent_item_colon'          => prl_lbl( 'Parent' ) . ' ' . ucfirst( $var['singular_name'] ),
					'edit_item'                  => prl_lbl( 'Edit' ) . ' ' . ucfirst( $var['singular_name'] ),
					'update_item'                => prl_lbl( 'Update' ) . ' ' . ucfirst( $var['singular_name'] ),
					'add_new_item'               => prl_lbl( 'Add New' ) . ' ' . ucfirst( $var['singular_name'] ),
					'new_item_name'              => prl_lbl( 'New' ) . ' ' . ucfirst( $var['singular_name'] ) . ' ' . prl_lbl( 'Name' ),
					'separate_items_with_commas' => prl_lbl( 'Separate' ) . ' ' . strtolower( $var['plural_name'] ) . ' ' . prl_lbl( 'with commas' ),
					'add_or_remove_items'        => prl_lbl( 'Add or remove' ) . ' ' . strtolower( $var['plural_name'] ),
					'choose_from_most_used'      => prl_lbl( 'Choose from the most used' ) . ' ' . strtolower( $var['plural_name'] ),
					'not_found'                  => prl_lbl( 'No') . ' ' . strtolower( $var['plural_name'] ) . ' ' . prl_lbl( 'found' ) . '.',
					'menu_name'                  => $var['plural_name'],
				);

				$args = array(
					'hierarchical'      => true,
					'labels'            => $labels,
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
					'rewrite'           => array( 'slug' => 'prl_' . $key ),
				);

				register_taxonomy( 'prl_' . $key, array( $var['post_type'] ), $args );
			}
		}
	}
}

if ( ! function_exists( 'prl_taxonomies' ) ) {
	function prl_taxonomies( $args ){
		return new PRL_Taxonomies( $args );
	}
}