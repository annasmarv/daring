<?php namespace App\Controllers\Learn;

use App\Controllers\BaseController;
use App\Models\ScheduleModel;
use App\Models\JournalModel;
use App\Models\AttendanceModel;
use App\Models\ClassesModel;
use App\Models\Data\StudentModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Presence extends BaseController
{
    protected $scheduleModel, $journalModel, $studentModel, $attendanceModel;

    function __construct()
    {
        $this->scheduleModel = new ScheduleModel();
        $this->journalModel = new JournalModel();
        $this->studentModel = new StudentModel();
        $this->attendanceModel = new AttendanceModel();
        $this->relationModel = new ClassesModel();
    }

    public function index()
    {   
        $getData = [
            'rel' => $this->request->getGet('rel'),
            'month' => $this->request->getGet('month')
        ];
        
        $data = [
            'title' => 'Rekap Absensi',
            // 'rel' => $this->relationModel->get_relation_user(),
            'th' => $this->journalModel->get_recap_journal($getData),
            'students' => $this->studentModel->get_student_class($getData['rel'])
        ];

        return view('presence/index', $data);
    }

    public function save()
    {
       $data = [
        'id' => $this->request->getPost('id'),
        'present' => $this->request->getPost('present')
       ];

       $this->attendanceModel->save($data);
    }

    public function export()
    {
        $db = db_connect();
        $getData = [
            'rel' => $this->request->getGet('rel'),
            'month' => $this->request->getGet('month')
        ];

        $rel = $this->relationModel->get_relation_detail($getData['rel']);
        $th = $this->journalModel->get_recap_journal($getData);
        $student = $this->studentModel->get_student_class($rel['class_group_id']);
    
        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $kolom = 3;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama');
            foreach ($th as $x) {
                        $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValueByColumnAndRow($kolom, 1, $x['teach_date']); 
                        
                        $kolom++;
                    }

        $column = 2;
        // tulis data mobil ke cell
        $no = 1;
        foreach ($student as $data) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no++)
                ->setCellValue('B' . $column, $data['fullname']);
                $kolomx = 3;
                $row = 2;
                foreach ($th as $w) {
                    $query2 = $db->query("SELECT `tbl_attendance`.`id` as `attendance_id`, `tbl_attendance`.`journal_id`, `tbl_attendance`.`present`, `tbl_attendance`.`description`, `users`.`fullname` FROM `tbl_attendance` LEFT JOIN `tbl_journal` ON `tbl_journal`.`id` = `tbl_attendance`.`journal_id` LEFT JOIN `users` ON `users`.`id` = `tbl_attendance`.`user_id` WHERE `tbl_attendance`.`journal_id` = '$w[journal_id]' AND `tbl_attendance`.`user_id` = '$data[id]'");
                    $result2 = $query2->getResultArray();
                    // $jawaban = $this->jawabanModel->get_answer_essay_by_task($id,$data['user_id']);
                    foreach ($result2 as $y) {
                        if ($y['present'] == 'H') {
                                $knc = 'Hadir';
                            }elseif ($y['present'] == 'I') {
                                $knc = 'Izin';
                            }elseif ($y['present'] == 'S') {
                                $knc = 'Sakit';
                            }elseif ($y['present'] == 'A') {
                                $knc = 'Alpha';
                            }else{
                                $knc = '';
                            }

                        $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValueByColumnAndRow($kolomx, $column, $knc);
                    $kolomx++;
                    }
                    
            $column++;
            }
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap Nilai';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
