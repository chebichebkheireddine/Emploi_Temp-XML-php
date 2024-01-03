<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["niveau"])) {
        $selectedNiveauData = explode('|', $_POST["niveau"]);
        $selectedSpecialiteId = $selectedNiveauData[0];
        $selectedSpecialiteNom = $selectedNiveauData[1];
        $selectedNiveau = $selectedNiveauData[2]; 
        // Load XML file
        $xmlFile = '../File_XML/XML_' . $selectedNiveau .$selectedSpecialiteNom. 'Etud.xml';
        $xml = new DOMDocument;
        $xml->load($xmlFile);

        // Load XSL file
        $xsl = new DOMDocument;
        $xsl->load('../File_XSLT/Etud_xslt.xsl');

        // Configure the transformer
        $proc = new XSLTProcessor;

        // Attach the xsl rules
        $proc->importStyleSheet($xsl);

        echo $proc->transformToXML($xml);
    }
}
?>
