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
				register_post_type( 'prl_' . $var,
					array(
						'labels'      => array(
							'name'          => ucfirst( prl_plural( $var ) ),
							'singular_name' => ucfirst($var),
						),
						'public'      => true,
						'has_archive' => true,
					)
				);
			}
		}
	}
}

if ( ! function_exists( 'prl_post_types' ) ) {
	function prl_post_types( $args ){
		return new PRL_Post_Types( $args );
	}
}
