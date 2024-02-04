<?php

namespace App\Controllers;

use TCPDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\SptModel;
use App\Models\PelaksanaModel;
use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\Database\Exceptions\DatabaseException;



class Pelaksana extends ResourcePresenter
{
    
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $spt = new SptModel();
        $dataspt = $spt->pelaksanaspt();
        $data = [
            'title'     => 'Surat Perintah Tugas',
            'subtitle'  => 'Home',
            'spt'       => $dataspt,

        ];
        return view('pelaksana/index', $data);
    }
    

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $pelaksana = new PelaksanaModel();
        try {
            $data = $this->request->getPost();
            $pelaksana->save($data);
            $ket = [
                    'error' => false,
                    'message' => 'Data Berhasil Simpan',
                ];
            return $this->response->setJSON($ket);
            // return redirect()->back()->with('berhasil','Data Berhasil disimpan');
            // Data inserted successfully
        } catch (DatabaseException $e) {
            // $error = $e->getMessage();
            $validationerror = [
                'error'     => true,
                'message'   => 'Data sudah ada, harap memilih pegawai lain !',
            ];
            return $this->response->setJSON($validationerror);
            
            // return redirect()->back()->with('error','Data sudah ada, harap memilih pegawai lain !');
            // Handle the duplicate entry error, perhaps by returning an error message.
        }
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id = null)
    {
        $pelaksana = new PelaksanaModel();
        
        // $dataspt = $spt->find($id);
        $pelaksana->delete($id);
        return redirect()->back()->with('info','Data Berhasil di Hapus');
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }

    public function updatetoggle()
    {
        $itemModel = new PelaksanaModel();
        $itemIds = $this->request->getPost('item_ids');
        $datapelaksana = $itemModel->pelaksanastatus($itemIds);
        
        $status = $datapelaksana[0]['pelaksana_utama'];
        // dd($status);

        // if (!empty($itemIds)) {
            if($status == '0'){
                $itemModel->where('pelaksana_id', $itemIds)->set(['pelaksana_utama' => 1])->update();
            } else {
                $itemModel->where('pelaksana_id', $itemIds)->set(['pelaksana_utama' => 0])->update();
            }
    }

    public function sptpdf($id = null)
    {
        helper('date');
        // set_time_limit(300);
        // $spt = new SptModel();
        $pelaksana = new PelaksanaModel();
        $cek = $pelaksana->caripengikut($id);
        $cekutama = $pelaksana->cariutama($id);
        // dd($cek, $cekutama);
        if($cek <= 0) {
            session()->setFlashdata('info', 'Data Pelaksana Perjalanan Dinas Tidak ada, Harap diisi terlebih dahulu !!!');
            return redirect()->back();
        } elseif ($cekutama > 1 OR $cekutama == 0) {
                session()->setFlashdata('info','Pelaksana Utama Perjalanan Dinas Lebih dari 1 orang atau sama sekali belum di tentukan, Harap diisi Pelaksana Utama hanya 1 orang !!!');
                return redirect()->back();
            }
            
        
        $dataspt = $pelaksana->datapelaksana($id);
        // dd($dataspt);
        $data = [
            'imageSrc'    => $this->imageToBase64(ROOTPATH . '/public/images/kop.png'),
            'title'     => 'Surat Perintah Tugas',
            'subtitle'  => 'Home',
            'spt'       => $dataspt,
            'pelaksana'     => $cek,
        ];
        // dd($data);
        // return view('pelaksana/spt_pdf', $data);
        $html = view('pelaksana/spt_pdf', $data);
        
       
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portraid');
        $dompdf->render();
        $dompdf->stream('Dokumenku',array("Attachment"=>false));

    }
    // Kunci menampilkan image di DOMPdf 
    // dari : https://www.binaryboxtuts.com/php-tutorials/generating-pdf-from-html-in-codeigniter-4/
    private function imageToBase64($path) {
        $path = $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    public function sppdpdf($id = null)
    {
        set_time_limit(300);
        // $spt = new SptModel();
        $pelaksana = new PelaksanaModel();
        $cek = $pelaksana->caripengikut($id);
        $cekutama = $pelaksana->cariutama($id);
        $namautama = $pelaksana->pelaksanautama($id);
        $namapengikut = $pelaksana->pelaksanapengikut($id);
        if($cek <= 0) {
            session()->setFlashdata('info', 'Data Pelaksana Perjalanan Dinas Tidak ada, Harap diisi terlebih dahulu !!!');
            return redirect()->back();
        } elseif ($cekutama > 1 OR $cekutama == 0) {
                session()->setFlashdata('info','Pelaksana Utama Perjalanan Dinas Lebih dari 1 orang atau sama sekali belum di tentukan, Harap diisi Pelaksana Utama hanya 1 orang !!!');
                return redirect()->back();
            }
        $dataspt = $pelaksana->datapelaksana($id);
        $data = [
            'imageSrc'    => $this->imageToBase64(ROOTPATH . '/public/images/kop.png'),
            'title'     => 'Surat Perintah Tugas',
            'subtitle'  => 'Home',
            'spt'       => $dataspt,
            'utama'     => $namautama,
            'pengikut'  => $namapengikut,
            'jlhpengikut'   => $cek,
            'terbilang' => $pelaksana->angkaKeHuruf(intval($dataspt['data'][0]->spt_lama))
        ];
        // dd($data);
        // return view('pelaksana/sppd_pdf', $data);
        $html = view('pelaksana/sppd_pdf', $data);
        
       
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portraid');
        $dompdf->render();
        $dompdf->stream('SPPD',array("Attachment"=>false));

    }

    public function sptbupati($itemIds)
    {
        $itemModel = new PelaksanaModel();
        // $itemIds = $this->request->getPost('item_ids');
        $kabanpelaksana = $itemModel->kabanpelaksana($itemIds);
        // $kabanpelaksana = $itemModel->kabanpelaksana($itemIds);
        $data = [
            'imageSrc'    => $this->imageToBase64(ROOTPATH . '/public/images/kopbupati.png'),
            // 'title'     => 'Surat Perintah Tugas',
            // 'subtitle'  => 'Home',
            'kaban'       => $kabanpelaksana,
            
            // 'terbilang' => $itemModel->angkaKeHuruf(intval($kabanpelaksana[0]->spt_lama))
        ];
        // dd($data);
        // return view('pelaksana/sptbupati_pdf', $data);
        $html = view('pelaksana/sptbupati_pdf', $data);
        
       
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portraid');
        $dompdf->render();
        $dompdf->stream('SPPD',array("Attachment"=>false));

       
    }

    public function sptsekda($itemIds)
    {
        $itemModel = new PelaksanaModel();
        // $itemIds = $this->request->getPost('item_ids');
        $kabanpelaksana = $itemModel->kabanpelaksana($itemIds);
        // $kabanpelaksana = $itemModel->kabanpelaksana($itemIds);
        $data = [
            'imageSrc'    => $this->imageToBase64(ROOTPATH . '/public/images/kopsekda.png'),
            // 'title'     => 'Surat Perintah Tugas',
            // 'subtitle'  => 'Home',
            'kaban'       => $kabanpelaksana,
            
            // 'terbilang' => $itemModel->angkaKeHuruf(intval($kabanpelaksana[0]->spt_lama))
        ];
        // dd($data);
        // return view('pelaksana/sptbupati_pdf', $data);
        $html = view('pelaksana/sptsekda_pdf', $data);
        
       
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portraid');
        $dompdf->render();
        $dompdf->stream('SPPD',array("Attachment"=>false));

       
    }
    
    
}
