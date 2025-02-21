<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'teacher';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nom', 'contact', 'email', 'intervenant', 'statut_paiement'];

    public function getTeachers()
    {
        return $this->findAll();
    }

    public function addTeacher($data)
    {
        return $this->insert($data);
    }

    public function updateTeacher($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteTeacher($id)
    {
        return $this->delete($id);
    }
}