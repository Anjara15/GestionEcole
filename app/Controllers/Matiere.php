<?php

namespace App\Controllers;

use App\Models\MatiereModel;

class Matiere extends BaseController {

    protected $matiereModel;

    public function __construct()
    {
        $this->matiereModel = new MatiereModel();
    }

    public function index()
    {
        $data['matieres'] = $this->matiereModel->getMatieres();
        return view('matieres/index', $data);
    }
    
    public function add()
    {
        return view('matieres/add');
    }

    public function store()
    {
        $data = [
            'niveau' => $this->request->getPost('niveau'),
            'nom_matiere' => $this->request->getPost('nom_matiere'),
            'enseignant' => $this->request->getPost('enseignant'),
            'type' => $this->request->getPost('type'),
        ];

        $this->matiereModel->addMatiere($data);

        return redirect()->to('/matieres')->with('success', 'Matière ajoutée avec succès.');
    }

    public function delete($id = null)
    {
        $matiere = $this->matiereModel->find($id);

        if (empty($matiere)) {
            return redirect()->to('/matieres')->with('error', 'Matière non trouvée.');
        }

        $this->matiereModel->deleteMatiere($id);

        return redirect()->to('/matieres')->with('success', 'Matière supprimée avec succès.');
    }

    public function update($id = null)
    {
        $data = [
            'niveau' => $this->request->getPost('niveau'),
            'nom_matiere' => $this->request->getPost('nom_matiere'),
            'enseignant' => $this->request->getPost('enseignant'),
            'type' => $this->request->getPost('type'),
        ];

        $this->matiereModel->updateMatiere($id, $data);

        return redirect()->to('/matieres')->with('success', 'Matière mise à jour avec succès.');
    }

    public function edit($id = null)
    {
        $data['matiere'] = $this->matiereModel->find($id);

        if (empty($data['matiere'])) {
            return redirect()->to('/matieres')->with('error', 'Matière non trouvée.');
        }

        return view('matieres/edit', $data);
    }

}