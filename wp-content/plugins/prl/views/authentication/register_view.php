<form class="ui form">

	<div class="field">
		<label>Name</label>
		<div class="two fields">
			<div class="field"><?php echo $firstname; ?></div>
			<div class="field"><?php echo $lastname; ?></div>
		</div>
	</div>
	
	<div class="field">
		<div class="fields">
			<div class="five wide field">
				<label>Nickname</label><?php echo $nickname; ?>
			</div>
			<div class="six wide field">
				<label>E-mail</label><?php echo $email; ?>
			</div>
			<div class="five wide field">
				<label>Password</label><?php echo $password; ?>
			</div>
		</div>
	</div>

	<div class="ui button" tabindex="0">Register</div>
	
</form>