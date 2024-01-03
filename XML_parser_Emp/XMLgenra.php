<?php
// Include DB connection
include("../Bd/DB.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["niveau"])) {
        $selectedNiveau = $_POST["niveau"];

        // Prepare SQL statement with a parameter placeholder
        $query = "SELECT e.nom_ens AS enseignant, 
        m.nom_mod AS modules, 
        s.nom_salle AS salle, 
        c.jour, 
        c.heure_debut, 
        c.heure_fin
        FROM cours c
        JOIN enseignant e ON c.id_ens = e.id_ens
        JOIN modules m ON c.id_mod = m.id_mod
        JOIN salles s ON c.id_salle = s.id_salle
        JOIN promotion p ON c.id_promo = p.id_promo
        JOIN specialite sp ON p.id_speci = sp.id_speci
        JOIN promotion d ON c.id_promo = d.id_promo
        WHERE d.id_promo = ?"; // Using a placeholder

        // Prepare and bind the parameter
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $selectedNiveau);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            // Create the XML document
            $xml = new DOMDocument('1.0');
            $xml->formatOutput = true;

            // Create the root element
            $rootNode = $xml->createElement('emploi');
            $xml->appendChild($rootNode);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $seanceNode = $xml->createElement('seance');

                    // Set attributes based on fetched database values
                    $seanceNode->setAttribute('prof', $row['enseignant']);
                    $seanceNode->setAttribute('module', $row['modules']);
                    $seanceNode->setAttribute('salle', $row['salle']);
                    $seanceNode->setAttribute('jour', $row['jour']);
                    $seanceNode->setAttribute('debut', $row['heure_debut']);
                    $seanceNode->setAttribute('fin', $row['heure_fin']);

                    // Append seanceNode to the root node
                    $rootNode->appendChild($seanceNode);
                }

                // File and schema operations
                $xsdFile = '../File_XSD/emploi.xsd';
                $xmlFile = '../File_XML/XML_' . $selectedNiveau . 'Etud.xml';
            $xml->save($xmlFile);

            // Output XML to the browser
            header('Content-type: text/xml');
            echo $xml->saveXML();
            } else {
                echo "No results found in the database";
            }
            $result->free_result();
        } else {
            echo "Query execution failed.";
        }

        // Close the prepared statement and the database connection
        $stmt->close();
        $conn->close();
    }
}
?>
