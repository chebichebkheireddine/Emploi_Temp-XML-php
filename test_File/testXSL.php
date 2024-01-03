<?php
include("Bd/DB.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["niveau"])) {
        $selectedNiveau = $_POST["niveau"];
        // Load XML file
        $xml = new DOMDocument;
        $xml->load('File_XML/XML_'. $selectedNiveau .'.xml');

        // Load XSL file
        $xsl = new DOMDocument;
        $xsl->load('File_XSLT/test_xslt.xsl');

        // Configure the transformer
        $proc = new XSLTProcessor;

        // Attach the xsl rules
        $proc->importStyleSheet($xsl);

        echo $proc->transformToXML($xml);

    }
}
?>