<?php

namespace App\Controllers;

use App\Models\ScheduleModel;

class Schedule extends BaseController
{
    protected $scheduleModel;

    public function __construct()
    {
        $this->scheduleModel = new ScheduleModel();
    }

    public function index()
    {
        $data['schedules'] = $this->scheduleModel->findAll();
        return view('schedule/index', $data);
    }

    public function create()
    {
        return view('schedule/create');
    }

    public function store()
    {
        $data = $this->request->getPost();
        $this->scheduleModel->insert($data);
        return redirect()->to(base_url('schedule'));
    }
    
    public function update($id)
    {
        $model = new ScheduleModel();
    
        $data = [
            'event_name' => $this->request->getPost('event_name'),
            'date' => $this->request->getPost('date'),
            'start_time' => $this->request->getPost('start_time'),
            'end_time' => $this->request->getPost('end_time'),
        ];
    
        $model->update($id, $data);
    
        return redirect()->to(site_url('schedule'));
    }

    public function edit($id)
    {
        $model = new ScheduleModel();
    
        $data['schedules'] = $model->find($id);
    
        return view('schedule/edit', $data);
    }

    public function delete($id)
    {
        $model = new ScheduleModel();

        $model->delete($id);

        return redirect()->to('/schedule');
    }
}