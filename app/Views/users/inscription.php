<h1>Inscription</h1>
<p>Remplissez le formulaire pour vous inscrire.</p>
<?php if($errors): ?>
	<div class="alert alert-danger">
		<?= $message; ?>
	</div>
<?php endif; ?>
<form method="post">
    <?= $form->input('nom', 'Nom',true); ?>
    <?= $form->input('prenom', 'Prénom',true); ?>
	<?= $form->input('username', 'Pseudo',true); ?>
	<?= $form->input('password', 'Mot de passe', true,['type' => 'password']); ?>
    <?= $form->input('question', 'Question secrète',true); ?>
    <?= $form->input('reponse', 'Réponse à la question secrète', true,['type' => 'password']); ?>
	<?= $form->submit('Envoyer'); ?>
</form>