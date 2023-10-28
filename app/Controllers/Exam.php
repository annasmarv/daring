<?php namespace App\Controllers;
use App\Controllers\BaseController;
use Irsyadulibad\DataTables\DataTables;
use App\Models\QuestbankModel;
use App\Models\QuestModel;
use App\Models\TasksModel;
use App\Models\JointaskModel;
use App\Models\AnswerModel;
use App\Models\Data\SubjectModel;

class Exam extends BaseController
{
    public function __construct()
    {
        $this->questModel = new QuestModel();
        $this->taskModel = new TasksModel();
        $this->jointaskModel = new JointaskModel();
        $this->answerModel = new AnswerModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
    date_default_timezone_set('Asia/Jakarta');

        $uri = service('uri');
        $id = $uri->getSegment(2);
        $user = user()->id;
        $qna = $this->answerModel->select('mpd_answer.*, mpd_answer.id as asid, tbl_quest.question, tbl_quest.answer1, tbl_quest.answer2, tbl_quest.answer3, tbl_quest.answer4, tbl_quest.answer5, tbl_quest.type, tbl_quest_bank.quest_option, tbl_quest.quest_keys')
                                ->join('mpd_task', 'mpd_task.id = mpd_answer.task_id')
                                ->join('tbl_quest_bank', 'tbl_quest_bank.id = mpd_task.quest_bank_id')
                                ->join('tbl_quest', ('tbl_quest.quest_bank_id = mpd_task.quest_bank_id and tbl_quest.number = mpd_answer.number'))
                                ->where(['mpd_answer.task_id' => $id ,'mpd_task.task_status' => '1', 'mpd_answer.user_id' => $user])
                                ->orderBy('mpd_answer.number', 'ASC');
        $data = [
            'title' => 'Mengerjakan Soal',
            'qna' => $qna->paginate(1 ,'qna'),
            'pager' => $this->answerModel->pager
        ];

        return view('student/exam', $data);
    }

    public function start()
    {
    date_default_timezone_set('Asia/Jakarta');
        
        $task_id = $this->request->getPost('task_id');
        $limit = $this->request->getPost('limit');
        $user_id = user()->id;

        $query_tes = $this->taskModel->get_by_kolom_limit('id', $task_id, 1);
        
        if ($query_tes->getRow()->id>0) {
            $query_tes = $query_tes->getRow();
            // Cek apakah tes sudah pernah dilakukan
          
            if($this->jointaskModel->count_by_user_tes($user_id, $task_id)->getRow()->id==0){
                $is_ok = 1;
                if($is_ok==1){
                    $this->db->transStart();

                    // 1. Memasukkan data ke test_user
                    $data_tes['task_id'] = $task_id;
                    $data_tes['user_id'] = $user_id;
                    $data_tes['status'] = 1;
                    $data_tes['chance'] = 0;
                    $data_tes['date'] = date('Y-m-d');
                    $data_tes['date_task'] = date('Y-m-d H:i:s');

                    $tests_users_id = $this->jointaskModel->save($data_tes);
                    $i_soal = 0;
                    // Mendapatkan Soal berdasarkan Kode Bank Soal
                    $query_soal = $this->questModel->get_quest_limit($query_tes->quest_bank_id,$query_tes->quest_total);
                    date_default_timezone_set('Asia/Jakarta');
                    if($query_soal>0){
                        $query_soal = $query_soal;
                        $insert_soal = array();
                        foreach ($query_soal as $soal) {
                            // Memasukkan data soal ke table 
                            $data_soal['sort'] = ++$i_soal;
                            $data_soal['number'] = $soal['number'];
                            $data_soal['point'] = $soal['point'];
                            $data_soal['task_id'] = $task_id;
                            $data_soal['quest_type'] = $soal['type'];
                            $data_soal['answer_date'] = date('Y-m-d H:i:s');
                            $data_soal['answer_key'] = $soal['quest_keys'];
                            $data_soal['user_id'] = $user_id;
                            $insert_soal[] = $data_soal;
                        }

                        // menggunakan batch query langsung untuk mengehemat waktu dan memory
                        $this->answerModel->save_batch($insert_soal);
                    }
                    $this->db->transComplete();
                }
            }
            $is_ok = 0;
            if ($is_ok == 0) {
                $cekid = $this->jointaskModel->get_id_join_task($user_id,$task_id)->getRow()->id;
                $chance = $this->jointaskModel->get_id_join_task($user_id,$task_id)->getRow()->chance;
                $data = [
                    'id' => $cekid,
                    'chance' => $chance+1
                    
                ];
                $this->jointaskModel->save($data);
            }
        }
        return redirect()->to(base_url('exam/'.$task_id));
    }

    public function save()
    {
        $user  = user()->id;
        $id = $this->request->getPost('id');
        $jwb = $this->request->getPost('jwb');
        $kunci = $this->request->getPost('id_user');
        // if ($jwb == $kunci) {
            $poin = $this->request->getPost('point');
        // }
        // $poin = '';
        $task_id = $this->request->getPost('task_id');
        $sort = $this->request->getPost('sort');
        if ($jwb == $kunci) {
        $data = [
            'id' => $id,
            'XJawaban' => $this->request->getPost('jwb'),
            'XNilai' => $poin,
            'XJawabanEssai' => $this->request->getPost('jwb2')
        ];
        }else{
            $data = [
            'id' => $id,
            'XJawaban' => $this->request->getPost('jwb'),
            'XNilai' => 0,
            'XJawabanEssai' => $this->request->getPost('jwb2')
        ];
        }

        $this->answerModel->save($data);
        return redirect()->to(base_url('exam/'.$task_id.'?page_qna='.$sort));
    }
    public function get_soal($task_id=null, $user_id=null){
        $data['tes_soal_id'] = '';
        $data['tes_soal'] = '';
        $data['data'] = 0;
        if(!empty($tessoal_id) AND !empty($tesuser_id)){

            $waktuuser = date('Y-m-d H:i:s');
            if($this->cbt_tes_user_model->count_by_status_waktuuser($tesuser_id, $waktuuser)->row()->hasil>0){
                $data['data'] = 1;
                $query_soal = $this->cbt_tes_soal_model->get_by_tessoal_limit($tessoal_id, 1);
                $soal = '';
                if($query_soal->num_rows()>0){
                    $data['tes_soal_id'] = $tessoal_id;

                    $query_soal = $query_soal->row();

                    // Soal Ragu-ragu
                    $data['tes_ragu'] = $query_soal->tessoal_ragu;

                    // Mengupdate tessoal_display_time pada table test_log
                    $data_tes_soal['tessoal_display_time'] = date('Y-m-d H:i:s');
                    $this->cbt_tes_soal_model->update('tessoal_id', $tessoal_id, $data_tes_soal);
                    
                    // mengganti [baseurl] ke alamat sesungguhnya
                    $soal = $query_soal->soal_detail;
                    $soal = str_replace("[base_url]", base_url(), $soal);

                    $soal = $soal.'<hr />';

                    $data['tes_soal_nomor'] = $query_soal->tessoal_order;

                    $soal = $soal.'<div class="form-group">';
                    if($query_soal->soal_tipe==1){
                        $query_jawaban = $this->cbt_tes_soal_jawaban_model->get_by_tessoal($query_soal->tessoal_id);
                        if($query_jawaban->num_rows()>0){
                            $query_jawaban = $query_jawaban->result();
                            foreach ($query_jawaban as $jawaban) {
                                // mengganti [baseurl] ke alamat sesungguhnya pada tag img / gambars
                                $temp_jawaban = $jawaban->jawaban_detail;
                                $temp_jawaban = str_replace("[base_url]", base_url(), $temp_jawaban);

                                if($jawaban->soaljawaban_selected==1){
                                    $soal = $soal.'<div class="radio"><label><input type="radio" onchange="jawab()" name="soal-jawaban" value="'.$jawaban->soaljawaban_jawaban_id.'" checked> '.$temp_jawaban.'</label></div>';
                                }else{
                                    $soal = $soal.'<div class="radio"><label><input type="radio" onchange="jawab()" name="soal-jawaban" value="'.$jawaban->soaljawaban_jawaban_id.'" > '.$temp_jawaban.'</label></div>';
                                }
                            }
                        }
                    }else if($query_soal->soal_tipe==2){
                        if(!empty($query_soal->tessoal_jawaban_text)){
                            $soal = $soal.'<textarea class="textarea" id="soal-jawaban" name="soal-jawaban" style="width: 100%; height: 150px; font-size: 13px; line-height: 25px; border: 1px solid #dddddd; padding: 10px;">'.$query_soal->tessoal_jawaban_text.'</textarea>
                                <button type="button" onclick="jawab()" class="btn btn-default" style="margin-bottom: 5px;" title="Simpan Jawaban">Simpan Jawaban</button>
                                ';
                        }else{
                            $soal = $soal.'<textarea class="textarea" id="soal-jawaban" name="soal-jawaban" style="width: 100%; height: 150px; font-size: 13px; line-height: 25px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                <button type="button" onclick="jawab()" class="btn btn-default" style="margin-bottom: 5px;" title="Simpan Jawaban">Simpan Jawaban</button>
                                ';
                        }
                    }else if($query_soal->soal_tipe==3){
                        if(!empty($query_soal->tessoal_jawaban_text)){
                            $soal = $soal.'
                                <input type="text" class="form-control" style="max-width: 500px;" id="soal-jawaban" name="soal-jawaban" value="'.$query_soal->tessoal_jawaban_text.'" autocomplete="off" />
                                <br />
                                <button type="button" onclick="jawab()" class="btn btn-default" style="margin-bottom: 5px;" title="Simpan Jawaban">Simpan Jawaban</button>
                                ';
                        }else{
                            $soal = $soal.'
                                <input type="text" class="form-control" style="max-width: 500px;" id="soal-jawaban" name="soal-jawaban" autocomplete="off" />
                                <br />
                                <button type="button" onclick="jawab()" class="btn btn-default" style="margin-bottom: 5px;" title="Simpan Jawaban">Simpan Jawaban</button>
                                ';
                        }
                    }
                    $soal = $soal.'</div>';

                    $data['tes_soal'] = $soal;
                }
            }else{
                $data['data'] = 2;
            }
        }

        return $data;
    }

    //--------------------------------------------------------------------

}