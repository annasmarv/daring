<?php namespace App\Controllers;

use App\Models\SkpModel;
use App\Models\SkpbulanModel;
use App\Models\SkplistModel;
use App\Models\SkplistparentModel;
use App\Models\JournalModel;
use App\Models\Learn\PlanModel;
use App\Models\MonthModel;

class Skp extends BaseController
{
    // protected $skpbulanModel;

    function __construct()
    {
        $this->skpModel = new SkpModel();
        $this->skpbulanModel = new SkpbulanModel();
        $this->skplistModel = new SkplistModel();
        $this->skpparentModel = new SkplistparentModel();
        $this->jurnalModel = new JournalModel;
        $this->planModel = new PlanModel;
        $this->monthModel = new MonthModel;
    }

    public function index()
    {   
        $data = [
            'title' => 'Penilaian Sasaran Kerja Pegawai',
            'months' => $this->monthModel->get_month_learn(),
            'skp' => $this->skpModel->get_skp_list_user()
        ];
        return view('skp/index', $data);
    }

    public function create()
    {   
        $db      = \Config\Database::connect();

        $this->skpModel->save(['user_id' => user()->id, 'month_id' => $this->request->getPost('month_id')]);
        $skp_id = $this->skpModel->getInsertID();

        $result = array();
        for ($i=1; $i <=6 ; $i++) { 
            $result[] = [
                'skp_id' => $skp_id,
                'skp_list_id' => $i,
                'mutu' => 0,
                'nilai' => 0,
                'user_id' => user()->id
            ];
        }

        $builder = $db->table('tbl_skp_bulan');
        $builder->insertBatch($result);

        return redirect()->to(base_url('skp/detail/'.$skp_id));
    }

    public function detail($skp_id)
    {   
        
        $data = [
            'title' => 'Penilaian Sasaran Kerja Pegawai',
            'skpparent' => $this->skpparentModel->get_skp_categories(),
            'skps' => $this->skpbulanModel->get_skp_by_skp_id($skp_id)
        ];
        
        return view('skp/add', $data);
    }

    public function save($skp_id)
    {   
        if (null !== $this->request->getPost('save')) {
            $db = \Config\Database::connect();
            $id = $this->request->getPost('id');
            $mutu = $this->request->getPost('mutu');

            $result = array();
            foreach ($id as $key => $val) {
                $result[] = [
                    'id' => $id[$key],
                    'mutu' => $mutu[$key],
                    'nilai' => (100+$mutu[$key]+76)/3
                ];
            }
        $builder = $db->table('tbl_skp_bulan');
        $builder->updateBatch($result, 'id');
        }
        elseif (null !== $this->request->getPost('delete')) {
            $this->skpbulanModel->whereIn('id', $this->request->getPost('skpid'))->delete();
        }

        return redirect()->to(base_url('skp/detail/'.$skp_id));
    }
    // (100+NN+76)/3

    public function saves($skp_id)
    {   
        $type = $this->request->getPost('type');

        if ($type == 1) {
            $data = [
                'skp_id' => $skp_id,
                'skp_list_id' => $this->request->getPost('skp_list_id'),
                'pelaksanaan' => $this->request->getPost('pelaksanaan'),
                'ketercapaian' => $this->request->getPost('ketercapaian'),
                'target' => 1,
                'realisasi' => 1,
                'mutu' => 0,
                'nilai' => 0,
                'user_id' => user()->id
            ];
        }else{
            if (!$this->validate([
                'file_upload' => [
                    'rules' => 'max_size[file_upload,5120]|mime_in[file_upload,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                    'errors' => [
                        'max_size' => 'Ukuran terlalu besar',
                        'mime_in' => 'File anda tidak sesuai'
                    ]
                ]
            ])) {
                return redirect()->to($this->request->getPost('uri'))->withInput();
            }

            $file_upload = $this->request->getFile('file_upload');

            $file_name = $file_upload->getRandomName();
            $dir = 'upload/skp/laporan/';
            $file_upload->move($dir, $file_name);

            $data = [
                'skp_id' => $skp_id,
                'skp_list_id' => $this->request->getPost('skp_list_id'),
                'laporan' => $file_name,
                'target' => 1,
                'realisasi' => 1,
                'mutu' => 0,
                'nilai' => 0,
                'user_id' => user()->id
            ];
        }

        $this->skpbulanModel->save($data);
        return redirect()->to(base_url('skp/detail/'.$skp_id));
    }

    public function reload($skp_id)
    {   
        $month = $this->skpModel->get_skp_list_user($skp_id);
        $monthx = explode(',', $month['weeks_id']);
        $skp1 = $this->planModel->count_for_skp($monthx);
        $skp2 = $this->jurnalModel->count_jp_journal_skp($monthx);

        $this->skpbulanModel->where(['skp_id' => $skp_id, 'user_id' => user()->id, 'skp_list_id' => 1])->set(['realisasi' => $skp1, 'nilai' => 0])->update();
        $this->skpbulanModel->where(['skp_id' => $skp_id, 'user_id' => user()->id, 'skp_list_id' => 2])->set(['realisasi' => $skp2, 'nilai' => 0])->update();

        return redirect()->to(base_url('skp/detail/'.$skp_id));
    }

    public function target()
    {   
        $db      = \Config\Database::connect();
        $id = $this->request->getPost('id');
        $target = $this->request->getPost('target');

        $result = array();
        foreach ($id as $key => $val) {
            $result[] = [
                'id' => $id[$key],
                'target' => $target[$key]
            ];
        }

        $builder = $db->table('tbl_skp_bulan');
        $builder->updateBatch($result, 'id');

        return redirect()->to(base_url($this->request->getPost('uri')));
    }

    public function get_skp_kegiatan()
    {
        $postData = [
            'id' => $this->request->getVar('type_id')
        ];

        $data = $this->skplistModel->get_skp_list($postData);

        echo json_encode($data);
    }

    public function print($skp_id)
    {
        $count = $this->skpbulanModel->count_skp_by_id($skp_id);
        $data = [
            'title' => 'Penilaian Sasaran Kinerja Pegawai',
            'data' => $this->skpModel->get_skp_list_user($skp_id),
            'skps' => $this->skpbulanModel->get_skp_by_skp_id($skp_id),
            'count' => $count['id']    
        ];

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('skp/pdf', $data));
        // $dompdf->setPaper('A4', 'potrait');
        $dompdf->setPaper(array(0,0,609.4488,935.433), 'potrait');
        $dompdf->render();
        $dompdf->stream('document.pdf', array('Attachment' => false));
    }

    public function add($id)
    {   
        $postData = [
            'id' => $_GET['type']
        ];
        $data = [
            'title' => 'Penilaian Sasaran Kerja Pegawai',
            'lists' => $this->skplistModel->get_skp_list($postData)
        ];
        
        return view('skp/addk', $data);
    }
}
