<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tableau de bord - Inscrits</title>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f6f8;
}
nav {
    background: #333;
    color: white;
    padding: 10px;
    display: flex;
    justify-content: space-around;
}
nav a {
    color: white;
    text-decoration: none;
    padding: 8px 15px;
}
nav a:hover {
    background-color: #555;
    border-radius: 5px;
}
.dashboard {
    padding: 20px;
}
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(200px,1fr));
    gap: 20px;
    margin-bottom: 30px;
}
.card {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
    cursor: pointer;
    transition: transform 0.2s;
}
.card:hover { transform: translateY(-5px); }
.card h2 { font-size: 2em; margin: 10px 0; }
.card p { color: #666; }

/* Détails dynamiques */
#details {
    display: none;
    margin-top: 20px;
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(200px,1fr));
    gap: 15px;
}
.detail-card {
    background: #fff;
    padding: 15px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
}
.detail-card h3 { margin: 0; font-size: 1.2em; color: #333; }
.detail-card p { margin: 5px 0 0 0; font-size: 1.5em; font-weight: bold; color: #075E54; }
</style>
</head>
<body>

<nav>
    <a href="accueil.php">Accueil</a>
    <a href="dashboard.php">Tableau de bord</a>
    <a href="messagerie.php">Messages</a>
    <a href="profil.php">Profil</a>
    <a href="parametres.php">Paramètres</a>
</nav>

<div class="dashboard">
    <div class="cards">
        <div class="card" id="todayIns">
            <h2 id="todayNumber">0</h2>
            <p>Inscrits aujourd'hui</p>
        </div>
        <div class="card">
            <h2 id="totalMembers">0</h2>
            <p>Total des membres</p>
        </div>
        <div class="card">
            <h2 id="onlineMembers">0</h2>
            <p>Connectés actuellement</p>
        </div>
    </div>

    <div id="details">
        <div class="detail-card">
            <h3>Dernières 15 minutes</h3>
            <p id="last15min">0</p>
        </div>
        <div class="detail-card">
            <h3>Ce mois-ci</h3>
            <p id="thisMonth">0</p>
        </div>
        <div class="detail-card">
            <h3>90 derniers jours</h3>
            <p id="last90days">0</p>
        </div>
        <div class="detail-card">
            <h3>Cette année</h3>
            <p id="thisYear">0</p>
        </div>
    </div>
</div>

<script>
// Données test
const membres = [
    {name:"Alice", date:new Date('2025-08-14T08:10')},
    {name:"Bob", date:new Date('2025-08-14T09:15')},
    {name:"Claire", date:new Date('2025-08-14T09:45')},
    {name:"David", date:new Date('2025-08-14T10:05')},
    {name:"Emma", date:new Date('2025-08-14T11:20')},
    {name:"Lucas", date:new Date('2025-08-14T12:50')},
    {name:"Sophie", date:new Date('2025-08-14T14:30')},
    {name:"Nina", date:new Date('2025-08-13T15:00')},
    {name:"Tom", date:new Date('2025-08-01T10:00')},
    {name:"Léa", date:new Date('2025-07-20T08:30')},
    {name:"Marc", date:new Date('2025-06-05T09:15')}
];

// Simuler les membres actuellement connectés (pour test)
const onlineMembersCount = 5;

// Affichage chiffres principaux
function updateMainStats(){
    const today = new Date();
    const todayCount = membres.filter(m=>m.date.toDateString()===today.toDateString()).length;
    document.getElementById('todayNumber').innerText = todayCount;
    document.getElementById('totalMembers').innerText = membres.length;
    document.getElementById('onlineMembers').innerText = onlineMembersCount;
}
updateMainStats();

// Détails au clic
document.getElementById('todayIns').addEventListener('click', ()=>{
    document.getElementById('details').style.display = 'grid';
    updateDetails();
});

function updateDetails(){
    const now = new Date();
    document.getElementById('last15min').innerText = membres.filter(m=>(now - m.date)/(1000*60) <= 15).length;
    document.getElementById('thisMonth').innerText = membres.filter(m=>m.date.getMonth()===now.getMonth() && m.date.getFullYear()===now.getFullYear()).length;
    document.getElementById('last90days').innerText = membres.filter(m=>((now - m.date)/(1000*60*60*24)) <= 90).length;
    document.getElementById('thisYear').innerText = membres.filter(m=>m.date.getFullYear()===now.getFullYear()).length;
}
</script>

</body>
</html>
