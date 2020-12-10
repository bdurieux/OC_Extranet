<section id="partnerInfos">
    <div id="partnerLogo">
        <img src="images/user.png" alt="logo acteur">
    </div>
    <h2><?= $partner['title']; ?></h2>
    <a href="#">Lien</a>
    <p><?= $partner['description']; ?></p>
</section>		
<section id="comments">
    <div id="headerComments">
        <div>
            <?php $s = (sizeof($comments)>1)? 's' : '';?>
            <h3><?= sizeof($comments); ?> commentaire<?= $s; ?></h3>
        </div>
        <div id="block-btn">
            <button class="btn btn-primary">Nouveau commentaire</button>
            <div id="review-btn">
                <label><strong><?= $partner['nb_like']; ?></strong></label>
                <button class="btn btn-success"><i class="fa fa-thumbs-up"></i></button>
                <label><strong><?= $partner['nb_dislike']; ?></strong></label>
                <button class="btn btn-danger"><i class="fa fa-thumbs-down"></i></button>
            </div>
        </div>				
    </div>
    <div id="listComments">
        <?php foreach ($comments as $comment): ?>	
            <div class="comment">
                <p><strong><?= $comment['user_id']; ?></strong></p>
                <p>Publié le <?= date('d/m/Y à H:i:s',strtotime($comment['date'])); ?></p>
                <p><?= $comment['content']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>