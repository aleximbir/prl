<form class="ui form" method="post" action="<?php echo $login_page; ?>">

	<div class="field">
		<label><?php echo $lbl_authentication; ?></label>
		<div class="two fields">
			<div class="field"><?php echo $nickname; ?></div>
			<div class="field"><?php echo $password; ?></div>
		</div>
	</div>

	<?php echo $btn_login; ?>
	
</form>