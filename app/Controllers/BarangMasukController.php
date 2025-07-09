<?php
namespace App\Controllers;

use App\Models\BarangMasuk;
use App\Models\ProfilToko;

class BarangMasukController extends BaseController
{
    protected $role;

    public function __construct()
    {
        $this->role = session('role') ?? 'user';
    }

    public function index()
    {
        $barangMasukModel = new BarangMasuk();
        $search = $this->request->getGet('search');
        $filterTanggalAwal = $this->request->getGet('tanggal_awal');
        $filterTanggalAkhir = $this->request->getGet('tanggal_akhir');
        $page = (int)($this->request->getGet('page') ?? 1);
        $perPage = (int)($this->request->getGet('entries') ?? 10);
        $builder = $barangMasukModel;
        if ($search) {
            $builder = $builder->groupStart()
                ->like('no_surat_jalan', $search)
                ->orLike('nama_barang', $search)
                ->orLike('supplier', $search)
                ->orLike('petugas', $search)
                ->groupEnd();
        }
        if ($filterTanggalAwal && $filterTanggalAkhir) {
            $builder = $builder->where('tanggal_terima >=', $filterTanggalAwal)
                               ->where('tanggal_terima <=', $filterTanggalAkhir);
        } elseif ($filterTanggalAwal) {
            $builder = $builder->where('tanggal_terima >=', $filterTanggalAwal);
        } elseif ($filterTanggalAkhir) {
            $builder = $builder->where('tanggal_terima <=', $filterTanggalAkhir);
        }
        $total = $builder->countAllResults();
        $barangMasuk = $barangMasukModel->filterBarangMasuk($search, $filterTanggalAwal, $filterTanggalAkhir, $perPage, ($page - 1) * $perPage);
        $totalPages = ceil($total / $perPage);

        // Ambil data profil toko
        $profilTokoModel = new ProfilToko();
        $profil_toko = $profilTokoModel->getProfilToko();

        $data = [
            'barangMasuk' => $barangMasuk,
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
        return view('barang_masuk', $data);
    }

    public function create()
    {
        return view('barang_masuk', ['action' => 'create', 'role' => $this->role]);
    }

    public function store()
    {
        $barangMasukModel = new \App\Models\BarangMasuk();
        $data = [
            'no_surat_jalan' => $this->request->getPost('no_surat_jalan'),
            'tanggal_terima' => $this->request->getPost('tanggal_terima'),
            'supplier' => $this->request->getPost('supplier'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'petugas' => $this->request->getPost('petugas')
        ];
        if ($this->request->isAJAX()) {
            if ($barangMasukModel->insert($data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Barang masuk berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan barang masuk']);
            }
        } else {
            $redirect = $this->role === 'admin' ? '/admin/barang-masuk?entries=10' : '/user/barang-masuk?entries=10';
            if ($barangMasukModel->insert($data)) {
                return redirect()->to($redirect)->with('success', 'Barang masuk berhasil ditambahkan');
            } else {
                return redirect()->back()->withInput()->with('errors', $barangMasukModel->errors());
            }
        }
    }

    public function edit($id)
    {
        $barangMasukModel = new \App\Models\BarangMasuk();
        $barangMasuk = $barangMasukModel->find($id);
        if (!$barangMasuk) {
            $redirect = $this->role === 'admin' ? '/admin/barang-masuk' : '/user/barang-masuk';
            return redirect()->to($redirect)->with('error', 'Barang masuk tidak ditemukan');
        }
        return view('barang_masuk', ['barangMasuk' => $barangMasuk, 'action' => 'edit', 'role' => $this->role]);
    }

    public function update($id)
    {
        $barangMasukModel = new \App\Models\BarangMasuk();
        $fields = ['no_surat_jalan', 'tanggal_terima', 'supplier', 'nama_barang', 'jumlah', 'satuan', 'petugas'];
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
            if ($barangMasukModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Barang masuk berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui barang masuk']);
            }
        }
        $redirect = $this->role === 'admin' ? '/admin/barang-masuk' : '/user/barang-masuk';
        if ($barangMasukModel->update($id, $data)) {
            return redirect()->to($redirect)->with('success', 'Barang masuk berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('errors', $barangMasukModel->errors());
        }
    }

    public function get($id)
    {
        $barangMasukModel = new \App\Models\BarangMasuk();
        $barangMasuk = $barangMasukModel->find($id);
        if (!$barangMasuk) {
            return $this->response->setJSON(['success' => false, 'message' => 'Barang masuk tidak ditemukan']);
        }
        return $this->response->setJSON(['success' => true, 'data' => $barangMasuk]);
    }

    public function delete($id)
    {
        $barangMasukModel = new \App\Models\BarangMasuk();
        if ($this->request->isAJAX()) {
            if ($barangMasukModel->delete($id)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Barang masuk berhasil dihapus']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus barang masuk']);
            }
        } else {
            $redirect = $this->role === 'admin' ? '/admin/barang-masuk' : '/user/barang-masuk';
            if ($barangMasukModel->delete($id)) {
                return redirect()->to($redirect)->with('success', 'Barang masuk berhasil dihapus');
            } else {
                return redirect()->to($redirect)->with('error', 'Gagal menghapus barang masuk');
            }
        }
    }

    public function export()
    {
        $barangMasukModel = new \App\Models\BarangMasuk();
        $search = $this->request->getGet('search');
        $filterTanggalAwal = $this->request->getGet('tanggal_awal');
        $filterTanggalAkhir = $this->request->getGet('tanggal_akhir');
        $format = $this->request->getGet('format') ?? 'excel';
        $barangMasuk = $barangMasukModel->filterBarangMasuk($search, $filterTanggalAwal, $filterTanggalAkhir, 1000, 0);
        $exportData = [];
        $no = 1;
        foreach ($barangMasuk as $item) {
            $exportData[] = [
                'No' => $no++,
                'No Surat Jalan' => $item['no_surat_jalan'],
                'Tanggal Terima' => $item['tanggal_terima'],
                'Supplier' => $item['supplier'],
                'Nama Barang' => $item['nama_barang'],
                'Jumlah' => $item['jumlah'],
                'Satuan' => $item['satuan'],
                'Petugas' => $item['petugas']
            ];
        }
        $title = 'Data Barang Masuk';
        switch ($format) {
            case 'excel':
                return $this->exportToExcel($exportData, $title);
            case 'pdf':
                return $this->exportToPDF($exportData, $title);
            case 'csv':
                return $this->exportToCSV($exportData, 'data_barang_masuk');
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
     * Endpoint pencarian dinamis barang masuk (AJAX)
     * URL: /barang-masuk/search
     * Method: GET
     * Params: search, tanggal_awal, tanggal_akhir
     * Return: JSON array data barang masuk
     */
    public function search()
    {
        $barangMasukModel = new \App\Models\BarangMasuk();
        $search = $this->request->getGet('search');
        $tanggal_awal = $this->request->getGet('tanggal_awal');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');
        $page = (int)($this->request->getGet('page') ?? 1);
        $perPage = (int)($this->request->getGet('entries') ?? 10);
        
        $data = $barangMasukModel->filterBarangMasuk($search, $tanggal_awal, $tanggal_akhir, $perPage, ($page - 1) * $perPage);
        return $this->response->setJSON($data);
    }
} 