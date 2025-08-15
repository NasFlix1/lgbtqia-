<header>
    <h1>LGBTQIA+ Connect</h1>
    <nav>
        <a href="#">Accueil</a>
        <a href="#">Messages</a>
        <a href="#">Profil</a>
        <a href="#">Paramètres</a>
        <a href="#" id="helpBtn">Système d'aide</a>
        <a href="#">Déconnexion</a>
    </nav>
</header>

<!-- MODALE AIDE -->
<div class="modal" id="helpModal">
    <div class="modal-content">
        <span class="close" id="closeHelpModal">&times;</span>
        <h2>Système d'aide</h2>
        <p>Bienvenue dans l'espace de soutien. Ici vous trouverez :</p>
        <ul>
            <li><strong>Support psychologique :</strong> Liens vers psy, lignes d'écoute, ressources en santé mentale.</li>
            <li><strong>Soutien social :</strong> Associations et groupes de soutien LGBTQIA+.</li>
            <li><strong>Travail sur soi :</strong> Conseils, exercices et ressources pour le bien-être et le développement personnel.</li>
        </ul>
        <p>Pour toute urgence médicale ou psychologique, contactez les services compétents immédiatement.</p>
    </div>
</div>

<script>
// MODALE SYSTÈME D'AIDE
const helpBtn = document.getElementById("helpBtn");
const helpModal = document.getElementById("helpModal");
const closeHelpModal = document.getElementById("closeHelpModal");

helpBtn.onclick = () => { helpModal.style.display = "flex"; };
closeHelpModal.onclick = () => { helpModal.style.display = "none"; };
window.onclick = (event) => { if(event.target === helpModal) helpModal.style.display = "none"; };
</script>
