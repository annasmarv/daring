<?php namespace App\Controllers\Setting;

use App\Controllers\BaseController;
use App\Models\Myth\Mythusers;
use App\Models\Myth\Mythgroup;
use App\Models\Myth\Mythgroupuser;

class Users extends BaseController
{
    protected $mythuser,$mythgroup;

    function __construct()
    {
        $this->mythuser = new Mythusers();
        $this->mythgroup = new Mythgroup();
        $this->mythgroupuser = new Mythgroupuser();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Manage Auth Users',
            'users' => $this->mythuser->get_users(),
            'groups' => $this->mythgroup->get_auth_groups()
        ];

        return view('auth/users', $data);
    }

    public function create()
    {
    	$data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        $this->mythuser->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('myth/groups'));
    }

    public function update()
    {
    	$data = [
    		'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        $this->mythuser->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('myth/groups'));
    }

    public function delete()
    {
    	$id = $this->request->getPost('user_id');
        
        $this->mythuser->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
		session()->setFlashdata('type', 'success');
		return redirect()->to(base_url('setting/users'));
    }

    public function reset()
    {
        $data = [
            'id' => $this->request->getPost('user_id'),
            'password_hash' => '$2y$10$9Ge0xlIsm/DlRup5PrxlRehrHWT2k3LrqXnm5KTvYV.0XCRHIO5eq'
        ];
        
        $this->mythuser->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        session()->setFlashdata('type', 'success');
        return redirect()->to(base_url('setting/users'));
    }

    public function import()
    {
        $role = $this->request->getPost('role');
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            if(isset($_FILES['upload']['name']) && in_array($_FILES['upload']['type'], $file_mimes)) {
             
                $arr_file = explode('.', $_FILES['upload']['name']);
                $extension = end($arr_file);
                
                if('csv' == $extension) {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
             
                $spreadsheet = $reader->load($_FILES['upload']['tmp_name']);
                 
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

                for($i = 1;$i < count($sheetData);$i++)
                {
                    $email    = $sheetData[$i]['1'];
                    $username = $sheetData[$i]['2'];
                    $fullname = $sheetData[$i]['3'];
                    $password = password_hash(base64_encode(hash('sha384', $sheetData[$i]['4'], true)), PASSWORD_DEFAULT);

                    $ar[] = array(                          
                            'email'         => $email,
                            'username'      => $username,
                            'fullname'      => $fullname,
                            'password_hash' => $password,
                            'active'        => 1,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'updated_at'    => date('Y-m-d H:i:s')
                        );
                    }

                $data['info'] = $ar;
                $count = count($ar);
                $this->mythuser->save_batch($ar);
                $first_id = $this->mythuser->insertID();
                $last_id = $first_id + ($count-1);

                for($i = $first_id;$i <= $last_id;$i++){
                    $xx[] = array(
                        'group_id' => $role,
                        'user_id' => $i
                    );
                }
                // dd($xx);
                $this->mythgroupuser->save_batch($xx);
                return redirect()->to(base_url('setting/users'));
            }
    }
}
