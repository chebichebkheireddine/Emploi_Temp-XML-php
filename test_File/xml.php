<?php
$xsdFile = 'File_XSD/emploi.xsd';
// Load the XSD
$xsd = new DOMDocument();
$xsd->load($xsdFile);

// Create the XML document
$xml = new DOMDocument('1.0');
$xml->formatOutput = true; // This makes the output nicely formatted

// Create the root element based on the XSD
$rootNode = $xml->createElementNS('http://www.w3.org/2001/XMLSchema', 'emploi'); // Replace 'namespaceURI' and 'RootElement' with your desired values
$rootNode->setAttribute('promotion', '2MGL');
$xml->appendChild($rootNode);

// Create elements based on XSD
// You'll need to traverse the XSD and create elements accordingly

// For example, creating a simple element:
$childNode = $xml->createElement('seance');
$rootNode->appendChild($childNode);

// Add attributes, if any
$childNode->setAttribute('jour', 'dd');
$childNode->setAttribute('debut', '12:22');
$childNode->setAttribute('fin', '14:00');
$childNode->setAttribute('prof', 'q');
$childNode->setAttribute('module', 'xml');
$childNode->setAttribute('salle', '11');

// Append this XML structure to the document
$xml->appendChild($rootNode);

// Save the generated XML to a file or output to the browser
$xmlFile = 'File_XML/test.xml'; // Set the path where you want to save the XML file
$xml->save($xmlFile);

// Output XML to the browser
header('Content-type: text/xml');
echo $xml->saveXML();
?>