<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Messagerie Test</title>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: #f2f2f2;
}

/* Liste des contacts */
#contacts {
    display: block;
}

.contact {
    display: flex;
    align-items: center;
    padding: 10px;
    background: #fff;
    border-bottom: 1px solid #ddd;
    cursor: pointer;
}
.contact:hover {
    background: #f9f9f9;
}
.contact img {
    border-radius: 50%;
    width: 50px;
    height: 50px;
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

/* Page de discussion */
#chat {
    display: none;
    height: 100vh;
    display: flex;
    flex-direction: column;
}

.chat-header {
    background: #075E54;
    color: #fff;
    padding: 10px;
    display: flex;
    align-items: center;
}
.chat-header img {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    margin-right: 10px;
}
.chat-header button {
    background: transparent;
    border: none;
    color: #fff;
    font-size: 18px;
    margin-right: 10px;
    cursor: pointer;
}

.messages {
    flex: 1;
    overflow-y: auto;
    padding: 10px;
    background: #e5ddd5;
}
.message {
    max-width: 70%;
    padding: 8px 12px;
    margin: 5px 0;
    border-radius: 15px;
    word-wrap: break-word;
}
.sent {
    background: #DCF8C6;
    align-self: flex-end;
}
.received {
    background: #fff;
    align-self: flex-start;
}

.chat-input {
    display: flex;
    background: #fff;
    padding: 10px;
    border-top: 1px solid #ddd;
}
.chat-input input {
    flex: 1;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 20px;
    outline: none;
}
.chat-input button {
    margin-left: 10px;
    background: #075E54;
    color: #fff;
    border: none;
    padding: 8px 15px;
    border-radius: 20px;
    cursor: pointer;
}
</style>
</head>
<body>

<!-- Page Contacts -->
<div id="contacts">
    <!-- Les contacts seront injectés ici -->
</div>

<!-- Page Chat -->
<div id="chat">
    <div class="chat-header">
        <button onclick="goBack()">←</button>
        <img id="chatImg" src="" alt="">
        <div id="chatName"></div>
    </div>
    <div class="messages" id="messages"></div>
    <div class="chat-input">
        <input type="text" id="msgInput" placeholder="Écrire un message...">
        <button onclick="sendMessage()">Envoyer</button>
    </div>
</div>

<script>
const contacts = [
    {name: "Alice", img: "https://i.pravatar.cc/50?img=1", last: "À plus tard !", time: "09:15"},
    {name: "Bob", img: "https://i.pravatar.cc/50?img=2", last: "Ok ça marche", time: "10:30"},
    {name: "Claire", img: "https://i.pravatar.cc/50?img=3", last: "Merci 😊", time: "11:00"},
    {name: "David", img: "https://i.pravatar.cc/50?img=4", last: "On se voit demain", time: "11:45"},
    {name: "Emma", img: "https://i.pravatar.cc/50?img=5", last: "Parfait !", time: "12:10"},
    {name: "Lucas", img: "https://i.pravatar.cc/50?img=6", last: "T'es dispo ?", time: "12:30"},
    {name: "Sophie", img: "https://i.pravatar.cc/50?img=7", last: "Super idée !", time: "13:00"},
    {name: "Noah", img: "https://i.pravatar.cc/50?img=8", last: "Oui 👍", time: "13:30"},
    {name: "Chloé", img: "https://i.pravatar.cc/50?img=9", last: "Haha 😂", time: "14:00"},
    {name: "Hugo", img: "https://i.pravatar.cc/50?img=10", last: "Pas de souci", time: "14:15"},
    {name: "Léa", img: "https://i.pravatar.cc/50?img=11", last: "Je t’appelle", time: "14:30"},
    {name: "Nathan", img: "https://i.pravatar.cc/50?img=12", last: "À bientôt", time: "14:45"},
    {name: "Camille", img: "https://i.pravatar.cc/50?img=13", last: "Ok merci", time: "15:00"},
    {name: "Julien", img: "https://i.pravatar.cc/50?img=14", last: "On verra", time: "15:15"},
    {name: "Sarah", img: "https://i.pravatar.cc/50?img=15", last: "Trop bien", time: "15:30"},
    {name: "Mathis", img: "https://i.pravatar.cc/50?img=16", last: "Je confirme", time: "15:45"},
    {name: "Zoé", img: "https://i.pravatar.cc/50?img=17", last: "J’arrive", time: "16:00"},
    {name: "Ethan", img: "https://i.pravatar.cc/50?img=18", last: "C’est noté", time: "16:15"},
    {name: "Lola", img: "https://i.pravatar.cc/50?img=19", last: "D’accord", time: "16:30"},
    {name: "Maxime", img: "https://i.pravatar.cc/50?img=20", last: "Merci !", time: "16:45"}
];

let currentChat = null;

function loadContacts() {
    const container = document.getElementById("contacts");
    contacts.forEach((c, i) => {
        const div = document.createElement("div");
        div.className = "contact";
        div.innerHTML = `
            <img src="${c.img}" alt="">
            <div class="contact-info">
                <div class="contact-name">${c.name}</div>
                <div class="contact-last">${c.last}</div>
            </div>
            <div class="contact-time">${c.time}</div>
        `;
        div.onclick = () => openChat(i);
        container.appendChild(div);
    });
}

function openChat(index) {
    currentChat = index;
    document.getElementById("contacts").style.display = "none";
    document.getElementById("chat").style.display = "flex";
    document.getElementById("chatName").innerText = contacts[index].name;
    document.getElementById("chatImg").src = contacts[index].img;
    document.getElementById("messages").innerHTML = `
        <div class="message received">${contacts[index].last}</div>
    `;
}

function goBack() {
    document.getElementById("chat").style.display = "none";
    document.getElementById("contacts").style.display = "block";
}

function sendMessage() {
    const input = document.getElementById("msgInput");
    if (input.value.trim() !== "") {
        const div = document.createElement("div");
        div.className = "message sent";
        div.innerText = input.value;
        document.getElementById("messages").appendChild(div);
        input.value = "";
        document.getElementById("messages").scrollTop = document.getElementById("messages").scrollHeight;
    }
}

loadContacts();
</script>

</body>
</html>
