<form class="ui form" method="post" action="<?php echo $add_and_edit_product_page; ?>">

	<h3 class="ui dividing header"><?php echo $lbl_product_details; ?></h3>

	<!-- TITLE -->
	<div class="field">
		<label><?php echo $lbl_title; ?></label>
		<?php echo $inp_title; ?>
	</div>

	<div class="field">
		<div class="ui toggle checkbox">
			<?php echo $chk_bold_title; ?>
			<label><?php echo $bold_title; ?></label>
		</div>
	</div>

	<!--SUBTITLE-->
	<div class="field">
		<label><?php echo $lbl_subtitle; ?></label>
		<?php echo $inp_subtitle; ?>
	</div>

	<div class="field">
		<div class="ui toggle checkbox">
			<?php echo $chk_active_subtitle; ?>
			<label><?php echo $active_subtitle; ?></label>
		</div>
	</div>

</form>