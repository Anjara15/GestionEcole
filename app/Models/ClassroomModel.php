<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassroomModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'classrooms';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nom','type','capacity'];

    public function getClassroom()
    {
        return $this->findAll();
    }
    public function addClassroom($data)
    {
        return $this->insert($data);
    }
    public function updateClassroom($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteClassroom($id)
    {
        return $this->delete($id);
    }
}


