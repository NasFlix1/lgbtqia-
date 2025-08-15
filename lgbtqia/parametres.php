<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Paramètres</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f8f8f8;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 600px;
        margin: 30px auto;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .tabs {
        display: flex;
        border-bottom: 2px solid #ddd;
    }
    .tab {
        flex: 1;
        text-align: center;
        padding: 10px;
        cursor: pointer;
        font-weight: bold;
        color: #555;
    }
    .tab.active {
        color: #000;
        border-bottom: 3px solid #4CAF50;
    }
    .tab-content {
        display: none;
        padding: 20px 0;
    }
    .tab-content.active {
        display: block;
    }
    label {
        display: block;
        margin: 10px 0 5px;
    }
    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }
    .social-login {
        text-align: center;
        margin-top: 20px;
    }
    .social-login h3 {
        margin-bottom: 10px;
        color: #333;
    }
    .social-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
    }
    .social-icons img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .social-icons img:hover {
        transform: scale(1.1);
    }
</style>
</head>
<body>

<div class="container">
    <div class="tabs">
        <div class="tab active" onclick="openTab('infos')">Informations</div>
        <div class="tab" onclick="openTab('securite')">Sécurité</div>
    </div>

    <div id="infos" class="tab-content active">
        <h2>Informations personnelles</h2>
        <p>Ici, l'utilisateur pourra modifier ses infos générales (photo, bio, etc.).</p>
    </div>

    <div id="securite" class="tab-content">
        <h2>Informations & Sécurité</h2>
        <label>Nom</label>
        <input type="text" placeholder="Entrez votre nom">
        <label>Prénom</label>
        <input type="text" placeholder="Entrez votre prénom">
        <label>Âge</label>
        <input type="number" placeholder="Votre âge">
        <label>Date de naissance</label>
        <input type="date">
        <label>Email</label>
        <input type="email" placeholder="Votre adresse email">
        <label>Mot de passe</label>
        <input type="password" placeholder="Nouveau mot de passe">

        <div class="social-login">
            <h3>Connexion avec :</h3>
            <div class="social-icons">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google">
                <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="Apple" style="background:#000; padding:10px;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c3/Facebook_icon_%28white%29.svg" alt="Facebook" style="background:#1877F2; padding:10px;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg" alt="Microsoft" style="background:#fff; border:1px solid #ccc; padding:10px;">
            </div>
        </div>
    </div>
</div>

<script>
function openTab(tabId) {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
    document.querySelector('.tab[onclick="openTab(\''+tabId+'\')"]').classList.add('active');
    document.getElementById(tabId).classList.add('active');
}
</script>

</body>
</html>
