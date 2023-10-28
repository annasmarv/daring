<?php namespace App\Controllers;

use App\Models\Data\StudentModel;
use App\Models\Attitude\AttitudedescModel;
use App\Models\Attitude\AttitudeModel;

class Attitude extends BaseController
{
    protected $attitudedescModel, $attitudeModel;

    function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->attitudedescModel = new AttitudedescModel();
        $this->attitudeModel = new AttitudeModel();
    }

    public function index()
    {   
        $data = [
            'title' => 'Penilaian Sikap',
            'attitudes' => $this->attitudedescModel->get_attitude_description(),
            'students' => $this->studentModel->get_student()
        ];

        return view('attitude/add', $data);
    }

    public function history()
    {   
        $data = [
            'title' => 'Penilaian Sikap',
            'list' => $this->attitudeModel->get_attitude()
        ];

        return view('attitude/history', $data);
    }

    public function lists()
    {   
        $data = [
            'title' => 'Penilaian Sikap',
            'list' => $this->attitudeModel->get_attitude_student()
        ];

        return view('attitude/lists', $data);
    }

    public function create()
    {
        $point = explode("|", $this->request->getPost('attdesc_id'));
        $point_id = $point[0];
        $pointvalue = $point[1];
        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'attdesc_id' => $point_id,
            'poin' => $pointvalue,
            'teacher_id' => user()->id,
            'periodyear' => period()->id
        ];

        $this->attitudeModel->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        session()->setFlashdata('type', 'success');
        return redirect()->to(base_url('attitude'));
    }

    public function save()
    {
       $data = [
        'id' => $this->request->getPost('id'),
        'present' => $this->request->getPost('present')
       ];

       $this->attitudeModel->save($data);
    }

    public function delete()
    {
        $data = [
            'id' => $this->request->getPost('id'),
        ];

        $this->attitudeModel->delete($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        session()->setFlashdata('type', 'success');
        return redirect()->to(base_url('attitude/history'));
    }

    public function student($user_id)
    {
        $data = [
            'title' => 'Penilaian Sikap',
            'list' => $this->attitudeModel->get_attitude_student_history($user_id),
            'sum' => $this->attitudeModel->get_sum_point_student($user_id)['total_poin']
        ];
   
        return view('attitude/student', $data);
    }
}
