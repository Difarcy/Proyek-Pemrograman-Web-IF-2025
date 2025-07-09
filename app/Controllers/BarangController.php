<?php
namespace App\Controllers;

use App\Models\Barang;
use App\Models\ProfilToko;
use CodeIgniter\HTTP\RequestInterface;

class BarangController extends BaseController
{
    protected $role;

    public function __construct()
    {
        $this->role = session('role') ?? 'user';
    }

    public function index()
    {
        $barangModel = new Barang();
        $search = $this->request->getGet('search');
        $kategori = $this->request->getGet('kategori');
        $page = (int)($this->request->getGet('page') ?? 1);
        $perPage = (int)($this->request->getGet('entries') ?? 10);

        $builder = $barangModel;
        if ($search) {
            $builder = $builder->groupStart()
                ->like('kode_barang', $search)
                ->orLike('nama_barang', $search)
                ->groupEnd();
        }
        if ($kategori) {
            $builder = $builder->where('kategori_barang', $kategori);
        }
        $total = $builder->countAllResults();

        $stokBarang = $barangModel->filterBarang($search, $kategori, $perPage, ($page - 1) * $perPage);
        $totalPages = ceil($total / $perPage);

        $kategoriList = $barangModel->select('kategori_barang')->distinct()->findAll();
        $kategoriList = array_unique(array_filter(array_map(function($row) {
            return $row['kategori_barang'];
        }, $kategoriList)));
        sort($kategoriList);

        // Ambil data profil toko
        $profilTokoModel = new ProfilToko();
        $profil_toko = $profilTokoModel->getProfilToko();

        $data = [
            'stokBarang' => $stokBarang,
            'filterSearch' => $search,
            'filterKategori' => $kategori,
            'total' => $total,
            'currentPage' => $page,
            'perPage' => $perPage,
            'totalPages' => $totalPages,
            'kategoriList' => $kategoriList,
            'role' => $this->role,
            'profil_toko' => $profil_toko
        ];

        return view('stok_barang', $data);
    }

    public function create()
    {
        return view('stok_barang', ['action' => 'create', 'role' => $this->role]);
    }

    public function store()
    {
        $barangModel = new \App\Models\Barang();
        $data = [
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'kategori_barang' => $this->request->getPost('kategori_barang'),
            'stok' => $this->request->getPost('stok'),
            'satuan' => $this->request->getPost('satuan')
        ];
        if ($this->request->isAJAX()) {
            if ($barangModel->insert($data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Barang berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan barang']);
            }
        } else {
            if ($barangModel->insert($data)) {
                $redirect = $this->role === 'admin' ? '/admin/stok-barang' : '/user/stok-barang';
                return redirect()->to($redirect)->with('success', 'Barang berhasil ditambahkan');
            } else {
                return redirect()->back()->withInput()->with('errors', $barangModel->errors());
            }
        }
    }

    public function edit($id)
    {
        $barangModel = new \App\Models\Barang();
        $barang = $barangModel->find($id);
        if (!$barang) {
            $redirect = $this->role === 'admin' ? '/admin/stok-barang' : '/user/stok-barang';
            return redirect()->to($redirect)->with('error', 'Barang tidak ditemukan');
        }
        return view('stok_barang', ['barang' => $barang, 'action' => 'edit', 'role' => $this->role]);
    }

    public function update($id)
    {
        $idPost = $this->request->getPost('id');
        if ($idPost !== null && $idPost !== '') {
            $id = $idPost;
        }
        $barangModel = new \App\Models\Barang();
        $data = [];
        $fields = ['kode_barang', 'nama_barang', 'kategori_barang', 'stok', 'satuan'];
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
            if ($barangModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Barang berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => implode(', ', $barangModel->errors())]);
            }
        } else {
            if ($barangModel->update($id, $data)) {
                $redirect = $this->role === 'admin' ? '/admin/stok-barang' : '/user/stok-barang';
                return redirect()->to($redirect)->with('success', 'Barang berhasil diperbarui');
            } else {
                return redirect()->back()->withInput()->with('errors', $barangModel->errors());
            }
        }
    }

    public function get($id)
    {
        $barangModel = new \App\Models\Barang();
        $barang = $barangModel->find($id);
        if (!$barang) {
            return $this->response->setJSON(['success' => false, 'message' => 'Barang tidak ditemukan']);
        }
        return $this->response->setJSON(['success' => true, 'data' => $barang]);
    }

    public function delete($id)
    {
        $barangModel = new \App\Models\Barang();
        if ($this->request->isAJAX()) {
            if ($barangModel->delete($id)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Barang berhasil dihapus']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus barang']);
            }
        } else {
            $redirect = $this->role === 'admin' ? '/admin/stok-barang' : '/user/stok-barang';
            if ($barangModel->delete($id)) {
                return redirect()->to($redirect)->with('success', 'Barang berhasil dihapus');
            } else {
                return redirect()->to($redirect)->with('error', 'Gagal menghapus barang');
            }
        }
    }

    public function export()
    {
        $barangModel = new \App\Models\Barang();
        $search = $this->request->getGet('search');
        $kategori = $this->request->getGet('kategori');
        $format = $this->request->getGet('format') ?? 'excel';
        $barang = $barangModel->filterBarang($search, $kategori, 1000, 0);
        $exportData = [];
        $no = 1;
        foreach ($barang as $item) {
            $exportData[] = [
                'No' => $no++,
                'Kode Barang' => $item['kode_barang'],
                'Nama Barang' => $item['nama_barang'],
                'Kategori' => $item['kategori_barang'],
                'Stok' => $item['stok'],
                'Satuan' => $item['satuan']
            ];
        }
        switch ($format) {
            case 'excel':
                return $this->exportToExcel($exportData, 'Data Barang');
            case 'pdf':
                return $this->exportToPDF($exportData, 'Data Barang');
            case 'csv':
                return $this->exportToCSV($exportData, 'data_barang');
            default:
                return $this->exportToExcel($exportData, 'Data Barang');
        }
    }

    public function kategoriList()
    {
        $barangModel = new \App\Models\Barang();
        $kategoriList = $barangModel->select('kategori_barang')->distinct()->findAll();
        $kategoriList = array_unique(array_filter(array_map(function($row) {
            return $row['kategori_barang'];
        }, $kategoriList)));
        sort($kategoriList);
        return $this->response->setJSON(['success' => true, 'data' => $kategoriList]);
    }

    /**
     * Endpoint pencarian dinamis stok barang (AJAX)
     * URL: /barang/search (atau sesuaikan dengan route)
     * Method: GET
     * Params: search, kategori
     * Return: JSON array data barang
     */
    public function search()
    {
        $barangModel = new \App\Models\Barang();
        $search = $this->request->getGet('search');
        $kategori = $this->request->getGet('kategori');
        $page = (int)($this->request->getGet('page') ?? 1);
        $perPage = (int)($this->request->getGet('entries') ?? 10);
        
        $data = $barangModel->filterBarang($search, $kategori, $perPage, ($page - 1) * $perPage);
        return $this->response->setJSON($data);
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
        $this->response->setHeader('Content-Type', 'text/csv');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $output = fopen('php://output', 'w');
        if (!empty($data)) {
            fputcsv($output, array_keys($data[0]));
        }
        foreach ($data as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
        return $this->response;
    }
} 