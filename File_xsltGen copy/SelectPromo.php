<?php
include("../Bd/DB.php");

$query = "SELECT 
p.id_speci AS promotion_id,
s.nom_speci AS specialite_nom,
s.id_speci AS specialite_id,
p.niveau
FROM 
promotion p
JOIN 
specialite s ON p.id_speci = s.id_speci";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>




    <div class="container mt-4">
        <form method="post" class="form-inline" id="myForm">
            <label for="niveau" class="mr-2">Select Niveau:</label>

            <?php
            if ($result->num_rows > 0) {
                echo '<select name="niveau" id="niveau" class="form-control mr-2" onchange="showTimetable(this.value)">';
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['niveau'] . '">' . $row['niveau'].$row['specialite_nom']  . '</option>';
                }
                echo '</select>';
            }
            ?>

            <button type="button" class="btn btn-primary"
                onclick="showTimetable(document.getElementById('niveau').value)">Generate Table</button>

        </form>

        <div id="timetable"></div>
    </div>

    <!-- Bootstrap JS (Optional - Only if you need Bootstrap JS functionalities) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function showTimetable(str) {
            var xhttp;
            if (str == "") {
                document.getElementById("timetable").innerHTML = "";
                return;
            }
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("timetable").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "PhpCodegen.php?niveau=" + str, true);
            xhttp.send();
        }
    </script>
</body>

</html>