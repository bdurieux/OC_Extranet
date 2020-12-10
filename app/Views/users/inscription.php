<h1>Inscription</h1>
<p>Remplissez le formulaire pour vous inscrire.</p>
<p>Tous les champs sont obligatoires.</p>
<form method="post">
    <?= $form->input('firstname', 'Nom'); ?>
    <?= $form->input('lastname', 'Prénom'); ?>
	<?= $form->input('username', 'Pseudo'); ?>
	<?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
    <?= $form->input('question', 'Question secrète'); ?>
    <?= $form->input('answer', 'Réponse à la question secrète', ['type' => 'password']); ?>
	<?= $form->submit('Envoyer'); ?>
</form>