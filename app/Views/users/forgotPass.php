<h1>Mot de passe oublié</h1>
<p>Entrez votre pseudo et répondez à la question secrète pour modifier votre mot de passe.</p>
<?php if($errors): ?>
	<div class="alert alert-danger">
		Identifiants incorrects!
	</div>
<?php endif; ?>
<form method="post">
	<?= $form->input('username', 'Pseudo'); ?>
    <p><strong>Question secrète:</strong></p>
    <p><?= $secretQuestion="surnom de la voisine" . " ?"; ?></p>
	<?= $form->input('password', 'Réponse secrète', ['type' => 'password']); ?>
	<?= $form->submit('Envoyer'); ?>
</form>