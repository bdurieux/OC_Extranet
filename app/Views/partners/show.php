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
            <button class="btn btn-primary" onclick="toggleNewComment()">Nouveau commentaire</i></button>
            <div id="review-btn">
                <form method="post">
                    <label><strong><?= 5;//$partner['nb_like']; ?></strong></label>
                    <button class="btn btn-success" type="submit" name="like"><i class="fa fa-thumbs-up"></i></button>
                </form>
                <form method="post">
                    <label><strong><?= 2;//$partner['nb_dislike']; ?></strong></label>
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
        <?php foreach ($comments as $comment): ?>	
            <div class="comment">
                <p><strong><?= $comment['user_id']; ?></strong></p>
                <p>Publié le <?= date('d/m/Y à H:i:s',strtotime($comment['date'])); ?></p>
                <p><?= $comment['content']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<script type="text/javascript" src="js/script.js"></script>