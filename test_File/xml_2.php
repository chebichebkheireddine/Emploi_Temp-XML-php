<?php
$xsdFile = 'File_XSD/promotion.xsd';

// Load the XSD
$xsd = new DOMDocument();
$xsd->load($xsdFile);

// Create the XML document
$xml = new DOMDocument('1.0');
$xml->formatOutput = true;

// Create the root element based on the XSD
$rootNode = $xml->createElementNS('http://www.w3.org/2001/XMLSchema', 'promotion');
$rootNode->setAttribute('option', 'MGL');
$rootNode->setAttribute('niveau', '1');
$xml->appendChild($rootNode);

// Create elements based on XSD
$childNodeEtudiants = $xml->createElement('etudiants');
$rootNode->appendChild($childNodeEtudiants);

$childNodeEtudiant = $xml->createElement('etudiant');
$childNodeEtudiant->setAttribute('numInscription', 'sdw32');
$childNodeEtudiant->setAttribute('nom', 'fff');
$childNodeEtudiant->setAttribute('prenome', 'f');
$childNodeEtudiants->appendChild($childNodeEtudiant);

$childNodeModules = $xml->createElement('modules');
$rootNode->appendChild($childNodeModules);

$childNodeModule = $xml->createElement('module');
$childNodeModule->setAttribute('idModule', 'e');
$childNodeModule->setAttribute('nomModule', 'ee');
$childNodeModules->appendChild($childNodeModule);

// Save the generated XML to a file
$xmlFile = 'File_XML/test.xml';
$xml->appendChild($rootNode);
$xml->save($xmlFile);

// Output XML to the browser
header('Content-type: text/xml');
echo $xml->saveXML();
?>
