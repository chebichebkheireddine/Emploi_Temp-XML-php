<?php
include("Bd/DB.php");

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
        <form action="XML_parser_Emp/XMLgenra.php" method="post" class="form-inline" id="myForm">
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
                    
            
            
            <button type="submit" class="btn btn-primary">Generate XML</button>
            
        </form>
    </div>

    <!-- Bootstrap JS (Optional - Only if you need Bootstrap JS functionalities) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
