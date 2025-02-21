<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DashboardModel;

class Dashboard extends Controller
{
    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $model = new DashboardModel();

        $data = [
            'totalStudents'  => $model->getTotal('students'),
            'totalTeacher'  => $model->getTotal('teacher'),
            'totalMatieres'  => $model->getTotal('matiere'),
            'totalClassrooms' => $model->getTotal('classrooms'),
            'totalEvents'    => $model->getTotal('schedules'),
            
        ];

        return view('dashboard', $data);
    }
}
