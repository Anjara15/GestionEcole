<?php

namespace App\Controllers;

use App\Models\StudentModel;

class Students extends BaseController
{
    public function index()
    {
        // Charger le modèle
        $model = new StudentModel();

        // Récupérer la liste des étudiants
        $data['students'] = $model->findAll();

        // Charger la vue et passer les données
        return view('students/index', $data);
    }

    public function add()
    {
        return view('students/add');
    }
    
    public function create()
    {
        $model = new StudentModel();
    
        $data = [
            'nom' => $this->request->getPost('nom'),
            'email' => $this->request->getPost('email'),
            'age' => $this->request->getPost('age'),
            'filiere' => $this->request->getPost('filiere'),
        ];
    
        $model->insert($data);
    
        return redirect()->to(site_url('students'));
    }

    public function update($id)
    {
        $model = new StudentModel();
    
        $data = [
            'nom' => $this->request->getPost('nom'),
            'email' => $this->request->getPost('email'),
            'age' => $this->request->getPost('age'),
            'filiere' => $this->request->getPost('filiere'),
        ];
    
        $model->update($id, $data);
    
        return redirect()->to(site_url('students'));
    }
    
    public function edit($id)
    {
        $model = new StudentModel();
    
        $data['student'] = $model->find($id);
    
        return view('students/edit', $data);
    }

    public function delete($id)
    {
        $model = new StudentModel();

        $model->delete($id);

        return redirect()->to('/students');
    }
}