<h1>Connexion</h1>
<?php if($errors): ?>
	<div class="alert alert-danger">
		Identifiants incorrects!
	</div>
<?php endif; ?>
<form method="post">
	<?= $form->input('username', 'Pseudo'); ?>
	<?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
	<?= $form->submit('Envoyer'); ?>
</form>
<p><a href="index.php?p=users.forgotPass">Mot de passe oublié?</a></p>

