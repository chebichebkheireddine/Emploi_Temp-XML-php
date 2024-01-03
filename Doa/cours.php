 <?php 

interface coursDOAintrfa
{

    public function getById($id_cours);
    public function getAll();
    public function getAllLimt();
    public function insert(Cours $cours);
    public function update(Cours $cours);
    public function delet($id_cours);

}
 class Cours {
    private $id;
    private $id_promo;
    private $id_ens;
    private $id_salle;
    private $id_mod;
    private $jour;
    private $heure_debut;
    private $heure_fin;

    public function __construct( $id_promo, $id_ens, $id_salle, $id_mod, $jour, $heure_debut, $heure_fin) {
        
        $this->id_promo = $id_promo;
        $this->id_ens = $id_ens;
        $this->id_salle = $id_salle;
        $this->id_mod = $id_mod;
        $this->jour = $jour;
        $this->heure_debut = $heure_debut;
        $this->heure_fin = $heure_fin;
    }

    // Getters and setters for the properties
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdPromo() {
        return $this->id_promo;
    }

    public function setIdPromo($id_promo) {
        $this->id_promo = $id_promo;
    }

    public function getIdEns() {
        return $this->id_ens;
    }

    public function setIdEns($id_ens) {
        $this->id_ens = $id_ens;
    }

    public function getIdSalle() {
        return $this->id_salle;
    }

    public function setIdSalle($id_salle) {
        $this->id_salle = $id_salle;
    }

    public function getIdMod() {
        return $this->id_mod;
    }

    public function setIdMod($id_mod) {
        $this->id_mod = $id_mod;
    }

    public function getJour() {
        return $this->jour;
    }

    public function setJour($jour) {
        $this->jour = $jour;
    }

    public function getHeureDebut() {
        return $this->heure_debut;
    }

    public function setHeureDebut($heure_debut) {
        $this->heure_debut = $heure_debut;
    }

    public function getHeureFin() {
        return $this->heure_fin;
    }

    public function setHeureFin($heure_fin) {
        $this->heure_fin = $heure_fin;
    }
}

class CoursDOA  implements coursDOAintrfa {
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
  


    public function getById($id_cours)
    {

        $stmt = $this->connection->prepare("SELECT * FROM cours WHERE id_cours=:id_cours");

        $stmt->execute(array(':id_cours' => $id_cours));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $cours = new Cours(
            $row['id_promo'], $row['id_ens'],$row['id_salle '],$row['id_mod '],
            $row['jour'], $row['heure_debut'], $row['heure_fin'],
            );
        $cours->setId($row['id_cours']);

        return $cours;

    }


    public function getAll()
    {
        $stmt = $this->connection->prepare("SELECT * FROM cours");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $courses = array();
        foreach ($rows as $row) {
            $cours = new Cours(
                $row['id_promo'], $row['id_ens'],$row['id_salle '],$row['id_mod '],
            $row['jour'], $row['heure_debut'], $row['heure_fin']
            );
        
            $cours->setId($row['id_product']);
            $courses[] = $cours;
        }
        return $courses;
    }
    public function getAllLimt()
    {
        $stmt = $this->connection->prepare("SELECT * FROM cours LIMIT 6");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $Coursrs = array();
        foreach ($rows as $row) {
            $cours = new Cours(
                $row['id_promo'], $row['id_ens'],$row['id_salle '],$row['id_mod '],
            $row['jour'], $row['heure_debut'], $row['heure_fin'],
            );
        
            $cours->setId($row['id_cours']);
            $Coursrs[] = $cours;
        }
        return $Coursrs;
    }
    

    public function insert(Cours $cours)
    {
        $stmt = $this->connection->prepare("INSERT INTO cours (id_promo, id_ens, id_salle, id_mod, jour, heure_debut, heure_fin) VALUES (:id_promo, :id_ens, :id_salle, :id_mod, :jour, :heure_debut, :heure_fin)");
        $stmt->execute(array(
            ':id_promo' => $cours->getIdPromo(),
            ':id_ens' => $cours->getIdEns(),
            ':id_salle' => $cours->getIdSalle(),
            ':id_mod' => $cours->getIdMod(),
            ':jour' => $cours->getJour(),
            ':heure_debut' => $cours->getHeureDebut(),
            ':heure_fin' => $cours->getHeureFin()
        ));

        $cours->setId($this->connection->lastInsertId());
    }

    public function update(Cours $cours)
    {
        $stmt = $this->connection->prepare("UPDATE cours
        SET id_promo = :id_promo,
            id_ens = :id_ens,
            id_salle = :id_salle,
            id_mod = :id_mod,
            jour = :jour,
            heure_debut = :heure_debut,
            heure_fin = :heure_fin
        WHERE id_cours = :id_cours");
    
        $stmt->execute(array(
            ':id_promo' => $cours->getIdPromo(),
            ':id_ens' => $cours->getIdEns(),
            ':id_salle' => $cours->getIdSalle(),
            ':id_mod' => $cours->getIdMod(),
            ':jour' => $cours->getJour(),
            ':heure_debut' => $cours->getHeureDebut(),
            ':heure_fin' => $cours->getHeureFin(),
            ':id_cours' => $cours->getId()
        ));
    }
    
    public function delet($id_cours)
    {
        $stmt = $this->connection->prepare("DELETE FROM cours WHERE id_cours = :id_cours");
        $stmt->execute(array(':id_cours' => $id_cours));
    }
    
    
}
?>
