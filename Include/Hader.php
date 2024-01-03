<!DOCTYPE html>
<html lang="en">
<head>
  <title>Empoi de temps</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .fakeimg {
      height: 200px;
      background: #aaabba;
    }
    .a.active {
      color: red; /* Change this to your preferred active link color */
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-blue navbar-light">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <?php
        $currentPage = basename($_SERVER['PHP_SELF']); // Get the current page filename
        
        $navItems = [
          ["name" => "Home", "url" => "index.php"],
          ["name" => "Ajouti emoloi de temps", "url" => "AddEmp.php"],
          ["name" => "empoi de temps", "url" => "empoi.php"],
          ["name" => "List etudiant ", "url" => "etudiant.php"],
          ["name" => " Générer XML Emploi ", "url" => "XML_Emploi.php"],
          ["name" => " Générer XML Etudiant ", "url" => "XML_Etudiant.php"],
          ["name" => "Ajouti les information ", "url" => "contact.php"]
        ];
        
        foreach ($navItems as $item) {
          $isActive = ($currentPage === basename($item['url'])) ? 'active' : '';
          echo '<li class="nav-item">';
          echo '<a class="nav-link ' . $isActive . '" href="' . $item['url'] . '">' . $item['name'] . '</a>';
          echo '</li>';
        }
      ?>
    </ul>
  </div>
</nav>
</body>
</html>
