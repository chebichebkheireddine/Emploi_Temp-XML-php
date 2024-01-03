<?php

interface PromotionDOAInterface
{
    public function getById($id_promo);
    public function getAll();
    public function getPromotionsWithSpecialites() ;
    public function insert(Promotion $promotion);
    public function update(Promotion $promotion);
    public function delete($id_promo);
}

class Promotion
{
    private $id_promo;
    private $id_speci;
    private $niveau;
    private $name_promo; // New property for promotion name

    public function __construct($id_speci, $niveau)
    {
        $this->id_speci = $id_speci;
        $this->niveau = $niveau;
    }

    public function getIdPromo()
    {
        return $this->id_promo;
    }

    public function setIdPromo($id_promo)
    {
        $this->id_promo = $id_promo;
    }

    public function getIdSpeci()
    {
        return $this->id_speci;
    }

    public function setIdSpeci($id_speci)
    {
        $this->id_speci = $id_speci;
    }

    public function getNiveau()
    {
        return $this->niveau;
    }

    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    }

    // Getter and Setter for name_promo
    public function getNamePromo()
    {
        return $this->name_promo;
    }

    public function setNamePromo($name_promo)
    {
        $this->name_promo = $name_promo;
    }
}


class PromotionDOA implements PromotionDOAInterface
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getById($id_promo)
    {
        $stmt = $this->connection->prepare("SELECT * FROM promotion WHERE id_promo = :id_promo");
        $stmt->execute(array(':id_promo' => $id_promo));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $promotion = new Promotion($row['id_speci'], $row['niveau']);
        $promotion->setIdPromo($row['id_promo']);

        return $promotion;
    }

    public function getAll()
    {
        $stmt = $this->connection->prepare("SELECT * FROM promotion");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $promotions = array();

        foreach ($rows as $row) {
            $promotion = new Promotion($row['id_speci'], $row['niveau']);
            $promotion->setIdPromo($row['id_promo']);
            $promotions[] = $promotion;
        }

        return $promotions;
    }
    public function getPromotionsWithSpecialites()
    {
        $stmt = $this->connection->prepare("
            SELECT 
                p.id_speci AS promotion_id,
                s.nom_speci AS specialite_nom,
                s.id_speci AS specialite_id,
                p.niveau,
                p.id_promo
            FROM 
                promotion p
            JOIN 
                specialite s ON p.id_speci = s.id_speci
        ");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $promotions = array();

        foreach ($rows as $row) {
            $promotion = new Promotion($row['id_speci'], $row['niveau']);
            $promotion->setIdPromo($row['id_promo']);

            // Additional properties from specialite table
            $promotion->specialite_nom = $row['specialite_nom'];
            $promotion->specialite_id = $row['specialite_id'];

            $promotions[] = $promotion;
        }

        return $promotions;
    }

    public function insert(Promotion $promotion)
    {
        $stmt = $this->connection->prepare("INSERT INTO promotion (id_speci, niveau) VALUES (:id_speci, :niveau)");
        $stmt->execute(array(
            ':id_speci' => $promotion->getIdSpeci(),
            ':niveau' => $promotion->getNiveau()
        ));

        $promotion->setIdPromo($this->connection->lastInsertId());
    }

    public function update(Promotion $promotion)
    {
        $stmt = $this->connection->prepare("UPDATE promotion SET id_speci = :id_speci, niveau = :niveau WHERE id_promo = :id_promo");
        $stmt->execute(array(
            ':id_speci' => $promotion->getIdSpeci(),
            ':niveau' => $promotion->getNiveau(),
            ':id_promo' => $promotion->getIdPromo()
        ));
    }

    public function delete($id_promo)
    {
        $stmt = $this->connection->prepare("DELETE FROM promotion WHERE id_promo = :id_promo");
        $stmt->execute(array(':id_promo' => $id_promo));
    }
}
?>
