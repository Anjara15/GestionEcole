<?php
namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getTotal($table, $column = '*')
    {
        $query = $this->db->query("SELECT COUNT($column) as total FROM $table");
        return $query->getRow()->total;
    }

    public function getSum($table, $column)
    {
        $query = $this->db->query("SELECT SUM($column) as total FROM $table");
        return $query->getRow()->total ?? 0;
    }
}
