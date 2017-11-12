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
				register_taxonomy(
					'prl_' . $var['name'],
					$var['post_type'],
					array(
						'hierarchical' => true,
						'label'        => $var['label'],
					)
				);
			}
		}
	}
}

if ( ! function_exists( 'prl_taxonomies' ) ) {
	function prl_taxonomies( $args ){
		return new PRL_Taxonomies( $args );
	}
}