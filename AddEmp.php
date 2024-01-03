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
";
include("Bd/DB.php");
include("Doa/cours.php");
$courObj = new CoursDOA($pdo);


?>
<div class="row">
    <!-- row no: 1 begin -->
    <div class="col-lg-12">
        <!-- col-lg-12 begin -->
        <h1 class="page-header"> Ajouter course </h1>

        <ol class="breadcrumb">
            <!-- breadcrumb begin -->
            <li class="active">
                <!-- active begin -->

                <i class="fa fa-bullhorn"></i> Ajouter course

            </li><!-- active finish -->
        </ol><!-- breadcrumb finish -->

    </div><!-- col-lg-12 finish -->
</div><!-- row no: 1 finish -->



<div class="panel-body">
    <!-- panel-body Begin -->

    <form method="post" class="form-horizontal" enctype="multipart/form-data">
        <!-- form-horizontal Begin -->

        <div class="form-group">
            <!-- form-group Begin -->

            <div class="col-md-6">
                <!-- col-md-6 Begin -->
                <select name="Promotion_Id" class="form-control">
                    <!-- form-control Begin -->
                    <option> Select a Promotion </option>

                    <?php

                    $get_SQL = "SELECT 
                    p.id_speci AS promotion_id,
                    s.nom_speci AS specialite_nom,
                    s.id_speci AS specialite_id,
                    p.niveau,
                    p.id_promo
                    
                    FROM 
                    promotion p
                    JOIN 
                    specialite s ON p.id_speci = s.id_speci WHERE
                    NOT 
                    p.id_speci=p.id_promoi";
                    $run_SQL = mysqli_query($conn, $get_SQL);

                    while ($row_SQL = mysqli_fetch_array($run_SQL)) {

                        //$plase_id = $row_pla['plase_id'];
                        $name_Promotion = $row_SQL['specialite_nom'] . '' . $row_SQL['niveau'];
                        $id_prom = $row_SQL['id_promo'];

                        echo "
                                  
                                  <option value='$id_prom'> $name_Promotion </option>
                                  
                                  ";
                    }

                    ?>

                </select><!-- form-control Finish -->
            </div><!-- col-md-6 Finish -->
        </div><!-- form-group Finish -->
        <div class="form-group">
            <!-- form-group Begin -->

            <div class="col-md-6">
                <!-- col-md-6 Begin -->
                <select name="enseignant_Id" class="form-control">
                    <!-- form-control Begin -->
                    <option>Select an enseignant</option>

                    <?php
                    // Assuming $conn is your database connection
                    
                    $get_SQL_E = "SELECT * FROM enseignant";
                    $run_SQL_E = mysqli_query($conn, $get_SQL_E);

                    while ($row_SQL_E = mysqli_fetch_array($run_SQL_E)) {
                        $name_enseignant = $row_SQL_E['nom_ens']; // Changed $row_SQL to $row_SQL_E
                        $id_enseignant = $row_SQL_E['id_ens']; // Changed $row_SQL to $row_SQL_E
                    
                        echo "<option value='$id_enseignant'> $name_enseignant </option>";
                    }
                    ?>

                </select><!-- form-control Finish -->
            </div><!-- col-md-6 Finish -->
        </div><!-- form-group Finish -->
        <div class="form-group">
            <!-- form-group Begin -->

            <div class="col-md-6">
                <!-- col-md-6 Begin -->
                <select name="Salle_Id" class="form-control">
                    <!-- form-control Begin -->
                    <option>Select an Salle</option>

                    <?php
                    // Assuming $conn is your database connection
                    
                    $get_SQL_S = "SELECT * FROM Salles";
                    $run_SQL_S = mysqli_query($conn, $get_SQL_S);

                    while ($row_SQL_S = mysqli_fetch_array($run_SQL_S)) {
                        $name_Salle = $row_SQL_S['nom_salle']; // Changed $row_SQL to $row_SQL_E
                        $id_Salle = $row_SQL_S['id_salle']; // Changed $row_SQL to $row_SQL_E
                    
                        echo "<option value='$id_Salle'> $name_Salle </option>";
                    }
                    ?>

                </select><!-- form-control Finish -->
            </div><!-- col-md-6 Finish -->
        </div><!-- form-group Finish -->
        <div class="form-group">
            <!-- form-group Begin -->

            <div class="col-md-6">
                <!-- col-md-6 Begin -->
                <select name="Module_Id" class="form-control">
                    <!-- form-control Begin -->
                    <option>Select an modules</option>

                    <?php
                    // Assuming $conn is your database connection
                    
                    $get_SQL_M = "SELECT * FROM modules";
                    $run_SQL_M = mysqli_query($conn, $get_SQL_M);

                    while ($row_SQL_M = mysqli_fetch_array($run_SQL_M)) {
                        $name_modules = $row_SQL_M['nom_mod']; // Changed $row_SQL to $row_SQL_E
                        $id_modules = $row_SQL_M['id_mod']; // Changed $row_SQL to $row_SQL_E
                    
                        echo "<option value='$id_modules'> $name_modules </option>";
                    }
                    ?>

                </select><!-- form-control Finish -->
            </div><!-- col-md-6 Finish -->
        </div><!-- form-group Finish -->
        <div class="form-group">
            <!-- form-group Begin -->
            <div class="col-md-6">
                <!-- col-md-6 Begin -->
                <select name="Jour" class="form-control">
                    <!-- form-control Begin -->
                    <option>Sélectionnez un jour</option>
                    <option value="dimanche">Dimanche</option>
                    <option value="lundi">Lundi</option>
                    <option value="mardi">Mardi</option>
                    <option value="mercredi">Mercredi</option>
                    <option value="jeudi">Jeudi</option>
                    <option value="vendredi">Vendredi</option>
                    <option value="samedi">Samedi</option>
                </select><!-- form-control Finish -->
            </div><!-- col-md-6 Finish -->
        </div><!-- form-group Finish -->
        <div class="form-group">
            <!-- form-group Begin -->
            <div class="col-md-6">
                <!-- col-md-6 Begin -->
                <select name="Timedebut" class="form-control">
                    <!-- form-control Begin -->
                    <option>Select a time debut</option>
                    <!-- Generating time options -->
                    <optgroup label="Time">
                        <!-- Starting from 8:00 AM -->
                        <option value="08:00:00">08:00 AM</option>
                        <!-- Incrementing by 1.5 hours till 5:00 PM -->
                        <option value="09:30:00">09:30 AM</option>
                        <option value="11:00:00">11:00 AM</option>
                        <option value="12:30:00">12:30 PM</option>
                        <option value="14:00:00">02:00 PM</option>
                        <option value="15:30:00">03:30 PM</option>
                        <option value="17:00:00">05:00 PM</option>
                    </optgroup>
                </select><!-- form-control Finish -->
            </div><!-- col-md-6 Finish -->
        </div><!-- form-group Finish -->
        <div class="form-group">
            <!-- form-group Begin -->
            <div class="col-md-6">
                <!-- col-md-6 Begin -->
                <select name="Timefin" class="form-control">
                    <!-- form-control Begin -->
                    <option>Select a time fin</option>
                    <!-- Generating time options -->
                    <optgroup label="Time">
                        <!-- Starting from 8:00 AM -->
                        
                        <!-- Incrementing by 1.5 hours till 5:00 PM -->
                        <option value="09:30:00">09:30 AM</option>
                        <option value="11:00:00">11:00 AM</option>
                        <option value="12:30:00">12:30 PM</option>
                        <option value="14:00:00">02:00 PM</option>
                        <option value="15:30:00">03:30 PM</option>
                        <option value="17:00:00">05:00 PM</option>
                    </optgroup>
                </select><!-- form-control Finish -->
            </div><!-- col-md-6 Finish -->
        </div><!-- form-group Finish -->
        <div class="form-group">
            <!-- form-group Begin -->

            <label class="col-md-3 control-label"></label>

            <div class="col-md-6">
                <!-- col-md-6 Begin -->

                <input name="submit" value="Ajout coure" type="submit" class="btn btn-primary form-control">

            </div><!-- col-md-6 Finish -->

        </div><!-- form-group Finish -->










    </form><!-- form-horizontal Finish -->

</div><!-- panel-body Finish -->

</div><!-- canel panel-default Finish -->

</div><!-- col-lg-12 Finish -->

</div><!-- row Finish -->

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>
<script src="js/tinymce/tinymce.min.js"></script>
<?php
if (isset($_POST['submit'])) {

$iD_promotion = $_POST['Promotion_Id'];
$iD_enseignant = $_POST['enseignant_Id'];
$iD_salle = $_POST['Salle_Id'];
$iD_module = $_POST['Module_Id'];
$jour = $_POST['Jour'];
$date_debut = $_POST['Timedebut'];
$date_fin = $_POST['Timefin'];
$coure= new Cours($iD_promotion,$iD_enseignant
,$iD_salle,$iD_module,$jour,$date_debut,$date_fin
);
$courObj->insert($coure);

}
?>