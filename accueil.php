<?php

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGROMARKET – Plateforme d'achat et vente de produits agricoles</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="acceuil.css">
</head>

<body>

    <!-- ========== BARRE D'INFO ========== -->
    <div class="infobar">
        <div class="wrap">
            <div class="left">
                <span>📍 Livraison partout au Cameroun</span>
                <span>📞 +237 688 09 83 94</span>
                <span>📩 agromarket@gmail.com</span>
            </div>
            <div class="right">
                <span>Suivez-nous :</span>
                <span class="social">
                    <span title="Facebook">f</span>
                    <span title="Instagram">ig</span>
                    <span title="WhatsApp">wa</span>
                </span>
                <a href="#">❔ Aide</a>
                <!-- Connexion → table utilisateur -->
                <a href="connexion.php">👤 Se connecter</a>
            </div>
        </div>
    </div>

    <!-- ========== LOGO + RECHERCHE + ACTIONS ========== -->
    <div class="brandbar">
        <div class="wrap">
            <div class="brand">
                <span class="leaf">🌿</span>
                <div>
                    <h1>AGROMARKET</h1>
                    <div class="tag">La terre ne trompe pas</div>
                </div>
            </div>

            <!-- Recherche multi-critères : produit / categorie / agriculteur -->
            <form class="searchbar" action="recherche.php" method="GET">
                <input type="text" name="q" placeholder="Rechercher un produit, une catégorie, un producteur...">
                <button type="submit">🔎</button>
            </form>

            <div class="brand-actions">
                <a class="cart-link" href="panier.php">
                    🛒 <span class="badge">0</span> Panier
                </a>
                <!-- Inscription → utilisateur + (agriculteur OU acheteur) -->
                <a class="btn-signup" href="inscription.php">👤 S'inscrire</a>
            </div>
        </div>
    </div>

    <!-- ========== NAVIGATION ========== -->
    <div class="navrow">
        <div class="wrap">
            <a class="accueil" href="acceuil.php">🏠 ACCUEIL</a>
            <a href="categories.php">CATÉGORIES ▾</a>          <!-- table categorie -->
            <a href="producteurs.php">PRODUCTEURS</a>         <!-- table agriculteur -->
            <a href="offres.php">OFFRES SPÉCIALES <span class="tag">NOUVEAU</span></a>
            <a href="a-propos.php">À PROPOS</a>
            <a href="blog.php">BLOG</a>
            <a href="contact.php">CONTACT</a>
        </div>
    </div>

    <!-- ========== HERO ========== -->
    <div class="hero">
        <div class="wrap">
            <div class="hero-text">
                <h2>La meilleure plateforme<br>pour acheter et vendre<br>des <em>produits agricoles</em></h2>
                <p>Nous connectons les producteurs locaux aux acheteurs. Produits frais, qualité garantie, prix équitables.</p>
                <div class="hero-cta">
                    <!-- Acheteur → catalogue (table produit) -->
                    <a class="primary" href="catalogue.php">🛍️ Acheter maintenant</a>
                    <!-- Agriculteur → inscription (utilisateur + agriculteur) -->
                    <a class="outline" href="inscription.php?role=agriculteur">🧺 Vendre mes produits</a>
                </div>
                <div class="stats">
                    <!-- Ces chiffres pourront venir de COUNT(*) sur les tables -->
                    <div class="stat">
                        <span class="ic">👥</span>
                        <div><b>500+</b><span>Producteurs</span></div>           <!-- COUNT(*) FROM agriculteur -->
                    </div>
                    <div class="stat">
                        <span class="ic">🧺</span>
                        <div><b>2000+</b><span>Produits disponibles</span></div> <!-- COUNT(*) FROM produit WHERE statut='disponible' -->
                    </div>
                    <div class="stat">
                        <span class="ic">🙂</span>
                        <div><b>3500+</b><span>Clients satisfaits</span></div>    <!-- COUNT(*) FROM acheteur -->
                    </div>
                    <div class="stat">
                        <span class="ic">🚚</span>
                        <div><b>Livraison rapide</b><span>Partout au Cameroun</span></div>
                    </div>
                </div>
            </div>
            <div class="hero-img">
                <div class="hero-placeholder">
                    <span>🥬 🍅 🌽 🍌 🥑</span>
                    <p>Produits frais du Cameroun</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== CATÉGORIES (table: categorie) ========== -->
    <div class="section">
        <div class="section-title">Nos catégories</div>
        <div class="cats">
            <!-- 
                Quand la BD sera remplie, remplacer par :
                <?php foreach ($categorie as $cat): ?>
                    <a href="catalogue.php?id_categorie=<?= $cat['id_categorie'] ?>" class="cat-card">
                        <div class="circle">...</div>
                        <b><?= htmlspecialchars($cat['nom_categorie']) ?></b>
                        <span><?= $cat['nb_produits'] ?>+ produits</span>
                    </a>
                <?php endforeach; ?>
            -->
            <a href="catalogue.php?id_categorie=1" class="cat-card">
                <div class="circle">🍎</div>
                <b>Fruits</b>
                <span>120+ produits</span>
            </a>
            <a href="catalogue.php?id_categorie=2" class="cat-card">
                <div class="circle">🥦</div>
                <b>Légumes</b>
                <span>150+ produits</span>
            </a>
            <a href="catalogue.php?id_categorie=3" class="cat-card">
                <div class="circle">🌾</div>
                <b>Céréales</b>
                <span>80+ produits</span>
            </a>
            <a href="catalogue.php?id_categorie=4" class="cat-card">
                <div class="circle">🥔</div>
                <b>Tubercules</b>
                <span>60+ produits</span>
            </a>
            <a href="catalogue.php?id_categorie=5" class="cat-card">
                <div class="circle">🥜</div>
                <b>Légumineuses</b>
                <span>70+ produits</span>
            </a>
            <a href="catalogue.php?id_categorie=6" class="cat-card">
                <div class="circle">🌶️</div>
                <b>Épices & Aromates</b>
                <span>40+ produits</span>
            </a>
        </div>
    </div>

    <!-- ========== PRODUITS POPULAIRES ========== -->
    <!-- Tables : produit + agriculteur + avis -->
    <div class="section">
        <div class="section-title">Produits populaires</div>
        <div class="prods">

            <!-- 
                Boucle dynamique recommandée :
                <?php foreach ($produits as $p): ?>
                    <div class="prod">
                        <span class="badge"><?= $p['statut'] === 'disponible' ? 'Frais' : '' ?></span>
                        <div class="prod-img">
                            <?php if ($p['photo']): ?>
                                <img src="uploads/<?= htmlspecialchars($p['photo']) ?>" alt="">
                            <?php else: ?>
                                🧺
                            <?php endif; ?>
                        </div>
                        <div class="body">
                            <div class="name"><?= htmlspecialchars($p['nom']) ?></div>
                            <div class="by">Par : <?= htmlspecialchars($p['nom_exploitation']) ?></div>
                            <div class="rate">
                                ★ <?= $p['note_moyenne'] ?? '—' ?> 
                                (<?= $p['nb_avis'] ?>)
                            </div>
                            <div class="foot">
                                <span class="price">
                                    <?= number_format($p['prix_unitaire'], 0, ',', ' ') ?> FCFA / <?= htmlspecialchars($p['unite']) ?>
                                </span>
                                <button class="cart-btn" data-id="<?= $p['id_produit'] ?>">🛒</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            -->

            <div class="prod">
                <span class="badge">Frais</span>
                <div class="prod-img">🍅</div>
                <div class="body">
                    <div class="name">Tomates fraîches</div>
                    <div class="by">Par : Jardin du Noun</div>          <!-- agriculteur.nom_exploitation -->
                    <div class="rate">★ 4,8 (32)</div>                 <!-- AVG(avis.note) + COUNT -->
                    <div class="foot">
                        <span class="price">3 000 FCFA / cageot</span> <!-- produit.prix_unitaire + unite -->
                        <button class="cart-btn" title="Ajouter au panier">🛒</button>
                    </div>
                </div>
            </div>

            <div class="prod">
                <span class="badge">Local</span>
                <div class="prod-img">🌽</div>
                <div class="body">
                    <div class="name">Maïs sec & frais</div>
                    <div class="by">Par : Plantation Roger</div>
                    <div class="rate">★ 4,6 (21)</div>
                    <div class="foot">
                        <span class="price">1 500 FCFA / seau</span>
                        <button class="cart-btn" title="Ajouter au panier">🛒</button>
                    </div>
                </div>
            </div>

            <div class="prod">
                <span class="badge">Bio</span>
                <div class="prod-img">🍌</div>
                <div class="body">
                    <div class="name">Bananes & Plantains</div>
                    <div class="by">Par : Plantation Kamdem</div>
                    <div class="rate">★ 4,3 (15)</div>
                    <div class="foot">
                        <span class="price">2 600 FCFA / régime</span>
                        <button class="cart-btn" title="Ajouter au panier">🛒</button>
                    </div>
                </div>
            </div>

            <div class="prod">
                <span class="badge">Frais</span>
                <div class="prod-img">🥑</div>
                <div class="body">
                    <div class="name">Avocats Hass</div>
                    <div class="by">Par : Ferme Bella</div>
                    <div class="rate">★ 4,9 (48)</div>
                    <div class="foot">
                        <span class="price">4 500 FCFA / carton</span>
                        <button class="cart-btn" title="Ajouter au panier">🛒</button>
                    </div>
                </div>
            </div>

            <div class="prod">
                <span class="badge">Local</span>
                <div class="prod-img">🥔</div>
                <div class="body">
                    <div class="name">Pommes de terre</div>
                    <div class="by">Par : Coopérative Ouest</div>
                    <div class="rate">★ 4,5 (27)</div>
                    <div class="foot">
                        <span class="price">2 200 FCFA / seau</span>
                        <button class="cart-btn" title="Ajouter au panier">🛒</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ========== POURQUOI NOUS CHOISIR ========== -->
    <div class="section why">
        <div class="section-title">Pourquoi choisir AGROMARKET ?</div>
        <div class="why-grid">
            <div class="why-card">
                <div class="ic">🌱</div>
                <div>
                    <b>Produits frais et de qualité</b>
                    <p>Des produits soigneusement sélectionnés directement chez les producteurs locaux (table agriculteur).</p>
                </div>
            </div>
            <div class="why-card">
                <div class="ic">🛡️</div>
                <div>
                    <b>Transactions sécurisées</b>
                    <p>Vos paiements sont protégés (table paiement) et vos données restent confidentielles.</p>
                </div>
            </div>
            <div class="why-card">
                <div class="ic">🚚</div>
                <div>
                    <b>Livraison rapide</b>
                    <p>Nous livrons vos commandes (tables commande + ligne_commande) partout au Cameroun.</p>
                </div>
            </div>
            <div class="why-card">
                <div class="ic">🎧</div>
                <div>
                    <b>Support dédié</b>
                    <p>Notre équipe est disponible pour vous accompagner 7j/7.</p>
                </div>
            </div>
        </div>
    </div>


</body>
</html>
