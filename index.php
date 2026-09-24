<?php
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AgriMarket — Du champ à votre table</title>
<link rel="stylesheet" href="index.css">
<link href="bootstrap-5.3.8/dist/css/bootstrap.min.css" rel="styesheet">
</head>
<body>

  <!-- Barre d'information -->
  <div class="infobar">
    <div class="wrap">
      <div class="left">
        <span>📍 Livraison dans tout le Cameroun</span>
        <span>📞 +237 6 95 12 34 56</span>
        <span>📩 contact@agrimarket.cm</span>
      </div>
      <div class="right">
        <span>Suivez-nous :</span>
        <span class="social"><span>f</span><span>ig</span><span>wa</span></span>
        <a href="#">❓ Aide</a>
        <a href="#">💂‍♂️ Se connecter</a>
      </div>
    </div>
  </div>

  <!-- Logo + recherche -->
  <div class="brandbar">
    <div class="wrap">
      <div class="brand">
        <span class="leaf">🌿</span>
        <div><h1>AgriMarket</h1><div class="tag">Du champ à votre table</div></div>
      </div>
      <div class="searchbar">
        <input type="text" placeholder="Rechercher un produit, une catégorie, un producteur...">
        <button>🔍</button>
      </div>
      <div class="brand-actions">
        <a class="cart-link" href="#">🛒 <span class="badge">0</span> Panier</a>
        <a class="btn-signup" href="#">👤 S'inscrire</a>
      </div>
    </div>
  </div>

  <!-- Menu de navigation -->
  <div class="navrow">
    <div class="wrap">
      <a class="accueil" href="#">🏠 ACCUEIL</a>
      <a href="#">CATÉGORIES ▾</a>
      <a href="#">PRODUCTEURS</a>
      <a href="#">OFFRES SPÉCIALES <span class="tag">NOUVEAU</span></a>
      <a href="#">À PROPOS</a>
      <a href="#">BLOG</a>
      <a href="#">CONTACT</a>
    </div>
  </div>

  <!-- Bannière principale -->
  <div class="hero">
    
    <div class="wrap">
      <div class="hero-text">
        <h2>La meilleure plateforme<br>pour acheter et vendre<br>des <em>produits agricoles</em></h2>
        <p>Nous connectons les producteurs locaux aux acheteurs. Produits frais, qualité garantie, prix équitables.</p>
        <div class="hero-cta">
          <a class="primary" href="#">🛍️ Acheter maintenant</a>
          <a class="outline" href="#">🧺 Vendre mes produits</a>
        </div>
        <div class="stats">
          <div class="stat"><span class="ic">👥</span><div><b>500+</b><span>Producteurs</span></div></div>
          <div class="stat"><span class="ic">🧺</span><div><b>2000+</b><span>Produits disponibles</span></div></div>
          <div class="stat"><span class="ic">🙂</span><div><b>3500+</b><span>Clients satisfaits</span></div></div>
          <div class="stat"><span class="ic">🚚</span><div><b>Livraison rapide</b><span>Partout au Cameroun</span></div></div>
        </div>
      </div>
      <div class="hero-img">
        
      </div>
    </div>
  </div>

  <!-- Catégories -->
  <div class="section">
    <div class="wrap">
      <div class="section-title">Nos catégories</div>
      <div class="cats">
        <div class="cat-card"><div class="circle" style="background-image:url('')"></div><b>Fruits</b><span>120+ produits</span></div>
        <div class="cat-card"><div class="circle" style="background-image:url('')"></div><b>Légumes</b><span>150+ produits</span></div>
        <div class="cat-card"><div class="circle" style="background-image:url('')"></div><b>Céréales</b><span>80+ produits</span></div>
        <div class="cat-card"><div class="circle" style="background-image:url('')"></div><b>Tubercules</b><span>60+ produits</span></div>
        <div class="cat-card"><div class="circle" style="background-image:url('')"></div><b>Légumineuses</b><span>70+ produits</span></div>
        <div class="cat-card"><div class="circle" style="background-image:url('')"></div><b>Épices & Aromates</b><span>40+ produits</span></div>
      </div>
    </div>
  </div>

  <!-- Produits populaires -->
  <div class="section">
    <div class="wrap">
      <div class="section-title">Produits populaires</div>
      <div class="prods">
        <div class="prod">
          <span class="badge">Frais</span>
          <img src="Screenshot_20260914-215431_1.png" alt="Tomates fraîches">
          <div class="body">
            <div class="name">Tomates fraîches</div>
            <div class="by">Par : Ferme du Noun</div>
            <div class="rate">★ 4,8 (32)</div>
            <div class="foot"><span class="price">3000 FCFA / cajeot</span><button class="cart-btn">🛒</button></div>
          </div>
        </div>
        <div class="prod">
          <span class="badge">Local</span>
          <img src="wouter-supardi-salari-HE_MjmWh9eQ-unsplash.jpg" alt="Maïs jaune">
          <div class="body">
            <div class="name">Maïs jaune</div>
            <div class="by">Par : AgroPlus</div>
            <div class="rate">★ 4,6 (21)</div>
            <div class="foot"><span class="price">2000 FCFA / sceau</span><button class="cart-btn">🛒</button></div>
          </div>
        </div>
        <div class="prod">
          <span class="badge">Bio</span>
          <img src="bananes_marche_1920x1080.jpg" alt="Bananes plantain">
          <div class="body">
            <div class="name">Bananes plantain</div>
            <div class="by">Par : Nature & Vous</div>
            <div class="rate">★ 4,7 (18)</div>
            <div class="foot"><span class="price">2500 FCFA / regime</span><button class="cart-btn">🛒</button></div>
          </div>
        </div>
        <div class="prod">
          <span class="badge">Sec</span>
          <img src="istockphoto-2270536335-1024x1024.jpg" alt="Arachides décortiquées">
          <div class="body">
            <div class="name">Arachides décortiquées</div>
            <div class="by">Par : Ferme du Noun</div>
            <div class="rate">★ 4,5 (27)</div>
            <div class="foot"><span class="price">2 500 FCFA / Kg</span><button class="cart-btn">🛒</button></div>
          </div>
        </div>
        <div class="prod">
          <span class="badge">Premium</span>
          <img src="tetiana-bykovets-7LKpstdOad0-unsplash.jpg" alt="Fèves de cacao">
          <div class="body">
            <div class="name"> cacao</div>
            <div class="by">Par : Cacao Excellence</div>
            <div class="rate">★ 4,9 (15)</div>
            <div class="foot"><span class="price">2 500 FCFA / Kg</span><button class="cart-btn">🛒</button></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pourquoi choisir AgriMarket -->
  <div class="section why">
    <div class="wrap">
      <div class="section-title">Pourquoi choisir AgriMarket ?</div>
      <div class="why-grid">
        <div class="why-card"><div class="ic">🌱</div><div><b>Produits frais et de qualité</b><p>Des produits soigneusement sélectionnés directement chez les producteurs.</p></div></div>
        <div class="why-card"><div class="ic">🛡️</div><div><b>Transactions sécurisées</b><p>Vos paiements sont protégés et vos données restent confidentielles.</p></div></div>
        <div class="why-card"><div class="ic">🚚</div><div><b>Livraison rapide</b><p>Nous livrons vos commandes partout au Cameroun dans les meilleurs délais.</p></div></div>
        <div class="why-card"><div class="ic">🎧</div><div><b>Support dédié</b><p>Notre équipe est disponible pour vous accompagner 7j/7.</p></div></div>
      </div>
    </div>
  </div>

  <footer>
    &copy; 2026 AgriMarket — Du champ à votre table. Tous droits réservés.
  </footer>

</body>
</html>