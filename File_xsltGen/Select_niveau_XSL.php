<?php
include("Bd/DB.php");


?>

<!DOCTYPE html>
<html>



<body>
    <div class="container mt-4">
        <form method="post" class="form-inline" id="myForm">
            <label for="niveau" class="mr-2">Select Niveau:</label>

            
            <select name="niveau" id="niveau" class="form-control mr-2">
            
                    <option value="2">MGL2</option>
                    <option value="3">MGL1</option>
                    <option value="4">MGI2</option>
                    <option value="5">MGI1</option>
                    <option value="6">MRT2</option>
                    <option value="7">MRT1</option>
                    <option value="8">L1</option>
                    <option value="9">l2</option>
                    <option value="10">l3</option>
            </select>
                    
            
            <button type="button" class="btn btn-primary" onclick="showTimetable(document.getElementById('niveau').value)">Generate Table</button>
            
        </form>
        <div id="timetable"></div>
    </div>

    <!-- Bootstrap JS (Optional - Only if you need Bootstrap JS functionalities) -->
   
</body>
</html>
