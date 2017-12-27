<form class="ui form" method="post" action="<?php echo $add_and_edit_product_page; ?>">

	<h3 class="ui dividing header"><?php echo $lbl_product_details; ?></h3>

	<div class="ui grid">
		<?php if ( $rows ){
			foreach ( $rows as $key => $row ) {
				$fieldscount = prl_get_cardinal_number( count( $row ) ); ?>
				
				<div class="<?php echo $fieldscount; ?> column row">
					
					<?php if ( $row ) {
						foreach ( $row as $k => $r ) {
							$inp_type = $r['type']; ?>

							<div class="column field">
								<label><?php echo ucfirst( $r['name'] ); ?></label>
								<?php 
								if ( $inp_type == 'text' || $inp_type == 'textarea' || $inp_type == 'wysiwyg' ) {
									echo prl_form(
										array(
											'type' => $r['type'],
											'name' => $r['type'] . '_' . prl_replace( strtolower( $r['name'] ), ' ', '_' ),
											'class' => $r['class'],
											'id' => $r['id'],
											'placeholder' => $r['placeHolder'],
											'value' => $r['defaultValue'],
											'disabled' => $r['disabled'],
											'readonly' => $r['readOnly']
										)
									);
								} else if ( $inp_type == 'radio' || $inp_type == 'checkbox' ) {
									if ( isset( $r['values'] ) ) {
										if ( is_array( $r['values'] ) ) {
											foreach ( $r['values'] as $key => $value ) {
												echo prl_form(
													array(
														'type' => $r['type'],
														'name' => $r['type'] . '_' . prl_replace( strtolower( $r['name'] ), ' ', '_' ),
														'class' => $r['class'],
														'id' => $r['id'],
														'value' => $value,
														'disabled' => $r['disabled'],
														'readonly' => $r['readOnly']
													)
												);
												echo prl_lbl( $value );
											}
										}
									}
								} else if ( $inp_type == 'select' ) {
									echo prl_form(
										array(
											'type' => $r['type'],
											'name' => $r['type'] . '_' . prl_replace( strtolower( $r['name'] ), ' ', '_' ),
											'class' => $r['class'],
											'id' => $r['id'],
											'value' => $r['values'],
											'disabled' => $r['disabled'],
											'readonly' => $r['readOnly']
										)
									);
								} else if ( $inp_type == 'toggle' ) {

								} else if ( $inp_type == 'file' ) {

								}
								
								if ( $r['extra_price'] == 'yes' ) { ?>
									<div class="ui toggle checkbox">
										<?php echo prl_form( array( 'type' => 'checkbox', 'name' => 'chk_bold_title', 'class' => 'hidden' ) ); ?>
										<label><?php echo $r['ep_description'] . '(' . $r['ep_price'] . ')'; ?></label>
									</div>
								<?php } ?>
							</div>
						
						<?php }
					} ?>

				</div>

			<?php }
		} ?>
	</div>

</form>