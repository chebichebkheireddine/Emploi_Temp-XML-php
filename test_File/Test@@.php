<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom styles here */
    </style>
</head>

<body>

    <h1>The XMLHttpRequest Object</h1>

    <button type="button" class="btn btn-primary" onclick="loadDoc()">Get my courses</button>
    <br><br>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Day</th>
                <th>Module</th>
                <th>Professor</th>
                <th>Room</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
        </thead>
        <tbody id="demo"></tbody>
    </table>

    <script>
        function loadDoc() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    myFunction(this);
                }
            };
            xhttp.open("GET", "File_XML/XML_2MGL.xml", true);
            xhttp.send();
        }

        function myFunction(xml) {
            var i;
            var xmlDoc = xml.responseXML;
            var table = "";
            var seance = xmlDoc.getElementsByTagName("seance")[0];
            var professor = seance.getAttribute("prof");
            var module = seance.getAttribute("module");
            var room = seance.getAttribute("salle");
            var day = seance.getAttribute("jour");
            var startTime = seance.getAttribute("debut");
            var endTime = seance.getAttribute("fin");

            table += `
        <tr>
        <td>${day}</td>
        <td>${module}</td>
          <td>${professor}</td>
          <td>${room}</td>
          
          <td>${startTime}</td>
          <td>${endTime}</td>
        </tr>
      `;

            document.getElementById("demo").innerHTML = table;
        }
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>