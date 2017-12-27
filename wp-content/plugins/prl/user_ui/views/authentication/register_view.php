<form class="ui form" method="post" action="<?php echo $register_page; ?>">

	<div class="field">
		<label><?php echo $lbl_name; ?></label>
		<div class="two fields">
			<div class="field"><?php echo $firstname; ?></div>
			<div class="field"><?php echo $lastname; ?></div>
		</div>
	</div>
	
	<div class="field">
		<label><?php echo $lbl_authentication; ?></label>
		<div class="fields">
			<div class="five wide field"><?php echo $nickname; ?></div>
			<div class="six wide field"><?php echo $email; ?></div>
			<div class="five wide field"><?php echo $password; ?></div>
		</div>
	</div>

	<?php echo $btn_register; ?>
	
</form>