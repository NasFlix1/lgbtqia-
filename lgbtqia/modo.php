<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modération - Signalements</title>
<style>
	body {margin:0; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f5f6fa;}
	header {background:#2f3640; color:white; padding:20px; text-align:center; box-shadow:0 2px 5px rgba(0,0,0,0.3);}
	.container {display:flex; flex-wrap:wrap; justify-content:center; padding:20px; gap:20px;}
	.cellule {
		background:white; border-radius:12px; box-shadow:0 6px 15px rgba(0,0,0,0.15);
		padding:20px; width:300px; cursor:pointer; transition: transform 0.2s, box-shadow 0.2s;
	}
	.cellule:hover {transform: translateY(-3px); box-shadow:0 10px 20px rgba(0,0,0,0.2);}
	.cellule h3 {margin-top:0; color:#2f3640;}
	.cellule p {color:#718093;}
	.modal {display:none; position:fixed; top:0; left:0; width:100%; height:100%;
		background: rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:100;}
	.modal-content {
		background:white; padding:25px; border-radius:12px; width:90%; max-width:600px;
		position:relative; box-shadow:0 8px 25px rgba(0,0,0,0.3); max-height:90vh; overflow-y:auto;
	}
	.close {position:absolute; top:15px; right:20px; font-size:25px; cursor:pointer; color:#e84118;}
	h2 {color:#2f3640;}
	.warning-history {margin-top:15px; border-top:1px solid #dcdde1; padding-top:10px;}
	.warning-item {background:#f1f2f6; margin-bottom:10px; padding:10px; border-radius:8px;}
	.warning-item p {margin:3px 0; font-size:14px; color:#2f3640;}
	button {margin-top:10px; padding:10px 15px; border:none; border-radius:8px; background:#40739e; color:white; cursor:pointer; transition:0.3s;}
	button:hover {background:#487eb0;}
	.action-buttons {display:flex; gap:10px; margin-top:10px;}
	.action-buttons button {flex:1;}
	a {color:#40739e; cursor:pointer; text-decoration:underline;}
	textarea {width:100%; padding:8px; border-radius:6px; border:1px solid #ccc; box-sizing:border-box;}
</style>
</head>
<body>

<header>
	<h1>Modération - Signalements</h1>
</header>

<div class="container" id="signalements"></div>

<!-- MODALE -->
<div class="modal" id="modal">
	<div class="modal-content">
		<span class="close" id="closeModal">&times;</span>
		<h2 id="modalName"></h2>
		<p><strong>Âge :</strong> <span id="modalAge"></span></p>
		<p><strong>Raison :</strong> <span id="modalRaison"></span></p>
		<p><strong>Signalé par :</strong> <span id="modalReporter"></span></p>
		<p><strong>Messages signalés :</strong></p>
		<ul id="modalMessages"></ul>

		<p><strong>Avertissements :</strong></p>
		<div class="warning-history" id="warningHistory"></div>

		<label for="justification">Ajouter un avertissement :</label>
		<textarea id="justification" placeholder="Justification..."></textarea>
		<button id="addWarningBtn">Ajouter avertissement</button>

		<div class="action-buttons">
			<button id="quarantaineBtn" style="background:orange;">Mettre en quarantaine</button>
			<button id="bloquerBtn" style="background:red;">Bloquer</button>
			<button id="suspendreBtn" style="background:purple;">Suspendre temporairement</button>
		</div>
	</div>
</div>

<script>
	const usersSignalés = [
		{
			name: "JOHN DOE",
			age: 22,
			raison: "Comportement inapproprié",
			reporter: {name:"Alice"},
			messages: ["Salut, tu es nul !", "Arrête de spammer"],
			warnings: [
				{modo:"Modérateur1", justification:"Langage inapproprié", date:"2025-08-10"}
			],
			status:"Actif"
		},
		{
			name: "JANE SMITH",
			age: 19,
			raison: "Spam / publicité",
			reporter: {name:"Bob"},
			messages: ["Achetez ce produit !", "Visitez mon site !"],
			warnings: [],
			status:"Actif"
		}
	];

	const container = document.getElementById("signalements");
	const modal = document.getElementById("modal");
	const closeModal = document.getElementById("closeModal");

	let currentIndex = null;

	function afficherSignalements() {
		container.innerHTML = "";
		usersSignalés.forEach((user, index) => {
			const cellule = document.createElement("div");
			cellule.className = "cellule";
			cellule.innerHTML = `<h3><a id="signalé${index}">${user.name}</a></h3><p>Raison : ${user.raison}</p>`;
			cellule.addEventListener("click", () => openModal(index));
			container.appendChild(cellule);
		});
	}

	function openModal(index){
		currentIndex = index;
		const user = usersSignalés[index];

		// Nom du signalé cliquable
		const modalName = document.getElementById("modalName");
		modalName.innerHTML = `<a id="signaléModal">${user.name}</a>`;
		document.getElementById("signaléModal").onclick = () => {
			openUserDossier(index);
		};

		document.getElementById("modalAge").textContent = user.age;
		document.getElementById("modalRaison").textContent = user.raison;

		// Reporter cliquable
		const reporterEl = document.getElementById("modalReporter");
		reporterEl.innerHTML = `<a>${user.reporter.name}</a>`;
		reporterEl.onclick = () => alert(`Ouverture du dossier de ${user.reporter.name} (simulé).`);

		// Messages signalés
		const messagesList = document.getElementById("modalMessages");
		messagesList.innerHTML = "";
		user.messages.forEach(msg => {
			const li = document.createElement("li");
			li.textContent = msg;
			messagesList.appendChild(li);
		});

		// Historique avertissements
		updateWarningHistory(index);

		modal.style.display = "flex";
	}

	function updateWarningHistory(index){
		const user = usersSignalés[index];
		const warningHistoryEl = document.getElementById("warningHistory");
		warningHistoryEl.innerHTML = "";
		if(user.warnings.length === 0) warningHistoryEl.innerHTML="<p>Aucun avertissement</p>";
		user.warnings.forEach(w => {
			const div = document.createElement("div");
			div.className = "warning-item";
			div.innerHTML = `<p><strong>Modérateur :</strong> ${w.modo}</p>
							 <p><strong>Date :</strong> ${w.date}</p>
							 <p><strong>Justification :</strong> ${w.justification}</p>`;
			warningHistoryEl.appendChild(div);
		});
	}

	function openUserDossier(index){
		// Ici tu peux afficher toutes les informations du dossier complet
		alert(`Ouverture du dossier complet de ${usersSignalés[index].name} (simulation).`);
	}

	// Ajouter un avertissement
	document.getElementById("addWarningBtn").onclick = () => {
		const justification = document.getElementById("justification").value.trim();
		if(justification === ""){
			alert("Merci d'ajouter une justification !");
			return;
		}
		const date = new Date().toISOString().split('T')[0];
		usersSignalés[currentIndex].warnings.push({modo:"Vous", justification, date});
		document.getElementById("justification").value = "";
		updateWarningHistory(currentIndex);
	};

	// Actions quarantaine, bloquer, suspendre
	document.getElementById("quarantaineBtn").onclick = () => {
		usersSignalés[currentIndex].status="Quarantaine";
		alert(`${usersSignalés[currentIndex].name} mis en quarantaine`);
	};
	document.getElementById("bloquerBtn").onclick = () => {
		usersSignalés[currentIndex].status="Bloqué";
		alert(`${usersSignalés[currentIndex].name} bloqué`);
	};
	document.getElementById("suspendreBtn").onclick = () => {
		usersSignalés[currentIndex].status="Suspendu temporairement";
		alert(`${usersSignalés[currentIndex].name} suspendu temporairement`);
	};

	closeModal.onclick = () => modal.style.display = "none";
	window.onclick = (event) => { if(event.target === modal) modal.style.display = "none"; }

	afficherSignalements();
</script>

</body>
</html>
