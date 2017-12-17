<?php
if ( ! class_exists( 'PRL_Meta_Boxes' ) ) {
	class PRL_Meta_Boxes {

		public $post_type, $context, $priority, $hook_priority, $fields, $meta_box_id, $label;

		function __construct( $args = null ) {
			$this->meta_box_id   = isset( $args['meta_box_id'] ) ? $args['meta_box_id'] : 'PRL_Meta_Boxes';
			$this->label         = isset( $args['label'] ) ? $args['label'] : 'PRL Metabox';
			$this->post_type     = isset( $args['post_type'] ) ? $args['post_type'] : 'post';
			$this->context       = isset( $args['context'] ) ? $args['context'] : 'normal';
			$this->priority      = isset( $args['priority'] ) ? $args['priority'] : 'low';
			$this->hook_priority = isset( $args['hook_priority'] ) ? $args['hook_priority'] : 10;
			$this->fields        = isset( $args['fields'] ) ? $args['fields'] : array();

			self::hooks();
		}

		function enqueue_scripts() {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_media();
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'jquery' );
		}

		public function hooks() {
			add_action( 'add_meta_boxes' , array( $this, 'add_meta_box' ), $this->hook_priority );
			add_action( 'save_post', array( $this, 'save_meta_fields' ), 1, 2 );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_head', array( $this, 'scripts' ) );
			add_action( 'edit_form_after_title', array( $this, 'new_context_after_title' ) );
		}

		public function add_meta_box() {
			if( is_array( $this->post_type ) ){
				foreach ( $this->post_type as $post_type ) {
					add_meta_box( $this->meta_box_id, $this->label, array( $this, 'meta_fields_callback' ), $post_type, $this->context, $this->priority );
				}
			}
			else{
				add_meta_box( $this->meta_box_id, $this->label, array( $this, 'meta_fields_callback' ), $this->post_type, $this->context, $this->priority );
			}
		}

		public function new_context_after_title() {
			global $post, $wp_meta_boxes;

			do_meta_boxes( get_current_screen(), 'after_title', $post );
			unset( $wp_meta_boxes[get_post_type( $post )]['after_title'] );
		}

		public function meta_fields_callback() {
			global $post;
			
			echo '<input type="hidden" name="prl_cmb_nonce" id="prl_cmb_nonce" value="' . 
			wp_create_nonce( plugin_basename( __FILE__ ) ) . '" />';
			
			foreach ( $this->fields as $field ) {

				if ( $field['type'] == 'text' || $field['type'] == 'number' || $field['type'] == 'email' || $field['type'] == 'url' || $field['type'] == 'password' ) {
					echo $this->field_text( $field );
				}
				elseif( $field['type'] == 'textarea' ){
					echo $this->field_textarea( $field );
				}
				elseif( $field['type'] == 'radio' ){
					echo $this->field_radio( $field );
				}
				elseif( $field['type'] == 'select' ){
					echo $this->field_select( $field );
				}
				elseif( $field['type'] == 'checkbox' ){
					echo $this->field_checkbox( $field );
				}
				elseif( $field['type'] == 'color' ){
					echo $this->field_color( $field );
				}
				elseif( $field['type'] == 'file' ){
					echo $this->field_file( $field );
				}
				elseif( $field['type'] == 'wysiwyg' ){
					echo $this->field_wysiwyg( $field );
				}
				elseif( $field['type'] == 'repeater' ){
					echo $this->field_repeater( $field );
				}
			}
		}
		
		public function save_meta_fields( $post_id, $post ) {
			$cnt = 1;
			$j = 0;

			if ( isset( $_POST['repeater-rows-count'] ) ) {
				foreach ( $_POST['repeater-rows-count'] as $key => $value ) {
					
					$arrGeneral = array();

					for ( $i = 0; $i < $value; $i++ ) {

						$inp_type = $_POST['repeater-inp-type'][$j];

						$arrGeneral[$j] = array(
							'name'     => isset( $_POST['repeater-inp-name'][$j] ) ? $_POST['repeater-inp-name'][$j] : '',
							'type'     => isset( $_POST['repeater-inp-type'][$j] ) ? $_POST['repeater-inp-type'][$j] : '',
							'class'    => isset( $_POST['repeater-type-class'][$j] ) ? $_POST['repeater-type-class'][$j] : '',
							'id'       => isset( $_POST['repeater-type-id'][$j] ) ? $_POST['repeater-type-id'][$j] : '',
							'disabled' => isset( $_POST['repeater-type-disabled'][$j] ) ? $_POST['repeater-type-disabled'][$j] : '',
						);

						if ( $inp_type == 'text' || $inp_type == 'textarea' || $inp_type == 'wysiwyg' ) {
							$arrGeneral[$j]['defaultValue'] = isset( $_POST['repeater-type-default-value'][$j] ) ? $_POST['repeater-type-default-value'][$j] : '';
							$arrGeneral[$j]['palceHolder']  = isset( $_POST['repeater-type-placeholder'][$j] ) ? $_POST['repeater-type-placeholder'][$j] : '';
							$arrGeneral[$j]['readOnly']     = isset( $_POST['repeater-type-read-only'][$j] ) ? $_POST['repeater-type-read-only'][$j] : '';
						}

						if ( $inp_type == 'radio' || $inp_type == 'checkbox' || $inp_type == 'select' ) {
							$vArr = array();

							if ( isset( $_POST['repeater-type-values'][$j] ) ) {
								$valuesArr = explode( PHP_EOL, $_POST['repeater-type-values'][$j] );
							
								foreach ( $valuesArr as $v ) {
									$vArr[] = $v;
								}
							}

							$arrGeneral[$j]['values'] = $vArr;
							$arrGeneral[$j]['defaultValue'] = isset( $_POST['repeater-type-default-value'][$j] ) ? $_POST['repeater-type-default-value'][$j] : '';
						}

						if ( $inp_type == 'toggle' ) {
							$arrGeneral[$j]['description'] = isset( $_POST['repeater-type-description'][$j] ) ? $_POST['repeater-type-description'][$j] : '';
						}

						if ( $inp_type == 'file' ) {
							$arrGeneral[$j]['fileSize'] = isset( $_POST['repeater-type-file-size'][$j] ) ? $_POST['repeater-type-file-size'][$j] : '';
							$arrGeneral[$j]['fileType'] = isset( $_POST['repeater-type-file-type'][$j] ) ? $_POST['repeater-type-file-type'][$j] : '';
						}
						
						$j++;
					}

					$rows[$cnt] = $arrGeneral;
					$cnt++;
				}

				update_post_meta( $post->ID, 'add_new_product_page', $rows );
			}

			if (
				! isset( $_POST['prl_cmb_nonce'] ) ||
				! wp_verify_nonce( $_POST['prl_cmb_nonce'], plugin_basename( __FILE__ ) ) ||
				! current_user_can( 'edit_post', $post->ID ) ||
				$post->post_type == 'revision'
			) {
				return $post->ID;
			}

			foreach ( $this->fields as $field ){
				$key = $field['name'];
				$meta_values[$key] = $_POST[$key];
			}

			foreach ( $meta_values as $key => $value ) {
				$value = implode( ',', (array) $value );
				if( get_post_meta( $post->ID, $key, FALSE )) {
					update_post_meta( $post->ID, $key, $value );
				} else {
					add_post_meta( $post->ID, $key, $value );
				}
				if( ! $value ) delete_post_meta( $post->ID, $key );
			}

		}

		public function field_text( $field ) {
			global $post;

			$field['default'] = ( isset( $field['default'] ) ) ? $field['default'] : '';
			$value = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr ( get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
			$class  = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'prl-meta-field';
			$readonly  = isset( $field['readonly'] ) && ( $field['readonly'] == true ) ? " readonly" : "";
			$disabled  = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

			$html	= sprintf( '<fieldset class="prl-row" id="prl_cmb_fieldset_%1$s">', $field['name'] );
				if ( isset( $field['label'] ) ) {
					$html	.= sprintf( '<label class="prl-label" for="prl_cmb_%1$s">%2$s</label>', $field['name'], $field['label']);
				}

				$html  .= sprintf( '<input type="%1$s" class="%2$s" id="prl_cmb_%3$s" name="%3$s" value="%5$s" %6$s %7$s/>', $field['type'], $class, $field['name'], $field['name'], $value, $readonly, $disabled );

				$html	.= $this->field_description( $field );
			$html	.= '</fieldset>';

			return $html;
		}

		public function field_textarea( $field ) {
			global $post;

			$value = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr (get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
			$class    = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'prl-meta-field';
			$cols     = isset( $field['columns'] ) ? $field['columns'] : 24;
			$rows     = isset( $field['rows'] ) ? $field['rows'] : 5;
			$readonly = isset( $field['readonly'] ) && ( $field['readonly'] == true ) ? " readonly" : "";
			$disabled = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

			$html	= sprintf( '<fieldset class="prl-row" id="prl_cmb_fieldset_%1$s">', $field['name'] );
				$html	.= sprintf( '<label class="prl-label" for="prl_cmb_%1$s">%2$s</label>', $field['name'], $field['label']);

				$html  .= sprintf( '<textarea rows="' . $rows . '" cols="' . $cols . '" class="%1$s-text" id="prl_cmb_%2$s" name="%3$s" %4$s %5$s >%6$s</textarea>', $class, $field['name'], $field['name'], $readonly, $disabled, $value );

				$html .= $this->field_description( $field );
			$html	.= '</fieldset>';

			return $html;
		}

		public function field_radio( $field ) {
			global $post;
			
			$value     = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr (get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
			$class     = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
			$disabled  = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";
			
			$html      = sprintf( '<fieldset class="prl-row" id="prl_cmb_fieldset_%1$s">', $field['name'] );
				$html .= '<label class="prl-label">'.$field['label'].'</label>';
				foreach ( $field['options'] as $key => $label ) {
					$html .= sprintf( '<label for="%1$s[%2$s]">', $field['name'], $key );

					$html .= sprintf( '<input type="radio" class="radio %1$s" id="%2$s[%3$s]" name="%2$s" value="%3$s" %4$s %5$s />', $class, $field['name'], $key, checked( $value, $key, false ), $disabled );

					$html .= sprintf( '%1$s</label>', $label );
				}

				$html .= $this->field_description( $field );
			$html .= '</fieldset>';

			return $html;
		}

		public function field_checkbox( $field ) {
			global $post;

			$field['default'] = ( isset( $field['default'] ) ) ? $field['default'] : '';
			$value = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr (get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
			$class  = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
			$disabled  = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

			$html	= sprintf( '<fieldset class="prl-row" id="prl_cmb_fieldset_%1$s">', $field['name'] );
				$html .= sprintf( '<label class="prl-label" for="prl_cmb_%1$s">%2$s</label>', $field['name'], $field['label']);

				$html .= sprintf( '<input type="checkbox" class="checkbox" id="prl_cmb_%1$s" name="%1$s" value="on" %2$s %3$s />', $field['name'], checked( $value, 'on', false ), $disabled );

				$html .= $this->field_description( $field, true ) . '';
			$html	.= '</fieldset>';
			
			return $html;
		}

		public function field_select( $field ) {
			global $post;

			$field['default'] = ( isset( $field['default'] ) ) ? $field['default'] : '';
			$value            = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr ( get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
			$class            = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
			$disabled         = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";
			$multiple         = isset( $field['multiple'] ) && ( $field['multiple'] == true ) ? " multiple" : "";
			$name             = isset( $field['multiple'] ) && ( $field['multiple'] == true ) ? $field['name'] . '[]' : $field['name'];

			$html	= sprintf( '<fieldset class="prl-row" id="prl_cmb_fieldset_%1$s">', $field['name'] );
				$html	.= sprintf( '<label class="prl-label" for="prl_cmb_%1$s">%2$s</label>', $field['name'], $field['label']);
				$html   .= sprintf( '<select class="%1$s" name="%2$s" id="prl_cmb_%2$s" %3$s %4$s>', $class, $name, $disabled, $multiple );

					if( $multiple == '' ) :

					foreach ( $field['options'] as $key => $label ) {
						$html .= sprintf( '<option value="%s"%s>%s</option>', $key, selected( $value, $key, false ), $label );
					}

					else:

					$values = explode( ',', $value );
					foreach ( $field['options'] as $key => $label ) {
						$selected = in_array( $key, $values ) && $key != '' ? ' selected' : '';
						$html .= sprintf( '<option value="%s"%s>%s</option>', $key, $selected, $label );
					}

					endif;

				$html .= sprintf( '</select>' );
				$html .= $this->field_description( $field );
			$html .= '</fieldset>';

			return $html;
		}

		public function field_color( $field ) {
			global $post;

			$value = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr (get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
			$class = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
			
			$html  = sprintf( '<fieldset class="prl-row" id="prl_cmb_fieldset_%1$s">', $field['name'] );
				$html .= sprintf( '<label class="prl-label" for="prl_cmb_%1$s">%2$s</label>', $field['name'], $field['label']);
			
				$html .= sprintf( '<input type="text" class="%1$s-text wp-color-picker-field" id="prl_cmb_%2$s" name="%2$s" value="%4$s" data-default-color="%5$s" />', $class, $field['name'], $field['name'], $value, $field['default'] );
			
				$html .= $this->field_description( $field );
			$html .= '</fieldset>';

			return $html;
		}

		public function field_file( $field ) {
			global $post;

			$value = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr (get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
			$class    = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
			$disabled = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

			$id          = $field['name']  . '[' . $field['name'] . ']';
			$button_text = isset( $field['button_text'] ) ? $field['button_text'] : __( 'Choose File' );
			
			$html  = sprintf( '<fieldset class="prl-row" id="prl_cmb_fieldset_%1$s">', $field['name'] );
				$html .= sprintf( '<label class="prl-label" for="prl_cmb_%1$s">%2$s</label>', $field['name'], $field['label']);
				$html .= sprintf( '<input type="text" class="%1$s-text prl-url" id="prl_cmb_%2$s" name="%2$s" value="%3$s" %4$s />', $class, $field['name'], $value, $disabled );
				$html .= '<input type="button" class="button prl-browse" value="' . $button_text . '" ' . $disabled . ' />';
				$html .= $this->field_description( $field );
			$html .= '</fieldset>';
			
			return $html;
		}

		public function field_wysiwyg( $field ) {
			global $post;

			$value         = get_post_meta( $post->ID, $field['name'], true ) != '' ? get_post_meta( $post->ID, $field['name'], true ) : $field['default'];
			$class         = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'regular-text';
			$width         = isset( $field['width'] ) && ! is_null( $field['width'] ) ? $field['width'] : '500px';
			$teeny         = isset( $field['teeny'] ) && ( $field['teeny'] == true ) ? true : false;
			$text_mode     = isset( $field['text_mode'] ) && ( $field['text_mode'] == true ) ? true : false;
			$media_buttons = isset( $field['media_buttons'] ) && ( $field['media_buttons'] == true ) ? true : false;
			$rows          = isset( $field['rows'] ) ? $field['rows'] : 10;

			$html	= sprintf( '<fieldset class="prl-row" id="prl_cmb_fieldset_%1$s">', $field['name'] );
				$html	.= '<div style="max-width: ' . $width . ';">';

					$editor_settings = array(
						'teeny'         => $teeny,
						'textarea_name' => $field['name'] . '[' . $field['name'] . ']',
						'textarea_rows' => $rows,
						'quicktags'     => $text_mode,
						'media_buttons' => $media_buttons,
					);

					if ( isset( $field['options'] ) && is_array( $field['options'] ) ) {
						$editor_settings = array_merge( $editor_settings, $field['options'] );
					}

					ob_start();
					wp_editor( $value, $field['name'] . '-' . $field['name'], $editor_settings );
					$html .= ob_get_contents();
					ob_end_clean();
				
				$html	.= '</div>';
			$html	.= '</fieldset>';
			return $html;
		}

		public function field_repeater( $field ) {
			global $post;

			$data = get_post_meta( $post->ID, 'add_new_product_page', true );
			echo '<pre>';
				print_r( $data );
			echo '</pre>';

			$field['default'] = ( isset( $field['default'] ) ) ? $field['default'] : '';
			$value = get_post_meta( $post->ID, $field['name'], true ) != '' ? esc_attr ( get_post_meta( $post->ID, $field['name'], true ) ) : $field['default'];
			$class  = isset( $field['class'] ) && ! is_null( $field['class'] ) ? $field['class'] : 'prl-meta-field';
			$readonly  = isset( $field['readonly'] ) && ( $field['readonly'] == true ) ? " readonly" : "";
			$disabled  = isset( $field['disabled'] ) && ( $field['disabled'] == true ) ? " disabled" : "";

			$html	= sprintf( '<fieldset class="prl-row" id="prl_cmb_fieldset_%1$s">', $field['name'] );
				if ( isset( $field['label'] ) ) {
					$html	.= sprintf( '<label class="prl-label" for="prl_cmb_%1$s">%2$s</label>', $field['name'], $field['label']);
				}
				$html .= '<div class="repeater-wrapper">';
					ob_start();
					echo get_repeater_content();
					$html .= ob_get_contents();
					ob_clean();
				$html .= '</div>'; // END repeater-wrapper

				$html .= '<button id="repeater-new-row" class="button button-primary button-large">' . prl_lbl( 'Add New Row' ) . '</button>';

				$html .= $this->field_description( $field );
			$html .= '</fieldset>';

			return $html;
		}

		public function field_description( $args, $no_p = false ) {
			if ( ! empty( $args['desc'] ) ) {
				if( isset( $args['desc_p'] ) ) {
					$desc = sprintf( '<p class="description">%s</p>', $args['desc'] );
				} else{
					$desc = sprintf( '<small class="prl-small">%s</small>', $args['desc'] );
				}
			} else {
				$desc = '';
			}

			return $desc;
		}

		function scripts() { ?>
			<script>
				jQuery(document).ready(function($) {
					//color picker
					$('.wp-color-picker-field').wpColorPicker();

					// media uploader
					$('.prl-browse').on('click', function (event) {
						event.preventDefault();

						var self = $(this);

						var file_frame = wp.media.frames.file_frame = wp.media({
							title: self.data('uploader_title'),
							button: {
								text: self.data('uploader_button_text'),
							},
							multiple: false
						});

						file_frame.on('select', function () {
							attachment = file_frame.state().get('selection').first().toJSON();

							self.prev('.prl-url').val(attachment.url);
							$('.supports-drag-drop').hide()
						});

						file_frame.open();
					});
				});
			</script>

			<style type="text/css">
				.form-table th { padding: 20px 10px; }
				.prl-row { border-bottom: 1px solid #ebebeb; padding: 8px 4px; }
				.prl-label {display: inline-block;vertical-align: top;width: 200px; font-weight: 600; font-size: 14px;}
				.prl-meta-field, .prl-meta-field-text {width: 100%;}
				.regular-text-text.prl-url {width: calc(100% - 67px);}
				#wpbody-content .metabox-holder { padding-top: 5px; }
			</style>
			<?php
		}
	}
}

if ( ! function_exists( 'prl_meta_boxes' ) ) {
	function prl_meta_boxes( $args ){
		return new PRL_Meta_Boxes( $args );
	}
}
