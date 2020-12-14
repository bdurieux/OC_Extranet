<h1>Contact</h1>
<p>Remplissez le formulaire suivant pour nous contacter</p>
<form method="post"> 
	<?= $form->input('mail', 'Email'); ?>
	<?= $form->input('message', 'Message', ['type' => 'password']); ?>
    <?= $form->submit('Envoyer'); ?>
</form>