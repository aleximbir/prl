<form class="ui form" method="post" enctype="multipart/form-data" action="<?php echo $add_and_edit_product_page; ?>">

	<h3 class="ui dividing header"><?php echo $lbl_product_details; ?></h3>

	<div class="ui grid">
		<?php if ( $rows ){
			foreach ( $rows as $key => $row ) { ?>
				
				<div class="<?php echo prl_get_cardinal_number( count( $row ) ); ?> column row">
					
					<?php if ( $row ) {
						foreach ( $row as $k => $r ) { ?>

							<div class="column field">
								<?php 
								prl_show_content_by_inp_type( $r );
								prl_show_extra_price_content( $r );
								?>
							</div>
						
						<?php }
					} ?>

				</div>

			<?php }
		} ?>
	</div>

</form>