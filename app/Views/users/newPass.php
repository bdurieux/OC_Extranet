<h1>Nouveau mot de passe</h1>
<p>Entrez votre pseudo et votre nouveau mot de passe.</p>
<form method="post">
	<?= $form->input('username', 'Pseudo'); ?>
	<?= $form->input('password', 'Nouveau mot de passe', ['type' => 'password']); ?>
	<?= $form->submit(); ?>
</form>