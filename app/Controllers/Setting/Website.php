<?php namespace App\Controllers\Setting;

use App\Controllers\BaseController;
use App\Models\WebsiteModel;
// use App\Models\SliderModel;

class Website extends BaseController
{
    private $web;
    public function __construct()
    {
        $this->web = new WebsiteModel();
        // $this->slider = new SliderModel();
    }

    public function index()
    {   
        $data = [
            'title' => 'Pengaturan',
            'setting' => $this->web->getSetting()
        ];
        
        return view('setting/index', $data);
    }

    public function update()
    {
        // if (!$this->validate([
        //     'favicon' => [
        //         'rules' => 'max_size[favicon,2048]|is_image[favicon]|mime_in[favicon,image/jpg,image/jpeg,image/png]',
        //         'errors' => [
        //             'max_size' => 'Ukuran terlalu besar',
        //             'is_image' => 'File anda bukan gambar',
        //             'mime_in' => 'File anda bukan gambar'
        //         ]
        //     ],
        //     'logo' => [
        //         'rules' => 'max_size[logo,2048]|is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/png]',
        //         'errors' => [
        //             'max_size' => 'Ukuran terlalu besar',
        //             'is_image' => 'File anda bukan gambar',
        //             'mime_in' => 'File anda bukan gambar'
        //         ]
        //     ],
        //     'logo-text' => [
        //         'rules' => 'max_size[logo-text,2048]|is_image[logo-text]|mime_in[favicon,image/jpg,image/jpeg,image/png]',
        //         'errors' => [
        //             'max_size' => 'Ukuran terlalu besar',
        //             'is_image' => 'File anda bukan gambar',
        //             'mime_in' => 'File anda bukan gambar'
        //         ]
        //     ],
        //     'login-image' => [
        //         'rules' => 'max_size[login-image,2048]|is_image[login-image]|mime_in[login-image,image/jpg,image/jpeg,image/png]',
        //         'errors' => [
        //             'max_size' => 'Ukuran terlalu besar',
        //             'is_image' => 'File anda bukan gambar',
        //             'mime_in' => 'File anda bukan gambar'
        //         ]
        //     ],
        // ])) {
        //     return redirect()->to('/setting')->withInput();
        // }

        // $favicon = $this->request->getFile('favicon');
        // $logo = $this->request->getFile('logo');
        // $logo_text = $this->request->getFile('logo-text');
        // $login_image = $this->request->getFile('login-image');

        if ($post_image->getError() == 4) {
            $image_name = $this->request->getVar('old_post_image');
        }else{
            $image_name = $post_image->getRandomName();
            $post_image->move('img/thumbnail', $image_name);
        }

        $data = [
            'id' => 1,
            'name' => $this->request->getPost('name'),
            'url' => $this->request->getPost('url'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keyword' => $this->request->getPost('meta_keyword'),
            'facebook' => $this->request->getPost('facebook'),
            'twitter' => $this->request->getPost('twitter'),
            'instagram' => $this->request->getPost('instagram'),
            'youtube' => $this->request->getPost('youtube'),
            'maps' => $this->request->getPost('maps'),
            'footer' => $this->request->getPost('footer'),
        ];

        $this->web->save($data);
        session()->setFlashdata('pesan', 'Data berhasil di perbaharui');
        session()->setFlashdata('type', 'success');
        return redirect()->to(base_url('setting'));
    }

    public function slider()
    {   
        $data = [
            'title' => 'Admin: Gambar Slide',
            'sliders' => $this->slider->getSliders()->getResultArray()
        ];
        
        return view('admin/setting/slider', $data);
    }

    public function slider_update($id)
    {   
        $data = [
            'title' => 'Admin: Gambar Slide',
            'slide' => $this->slider->getSliders($id)
        ];
        
        return view('admin/setting/slider-up', $data);
    }

    public function slider_create()
    {   
        $data = [
            'title' => 'Admin: Tambah Slide'
        ];
        
        return view('admin/setting/slider-add', $data);
    }

    public function slider_add()
    {
        if (!$this->validate([
            'slider' => [
                'rules' => 'max_size[slider,10240]|is_image[slider]|mime_in[slider,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran terlalu besar',
                    'is_image' => 'File anda bukan gambar',
                    'mime_in' => 'File anda bukan gambar'
                ]

            ]
        ])) {
            return redirect()->to('panel/setting/slider')->withInput();
        }

        $fileSlider = $this->request->getFile('slider');
        if ($fileSlider->getError() == 4) {
            $namaSlider = 'default.png';
        }else{
            $namaSlider = $fileSlider->getRandomName();
            $fileSlider->move('assets/images/sliders', $namaSlider);
        }

        $this->slider->save([
            'title' => $this->request->getPost('title'),
            'url' => $this->request->getPost('url'),
            'url_type' => $this->request->getPost('url_type'),
            'image' => $namaSlider
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('panel/setting/slider');
    }

    public function slider_up($id)
    {
        if (!$this->validate([
            'slider' => [
                'rules' => 'max_size[slider,10240]|is_image[slider]|mime_in[slider,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran terlalu besar',
                    'is_image' => 'File anda bukan gambar',
                    'mime_in' => 'File anda bukan gambar'
                ]

            ]
        ])) {
            return redirect()->to('panel/setting/slider')->withInput();
        }

        $fileSlider = $this->request->getFile('slider');
        if ($fileSlider->getError() == 4) {
            $namaSlider = $this->request->getVar('slider_lama');
        }else{
            $namaSlider = $fileSlider->getRandomName();
            $fileSlider->move('assets/images/sliders', $namaSlider);
        }

        $this->slider->save([
            'id' => $id,
            'title' => $this->request->getPost('title'),
            'url' => $this->request->getPost('url'),
            'url_type' => $this->request->getPost('url_type'),
            'image' => $namaSlider
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        session()->setFlashdata('type', 'success');
        return redirect()->to('panel/setting/slider');
    }

    public function slider_status($id)
    {
        $data['is_active'] = $this->request->getPost('is_active');
        $data['id'] = $id;
        $this->slider->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        session()->setFlashdata('type', 'success');
        return redirect()->to(base_url('panel/setting/slider'));
    }

    public function slider_delete($id)
    {
        $this->slider->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        session()->setFlashdata('type', 'success');
        return redirect()->to(base_url('panel/setting/slider'));
    }

}
