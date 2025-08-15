<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .input-group {
            position: relative;
            margin-bottom: 15px;
        }
        input {
            width: 100%;
            padding: 12px 40px 12px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }
        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Connexion</h2>
    <form>
        <div class="input-group">
            <input type="text" placeholder="Adresse e-mail ou numéro de téléphone" required>
        </div>
        <div class="input-group">
            <input type="password" id="password" placeholder="Mot de passe" required>
            <span class="eye-icon" onclick="togglePassword()">👁️</span>
        </div>
        <button type="submit">Se connecter</button>
        <a href=".//inscription.php">inscription</a>

    </form>
</div>


<script>
function togglePassword() {
    const password = document.getElementById("password");
    password.type = password.type === "password" ? "text" : "password";
}
</script>

</body>
</html>
