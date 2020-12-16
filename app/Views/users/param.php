<h1>Paramètres du compte</h1>
<?php if($errors): ?>
	<div class="alert alert-danger">
		<?= $message; ?>
	</div>
<?php endif; ?>
<form method="post">   	
    <?= $form->input('nom', 'Nom'); ?>
    <?= $form->input('prenom', 'Prénom'); ?>
	<?= $form->input('username', 'Pseudo'); ?>
	<?= $form->input('password', 'Mot de passe', true,['type' => 'password']); ?>
    <?= $form->input('question', 'Question secrète'); ?>
    <?= $form->input('reponse', 'Réponse à la question secrète', true,['type' => 'password']); ?>
    <?= $form->submit('Sauvegarder'); ?>
</form>