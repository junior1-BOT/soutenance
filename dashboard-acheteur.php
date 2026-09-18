<?php
/**
 * DASHBOARD ACHETEUR - AGROMARKET
 * Tables : utilisateur, acheteur, commande, ligne_commande, produit, avis
 */
session_start();
require_once 'pdo.php';

// Sécurité : doit être connecté en tant qu'acheteur
if (!isset($_SESSION['id_utilisateur']) || ($_SESSION['role'] ?? '') !== 'acheteur') {
    header('Location: ../connexion.php');
    exit;
}

$prenom = $_SESSION['prenom'] ?? '';
$nom    = $_SESSION['nom'] ?? '';
$id_utilisateur = $_SESSION['id_utilisateur'];
$id_acheteur    = $_SESSION['id_role'] ?? null;

// Stats simples
$nb_commandes = 0;
$nb_en_cours  = 0;

try {
    if ($id_acheteur) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM commande WHERE id_acheteur = ?");
        $stmt->execute([$id_acheteur]);
        $nb_commandes = (int) $stmt->fetchColumn();

        $stmt = $pdo->prepare("
            SELECT COUNT(*) FROM commande 
            WHERE id_acheteur = ? AND statut IN ('en_attente', 'confirmee', 'en_livraison')
        ");
        $stmt->execute([$id_acheteur]);
        $nb_en_cours = (int) $stmt->fetchColumn();
    }
} catch (PDOException $e) {
    // silencieux pour l'affichage
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon espace – Acheteur | AGROMARKET</title>
   
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="layout">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="brand">
            <span class="leaf">🌿</span>
            <strong>AGROMARKET</strong>
        </div>
        <nav>
            <a href="dashboard.php" class="active">🏠 Tableau de bord</a>
            <a href="../catalogue.php">🛒 Catalogue</a>
            <a href="mes-commandes.php">📦 Mes commandes</a>
            <a href="panier.php">🧺 Panier</a>
            <a href="profil.php">👤 Mon profil</a>
            <a href="accueil.php" class="logout">🚪 Déconnexion</a>
        </nav>
    </aside>

    <!-- MAIN -->
    <main class="content">
        <header class="top">
            <div>
                <h1>Bonjour, <?= htmlspecialchars($prenom) ?> 👋</h1>
                <p>Bienvenue dans votre espace acheteur</p>
            </div>
            <div class="user-badge">
                <span class="avatar"><?= strtoupper(substr($prenom, 0, 1)) ?></span>
                <span><?= htmlspecialchars($prenom . ' ' . $nom) ?></span>
            </div>
        </header>

        <section class="stats">
            <div class="stat-card">
                <div class="stat-icon">📦</div>
                <div>
                    <b><?= $nb_commandes ?></b>
                    <span>Commandes totales</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🚚</div>
                <div>
                    <b><?= $nb_en_cours ?></b>
                    <span>En cours</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⭐</div>
                <div>
                    <b>—</b>
                    <span>Avis laissés</span>
                </div>
            </div>
        </section>

        <section class="panel">
            <h2>Actions rapides</h2>
            <div class="actions">
                <a href="../catalogue.php" class="action-btn">🛍️ Voir le catalogue</a>
                <a href="mes-commandes.php" class="action-btn outline">📦 Mes commandes</a>
                <a href="profil.php" class="action-btn outline">👤 Mon profil</a>
            </div>
        </section>

        <section class="panel">
            <h2>Dernières commandes</h2>
            <p class="empty">Aucune commande pour le moment. <a href="../catalogue.php">Commencer vos achats</a></p>
        </section>
    </main>
</div>

</body>
</html>
