<?php

session_start();
require_once 'pdo.php';

// Sécurité : doit être connecté en tant qu'agriculteur
if (!isset($_SESSION['id_utilisateur']) || ($_SESSION['role'] ?? '') !== 'agriculteur') {
    header('Location: connexion.php');
    exit;
}

$prenom = $_SESSION['prenom'] ?? '';
$nom    = $_SESSION['nom'] ?? '';
$id_utilisateur  = $_SESSION['id_utilisateur'];
$id_agriculteur  = $_SESSION['id_role'] ?? null;
$nom_exploitation = $_SESSION['nom_exploitation'] ?? 'Mon exploitation';

// Stats
$nb_produits   = 0;
$nb_disponibles = 0;
$nb_commandes  = 0;

try {
    if ($id_agriculteur) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM produit WHERE id_agriculteur = ?");
        $stmt->execute([$id_agriculteur]);
        $nb_produits = (int) $stmt->fetchColumn();

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM produit WHERE id_agriculteur = ? AND statut = 'disponible'");
        $stmt->execute([$id_agriculteur]);
        $nb_disponibles = (int) $stmt->fetchColumn();

        // Commandes contenant au moins un de ses produits
        $stmt = $pdo->prepare("
            SELECT COUNT(DISTINCT c.id_commande)
            FROM commande c
            INNER JOIN ligne_commande lc ON lc.id_commande = c.id_commande
            INNER JOIN produit p ON p.id_produit = lc.id_produit
            WHERE p.id_agriculteur = ?
        ");
        $stmt->execute([$id_agriculteur]);
        $nb_commandes = (int) $stmt->fetchColumn();
    }
} catch (PDOException $e) {
    // silencieux
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon espace – Agriculteur | AGROMARKET</title>

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
            <a href="mes-produits.php">🧺 Mes produits</a>
            <a href="ajouter-produit.php">➕ Ajouter un produit</a>
            <a href="commandes-recues.php">📦 Commandes reçues</a>
            <a href="mon-exploitation.php">🌾 Mon exploitation</a>
            <a href="profil.php">👤 Mon profil</a>
            <a href="../deconnexion.php" class="logout">🚪 Déconnexion</a>
        </nav>
    </aside>

    <!-- MAIN -->
    <main class="content">
        <header class="top">
            <div>
                <h1>Bonjour, <?= htmlspecialchars($prenom) ?> 👋</h1>
                <p><?= htmlspecialchars($nom_exploitation) ?></p>
            </div>
            <div class="user-badge">
                <span class="avatar"><?= strtoupper(substr($prenom, 0, 1)) ?></span>
                <span><?= htmlspecialchars($prenom . ' ' . $nom) ?></span>
            </div>
        </header>

        <section class="stats">
            <div class="stat-card">
                <div class="stat-icon">🧺</div>
                <div>
                    <b><?= $nb_produits ?></b>
                    <span>Produits publiés</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div>
                    <b><?= $nb_disponibles ?></b>
                    <span>Disponibles</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📦</div>
                <div>
                    <b><?= $nb_commandes ?></b>
                    <span>Commandes reçues</span>
                </div>
            </div>
        </section>

        <section class="panel">
            <h2>Actions rapides</h2>
            <div class="actions">
                <a href="ajouter-produit.php" class="action-btn">➕ Ajouter un produit</a>
                <a href="mes-produits.php" class="action-btn outline">🧺 Mes produits</a>
                <a href="commandes-recues.php" class="action-btn outline">📦 Commandes reçues</a>
            </div>
        </section>

        <section class="panel">
            <h2>Mes produits récents</h2>
            <p class="empty">Aucun produit pour le moment. <a href="ajouter-produit.php">Publier votre premier produit</a></p>
        </section>
    </main>
</div>

</body>
</html>
