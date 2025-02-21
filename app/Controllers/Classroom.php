<?php

namespace App\Controllers;

use App\Models\ClassroomModel;

class Classroom extends BaseController {

    protected $ClassroomModel;

    public function __construct()
    {
        $this->ClassroomModel = new ClassroomModel();
    }

    public function index()
    {
        $data['classrooms'] = $this->ClassroomModel->getClassroom();
        return view('classroom/index', $data);
    }

   


    public function add()
    {
        return view('classroom/add');
    }
    
    public function store()
    {
        $model = new ClassroomModel();
    
        $data = [
            'nom' => $this->request->getPost('nom'),
            'type' => $this->request->getPost('type'),
            'capacity' => $this->request->getPost('capacity'),
        ];
    
       
        $model->insert($data);
    
        return redirect()->to(site_url('classroom'));
    
    }
    
    public function update($id)
    {
        $model = new ClassroomModel();
    
        $data = [
            'nom' => $this->request->getPost('nom'),
            'type' => $this->request->getPost('type'),
            'capacity' => $this->request->getPost('capacity'),
        ];
    
        $model->update($id, $data);
    
        return redirect()->to(site_url('classroom'));
    }

    public function edit($id)
    {
        $model = new ClassroomModel();
    
        $data['classrooms'] = $model->find($id);
    
        return view('classroom/edit', $data);
    }
    
    public function delete($id = null)
    {
        $this->ClassroomModel->deleteClassroom($id);
        return redirect()->to('/classroom');
    }
}