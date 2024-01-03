<?php

interface SpecialiteDOAInterface
{
    public function getById($id_speci);
    public function getAll();
    public function insert(Specialite $specialite);
    public function update(Specialite $specialite);
    public function delete($id_speci);
}

class Specialite
{
    private $id_speci;
    private $nom_speci;
    private $description;

    public function __construct($nom_speci, $description)
    {
        $this->nom_speci = $nom_speci;
        $this->description = $description;
    }

    public function getIdSpeci()
    {
        return $this->id_speci;
    }

    public function setIdSpeci($id_speci)
    {
        $this->id_speci = $id_speci;
    }

    public function getNomSpeci()
    {
        return $this->nom_speci;
    }

    public function setNomSpeci($nom_speci)
    {
        $this->nom_speci = $nom_speci;
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

class SpecialiteDOA implements SpecialiteDOAInterface
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getById($id_speci)
    {
        $stmt = $this->connection->prepare("SELECT * FROM specialite WHERE id_speci = :id_speci");
        $stmt->execute(array(':id_speci' => $id_speci));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $specialite = new Specialite($row['nom_speci'], $row['discription']);
        $specialite->setIdSpeci($row['id_speci']);

        return $specialite;
    }

    public function getAll()
    {
        $stmt = $this->connection->prepare("SELECT * FROM specialite");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $specialites = array();

        foreach ($rows as $row) {
            $specialite = new Specialite($row['nom_speci'], $row['discription']);
            $specialite->setIdSpeci($row['id_speci']);
            $specialites[] = $specialite;
        }

        return $specialites;
    }

    public function insert(Specialite $specialite)
    {
        $stmt = $this->connection->prepare("INSERT INTO specialite (nom_speci, discription) VALUES (:nom_speci, :description)");
        $stmt->execute(array(
            ':nom_speci' => $specialite->getNomSpeci(),
            ':description' => $specialite->getDescription()
        ));

        $specialite->setIdSpeci($this->connection->lastInsertId());
    }

    public function update(Specialite $specialite)
    {
        $stmt = $this->connection->prepare("UPDATE specialite SET nom_speci = :nom_speci, discription = :description WHERE id_speci = :id_speci");
        $stmt->execute(array(
            ':nom_speci' => $specialite->getNomSpeci(),
            ':description' => $specialite->getDescription(),
            ':id_speci' => $specialite->getIdSpeci()
        ));
    }

    public function delete($id_speci)
    {
        $stmt = $this->connection->prepare("DELETE FROM specialite WHERE id_speci = :id_speci");
        $stmt->execute(array(':id_speci' => $id_speci));
    }
}
?>
