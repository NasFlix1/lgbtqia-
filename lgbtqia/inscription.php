<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inscription</title>
	<style>
		body {
			margin: 0;
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
			background-color: #7f5fc5; /* fond violet doux */
			font-family: Arial, sans-serif;
		}
		.form-card {
			background: rgba(255, 255, 255, 0.15);
			backdrop-filter: blur(10px);
			border-radius: 15px;
			padding: 30px;
			width: 350px;
			color: white;
			box-shadow: 0 4px 20px rgba(0,0,0,0.3);
		}
		h1 {
			text-align: center;
			margin-bottom: 20px;
		}
		label {
			display: block;
			margin: 8px 0 5px;
			font-size: 14px;
			color: #f1f1f1;
		}
		input, select {
			width: 100%;
			padding: 10px;
			border: none;
			border-radius: 8px;
			margin-bottom: 10px;
			font-size: 14px;
			outline: none;
			box-sizing: border-box;
		}
		.button-container {
			display: flex;
			justify-content: space-between;
			gap: 10px;
		}
		button {
			flex: 1;
			padding: 12px;
			background: rgba(255,255,255,0.3);
			border: none;
			border-radius: 8px;
			color: white;
			font-size: 16px;
			cursor: pointer;
			transition: background 0.3s;
		}
		button:hover {
			background: rgba(255,255,255,0.5);
		}
		.step {
			display: none;
		}
		.step.active {
			display: block;
		}
		.error {
			color: #ffbaba;
			font-size: 12px;
			margin-bottom: 10px;
		}
	</style>
</head>
<body>

<div class="form-card">
	<h1>Inscription</h1>
	<form action="traitement.php" method="post" id="formulaire">

		<!-- ÉTAPE 1 -->
		<div class="step active" id="step1">
			<h3>Données publiques</h3>
			<label for="prenom">Prénom</label>
			<input type="text" id="prenom" name="prenom" placeholder="Votre prénom" required>

			<label for="date_naissance">Date de naissance</label>
			<input type="date" id="date_naissance" name="date_naissance" required>

			<label for="code_postal">Code postal</label>
			<input type="text" id="code_postal" name="code_postal" maxlength="5" pattern="[0-9]{5}" placeholder="Ex : 75001" required>

			<label for="sexe">Sexe</label>
			<select id="sexe" name="sexe" required>
				<option value="" disabled selected>Choisissez votre sexe</option>
				<option value="homme">Homme</option>
				<option value="femme">Femme</option>
				<option value="non-binaire">Non-binaire</option>
				<option value="autre">Autre</option>
			</select>

			<label for="orientation">Orientation sexuelle</label>
			<select id="orientation" name="orientation" required>
				<option value="" disabled selected>Choisissez votre orientation</option>
				<option value="gay">Gay</option>
				<option value="lesbienne">Lesbienne</option>
				<option value="bi">Bi</option>
				<option value="pan">Pan</option>
				<option value="asexuel">Asexuel</option>
				<option value="autre">Autre</option>
			</select>

			<div class="button-container">
				<button type="button" id="nextBtn1">Suivant</button>
			</div>
		</div>

		<!-- ÉTAPE 2 -->
		<div class="step" id="step2">
			<h3>Données confidentielles</h3>

			<label for="email">Adresse email</label>
			<input type="email" id="email" name="email" placeholder="Votre adresse email" required>

			<label for="telephone">Numéro de téléphone</label>
			<input type="text" id="telephone" name="telephone" placeholder="06 12 34 56 78" maxlength="14">

			<div style="margin:10px 0;">
				<input type="checkbox" id="autorisation" name="autorisation">
				<label for="autorisation" style="display:inline;">J'autorise que les gens me trouvent grâce à mon numéro</label>
			</div>

			<label for="nom">Nom</label>
			<input type="text" id="nom" name="nom" placeholder="Votre nom" required style="text-transform: uppercase;">

			<div class="button-container">
				<button type="button" id="prevBtn1">Précédent</button>
				<button type="button" id="nextBtn2">Suivant</button>
			</div>
		</div>

		<!-- ÉTAPE 3 (Mot de passe) -->
		<div class="step" id="step3">
			<h3>Sécurité du compte</h3>

			<label for="password">Mot de passe</label>
			<input type="password" id="password" name="password" placeholder="Créez un mot de passe" required>
			<div class="error" id="passwordError"></div>

			<div class="button-container">
				<button type="button" id="prevBtn2">Précédent</button>
				<button type="submit">S'inscrire</button>
			</div>
		</div>

	</form>
</div>

<script>
	// Étapes
	const step1 = document.getElementById("step1");
	const step2 = document.getElementById("step2");
	const step3 = document.getElementById("step3");

	document.getElementById("nextBtn1").addEventListener("click", () => {
		step1.classList.remove("active");
		step2.classList.add("active");
	});
	document.getElementById("prevBtn1").addEventListener("click", () => {
		step2.classList.remove("active");
		step1.classList.add("active");
	});
	document.getElementById("nextBtn2").addEventListener("click", () => {
		step2.classList.remove("active");
		step3.classList.add("active");
	});
	document.getElementById("prevBtn2").addEventListener("click", () => {
		step3.classList.remove("active");
		step2.classList.add("active");
	});

	// Validation Code postal
	document.getElementById("code_postal").addEventListener("input", function() {
		this.value = this.value.replace(/[^0-9]/g, '').slice(0, 5);
	});

	// Format téléphone
	document.getElementById("telephone").addEventListener("input", function() {
		let numbers = this.value.replace(/\D/g, '').slice(0, 10);
		let spaced = numbers.replace(/(\d{2})(?=\d)/g, '$1 ').trim();
		this.value = spaced;
	});

	// Validation mot de passe
	document.getElementById("formulaire").addEventListener("submit", function(e) {
		const pwd = document.getElementById("password").value;
		const errorDiv = document.getElementById("passwordError");
		const specialChars = pwd.replace(/[A-Za-z0-9]/g, "").length;
		const numbers = (pwd.match(/\d/g) || []).length;
		const upperCase = (pwd.match(/[A-Z]/g) || []).length;

		if (pwd.length < 12 || specialChars < 2 || numbers < 2 || upperCase < 2) {
			e.preventDefault();
			errorDiv.textContent = "Le mot de passe doit contenir au moins 12 caractères, 2 majuscules, 2 chiffres et 2 caractères spéciaux.";
		} else {
			errorDiv.textContent = "";
		}
	});
</script>

</body>
</html>
