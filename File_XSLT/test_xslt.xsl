<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html>
      <head>
        <!-- Bootstrap CSS link -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
      </head>
      <body>
        <div class="container mt-4">
          <h2>Emploi</h2>
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>Prof</th>
                <th>Module</th>
                <th>Salle</th>
                <th>Jour</th>
                <th>Début</th>
                <th>Fin</th>
              </tr>
            </thead>
            <tbody>
              <xsl:apply-templates select="emploi/seance"/>
            </tbody>
          </table>
        </div>
      </body>
    </html>
  </xsl:template>
  
  <xsl:template match="seance">
    <tr>
      <td><xsl:value-of select="@prof"/></td>
      <td><xsl:value-of select="@module"/></td>
      <td><xsl:value-of select="@salle"/></td>
      <td><xsl:value-of select="@jour"/></td>
      <!-- Adjust time format if needed -->
      <td><xsl:value-of select="@debut"/></td>
      <td><xsl:value-of select="@fin"/></td>
    </tr>
  </xsl:template>
</xsl:stylesheet>
