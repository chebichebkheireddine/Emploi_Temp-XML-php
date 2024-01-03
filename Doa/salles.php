<?php

interface SalleDOAInterface
{
    public function getById($id_salle);
    public function getAll();
    public function insert(Salle $salle);
    public function update(Salle $salle);
    public function delete($id_salle);
}

class Salle
{
    private $id_salle;
    private $nom_salle;
    private $description;

    public function __construct($nom_salle, $description)
    {
        $this->nom_salle = $nom_salle;
        $this->description = $description;
    }

    public function getIdSalle()
    {
        return $this->id_salle;
    }

    public function setIdSalle($id_salle)
    {
        $this->id_salle = $id_salle;
    }

    public function getNomSalle()
    {
        return $this->nom_salle;
    }

    public function setNomSalle($nom_salle)
    {
        $this->nom_salle = $nom_salle;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}

class SalleDOA implements SalleDOAInterface
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getById($id_salle)
    {
        $stmt = $this->connection->prepare("SELECT * FROM salles WHERE id_salle = :id_salle");
        $stmt->execute(array(':id_salle' => $id_salle));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $salle = new Salle($row['nom_salle'], $row['discription']);
        $salle->setIdSalle($row['id_salle']);

        return $salle;
    }

    public function getAll()
    {
        $stmt = $this->connection->prepare("SELECT * FROM salles");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $salles = array();

        foreach ($rows as $row) {
            $salle = new Salle($row['nom_salle'], $row['discription']);
            $salle->setIdSalle($row['id_salle']);
            $salles[] = $salle;
        }

        return $salles;
    }

    public function insert(Salle $salle)
    {
        $stmt = $this->connection->prepare("INSERT INTO salles (nom_salle, discription) VALUES (:nom_salle, :description)");
        $stmt->execute(array(
            ':nom_salle' => $salle->getNomSalle(),
            ':description' => $salle->getDescription()
        ));

        $salle->setIdSalle($this->connection->lastInsertId());
    }

    public function update(Salle $salle)
    {
        $stmt = $this->connection->prepare("UPDATE salles SET nom_salle = :nom_salle, discription = :description WHERE id_salle = :id_salle");
        $stmt->execute(array(
            ':nom_salle' => $salle->getNomSalle(),
            ':description' => $salle->getDescription(),
            ':id_salle' => $salle->getIdSalle()
        ));
    }

    public function delete($id_salle)
    {
        $stmt = $this->connection->prepare("DELETE FROM salles WHERE id_salle = :id_salle");
        $stmt->execute(array(':id_salle' => $id_salle));
    }
}
?>
