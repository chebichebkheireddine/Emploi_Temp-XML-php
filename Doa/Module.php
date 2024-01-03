<?php

interface ModuleDOAInterface
{
    public function getById($id_mod);
    public function getAll();
    public function insert(Module $module);
    public function update(Module $module);
    public function delete($id_mod);
}

class Module
{
    private $id_mod;
    private $nom_mod;
    private $description;

    public function __construct($nom_mod, $description)
    {
        $this->nom_mod = $nom_mod;
        $this->description = $description;
    }

    public function getIdMod()
    {
        return $this->id_mod;
    }

    public function setIdMod($id_mod)
    {
        $this->id_mod = $id_mod;
    }

    public function getNomMod()
    {
        return $this->nom_mod;
    }

    public function setNomMod($nom_mod)
    {
        $this->nom_mod = $nom_mod;
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

class ModuleDOA implements ModuleDOAInterface
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getById($id_mod)
    {
        $stmt = $this->connection->prepare("SELECT * FROM modules WHERE id_mod = :id_mod");
        $stmt->execute(array(':id_mod' => $id_mod));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $module = new Module($row['nom_mod'], $row['discription']);
        $module->setIdMod($row['id_mod']);

        return $module;
    }

    public function getAll()
    {
        $stmt = $this->connection->prepare("SELECT * FROM modules");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $modules = array();

        foreach ($rows as $row) {
            $module = new Module($row['nom_mod'], $row['discription']);
            $module->setIdMod($row['id_mod']);
            $modules[] = $module;
        }

        return $modules;
    }

    public function insert(Module $module)
    {
        $stmt = $this->connection->prepare("INSERT INTO modules (nom_mod, discription) VALUES (:nom_mod, :description)");
        $stmt->execute(array(
            ':nom_mod' => $module->getNomMod(),
            ':description' => $module->getDescription()
        ));

        $module->setIdMod($this->connection->lastInsertId());
    }

    public function update(Module $module)
    {
        $stmt = $this->connection->prepare("UPDATE modules SET nom_mod = :nom_mod, discription = :description WHERE id_mod = :id_mod");
        $stmt->execute(array(
            ':nom_mod' => $module->getNomMod(),
            ':description' => $module->getDescription(),
            ':id_mod' => $module->getIdMod()
        ));
    }

    public function delete($id_mod)
    {
        $stmt = $this->connection->prepare("DELETE FROM modules WHERE id_mod = :id_mod");
        $stmt->execute(array(':id_mod' => $id_mod));
    }
}
?>
