<?php
/**
 * PAGE DE CONNEXION - AGROMARKET
 * Base : agromarket
 *
 * Tables utilisées :
 * - utilisateur   → email + mot_de_passe + statut
 * - admin         → détection du rôle admin
 * - agriculteur   → détection du rôle agriculteur
 * - acheteur      → détection du rôle acheteur
 */

session_start();
require_once 'pdo.php';

// Si déjà connecté → redirection selon le rôle
if (isset($_SESSION['id_utilisateur'])) {
    $role = $_SESSION['role'] ?? '';
    if ($role === 'admin') {
        header('Location: admin/dashboard.php');
        exit;
    } elseif ($role === 'agriculteur') {
        header('Location: agriculteur/dashboard.php');
        exit;
    } else {
        header('Location: acheteur/dashboard.php');
        exit;
    }
}

$erreurs = [];
$email   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email        = trim($_POST['email'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    // Validations de base
    if ($email === '') {
        $erreurs[] = "L'email est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'email n'est pas valide.";
    }
    if ($mot_de_passe === '') {
        $erreurs[] = "Le mot de passe est obligatoire.";
    }

    if (empty($erreurs)) {
        try {
            // 1. Récupérer l'utilisateur
            $stmt = $pdo->prepare("
                SELECT id_utilisateur, nom, prenom, email, mot_de_passe, statut
                FROM utilisateur
                WHERE email = ?
            ");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if (!$user) {
                $erreurs[] = "Email ou mot de passe incorrect.";
            } elseif ($user['statut'] !== 'actif') {
                $erreurs[] = "Votre compte est " . $user['statut'] . ". Contactez l'administrateur.";
            } elseif (!password_verify($mot_de_passe, $user['mot_de_passe'])) {
                $erreurs[] = "Email ou mot de passe incorrect.";
            } else {
                // 2. Déterminer le rôle
                $role = null;
                $id_role = null;

                // Admin ?
                $stmt = $pdo->prepare("SELECT id_admin FROM admin WHERE id_utilisateur = ?");
                $stmt->execute([$user['id_utilisateur']]);
                $admin = $stmt->fetch();
                if ($admin) {
                    $role = 'admin';
                    $id_role = $admin['id_admin'];
                }

                // Agriculteur ?
                if (!$role) {
                    $stmt = $pdo->prepare("SELECT id_agriculteur, nom_exploitation FROM agriculteur WHERE id_utilisateur = ?");
                    $stmt->execute([$user['id_utilisateur']]);
                    $agri = $stmt->fetch();
                    if ($agri) {
                        $role = 'agriculteur';
                        $id_role = $agri['id_agriculteur'];
                        $_SESSION['nom_exploitation'] = $agri['nom_exploitation'];
                    }
                }

                // Acheteur ?
                if (!$role) {
                    $stmt = $pdo->prepare("SELECT id_acheteur FROM acheteur WHERE id_utilisateur = ?");
                    $stmt->execute([$user['id_utilisateur']]);
                    $ach = $stmt->fetch();
                    if ($ach) {
                        $role = 'acheteur';
                        $id_role = $ach['id_acheteur'];
                    }
                }

                if (!$role) {
                    $erreurs[] = "Aucun rôle associé à ce compte. Contactez l'administrateur.";
                } else {
                    // 3. Créer la session
                    $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
                    $_SESSION['nom']            = $user['nom'];
                    $_SESSION['prenom']         = $user['prenom'];
                    $_SESSION['email']          = $user['email'];
                    $_SESSION['role']           = $role;
                    $_SESSION['id_role']        = $id_role;

                    // 4. Redirection selon le rôle
                    if ($role === 'admin') {
                        header('Location: admin/dashboard.php');
                    } elseif ($role === 'agriculteur') {
                        header('Location: agriculteur/dashboard.php');
                    } else {
                        header('Location: acheteur/dashboard.php');
                    }
                    exit;
                }
            }
        } catch (PDOException $e) {
            $erreurs[] = "Erreur technique. Veuillez réessayer.";
            // En développement : $erreurs[] = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion – AGROMARKET</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="connexion.css">
</head>

<body>

    <div class="topbar">
        <div class="wrap">
            <a href="accueil.php" class="logo">
                <span class="leaf">🌿</span>
                <strong>AGROMARKET</strong>
            </a>
            <a href="inscription.php" class="link-login">Pas encore de compte ? S'inscrire</a>
        </div>
    </div>

    <main class="main">
        <div class="card">

            <div class="card-header">
                <h1>Connexion</h1>
                <p>Accédez à votre espace AGROMARKET</p>
            </div>

            <?php if (!empty($erreurs)): ?>
                <div class="alert error">
                    <ul>
                        <?php foreach ($erreurs as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="" novalidate>

                <div class="form-group">
                    <label for="email">Adresse email <span class="required">*</span></label>
                    <input type="email" id="email" name="email"
                           value="<?= htmlspecialchars($email) ?>"
                           required maxlength="150"
                           placeholder="exemple@gmail.com"
                           autocomplete="email">
                </div>

                <div class="form-group">
                    <label for="mot_de_passe">Mot de passe <span class="required">*</span></label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe"
                           required
                           placeholder="Votre mot de passe"
                           autocomplete="current-password">
                </div>

                <div class="form-options">
                    <label class="remember">
                        <input type="checkbox" name="remember">
                        Se souvenir de moi
                    </label>
                    <a href="mot-de-passe-oublie.php" class="forgot">Mot de passe oublié ?</a>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Se connecter</button>
                </div>

            </form>

            <div class="divider">
                <span>ou</span>
            </div>

            <p class="bottom-link">
                Vous n'avez pas encore de compte ?
                <a href="inscription.php">Créer un compte</a>
            </p>

        </div>
    </main>

</body>
</html>
