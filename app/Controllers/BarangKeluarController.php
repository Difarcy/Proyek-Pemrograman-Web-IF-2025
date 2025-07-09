<?php
namespace App\Controllers;

use App\Models\BarangKeluar;
use App\Models\ProfilToko;

class BarangKeluarController extends BaseController
{
    protected $role;

    public function __construct()
    {
        $this->role = session('role') ?? 'user';
    }

    public function index()
    {
        $barangKeluarModel = new BarangKeluar();
        $search = $this->request->getGet('search');
        $filterTanggalAwal = $this->request->getGet('tanggal_awal');
        $filterTanggalAkhir = $this->request->getGet('tanggal_akhir');
        $page = (int)($this->request->getGet('page') ?? 1);
        $perPage = (int)($this->request->getGet('entries') ?? 10);
        $builder = $barangKeluarModel;
        if ($search) {
            $builder = $builder->groupStart()
                ->like('no_surat_jalan', $search)
                ->orLike('nama_barang', $search)
                ->orLike('customer', $search)
                ->orLike('petugas', $search)
                ->groupEnd();
        }
        if ($filterTanggalAwal && $filterTanggalAkhir) {
            $builder = $builder->where('tanggal_keluar >=', $filterTanggalAwal)
                               ->where('tanggal_keluar <=', $filterTanggalAkhir);
        } elseif ($filterTanggalAwal) {
            $builder = $builder->where('tanggal_keluar >=', $filterTanggalAwal);
        } elseif ($filterTanggalAkhir) {
            $builder = $builder->where('tanggal_keluar <=', $filterTanggalAkhir);
        }
        $total = $builder->countAllResults();
        $barangKeluar = $barangKeluarModel->filterBarangKeluar($search, $filterTanggalAwal, $filterTanggalAkhir, $perPage, ($page - 1) * $perPage);
        $totalPages = ceil($total / $perPage);

        // Ambil data profil toko
        $profilTokoModel = new ProfilToko();
        $profil_toko = $profilTokoModel->getProfilToko();

        $data = [
            'barangKeluar' => $barangKeluar,
            'filterSearch' => $search,
            'filterTanggalAwal' => $filterTanggalAwal,
            'filterTanggalAkhir' => $filterTanggalAkhir,
            'total' => $total,
            'currentPage' => $page,
            'perPage' => $perPage,
            'totalPages' => $totalPages,
            'role' => $this->role,
            'profil_toko' => $profil_toko
        ];
        return view('barang_keluar', $data);
    }

    public function create()
    {
        return view('barang_keluar', ['action' => 'create', 'role' => $this->role]);
    }

    public function store()
    {
        $barangKeluarModel = new \App\Models\BarangKeluar();
        $data = [
            'no_surat_jalan' => $this->request->getPost('no_surat_jalan'),
            'tanggal_keluar' => $this->request->getPost('tanggal_keluar'),
            'customer' => $this->request->getPost('customer'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'petugas' => $this->request->getPost('petugas')
        ];
        if ($this->request->isAJAX()) {
            if ($barangKeluarModel->insert($data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Barang keluar berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan barang keluar']);
            }
        }
        $redirect = $this->role === 'admin' ? '/admin/barang-keluar' : '/user/barang-keluar';
        if ($barangKeluarModel->insert($data)) {
            return redirect()->to($redirect)->with('success', 'Barang keluar berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('errors', $barangKeluarModel->errors());
        }
    }

    public function edit($id)
    {
        $barangKeluarModel = new \App\Models\BarangKeluar();
        $barangKeluar = $barangKeluarModel->find($id);
        if (!$barangKeluar) {
            $redirect = $this->role === 'admin' ? '/admin/barang-keluar' : '/user/barang-keluar';
            return redirect()->to($redirect)->with('error', 'Barang keluar tidak ditemukan');
        }
        return view('barang_keluar', ['barangKeluar' => $barangKeluar, 'action' => 'edit', 'role' => $this->role]);
    }

    public function update($id)
    {
        $barangKeluarModel = new \App\Models\BarangKeluar();
        $fields = ['no_surat_jalan', 'tanggal_keluar', 'customer', 'nama_barang', 'jumlah', 'satuan', 'petugas'];
        $data = [];
        foreach ($fields as $field) {
            $value = $this->request->getPost($field);
            if ($value !== null && $value !== '') {
                $data[$field] = $value;
            }
        }
        if (empty($data)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak ada data yang diubah']);
        }
        if ($this->request->isAJAX()) {
            if ($barangKeluarModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Barang keluar berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui barang keluar']);
            }
        }
        $redirect = $this->role === 'admin' ? '/admin/barang-keluar' : '/user/barang-keluar';
        if ($barangKeluarModel->update($id, $data)) {
            return redirect()->to($redirect)->with('success', 'Barang keluar berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('errors', $barangKeluarModel->errors());
        }
    }

    public function get($id)
    {
        $barangKeluarModel = new \App\Models\BarangKeluar();
        $barangKeluar = $barangKeluarModel->find($id);
        if (!$barangKeluar) {
            return $this->response->setJSON(['success' => false, 'message' => 'Barang keluar tidak ditemukan']);
        }
        return $this->response->setJSON(['success' => true, 'data' => $barangKeluar]);
    }

    public function delete($id)
    {
        $barangKeluarModel = new \App\Models\BarangKeluar();
        if ($this->request->isAJAX()) {
            if ($barangKeluarModel->delete($id)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Barang keluar berhasil dihapus']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus barang keluar']);
            }
        } else {
            $redirect = $this->role === 'admin' ? '/admin/barang-keluar' : '/user/barang-keluar';
            if ($barangKeluarModel->delete($id)) {
                return redirect()->to($redirect)->with('success', 'Barang keluar berhasil dihapus');
            } else {
                return redirect()->to($redirect)->with('error', 'Gagal menghapus barang keluar');
            }
        }
    }

    public function export()
    {
        $barangKeluarModel = new \App\Models\BarangKeluar();
        $search = $this->request->getGet('search');
        $filterTanggalAwal = $this->request->getGet('tanggal_awal');
        $filterTanggalAkhir = $this->request->getGet('tanggal_akhir');
        $format = $this->request->getGet('format') ?? 'excel';
        $barangKeluar = $barangKeluarModel->filterBarangKeluar($search, $filterTanggalAwal, $filterTanggalAkhir, 1000, 0);
        $exportData = [];
        $no = 1;
        foreach ($barangKeluar as $item) {
            $exportData[] = [
                'No' => $no++,
                'No Surat Jalan' => $item['no_surat_jalan'],
                'Tanggal Keluar' => $item['tanggal_keluar'],
                'Customer' => $item['customer'],
                'Nama Barang' => $item['nama_barang'],
                'Jumlah' => $item['jumlah'],
                'Satuan' => $item['satuan'],
                'Petugas' => $item['petugas']
            ];
        }
        $title = 'Data Barang Keluar';
        switch ($format) {
            case 'excel':
                return $this->exportToExcel($exportData, $title);
            case 'pdf':
                return $this->exportToPDF($exportData, $title);
            case 'csv':
                return $this->exportToCSV($exportData, 'data_barang_keluar');
            default:
                return $this->exportToExcel($exportData, $title);
        }
    }

    private function exportToExcel($data, $title)
    {
        $filename = $title . '_' . date('Y-m-d') . '.xlsx';
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        if (!empty($data)) {
            $sheet->fromArray(array_keys($data[0]), NULL, 'A1');
            $sheet->fromArray($data, NULL, 'A2');
            // Set 'No' column (A) to left-aligned
            $sheet->getStyle('A:A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        }
        while (ob_get_level()) {
            ob_end_clean();
        }
        $response = service('response');
        $response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        ob_start();
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        $excelOutput = ob_get_clean();
        $response->setBody($excelOutput);
        return $response;
    }

    private function exportToPDF($data, $title)
    {
        $filename = $title . '_' . date('Y-m-d') . '.pdf';
        $html = '<html><head><title>' . $title . '</title>';
        $html .= '<style>';
        $html .= 'body { font-family: Arial, sans-serif; margin: 20px; }';
        $html .= 'table { width: 100%; border-collapse: collapse; margin-top: 20px; }';
        $html .= 'th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }';
        $html .= 'th { background-color: #f2f2f2; font-weight: bold; }';
        $html .= 'h1 { color: #333; }';
        $html .= '</style></head><body>';
        $html .= '<h1>' . $title . '</h1>';
        $html .= '<p>Tanggal Export: ' . date('d/m/Y H:i') . '</p>';
        if (!empty($data)) {
            $html .= '<table>';
            $html .= '<thead><tr>';
            foreach (array_keys($data[0]) as $header) {
                $html .= '<th>' . $header . '</th>';
            }
            $html .= '</tr></thead><tbody>';
            foreach ($data as $row) {
                $html .= '<tr>';
                foreach ($row as $value) {
                    $html .= '<td>' . $value . '</td>';
                }
                $html .= '</tr>';
            }
            $html .= '</tbody></table>';
        }
        $html .= '</body></html>';
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $pdfOutput = $dompdf->output();
        $response = service('response');
        $response->setHeader('Content-Type', 'application/pdf');
        $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $response->setBody($pdfOutput);
        return $response;
    }

    private function exportToCSV($data, $filename)
    {
        $filename = $filename . '_' . date('Y-m-d') . '.csv';
        $response = service('response');
        $response->setHeader('Content-Type', 'text/csv');
        $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        $fh = fopen('php://output', 'w');
        if (!empty($data)) {
            fputcsv($fh, array_keys($data[0]));
            foreach ($data as $row) {
                fputcsv($fh, $row);
            }
        }
        fclose($fh);
        return $response;
    }

    /**
     * Endpoint pencarian dinamis barang keluar (AJAX)
     * URL: /barang-keluar/search
     * Method: GET
     * Params: search, tanggal_awal, tanggal_akhir
     * Return: JSON array data barang keluar
     */
    public function search()
    {
        $barangKeluarModel = new \App\Models\BarangKeluar();
        $search = $this->request->getGet('search');
        $tanggal_awal = $this->request->getGet('tanggal_awal');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');
        $page = (int)($this->request->getGet('page') ?? 1);
        $perPage = (int)($this->request->getGet('entries') ?? 10);
        
        $data = $barangKeluarModel->filterBarangKeluar($search, $tanggal_awal, $tanggal_akhir, $perPage, ($page - 1) * $perPage);
        return $this->response->setJSON($data);
    }
} 