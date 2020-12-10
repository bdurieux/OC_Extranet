<h1>Paramètres du compte</h1>
<form method="post">   	
    <?= $form->input('firstname', 'Nom'); ?>
    <?= $form->input('lastname', 'Prénom'); ?>
	<?= $form->input('username', 'Pseudo'); ?>
	<?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
    <?= $form->input('question', 'Question secrète'); ?>
    <?= $form->input('response', 'Réponse à la question secrète', ['type' => 'password']); ?>
    <?= $form->submit('Sauvegarder'); ?>
</form>