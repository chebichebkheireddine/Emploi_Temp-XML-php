
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
include("File_xsltGen/SelectPromo.php");
?>
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
            xhttp.open("GET", "File_xsltGen/PhpCodegen.php?niveau=" + str, true);
            xhttp.send();
        }
    </script>