<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:ns="http://www.w3.org/2001/XMLSchema">

  <!-- Include Bootstrap CDN -->
  <xsl:variable name="bootstrapCDN">
    <![CDATA[https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css]]>
  </xsl:variable>

  <!-- Template to match the root element -->
  <xsl:template match="/">
    <html>
      <head>
        <title>Promotion Information</title>
        <!-- Link to Bootstrap CDN -->
        <link rel="stylesheet" href="{$bootstrapCDN}" />
      </head>
      <body>
        <div class="container">
          <h1>Promotion Information</h1>
          <xsl:apply-templates select="ns:Promotion"/>
        </div>
      </body>
    </html>
  </xsl:template>

  <!-- Template to match the Promotion element -->
  <xsl:template match="ns:Promotion">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Promotion Niveau: <xsl:value-of select="@niveau"/></h2>
        <h3 class="card-subtitle mb-2 text-muted">Option: <xsl:value-of select="@Option"/></h3>
        <h4>Students:</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Num Inscription</th>
              <th>Nom</th>
              <th>Prenom</th>
            </tr>
          </thead>
          <tbody>
            <xsl:apply-templates select="ns:etudiants/ns:etudiant"/>
          </tbody>
        </table>
        <h4>Modules:</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
            </tr>
          </thead>
          <tbody>
            <xsl:apply-templates select="ns:modules/ns:module"/>
          </tbody>
        </table>
      </div>
    </div>
  </xsl:template>

  <!-- Template to match etudiant elements -->
  <xsl:template match="ns:etudiant">
    <tr>
      <td><xsl:value-of select="@numInscription"/></td>
      <td><xsl:value-of select="@nom"/></td>
      <td><xsl:value-of select="@prenome"/></td>
    </tr>
  </xsl:template>

  <!-- Template to match module elements -->
  <xsl:template match="ns:module">
    <tr>
      <td><xsl:value-of select="@idModule"/></td>
      <td><xsl:value-of select="@nomModule"/></td>
    </tr>
  </xsl:template>

</xsl:stylesheet>
