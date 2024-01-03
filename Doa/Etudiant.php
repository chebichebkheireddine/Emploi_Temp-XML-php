<?php

interface EtudiantDOAInterface
{
    public function getById($num_etudiant);
    public function getAll();
    public function insert(Etudiant $etudiant);
    public function update(Etudiant $etudiant);
    public function delete($num_etudiant);
}

class Etudiant
{
    private $num_etudiant;
    private $nom;
    private $prenom;
    private $adresse;

    public function __construct($nom, $prenom, $adresse)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
    }

    public function getNumEtudiant()
    {
        return $this->num_etudiant;
    }

    public function setNumEtudiant($num_etudiant)
    {
        $this->num_etudiant = $num_etudiant;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }
}

class EtudiantDOA implements EtudiantDOAInterface
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getById($num_etudiant)
    {
        $stmt = $this->connection->prepare("SELECT * FROM etudiant WHERE Num_etudiant = :num_etudiant");
        $stmt->execute(array(':num_etudiant' => $num_etudiant));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $etudiant = new Etudiant($row['nom'], $row['prenom'], $row['adresse']);
        $etudiant->setNumEtudiant($row['Num_etudiant']);

        return $etudiant;
    }

    public function getAll()
    {
        $stmt = $this->connection->prepare("SELECT * FROM etudiant");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $etudiants = array();

        foreach ($rows as $row) {
            $etudiant = new Etudiant($row['nom'], $row['prenom'], $row['adresse']);
            $etudiant->setNumEtudiant($row['Num_etudiant']);
            $etudiants[] = $etudiant;
        }

        return $etudiants;
    }

    public function insert(Etudiant $etudiant)
    {
        $stmt = $this->connection->prepare("INSERT INTO etudiant (nom, prenom, adresse) VALUES (:nom, :prenom, :adresse)");
        $stmt->execute(array(
            ':nom' => $etudiant->getNom(),
            ':prenom' => $etudiant->getPrenom(),
            ':adresse' => $etudiant->getAdresse()
        ));

        $etudiant->setNumEtudiant($this->connection->lastInsertId());
    }

    public function update(Etudiant $etudiant)
    {
        $stmt = $this->connection->prepare("UPDATE etudiant SET nom = :nom, prenom = :prenom, adresse = :adresse WHERE Num_etudiant = :num_etudiant");
        $stmt->execute(array(
            ':nom' => $etudiant->getNom(),
            ':prenom' => $etudiant->getPrenom(),
            ':adresse' => $etudiant->getAdresse(),
            ':num_etudiant' => $etudiant->getNumEtudiant()
        ));
    }

    public function delete($num_etudiant)
    {
        $stmt = $this->connection->prepare("DELETE FROM etudiant WHERE Num_etudiant = :num_etudiant");
        $stmt->execute(array(':num_etudiant' => $num_etudiant));
    }
}
?>
