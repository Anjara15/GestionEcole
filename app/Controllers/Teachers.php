<?php

namespace App\Controllers;

use App\Models\TeacherModel;

class Teachers extends BaseController {

    protected $teacherModel;

    public function __construct()
    {
        $this->teacherModel = new TeacherModel();
    }

    public function index()
    {
        $data['teachers'] = $this->teacherModel->getTeachers();
        return view('teachers/index', $data);
    }

    public function add()
    {
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $this->teacherModel->addTeacher($data);
            return redirect()->to('/teachers');
        }
        return view('teachers/add');
    }

    public function create()
    {
        $model = new TeacherModel();
    
        $data = [
            'nom' => $this->request->getPost('nom'),
            'contact' => $this->request->getPost('contact'),
            'email' => $this->request->getPost('email'),
            'intervenant' => $this->request->getPost('intervenant'),
            'statut_paiement' => $this->request->getPost('statut_paiement'),
        ];
    
       
        $model->insert($data);
    
        return redirect()->to(site_url('teachers'));
    }

    public function update($id = null)
    {
        if (!$id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('ID non spécifié');
        }

        $model = new TeacherModel();

        $data = [
            'nom' => $this->request->getPost('nom'),
            'contact' => $this->request->getPost('contact'),
            'email' => $this->request->getPost('email'),
            'intervenant' => $this->request->getPost('intervenant'),
            'statut_paiement' => $this->request->getPost('statut_paiement'),
        ];

        if ($model->update($id, $data)) {
            return redirect()->to(site_url('teachers'))->with('success', 'Professeur mis à jour avec succès');
        } else {
            return redirect()->back()->with('error', 'Échec de la mise à jour du professeur');
        }
    }

    public function edit($id = null)
    {
        $model = new TeacherModel();
        

        if ($this->request->getMethod() === 'post') {
           
            $data = $this->request->getPost();
            $this->teacherModel->update($id, $data);
            return redirect()->to('/teachers')->with('success', 'Professeur mis à jour avec succès');
        }

        
        $teacher = $model->find($id);
        if (!$teacher) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Professeur introuvable');
        }
        $data['teacher'] =  $model->find($id);
        return view('teachers/edit', $data);
    }

    public function delete($id = null)
    {
        $this->teacherModel->deleteTeacher($id);
        return redirect()->to('/teachers');
    }
}
