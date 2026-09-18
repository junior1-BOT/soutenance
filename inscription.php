<?php
/**
 * PAGE D'INSCRIPTION - AGROMARKET
 * Alignée STRICTEMENT sur la structure de la base : plateforme_agricole
 *
 * Tables utilisées :
 * - utilisateur   → données communes (nom, prenom, email, mot_de_passe, telephone)
 * - agriculteur   → si rôle = vendeur (nom_exploitation, localisation, description_exploitation)
 * - acheteur      → si rôle = acheteur (adresse_livraison)
 *
 * Flux :
 * 1. Insertion dans utilisateur
 * 2. Récupération de id_utilisateur
 * 3. Insertion dans agriculteur OU acheteur selon le rôle choisi
 */

session_start();

// -------------------------------------------------
// Connexion à la base de données
// -------------------------------------------------
$serveur = "localhost";
$base = "agromarket"; 
$utilisateur = "root";
$motdepasse = ""; 

$erreurs =[];
$succes=false;
try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$base;charset=utf8", $utilisateur, $motdepasse);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// -------------------------------------------------
// Traitement du formulaire
// -------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($erreurs)) {

    // Récupération et nettoyage
    $nom            = trim($_POST['nom'] ?? '');
    $prenom         = trim($_POST['prenom'] ?? '');
    $email          = trim($_POST['email'] ?? '');
    $telephone      = trim($_POST['telephone'] ?? '');
    $mot_de_passe   = $_POST['mot_de_passe'] ?? '';
    $confirmation   = $_POST['confirmation'] ?? '';
    $role           = $_POST['role'] ?? '';

    // Champs spécifiques agriculteur
    $nom_exploitation         = trim($_POST['nom_exploitation'] ?? '');
    $localisation             = trim($_POST['localisation'] ?? '');
    $description_exploitation = trim($_POST['description_exploitation'] ?? '');

    // Champ spécifique acheteur
    $adresse_livraison = trim($_POST['adresse_livraison'] ?? '');

    // ---------- Validations ----------
    if ($nom === '')            $erreurs[] = "Le nom est obligatoire.";
    if ($prenom === '')         $erreurs[] = "Le prénom est obligatoire.";
    if ($email === '')          $erreurs[] = "L'email est obligatoire.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erreurs[] = "L'email n'est pas valide.";
    if ($mot_de_passe === '')   $erreurs[] = "Le mot de passe est obligatoire.";
    elseif (strlen($mot_de_passe) < 6) $erreurs[] = "Le mot de passe doit contenir au moins 6 caractères.";
    if ($mot_de_passe !== $confirmation) $erreurs[] = "Les mots de passe ne correspondent pas.";
    if (!in_array($role, ['agriculteur', 'acheteur'])) $erreurs[] = "Veuillez choisir un rôle (Agriculteur ou Acheteur).";

    if ($role === 'agriculteur') {
        if ($nom_exploitation === '') $erreurs[] = "Le nom de l'exploitation est obligatoire pour un agriculteur.";
    }
    if ($role === 'acheteur') {
        if ($adresse_livraison === '') $erreurs[] = "L'adresse de livraison est obligatoire pour un acheteur.";
    }

    // Vérifier si l'email existe déjà
    if (empty($erreurs)) {
        $stmt = $pdo->prepare("SELECT id_utilisateur FROM utilisateur WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $erreurs[] = "Cet email est déjà utilisé. Connectez-vous ou utilisez un autre email.";
        }
    }

    // ---------- Insertion ----------
    if (empty($erreurs)) {
        try {
            $pdo->beginTransaction();

            // 1. Table utilisateur
            $hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("
                INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, telephone, statut)
                VALUES (?, ?, ?, ?, ?, 'actif')
            ");
            $stmt->execute([$nom, $prenom, $email, $hash, $telephone ?: null]);

            $id_utilisateur = $pdo->lastInsertId();

            // 2. Table selon le rôle
            if ($role === 'agriculteur') {
                $stmt = $pdo->prepare("
                    INSERT INTO agriculteur (id_utilisateur, nom_exploitation, localisation, description_exploitation)
                    VALUES (?, ?, ?, ?)
                ");
                $stmt->execute([
                    $id_utilisateur,
                    $nom_exploitation,
                    $localisation ?: null,
                    $description_exploitation ?: null
                ]);
            } else {
                // acheteur
                $stmt = $pdo->prepare("
                    INSERT INTO acheteur (id_utilisateur, adresse_livraison)
                    VALUES (?, ?)
                ");
                $stmt->execute([$id_utilisateur, $adresse_livraison]);
            }

            $pdo->commit();
            $succes = true;

            // Optionnel : connexion automatique
            // $_SESSION['id_utilisateur'] = $id_utilisateur;
            // $_SESSION['role'] = $role;

        } catch (PDOException $e) {
            $pdo->rollBack();
            $erreurs[] = "Erreur lors de l'inscription. Veuillez réessayer.";
            // En dev : $erreurs[] = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription – AGROMARKET</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="inscription.css">
</head>

<body>

    <!-- Barre supérieure simple -->
    <div class="topbar">
        <div class="wrap">
            <a href="acceuil.php" class="logo">
                <span class="leaf">🌿</span>
                <strong>AGROMARKET</strong>
            </a>
            <a href="connexion.php" class="link-login">Déjà un compte ? Se connecter</a>
        </div>
    </div>

    <main class="main">
        <div class="card">

            <div class="card-header">
                <h1>Créer un compte</h1>
                <p>Rejoignez la plateforme d'achat et de vente de produits agricoles</p>
            </div>

            <?php if ($succes): ?>
                <div class="alert success">
                    <strong>Inscription réussie !</strong><br>
                    Votre compte a été créé avec succès.
                    <br><br>
                    <a href="connexion.php" class="btn-primary" style="display:inline-block;margin-top:8px;">Se connecter maintenant</a>
                </div>
            <?php else: ?>

                <?php if (!empty($erreurs)): ?>
                    <div class="alert error">
                        <ul>
                            <?php foreach ($erreurs as $err): ?>
                                <li><?= htmlspecialchars($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" id="form-inscription" novalidate>

                    <!-- ========== RÔLE ========== -->
                    <div class="form-group">
                        <label class="label">Je m'inscris en tant que <span class="required">*</span></label>
                        <div class="role-cards">
                            <label class="role-card">
                                <input type="radio" name="role" value="acheteur" <?= (($_POST['role'] ?? '') === 'acheteur') ? 'checked' : '' ?> required>
                                <div class="role-content">
                                    <span class="role-icon">🛒</span>
                                    <strong>Acheteur</strong>
                                    <small>Je souhaite acheter des produits</small>
                                </div>
                            </label>
                            <label class="role-card">
                                <input type="radio" name="role" value="agriculteur" <?= (($_POST['role'] ?? '') === 'agriculteur') ? 'checked' : '' ?>>
                                <div class="role-content">
                                    <span class="role-icon">👨‍🌾</span>
                                    <strong>Agriculteur</strong>
                                    <small>Je souhaite vendre mes produits</small>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- ========== INFORMATIONS PERSONNELLES (table utilisateur) ========== -->
                    <fieldset>
                        <legend>Informations personnelles</legend>

                        <div class="row">
                            <div class="form-group">
                                <label for="nom">Nom <span class="required">*</span></label>
                                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required maxlength="100" placeholder="Ex: Kamga">
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom <span class="required">*</span></label>
                                <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>" required maxlength="100" placeholder="Ex: Jean">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Adresse email <span class="required">*</span></label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required maxlength="150" placeholder="exemple@gmail.com">
                        </div>

                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="tel" id="telephone" name="telephone" value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>" maxlength="20" placeholder="+237 6XX XX XX XX">
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="mot_de_passe">Mot de passe <span class="required">*</span></label>
                                <input type="password" id="mot_de_passe" name="mot_de_passe" required minlength="6" placeholder="Minimum 6 caractères">
                            </div>
                            <div class="form-group">
                                <label for="confirmation">Confirmer le mot de passe <span class="required">*</span></label>
                                <input type="password" id="confirmation" name="confirmation" required minlength="6" placeholder="Retapez le mot de passe">
                            </div>
                        </div>
                    </fieldset>

                    <!-- ========== CHAMPS AGRICULTEUR (table agriculteur) ========== -->
                    <fieldset id="bloc-agriculteur" class="bloc-role" style="display:none;">
                        <legend>Informations de l'exploitation</legend>

                        <div class="form-group">
                            <label for="nom_exploitation">Nom de l'exploitation <span class="required">*</span></label>
                            <input type="text" id="nom_exploitation" name="nom_exploitation" value="<?= htmlspecialchars($_POST['nom_exploitation'] ?? '') ?>" maxlength="150" placeholder="Ex: Ferme du Noun">
                        </div>

                        <div class="form-group">
                            <label for="localisation">Localisation</label>
                            <input type="text" id="localisation" name="localisation" value="<?= htmlspecialchars($_POST['localisation'] ?? '') ?>" maxlength="255" placeholder="Ex: Bafoussam, Ouest Cameroun">
                        </div>

                        <div class="form-group">
                            <label for="description_exploitation">Description de l'exploitation</label>
                            <textarea id="description_exploitation" name="description_exploitation" rows="3" placeholder="Présentez brièvement votre exploitation, vos cultures..."><?= htmlspecialchars($_POST['description_exploitation'] ?? '') ?></textarea>
                        </div>
                    </fieldset>

                    <!-- ========== CHAMPS ACHETEUR (table acheteur) ========== -->
                    <fieldset id="bloc-acheteur" class="bloc-role" style="display:none;">
                        <legend>Adresse de livraison</legend>

                        <div class="form-group">
                            <label for="adresse_livraison">Adresse de livraison <span class="required">*</span></label>
                            <textarea id="adresse_livraison" name="adresse_livraison" rows="3" placeholder="Ex: Quartier Mvog-Ada, Yaoundé"><?= htmlspecialchars($_POST['adresse_livraison'] ?? '') ?></textarea>
                        </div>
                    </fieldset>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Créer mon compte</button>
                        <p class="cgu">En créant un compte, vous acceptez nos conditions d'utilisation.</p>
                    </div>

                </form>
            <?php endif; ?>

        </div>
    </main>

    <script>
        // Afficher / masquer les blocs selon le rôle choisi
        const radios = document.querySelectorAll('input[name="role"]');
        const blocAgri = document.getElementById('bloc-agriculteur');
        const blocAcheteur = document.getElementById('bloc-acheteur');

        function updateRoleBlocks() {
            const role = document.querySelector('input[name="role"]:checked')?.value;
            blocAgri.style.display = (role === 'agriculteur') ? 'block' : 'none';
            blocAcheteur.style.display = (role === 'acheteur') ? 'block' : 'none';
        }

        radios.forEach(r => r.addEventListener('change', updateRoleBlocks));
        // Initialisation (si retour après erreur)
        updateRoleBlocks();
    </script>

</body>
</html>
