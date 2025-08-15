<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Messagerie Web avec signalement</title>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

/* Barre de menu */
nav {
    background-color: #333;
    color: #fff;
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

/* Conteneur principal */
.container {
    display: flex;
    height: calc(100vh - 50px);
}

/* Liste des contacts */
.contacts-list {
    width: 30%;
    background: #fff;
    overflow-y: auto;
    border-right: 1px solid #ccc;
}
.contact {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
}
.contact:hover {
    background-color: #f0f0f0;
}
.contact img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}
.contact-info {
    flex: 1;
}
.contact-name {
    font-weight: bold;
}
.contact-last {
    font-size: 0.9em;
    color: #666;
}
.contact-time {
    font-size: 0.8em;
    color: #999;
}

/* Zone chat */
.chat-container {
    flex: 1;
    display: flex;
    flex-direction: column;
}
.chat-header {
    padding: 10px;
    background-color: #333;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.chat-header-left {
    display: flex;
    align-items: center;
    gap: 10px;
}
.chat-header img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
.chat-user-info {
    display: flex;
    align-items: center;
    gap: 15px;
}
.chat-user-info div {
    font-size: 0.9em;
}

/* Boutons actions sur la même ligne */
.chat-actions {
    display: flex;
    gap: 10px;
}
.chat-actions button {
    padding: 5px 10px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    font-size: 0.85em;
}
.chat-actions .mute { background-color: #888; color: #fff; }
.chat-actions .block { background-color: #e74c3c; color: #fff; }
.chat-actions .report { background-color: #f39c12; color: #fff; }
.chat-actions button:hover { opacity: 0.8; }

/* Bandeau signalement */
#reportBanner {
    display:none;
    background-color:#e74c3c;
    color:white;
    padding:10px;
    text-align:center;
}

/* Formulaire signalement */
#reportForm {
    display:none;
    padding:10px;
    background:#fff;
    border-top:1px solid #ccc;
}

/* Messages */
.chat-messages {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
    background: #e5e5e5;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.message {
    max-width: 70%;
    padding: 10px 15px;
    border-radius: 15px;
    word-wrap: break-word;
}
.sent {
    background-color: #d1f7c4;
    align-self: flex-end;
    border-bottom-right-radius: 5px;
}
.received {
    background-color: #fff;
    align-self: flex-start;
    border-bottom-left-radius: 5px;
}

/* Zone de saisie */
.chat-input {
    display: flex;
    gap: 10px;
    padding: 10px;
    background: #fff;
    border-top: 1px solid #ccc;
}
.chat-input input {
    flex: 1;
    padding: 10px;
    border-radius: 20px;
    border: 1px solid #ccc;
}
.chat-input button {
    padding: 10px 20px;
    border-radius: 20px;
    border: none;
    background-color: #333;
    color: #fff;
    cursor: pointer;
}
.chat-input button:hover {
    background-color: #555;
}
</style>
</head>
<body>

<nav>
    <a href="accueil.php">Accueil</a>
    <a href="contacts.php">Contacts</a>
    <a href="#">Messages</a>
    <a href="profil.php">Profil</a>
    <a href="parametres.php">Paramètres</a>
</nav>

<div class="container">
    <!-- Liste contacts -->
    <div class="contacts-list" id="contactsList"></div>

    <!-- Chat -->
    <div class="chat-container">
        <div class="chat-header">
            <div class="chat-header-left">
                <img src="" id="chatImg" alt="">
                <div class="chat-user-info">
                    <div id="chatName"></div>
                    <div id="chatCityAge"></div>
                </div>
                <div class="chat-actions">
                    <button class="mute">Mute</button>
                    <button class="block">Bloquer</button>
                    <button class="report">Signaler</button>
                </div>
            </div>
        </div>

        <!-- Bandeau signalement -->
        <div id="reportBanner">
            Votre signalement n'est pas visible par la personne signalée.
        </div>

        <!-- Formulaire signalement -->
        <div id="reportForm">
            <label for="problemType">Type de problème :</label>
            <select id="problemType">
                <option value="">--Sélectionnez--</option>
                <option value="spam">Spam / Publicité</option>
                <option value="harcelement">Harcèlement</option>
                <option value="insultes">Insultes / Vulgarité</option>
                <option value="contenu_inapproprie">Contenu inapproprié</option>
                <option value="autre">Autre</option>
            </select>
            <br><br>
            <label for="reportText">Détails :</label>
            <textarea id="reportText" rows="4" style="width:100%; border-radius:5px; border:1px solid #ccc;" placeholder="Expliquez ce qu'il s'est passé..."></textarea>
            <br><br>
            <button onclick="submitReport()" style="background:#e74c3c;color:white;border:none;padding:8px 15px;border-radius:5px; cursor:pointer;">Envoyer le signalement</button>
        </div>

        <!-- Messages -->
        <div class="chat-messages" id="chatMessages"></div>

        <div class="chat-input">
            <input type="text" id="chatInput" placeholder="Écrire un message...">
            <button onclick="sendMessage()">Envoyer</button>
        </div>
    </div>
</div>

<script>
const contacts = [
    {name:"Alice", img:"https://i.pravatar.cc/50?img=1", last:"À plus tard !", city:"Paris", age:25, messages:[{text:"Salut !", type:"received"},{text:"À plus tard !", type:"sent"}]},
    {name:"Bob", img:"https://i.pravatar.cc/50?img=2", last:"Ok ça marche", city:"Lyon", age:30, messages:[{text:"Bonjour", type:"received"},{text:"Ok ça marche", type:"sent"}]},
    {name:"Claire", img:"https://i.pravatar.cc/50?img=3", last:"Merci 😊", city:"Marseille", age:28, messages:[{text:"Merci 😊", type:"received"}]},
    {name:"David", img:"https://i.pravatar.cc/50?img=4", last:"On se voit demain", city:"Bordeaux", age:32, messages:[{text:"On se voit demain", type:"received"}]},
];

const signalements = []; // Tableau local pour stocker les signalements

// Charger la liste des contacts
const contactsList = document.getElementById('contactsList');
contacts.forEach((c,i)=>{
    const div=document.createElement('div');
    div.classList.add('contact');
    div.innerHTML=`<img src="${c.img}" alt=""><div class="contact-info"><div class="contact-name">${c.name}</div><div class="contact-last">${c.last}</div></div><div class="contact-time">12:00</div>`;
    div.onclick=()=>openChat(i);
    contactsList.appendChild(div);
});

let currentChat=null;
function openChat(index){
    currentChat=index;
    document.getElementById('chatImg').src=contacts[index].img;
    document.getElementById('chatName').innerText=contacts[index].name;
    document.getElementById('chatCityAge').innerText=contacts[index].city+" - "+contacts[index].age+" ans";
    const chatMessages=document.getElementById('chatMessages');
    chatMessages.innerHTML='';
    contacts[index].messages.forEach(m=>{
        const div=document.createElement('div');
        div.classList.add('message',m.type);
        div.textContent=m.text;
        chatMessages.appendChild(div);
    });
    chatMessages.scrollTop=chatMessages.scrollHeight;
}

// Envoyer un message
function sendMessage(){
    if(currentChat===null) return;
    const input=document.getElementById('chatInput');
    const text=input.value.trim();
    if(text==='') return;
    const div=document.createElement('div');
    div.classList.add('message','sent');
    div.textContent=text;
    document.getElementById('chatMessages').appendChild(div);
    contacts[currentChat].messages.push({text:text,type:'sent'});
    input.value='';
    document.getElementById('chatMessages').scrollTop=document.getElementById('chatMessages').scrollHeight;
}

// Gestion du signalement
document.querySelector('.report').addEventListener('click', function() {
    document.getElementById('reportBanner').style.display = 'block';
    document.getElementById('reportForm').style.display = 'block';
});

function submitReport() {
    const type = document.getElementById('problemType').value;
    const text = document.getElementById('reportText').value.trim();
    if(type === "") {
        alert("Veuillez sélectionner un type de problème.");
        return;
    }
    if(text === "") {
        alert("Veuillez détailler le problème.");
        return;
    }

    // Stockage local
    signalements.push({
        contact: contacts[currentChat].name,
        type: type,
        details: text,
        date: new Date().toLocaleString()
    });

    console.log("Signalement envoyé :", signalements);

    alert("Votre signalement a été envoyé avec succès !");

    document.getElementById('reportBanner').style.display = 'none';
    document.getElementById('reportForm').style.display = 'none';
    document.getElementById('problemType').value = "";
    document.getElementById('reportText').value = "";
}
</script>
</body>
</html>
