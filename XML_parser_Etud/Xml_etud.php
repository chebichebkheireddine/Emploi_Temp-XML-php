<?php
include("../Bd/DB.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["niveau"])) {
        $selectedNiveauData = explode('|', $_POST["niveau"]);
        $selectedSpecialiteId = $selectedNiveauData[0];
        $selectedSpecialiteNom = $selectedNiveauData[1];
        $selectedNiveau = $selectedNiveauData[2];

        // Your database connection code here (from "../Bd/DB.php")
        // Assuming $conn is the database connection object

        // Check if the connection is successful before proceeding
        if ($conn) {
            $query = "SELECT 
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
                e.id_promo = ?";

            // Prepare and bind the parameter
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $selectedSpecialiteId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Create the XML document
                $xml = new DOMDocument('1.0', 'UTF-8');
                $xml->formatOutput = true;

                // Create the root element based on the provided XSD structure
                $rootNode = $xml->createElementNS('http://www.w3.org/2001/XMLSchema', 'Promotion');
                $rootNode->setAttribute('Option', $selectedSpecialiteNom);
                $rootNode->setAttribute('niveau', $selectedNiveau); // Moved this outside the while loop

                $xml->appendChild($rootNode);

                // Create child elements based on XSD structure
                $childNodeEtudiants = $xml->createElement('etudiants');
                $rootNode->appendChild($childNodeEtudiants);

                $childNodeModules = $xml->createElement('modules');
                $rootNode->appendChild($childNodeModules);

                while ($row = $result->fetch_assoc()) {
                    // Create elements based on XSD structure for each database row
                    $childNodeEtudiant = $xml->createElement('etudiant');
                    $childNodeEtudiant->setAttribute('numInscription', $row['Num_etudiant']);
                    $childNodeEtudiant->setAttribute('nom', $row['nom']);
                    $childNodeEtudiant->setAttribute('prenom', $row['prenom']); // Fixed 'prenome' typo
                    $childNodeEtudiants->appendChild($childNodeEtudiant);

                    $childNodeModule = $xml->createElement('module');
                    $childNodeModule->setAttribute('idModule', $row['id_mod']);
                    $childNodeModule->setAttribute('nomModule', $row['modules']);
                    $childNodeModules->appendChild($childNodeModule);
                }

                $xmlFile = '../File_XML/XML_' . $selectedNiveau . $selectedSpecialiteNom . 'Etud.xml';
                $xml->save($xmlFile);

                // Output XML to the browser
                header('Content-type: text/xml');
                echo $xml->saveXML();
            } else {
                echo "No results found in the database";
            }

            // Close resources (e.g., prepared statement, database connection)
            $stmt->close();
            $conn->close();
        } else {
            echo "Database connection failed";
        }
    }
}
?>
