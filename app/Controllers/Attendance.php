<?php namespace App\Controllers;

use App\Models\AttendanceModel;

class Attendance extends BaseController
{
    protected $attendanceModel;

    function __construct()
    {
        $this->attendanceModel = new AttendanceModel();
    }

    public function index($journal_id)
    {   
        $data = [
            'title' => 'Kehadiran',
            'journal' => $this->journalModel->get_journal_detail($journal_id),
            'students' => $this->attendanceModel->get_attendace($journal_id)
        ];
        return view('attendance/index', $data);
    }

    public function save()
    {
       $data = [
        'id' => $this->request->getPost('id'),
        'present' => $this->request->getPost('present')
       ];

       $this->attendanceModel->save($data);
    }
}
