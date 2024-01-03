
<?php 
include("Include/Hader.php");
echo "<head>
    <title>Select Niveau to show time</title>
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
    <style>
        /* Optional: Additional custom styles */
        /* Add your custom CSS here */
    </style>
</head> <body>
<div class='container mt-5'>";
include("Xslt_Aja/Select_Etud_sxlt.php");
?>
<script>
        function showTimetable(str) {
            if (str === "") {
                document.getElementById("timetable").innerHTML = "";
                return;
            }

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("timetable").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "Xslt_Aja/xmlAja.php?niveau=" + str, true);
            xhttp.send();
        }
    </script>