<?php
include("../Bd/DB.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["niveau"])) {
    $selectedNiveau = $_GET["niveau"];

    // Prepare SQL statement with a parameter placeholder
    $query = "SELECT e.nom_ens AS enseignant, 
                    m.nom_mod AS modules, 
                    s.nom_salle AS salle, 
                    sp.nom_speci AS promotion,
                    c.jour, 
                    c.heure_debut, 
                    c.heure_fin,
                    d.niveau 
             FROM cours c
             JOIN enseignant e ON c.id_ens = e.id_ens
             JOIN modules m ON c.id_mod = m.id_mod
             JOIN salles s ON c.id_salle = s.id_salle
             JOIN promotion p ON c.id_promo = p.id_promo
             JOIN specialite sp ON p.id_speci = sp.id_speci
             JOIN promotion d ON c.id_promo = d.id_promo
             WHERE d.niveau = ?"; // Using a placeholder

    // Prepare and bind the parameter
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $selectedNiveau);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<table class='table table-bordered mt-4'>
            <thead class='thead-dark'>
                <tr>
                    <th>Day</th>
                    <th>Module</th>
                    <th>Professor</th>
                    <th>Room</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['jour']."</td>
                    <td>".$row['modules']."</td>
                    <td>".$row['enseignant']."</td>
                    <td>".$row['salle']."</td>
                    <td>".$row['heure_debut']."</td>
                    <td>".$row['heure_fin']."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No results found in the database</td></tr>";
    }

    echo "</tbody></table>";

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
