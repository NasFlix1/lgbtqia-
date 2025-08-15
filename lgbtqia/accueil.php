<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Accueil - LGBTQIA+ Connect</title>
<style>
    body {margin:0; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f5f6fa;}
    header {background:#2f3640; color:white; padding:15px 20px; display:flex; justify-content:space-between; align-items:center; box-shadow:0 2px 5px rgba(0,0,0,0.3);}
    header h1 {margin:0; font-size:24px;}
    nav a {color:white; margin-left:20px; text-decoration:none; font-weight:500; cursor:pointer;}
    nav a:hover {text-decoration:underline;}

    .main {padding:20px;}
    .filters {display:flex; flex-wrap:wrap; gap:10px; margin-bottom:20px; justify-content:center;}
    .filters input, .filters select {padding:8px 10px; border-radius:8px; border:1px solid #ccc; font-size:14px;}
    
    .profiles {display:flex; flex-wrap:wrap; justify-content:center; gap:20px;}
    .profile-card {
        background:white; border-radius:12px; box-shadow:0 6px 15px rgba(0,0,0,0.15);
        width:250px; overflow:hidden; transition:transform 0.2s, box-shadow 0.2s; cursor:pointer;
    }
    .profile-card:hover {transform:translateY(-5px); box-shadow:0 10px 20px rgba(0,0,0,0.2);}
    .profile-card img {width:100%; height:250px; object-fit:cover;}
    .profile-info {padding:15px;}
    .profile-info h3 {margin:0; color:#2f3640;}
    .profile-info p {color:#718093; margin:5px 0;}
    .profile-actions {display:flex; justify-content:space-between; margin-top:10px;}
    .profile-actions button {flex:1; margin:2px; padding:8px; border:none; border-radius:8px; cursor:pointer; color:white; transition:0.3s;}
    .like {background:#44bd32;}
    .like:hover {background:#4cd137;}
    .message {background:#40739e;}
    .message:hover {background:#487eb0;}
    .dislike {background:#e84118;}
    .dislike:hover {background:#ff3838;}

    /* MODALES */
    .modal {display:none; position:fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:100;}
    .modal-content {background:white; padding:25px; border-radius:12px; width:90%; max-width:500px; position:relative; box-shadow:0 8px 25px rgba(0,0,0,0.3); max-height:90vh; overflow-y:auto;}
    .close {position:absolute; top:15px; right:20px; font-size:25px; cursor:pointer; color:#e84118;}
    .modal-content img {width:100%; border-radius:12px; margin-bottom:15px; object-fit:cover;}
    .modal-content h2 {margin:0;color:#2f3640;}
    .modal-content p {margin:5px 0; color:#2f3640;}
    .help-section {margin-bottom:15px;}
    .help-section strong {display:block; margin-bottom:5px;}
    .help-section textarea {width:100%; height:80px; border-radius:8px; border:1px solid #ccc; padding:8px; resize:none;}
    .help-section button {margin-top:8px; padding:8px 15px; border:none; border-radius:8px; background:#40739e; color:white; cursor:pointer;}

    /* CHAT INTERNE */
    .chat-container {display:flex; flex-direction:column; border:1px solid #ccc; border-radius:8px; padding:10px; max-height:200px; overflow-y:auto; margin-top:10px; background:#f1f2f6;}
    .chat-msg {margin-bottom:5px; padding:6px 10px; border-radius:10px; max-width:80%;}
    .chat-msg.user {background:#dcdde1; align-self:flex-end;}
    .chat-msg.team {background:#44bd32; color:white; align-self:flex-start;}
</style>
</head>
<body>

<header>
    <h1>LGBTQIA+ Connect</h1>
    <nav>
        <a href="#">Accueil</a>
        <a href="#">Messages</a>
        <a href="#">Profil</a>
        <a href="#">Paramètres</a>
        <a id="openHelpBtn">Système d'aide</a>
        <a href="#">Déconnexion</a>
    </nav>
</header>

<div class="main">
    <div class="filters">
        <input type="text" id="searchName" placeholder="Rechercher par nom...">
        <select id="filterSex">
            <option value="">Tous les sexes</option>
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
            <option value="Non-binaire">Non-binaire</option>
        </select>
        <select id="filterOrientation">
            <option value="">Toutes orientations</option>
            <option value="Gay">Gay</option>
            <option value="Lesbienne">Lesbienne</option>
            <option value="Bi">Bi</option>
            <option value="Pan">Pan</option>
            <option value="Hétéro">Hétéro</option>
        </select>
        <input type="text" id="filterCity" placeholder="Ville...">
    </div>

    <div class="profiles" id="profilesContainer"></div>
</div>

<!-- MODALE PROFIL -->
<div class="modal" id="modalProfile">
    <div class="modal-content">
        <span class="close" id="closeProfile">&times;</span>
        <img id="modalPhoto" src="" alt="Photo profil">
        <h2 id="modalName"></h2>
        <p><strong>Âge :</strong> <span id="modalAge"></span></p>
        <p><strong>Sexe :</strong> <span id="modalSex"></span></p>
        <p><strong>Orientation :</strong> <span id="modalOrientation"></span></p>
        <p><strong>Ville :</strong> <span id="modalCity"></span></p>
        <p><strong>Bio :</strong></p>
        <p id="modalBio"></p>
        <div class="profile-actions">
            <button class="like">Like</button>
            <button class="message">Message</button>
            <button class="dislike">Dislike</button>
        </div>
    </div>
</div>

<!-- MODALE SYSTÈME D'AIDE -->
<div class="modal" id="modalHelp">
    <div class="modal-content">
        <span class="close" id="closeHelp">&times;</span>
        <h2>Système d'aide</h2>

        <div class="help-section">
            <strong>Support psychologique</strong>
            <div class="help-details">
                <p>Lignes d'écoute et ressources :</p>
                <ul>
                    <li>SOS Amitié : 01 42 96 26 26</li>
                    <li>Suicide Écoute : 01 45 39 40 00</li>
                    <li>Psychologues LGBTQIA+ en ligne</li>
                </ul>
            </div>
        </div>

        <div class="help-section">
            <strong>Soutien social</strong>
            <div class="help-details">
                <p>Associations et groupes :</p>
                <ul>
                    <li>Inter-LGBT : info@inter-lgbt.org</li>
                    <li>Le Refuge : contact@le-refuge.org</li>
                </ul>
            </div>
        </div>

        <div class="help-section">
            <strong>Travail sur soi</strong>
            <div class="help-details">
                <p>Conseils et exercices :</p>
                <ul>
                    <li>Méditation et relaxation</li>
                    <li>Journaling et introspection</li>
                </ul>
            </div>
        </div>

        <div class="help-section">
            <strong>Contacter notre équipe interne</strong>
            <div class="help-details">
                <p>Nous ne sommes pas des psychologues, mais nous pouvons t'écouter et te guider.</p>
                <div class="chat-container" id="chatContainer"></div>
                <textarea id="teamMessage" placeholder="Écris ton message..."></textarea>
                <button onclick="sendTeamMessage()">Envoyer</button>
            </div>
        </div>
    </div>
</div>

<script>
const profiles = [
    {name:"Alex", age:22, sex:"Homme", orientation:"Gay", city:"Paris", photo:"https://placekitten.com/300/300", bio:"J'aime les sorties, les concerts et rencontrer de nouvelles personnes."},
    {name:"Sophie", age:24, sex:"Femme", orientation:"Lesbienne", city:"Lyon", photo:"https://placekitten.com/301/300", bio:"Passionnée de lecture et de voyages."},
    {name:"Jordan", age:26, sex:"Non-binaire", orientation:"Bi", city:"Marseille", photo:"https://placekitten.com/302/300", bio:"Aime la musique, les jeux vidéo et la nature."},
    {name:"Liam", age:23, sex:"Homme", orientation:"Gay", city:"Toulouse", photo:"https://placekitten.com/303/300", bio:"Fan de sport et de cinéma."},
];

// PROFILS
const container = document.getElementById("profilesContainer");
const modalProfile = document.getElementById("modalProfile");
const closeProfile = document.getElementById("closeProfile");

function displayProfiles(list){
    container.innerHTML="";
    list.forEach((profile, index)=>{
        const card = document.createElement("div");
        card.className="profile-card";
        card.innerHTML=`
            <img src="${profile.photo}" alt="${profile.name}">
            <div class="profile-info">
                <h3>${profile.name}, ${profile.age}</h3>
                <p>${profile.sex} - ${profile.orientation}</p>
                <p>${profile.city}</p>
            </div>
        `;
        card.addEventListener("click", ()=>openProfileModal(index));
        container.appendChild(card);
    });
}

function openProfileModal(index){
    const profile = profiles[index];
    document.getElementById("modalPhoto").src = profile.photo;
    document.getElementById("modalName").textContent = profile.name;
    document.getElementById("modalAge").textContent = profile.age;
    document.getElementById("modalSex").textContent = profile.sex;
    document.getElementById("modalOrientation").textContent = profile.orientation;
    document.getElementById("modalCity").textContent = profile.city;
    document.getElementById("modalBio").textContent = profile.bio;
    modalProfile.style.display = "flex";
}

closeProfile.onclick = ()=>modalProfile.style.display="none";
window.onclick = (event)=>{if(event.target===modalProfile) modalProfile.style.display="none";}

// FILTRES
function applyFilters(){
    const nameFilter = document.getElementById("searchName").value.toLowerCase();
    const sexFilter = document.getElementById("filterSex").value;
    const orientationFilter = document.getElementById("filterOrientation").value;
    const cityFilter = document.getElementById("filterCity").value.toLowerCase();

    const filtered = profiles.filter(p=>{
        return (p.name.toLowerCase().includes(nameFilter)) &&
               (sexFilter==="" || p.sex===sexFilter) &&
               (orientationFilter==="" || p.orientation===orientationFilter) &&
               (p.city.toLowerCase().includes(cityFilter));
    });

    displayProfiles(filtered);
}

document.getElementById("searchName").addEventListener("input", applyFilters);
document.getElementById("filterSex").addEventListener("change", applyFilters);
document.getElementById("filterOrientation").addEventListener("change", applyFilters);
document.getElementById("filterCity").addEventListener("input", applyFilters);
displayProfiles(profiles);

// MODALE AIDE
const modalHelp = document.getElementById("modalHelp");
const closeHelp = document.getElementById("closeHelp");
document.getElementById("openHelpBtn").addEventListener("click", ()=>modalHelp.style.display="flex");
closeHelp.onclick = ()=>modalHelp.style.display="none";
window.onclick = (event)=>{if(event.target===modalHelp) modalHelp.style.display="none";}

// CHAT INTERNE
const chatContainer = document.getElementById("chatContainer");
let chatMessages = [];

function sendTeamMessage(){
    const textarea = document.getElementById("teamMessage");
    const msg = textarea.value.trim();
    if(msg===""){alert("Écris ton message avant d'envoyer."); return;}
    
    // Ajouter le message utilisateur
    chatMessages.push({sender:"user", text:msg});
    displayChatMessages();
    textarea.value="";

    // Réponse automatique de l'équipe
    setTimeout(()=>{
        chatMessages.push({sender:"team", text:"Merci pour ton message ! Notre équipe l'a bien reçu et reviendra vers toi rapidement."});
        displayChatMessages();
    }, 800);
}

function displayChatMessages(){
    chatContainer.innerHTML="";
    chatMessages.forEach(m=>{
        const div = document.createElement("div");
        div.textContent = m.text;
        div.className = "chat-msg " + m.sender;
        chatContainer.appendChild(div);
    });
    chatContainer.scrollTop = chatContainer.scrollHeight;
}
</script>

</body>
</html>
