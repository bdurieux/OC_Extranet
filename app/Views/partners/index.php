<section id="presentation">
    <h1>GBAF</h1>
    <div id="presentation1">
        <p>Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 
        grands groupes français:</p>
        <ul>
            <li>BNP Parisbas</li>
            <li>BPCE</li>
            <li>Crédit Agricole</li>
            <li>Crédit Mutuel - CIC</li>
            <li>Société Générale</li>
            <li>La Banque Postale</li>
        </ul>
        <p>Même s'il existe une forte concurrence entre ces entités, elles vont toutes travailler
            de la même façon pour gérer près de 80 millions de comptes sur le territoire national.
            <br>
            Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes 
            de la réglemenation financière francaise. Sa mission est de promouvoir l'activité 
            bancaire à l'échelle nationale. C'est un interlocuteur privilégié des pouvoirs
            publics.
        </p>
    </div>
    <div id="presentation2">
        <img src="images/bank-generic.jpg">
    </div>
</section>
<section id="partners">
    <h2>Acteurs et partenaires</h2>
    <div id="partnersText">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
        Nunc ornare maximus vehicula. Duis nisi velit, dictum id mauris vitae, lobortis pretium quam. 
        Quisque sed nisi pulvinar, consequat justo id, feugiat leo. Cras eu elementum dui.
    </div>
    <?php foreach ($partners as $partner): ?>	
        <div class="partner">
            <div class="partner1">
                <img class="partnerIcon" src="images/user.png" alt="logo acteur">
            </div>
            <div class="partner2">                
                <div class="partnerText">
                    <h3><?= $partner['title']; ?></h3>
                    <p><?= $partner['description']; ?></p>
                    <a href="#">lien vers ??</a>					
                </div>
                <div class="partnerBtn">
                    <form action="index.php?p=partners.show&id=<?= $partner['id']; ?>" method="get">
                        <button class="btn btn-primary btn-suite" type="submit">Détails</button>
                    </form>                
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>