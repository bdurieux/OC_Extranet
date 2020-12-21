<div>
    <form method="post" id="newChat"  class="form-1">
        <?= $form->input('chat', 'Message',true, ['type' => 'textarea']); ?>
        <?= $form->submit('Envoyer'); ?>
    </form>
    <?php if(strlen($message)): ?>
        <div class="alert alert-danger">
            <?= $message; ?>
        </div>
    <?php endif; ?>
</div>
<div class="comment">
<?php foreach ($chats as $chat): ?>	
    <div class="">
        <p><strong title="<?= date('d/m/Y à H:i:s',strtotime($chat->date_add)); ?>">
        <?= htmlspecialchars($chat->username); ?></strong>: <?= htmlspecialchars($chat->message); ?></p>
    </div>
<?php endforeach; ?>
</div>