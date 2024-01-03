<?php
include("../Bd/DB.php");

$query = "SELECT 
p.id_speci AS promotion_id,
s.nom_speci AS specialite_nom,
s.id_speci AS specialite_id,
p.niveau,
p.id_promo

FROM 
promotion p
JOIN 
specialite s ON p.id_speci = s.id_speci";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Select Niveau to show time</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Optional: Additional custom styles */
        /* Add your custom CSS here */
    </style>
</head>

<body>
    <div class="container mt-4">
        <form action="XSL_Etude.php" method="post" class="form-inline" id="myForm">
            <label for="niveau" class="mr-2">Select Niveau:</label>
            <select name="niveau" id="niveau" class="form-control mr-2">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_promo'] . '|' . $row['specialite_nom'] . '|' . $row['niveau'] . '">' . $row['niveau'] . ' ' . $row['specialite_nom'] . '</option>';
                    }
                }
                ?>
            </select>
            <button type="submit" class="btn btn-primary">Generate XML</button>
        </form>
    </div>

    <!-- Bootstrap JS (Optional - Only if you need Bootstrap JS functionalities) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
