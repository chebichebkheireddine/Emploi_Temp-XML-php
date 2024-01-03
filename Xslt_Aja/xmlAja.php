<?php
include('../Bd/DB.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['niveau'])) {
    $selectedNiveauData = explode('|', $_GET["niveau"]);
    $selectedSpecialiteId = $selectedNiveauData[0];
    $selectedSpecialiteNom = $selectedNiveauData[1];
    $selectedNiveau = $selectedNiveauData[2]; 

    // Prepare SQL statement with a parameter placeholder
    $query = 'SELECT 
        m.nom_mod AS modules,
        m.id_mod AS id_mod,
        e.Num_etudiant,
        sp.nom_speci AS promotion,
        p.niveau,
        e.nom,
        e.prenom
    FROM 
        cours c
    JOIN 
        modules m ON c.id_mod = m.id_mod
    JOIN 
        promotion p ON c.id_promo = p.id_promo
    JOIN 
        etudiant e ON e.id_promo = p.id_promo
    JOIN 
        specialite sp ON p.id_speci = sp.id_speci
    WHERE 
        e.id_promo = ?'; // Using a placeholder

    // Prepare and bind the parameter
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $selectedSpecialiteId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<div class="card">
            <div class="card-body">
                <h2 class="card-title">Promotion Niveau: ' . $selectedNiveau . '</h2>
                <h3 class="card-subtitle mb-2 text-muted">Option: ' . $selectedSpecialiteNom . '</h3>
                <h4>Students:</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Num Inscription</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                        </tr>
                    </thead>
                    <tbody>';
        
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row['Num_etudiant'] . '</td>
                    <td>' . $row['nom'] . '</td>
                    <td>' . $row['prenom'] . '</td>
                </tr>';
        

        echo '</tbody></table>
            <h4>Modules:</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>';
        
        // Reset pointer to the beginning of the result set
        
            echo '<tr>
                    <td>' . $row['id_mod'] . '</td>
                    <td>' . $row['modules'] . '</td>
                </tr>';
        
        }
        echo '</tbody></table>
            </div>
        </div>';
    } else {
        echo '<div class="card">
                <div class="card-body">
                    <h2 class="card-title">No results found in the database</h2>
                </div>
            </div>';
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
