<?php

namespace App\Models;

use CodeIgniter\Model;

class MatiereModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'matiere';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'niveau','nom_matiere','enseignant','type'];

   
                           
    public function getMatieres()
    {
        return $this->findAll();
    }

    public function addMatiere($data)
    {
        return $this->insert($data);
    }
    public function updateMatiere($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteMatiere($id)
    {
        return $this->delete($id);
    }
}