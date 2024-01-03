<?php

interface EnseignantDOAInterface
{
    public function getById($id_ens);
    public function getAll();
    public function insert(Enseignant $enseignant);
    public function update(Enseignant $enseignant);
    public function delete($id_ens);
}

class Enseignant
{
    private $id_ens;
    private $nom_ens;
    private $trl;

    public function __construct($nom_ens, $trl)
    {
        $this->nom_ens = $nom_ens;
        $this->trl = $trl;
    }

    public function getIdEns()
    {
        return $this->id_ens;
    }

    public function setIdEns($id_ens)
    {
        $this->id_ens = $id_ens;
    }

    public function getNomEns()
    {
        return $this->nom_ens;
    }

    public function setNomEns($nom_ens)
    {
        $this->nom_ens = $nom_ens;
    }

    public function getTrl()
    {
        return $this->trl;
    }

    public function setTrl($trl)
    {
        $this->trl = $trl;
    }
}

class EnseignantDOA implements EnseignantDOAInterface
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getById($id_ens)
    {
        $stmt = $this->connection->prepare("SELECT * FROM enseignant WHERE id_ens = :id_ens");
        $stmt->execute(array(':id_ens' => $id_ens));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $enseignant = new Enseignant($row['nom_ens'], $row['trl']);
        $enseignant->setIdEns($row['id_ens']);

        return $enseignant;
    }

    public function getAll()
    {
        $stmt = $this->connection->prepare("SELECT * FROM enseignant");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $enseignants = array();

        foreach ($rows as $row) {
            $enseignant = new Enseignant($row['nom_ens'], $row['trl']);
            $enseignant->setIdEns($row['id_ens']);
            $enseignants[] = $enseignant;
        }

        return $enseignants;
    }

    public function insert(Enseignant $enseignant)
    {
        $stmt = $this->connection->prepare("INSERT INTO enseignant (nom_ens, trl) VALUES (:nom_ens, :trl)");
        $stmt->execute(array(
            ':nom_ens' => $enseignant->getNomEns(),
            ':trl' => $enseignant->getTrl()
        ));

        $enseignant->setIdEns($this->connection->lastInsertId());
    }

    public function update(Enseignant $enseignant)
    {
        $stmt = $this->connection->prepare("UPDATE enseignant SET nom_ens = :nom_ens, trl = :trl WHERE id_ens = :id_ens");
        $stmt->execute(array(
            ':nom_ens' => $enseignant->getNomEns(),
            ':trl' => $enseignant->getTrl(),
            ':id_ens' => $enseignant->getIdEns()
        ));
    }

    public function delete($id_ens)
    {
        $stmt = $this->connection->prepare("DELETE FROM enseignant WHERE id_ens = :id_ens");
        $stmt->execute(array(':id_ens' => $id_ens));
    }
}
?>
