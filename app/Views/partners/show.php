<section id="partnerInfos">
    <div id="partnerLogo">
        <img src="images/logo_p<?= $partner->id_acteur; ?>.png" alt="logo acteur">
    </div>
    <h2><?= $partner->acteur; ?></h2>
    <a href="#">Lien</a>
    <p><?= $partner->description; ?></p>
</section>		
<section id="comments">
    <div id="headerComments">
        <div>
            <?php $s = (sizeof($comments)>1)? 's' : '';?>
            <h3><?= sizeof($comments); ?> commentaire<?= $s; ?></h3>
        </div>
        <div id="block-btn">
            <div id="btn-comment">
                <button class="btn btn-primary" onclick="toggleNewComment()">Nouveau commentaire</i></button>
            </div>
            <div id="review-btn">
                <form method="post">
                    <label class="lbl-like"><strong><?= $nb_like; ?></strong></label>
                    <button class="btn btn-success" type="submit" name="like"><i class="fa fa-thumbs-up"></i></button>
                </form>
                <form method="post">
                    <label class="lbl-dislike"><strong><?= $nb_dislike; ?></strong></label>
                    <button class="btn btn-danger" type="submit" name="dislike"><i class="fa fa-thumbs-down"></i></button>
                </form>
            </div>
        </div>				
    </div>
    <div id="listComments">
        <form method="post" id="newComment" >
            <?= $form->input('comment', 'Nouveau commentaire',true, ['type' => 'textarea']); ?>
            <?= $form->submit('Envoyer'); ?>
        </form>
        <?php if(strlen($message)): ?>
            <div class="alert alert-danger">
                <?= $message; ?>
            </div>
        <?php endif; ?>
        <?php foreach ($comments as $comment): ?>	
            <div class="comment">
                <p><strong><?= $comment->prenom; ?></strong></p>
                <p>Publié le <?= date('d/m/Y à H:i:s',strtotime($comment->date_add)); ?></p>
                <p><?= $comment->post; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<script type="text/javascript" src="js/script.js"></script>