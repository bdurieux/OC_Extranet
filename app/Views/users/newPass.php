<h1>Nouveau mot de passe</h1>
<?php if($errors): ?>
	<div class="alert alert-danger">
		Identifiants incorrects!
	</div>
<?php endif; ?>
<p>Entrez votre pseudo et votre nouveau mot de passe.</p>
<form method="post">
	<?= $form->input('username', 'Pseudo',true); ?>
	<?= $form->input('password1', 'Nouveau mot de passe', ['type' => 'password']); ?>
	<?= $form->input('password2', 'Entrez le nouveau mot de passe', ['type' => 'password']); ?>
	<?= $form->submit(); ?>
</form>