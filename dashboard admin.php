<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriMarket — Dashboard Administrateur</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stysle.css">
</head>

<body>

    <div class="layout">

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="brand">🌿 <span class="label">AgriMarket<br><small>Panel Administrateur</small></span></div>
            <nav id="sidenav">
                <a data-view="dashboard" class="active">📊 <span class="label">Tableau de bord</span></a>
                <a data-view="utilisateurs">👥 <span class="label">Utilisateurs</span></a>
                <a data-view="producteurs">🌾 <span class="label">Producteurs</span></a>
                <a data-view="produits">📦 <span class="label">Produits</span></a>
                <a data-view="commandes">🧾 <span class="label">Commandes</span></a>
                <a data-view="litiges">⚠️ <span class="label">Litiges</span></a>
            </nav>
            <div class="logout">↩ <span class="label">Déconnexion</span></div>
        </aside>

        <!-- Main -->
        <div class="main">
            <div class="topbar">
                <h1 id="pageTitle">Tableau de bord</h1>
                <div class="search"><input type="text" placeholder="Rechercher un utilisateur, une commande..."></div>
                <div class="right">
                    <span class="icon-btn">🔔<span class="dot"></span></span>
                    <span class="icon-btn">✉️</span>
                    <div class="admin-chip">
                        <div class="av">AD</div> Admin Système
                    </div>
                </div>
            </div>

            <div class="content">

                <!-- VIEW: DASHBOARD -->
                <div class="view active" id="view-dashboard">
                    <div class="kpis">
                        <div class="kpi">
                            <div class="top">
                                <div class="ic" style="background:var(--green-light); color:var(--green);">👥</div>
                            </div>
                            <div class="val">2 340</div>
                            <div class="lbl">Utilisateurs inscrits</div>
                            <div class="trend up">▲ 0,0% ce mois</div>
                        </div>
                        <div class="kpi">
                            <div class="top">
                                <div class="ic" style="background:#FCEAD3; color:var(--amber);">🌾</div>
                            </div>
                            <div class="val">0</div>
                            <div class="lbl">Producteurs actifs</div>
                            <div class="trend up">▲ 0,0% ce mois</div>
                        </div>
                        <div class="kpi">
                            <div class="top">
                                <div class="ic" style="background:var(--blue-light); color:var(--blue);">🧾</div>
                            </div>
                            <div class="val">1 284</div>
                            <div class="lbl">Commandes ce mois</div>
                            <div class="trend up">▲ 0,0% ce mois</div>
                        </div>
                        <div class="kpi">
                            <div class="top">
                                <div class="ic" style="background:var(--red-light); color:var(--red);">⚠️</div>
                            </div>
                            <div class="val">7</div>
                            <div class="lbl">Litiges ouverts</div>
                            <div class="trend down">▼ 2 vs semaine dernière</div>
                        </div>
                    </div>

                    <div class="grid2">
                        <div class="panel">
                            <div class="head-row">
                                <h3>Ventes de la semaine (FCFA)</h3><span class="link-more">Exporter</span>
                            </div>
                            <div class="chart" id="salesChart"></div>
                        </div>
                        <div class="panel">
                            <h3>Répartition par catégorie</h3>
                            <div id="catBars"></div>
                        </div>
                    </div>

                    <div class="panel" style="margin-top:18px;">
                        <div class="head-row">
                            <h3>Dernières commandes</h3><span class="link-more" data-goto="commandes">Voir tout →</span>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Client</th>
                                    <th>Producteur</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><span class="pill attente">En attente</span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><span class="pill cours"></span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><span class="pill livree"></span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><span class="pill livree"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- VIEW: UTILISATEURS -->
                <div class="view" id="view-utilisateurs">
                    <div class="view-header">
                        <h2>Gestion des utilisateurs</h2>
                        <div style="display:flex; gap:10px;">
                            <input class="table-search" placeholder="Rechercher un utilisateur..." oninput="filterTable('userTable', this.value)">
                            <select class="filter-select">
                                <option>Tous les statuts</option>
                                <option>Actif</option>
                                <option>Suspendu</option>
                            </select>
                        </div>
                    </div>
                    <div class="panel">
                        <table id="userTable">
                            <thead>
                                <tr>
                                    <th>Utilisateur</th>
                                    <th>Email</th>
                                    <th>Inscrit le</th>
                                    <th>Commandes</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="row-avatar"><span class="av">ME</span> M. Etoa</td>
                                    <td>m.etoa@mail.cm</td>
                                    <td>12/03/2026</td>
                                    <td>14</td>
                                    <td><span class="pill valide">Actif</span></td>
                                    <td class="actions-cell"><button class="btn btn-voir">Voir</button><button class="btn btn-rejeter" onclick="toggleStatus(this,'Suspendu','rejete')">Suspendre</button></td>
                                </tr>
                                <tr>
                                    <td class="row-avatar"><span class="av">AN</span> A. Ngo</td>
                                    <td>a.ngo@mail.cm</td>
                                    <td>28/04/2026</td>
                                    <td>7</td>
                                    <td><span class="pill valide">Actif</span></td>
                                    <td class="actions-cell"><button class="btn btn-voir">Voir</button><button class="btn btn-rejeter" onclick="toggleStatus(this,'Suspendu','rejete')">Suspendre</button></td>
                                </tr>
                                <tr>
                                    <td class="row-avatar"><span class="av">PF</span> P. Fotso</td>
                                    <td>p.fotso@mail.cm</td>
                                    <td>02/05/2026</td>
                                    <td>3</td>
                                    <td><span class="pill rejete">Suspendu</span></td>
                                    <td class="actions-cell"><button class="btn btn-voir">Voir</button><button class="btn btn-valider" onclick="toggleStatus(this,'Actif','valide')">Réactiver</button></td>
                                </tr>
                                <tr>
                                    <td class="row-avatar"><span class="av">SA</span> S. Ateba</td>
                                    <td>s.ateba@mail.cm</td>
                                    <td>19/06/2026</td>
                                    <td>21</td>
                                    <td><span class="pill valide">Actif</span></td>
                                    <td class="actions-cell"><button class="btn btn-voir">Voir</button><button class="btn btn-rejeter" onclick="toggleStatus(this,'Suspendu','rejete')">Suspendre</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- VIEW: PRODUCTEURS -->
                <div class="view" id="view-producteurs">
                    <div class="view-header">
                        <h2>Validation des producteurs</h2>
                        <input class="table-search" placeholder="Rechercher..." oninput="filterTable('prodTable', this.value)">
                    </div>
                    <div class="panel">
                        <table id="prodTable">
                            <thead>
                                <tr>
                                    <th>Producteur</th>
                                    <th>Localisation</th>
                                    <th>Produits</th>
                                    <th>Date demande</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="row-avatar"><span class="av">FN</span> Ferme du Noun</td>
                                    <td>Bafoussam</td>
                                    <td>18</td>
                                    <td>04/09/2026</td>
                                    <td><span class="pill attente">En attente</span></td>
                                    <td class="actions-cell"><button class="btn btn-valider" onclick="toggleStatus(this,'Validé','valide')">Valider</button><button class="btn btn-rejeter" onclick="toggleStatus(this,'Rejeté','rejete')">Rejeter</button></td>
                                </tr>
                                <tr>
                                    <td class="row-avatar"><span class="av">NV</span> Nature & Vous</td>
                                    <td>Douala</td>
                                    <td>9</td>
                                    <td>02/09/2026</td>
                                    <td><span class="pill attente">En attente</span></td>
                                    <td class="actions-cell"><button class="btn btn-valider" onclick="toggleStatus(this,'Validé','valide')">Valider</button><button class="btn btn-rejeter" onclick="toggleStatus(this,'Rejeté','rejete')">Rejeter</button></td>
                                </tr>
                                <tr>
                                    <td class="row-avatar"><span class="av">AP</span> AgroPlus</td>
                                    <td>Yaoundé</td>
                                    <td>26</td>
                                    <td>28/08/2026</td>
                                    <td><span class="pill valide">Validé</span></td>
                                    <td class="actions-cell"><button class="btn btn-voir">Voir profil</button></td>
                                </tr>
                                <tr>
                                    <td class="row-avatar"><span class="av">CE</span> Cacao Excellence</td>
                                    <td>Kribi</td>
                                    <td>5</td>
                                    <td>20/08/2026</td>
                                    <td><span class="pill valide">Validé</span></td>
                                    <td class="actions-cell"><button class="btn btn-voir">Voir profil</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- VIEW: PRODUITS -->
                <div class="view" id="view-produits">
                    <div class="view-header">
                        <h2>Modération des produits</h2>
                        <input class="table-search" placeholder="Rechercher un produit..." oninput="filterTable('prodModTable', this.value)">
                    </div>
                    <div class="panel">
                        <table id="prodModTable">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Producteur</th>
                                    <th>Catégorie</th>
                                    <th>Prix</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tomates fraîches</td>
                                    <td>Ferme du Noun</td>
                                    <td>Légumes</td>
                                    <td>1 500 FCFA/Kg</td>
                                    <td><span class="pill valide">Publié</span></td>
                                    <td class="actions-cell"><button class="btn btn-voir">Voir</button><button class="btn btn-rejeter" onclick="toggleStatus(this,'Retiré','rejete')">Retirer</button></td>
                                </tr>
                                <tr>
                                    <td>Maïs jaune</td>
                                    <td>AgroPlus</td>
                                    <td>Céréales</td>
                                    <td>900 FCFA/Kg</td>
                                    <td><span class="pill valide">Publié</span></td>
                                    <td class="actions-cell"><button class="btn btn-voir">Voir</button><button class="btn btn-rejeter" onclick="toggleStatus(this,'Retiré','rejete')">Retirer</button></td>
                                </tr>
                                <tr>
                                    <td>Miel de forêt</td>
                                    <td>Nature & Vous</td>
                                    <td>Épices & Aromates</td>
                                    <td>3 200 FCFA/L</td>
                                    <td><span class="pill attente">En attente</span></td>
                                    <td class="actions-cell"><button class="btn btn-valider" onclick="toggleStatus(this,'Publié','valide')">Approuver</button><button class="btn btn-rejeter" onclick="toggleStatus(this,'Refusé','rejete')">Refuser</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- VIEW: COMMANDES -->
                <div class="view" id="view-commandes">
                    <div class="view-header">
                        <h2>Supervision des commandes</h2>
                        <div style="display:flex; gap:10px;">
                            <input class="table-search" placeholder="Rechercher une commande..." oninput="filterTable('orderTable', this.value)">
                            <select class="filter-select">
                                <option>Tous les statuts</option>
                                <option>En attente</option>
                                <option>Expédiée</option>
                                <option>Livrée</option>
                            </select>
                        </div>
                    </div>
                    <div class="panel">
                        <table id="orderTable">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Client</th>
                                    <th>Producteur</th>
                                    <th>Date</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1042</td>
                                    <td>M. Etoa</td>
                                    <td>Ferme du Noun</td>
                                    <td>06/09/2026</td>
                                    <td>3 000 FCFA</td>
                                    <td><span class="pill attente">En attente</span></td>
                                </tr>
                                <tr>
                                    <td>#1041</td>
                                    <td>A. Ngo</td>
                                    <td>AgroPlus</td>
                                    <td>05/09/2026</td>
                                    <td>4 500 FCFA</td>
                                    <td><span class="pill cours">Expédiée</span></td>
                                </tr>
                                <tr>
                                    <td>#1039</td>
                                    <td>P. Fotso</td>
                                    <td>Nature & Vous</td>
                                    <td>03/09/2026</td>
                                    <td>1 800 FCFA</td>
                                    <td><span class="pill livree">Livrée</span></td>
                                </tr>
                                <tr>
                                    <td>#1037</td>
                                    <td>S. Ateba</td>
                                    <td>Cacao Excellence</td>
                                    <td>01/09/2026</td>
                                    <td>7 500 FCFA</td>
                                    <td><span class="pill livree">Livrée</span></td>
                                </tr>
                                <tr>
                                    <td>#1035</td>
                                    <td>J. Mballa</td>
                                    <td>Ferme du Noun</td>
                                    <td>30/08/2026</td>
                                    <td>2 200 FCFA</td>
                                    <td><span class="pill livree">Livrée</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- VIEW: LITIGES -->
                <div class="view" id="view-litiges">
                    <div class="view-header">
                        <h2>Gestion des litiges</h2>
                        <input class="table-search" placeholder="Rechercher..." oninput="filterTable('litigeTable', this.value)">
                    </div>
                    <div class="panel">
                        <table id="litigeTable">
                            <thead>
                                <tr>
                                    <th>N° Commande</th>
                                    <th>Client</th>
                                    <th>Motif</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1042</td>
                                    <td>M. Etoa</td>
                                    <td>Produit endommagé à la livraison</td>
                                    <td>06/09/2026</td>
                                    <td><span class="pill ouvert">Ouvert</span></td>
                                    <td class="actions-cell"><button class="btn btn-valider" onclick="toggleStatus(this,'Résolu','resolu')">Résoudre</button><button class="btn btn-voir">Voir détails</button></td>
                                </tr>
                                <tr>
                                    <td>#1028</td>
                                    <td>J. Mballa</td>
                                    <td>Quantité inférieure à la commande</td>
                                    <td>29/08/2026</td>
                                    <td><span class="pill ouvert">Ouvert</span></td>
                                    <td class="actions-cell"><button class="btn btn-valider" onclick="toggleStatus(this,'Résolu','resolu')">Résoudre</button><button class="btn btn-voir">Voir détails</button></td>
                                </tr>
                                <tr>
                                    <td>#1011</td>
                                    <td>A. Ngo</td>
                                    <td>Retard de livraison</td>
                                    <td>15/08/2026</td>
                                    <td><span class="pill resolu">Résolu</span></td>
                                    <td class="actions-cell"><button class="btn btn-voir">Voir détails</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="toast" id="toast"></div>