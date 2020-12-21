<h1>Mot de passe oublié</h1>
<p>Entrez votre pseudo et répondez à la question secrète pour modifier votre mot de passe.</p>
<?php if($errors): ?>
	<div class="alert alert-danger">
		<?= $message; ?>
	</div>
<?php endif; ?>
<form method="post" class="form-1">
	<?= $form->input('username', 'Pseudo',true); ?>
	<div class="<?= $unidentified; ?>">
		<p><strong>Question secrète:</strong></p>
		<p><?= $question; ?></p>
		<?= $form->input('reponse', 'Réponse secrète', true, ['type' => 'password']); ?>
	</div>
	<?= $form->submit('Envoyer'); ?>
</form>