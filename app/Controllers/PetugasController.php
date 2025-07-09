<?php
namespace App\Controllers;

use App\Models\Petugas;
use App\Models\ProfilToko;

class PetugasController extends BaseController
{
    protected $role;

    public function __construct()
    {
        $this->role = session('role') ?? 'user';
    }

    public function index()
    {
        $petugasModel = new Petugas();
        $search = $this->request->getGet('search');
        $jabatan = $this->request->getGet('jabatan');
        $perPage = $this->request->getGet('entries') ?? 10;
        $currentPage = $this->request->getGet('page') ?? 1;
        $total = $petugasModel->countAllResults();
        $petugas = $petugasModel->filterPetugas($search, $jabatan, $perPage, ($currentPage-1)*$perPage);
        $jabatanList = $petugasModel->getJabatanList();
        $totalPages = ceil($total / $perPage);

        // Ambil data profil toko
        $profilTokoModel = new ProfilToko();
        $profil_toko = $profilTokoModel->getProfilToko();

        $data = [
            'petugas' => $petugas,
            'filterSearch' => $search,
            'filterJabatan' => $jabatan,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'total' => $total,
            'jabatanList' => $jabatanList,
            'totalPages' => $totalPages,
            'role' => $this->role,
            'profil_toko' => $profil_toko
        ];
        return view('data_petugas', $data);
    }

    public function create()
    {
        return view('data_petugas', ['action' => 'create', 'role' => $this->role]);
    }

    public function store()
    {
        $petugasModel = new \App\Models\Petugas();
        $data = [
            'kode_petugas' => $this->request->getPost('kode_petugas'),
            'nama_petugas' => $this->request->getPost('nama_petugas'),
            'jabatan' => $this->request->getPost('jabatan'),
            'telepon' => $this->request->getPost('telepon'),
            'alamat' => $this->request->getPost('alamat'),
            'kota' => $this->request->getPost('kota')
        ];
        if ($this->request->isAJAX()) {
            if ($petugasModel->insert($data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Petugas berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => implode(', ', $petugasModel->errors())]);
            }
        } else {
            $redirect = $this->role === 'admin' ? '/admin/data-petugas' : '/user/data-petugas';
            if ($petugasModel->insert($data)) {
                return redirect()->to($redirect)->with('success', 'Petugas berhasil ditambahkan');
            } else {
                return redirect()->back()->withInput()->with('errors', $petugasModel->errors());
            }
        }
    }

    public function edit($id)
    {
        $petugasModel = new \App\Models\Petugas();
        $petugas = $petugasModel->find($id);
        if (!$petugas) {
            $redirect = $this->role === 'admin' ? '/admin/data-petugas' : '/user/data-petugas';
            return redirect()->to($redirect)->with('error', 'Petugas tidak ditemukan');
        }
        return view('data_petugas', ['petugas' => $petugas, 'action' => 'edit', 'role' => $this->role]);
    }

    public function update($id)
    {
        $petugasModel = new \App\Models\Petugas();
        $data = [];
        $fields = ['kode_petugas', 'nama_petugas', 'jabatan', 'telepon', 'alamat', 'kota'];
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
            if ($petugasModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Petugas berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => implode(', ', $petugasModel->errors())]);
            }
        } else {
            $redirect = $this->role === 'admin' ? '/admin/data-petugas' : '/user/data-petugas';
            if ($petugasModel->update($id, $data)) {
                return redirect()->to($redirect)->with('success', 'Petugas berhasil diperbarui');
            } else {
                return redirect()->back()->withInput()->with('errors', $petugasModel->errors());
            }
        }
    }

    public function get($id)
    {
        $petugasModel = new \App\Models\Petugas();
        $petugas = $petugasModel->find($id);
        if (!$petugas) {
            return $this->response->setJSON(['success' => false, 'message' => 'Petugas tidak ditemukan']);
        }
        return $this->response->setJSON(['success' => true, 'data' => $petugas]);
    }

    public function delete($id)
    {
        $petugasModel = new \App\Models\Petugas();
        if ($this->request->isAJAX()) {
            if ($petugasModel->delete($id)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Petugas berhasil dihapus']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus petugas']);
            }
        } else {
            $redirect = $this->role === 'admin' ? '/admin/data-petugas' : '/user/data-petugas';
            if ($petugasModel->delete($id)) {
                return redirect()->to($redirect)->with('success', 'Petugas berhasil dihapus');
            } else {
                return redirect()->to($redirect)->with('error', 'Gagal menghapus petugas');
            }
        }
    }

    public function export()
    {
        $petugasModel = new \App\Models\Petugas();
        $search = $this->request->getGet('search');
        $jabatan = $this->request->getGet('jabatan');
        $format = $this->request->getGet('format') ?? 'excel';
        $petugas = $petugasModel->filterPetugas($search, $jabatan, 1000, 0);
        $exportData = [];
        $no = 1;
        foreach ($petugas as $p) {
            $exportData[] = [
                'No' => $no++,
                'Kode Petugas' => $p['kode_petugas'],
                'Nama Petugas' => $p['nama_petugas'],
                'Jabatan' => $p['jabatan'],
                'Telepon' => $p['telepon'],
                'Alamat' => $p['alamat'],
                'Kota' => $p['kota']
            ];
        }
        $title = 'Data Petugas';
        switch ($format) {
            case 'excel':
                return $this->exportToExcel($exportData, $title);
            case 'pdf':
                return $this->exportToPDF($exportData, $title);
            case 'csv':
                return $this->exportToCSV($exportData, 'data_petugas');
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

    /**
     * Endpoint pencarian dinamis petugas (AJAX)
     * URL: /data-petugas/search
     * Method: GET
     * Params: search, jabatan
     * Return: JSON array data petugas
     */
    public function search()
    {
        $petugasModel = new \App\Models\Petugas();
        $search = $this->request->getGet('search');
        $jabatan = $this->request->getGet('jabatan');
        $page = (int)($this->request->getGet('page') ?? 1);
        $perPage = (int)($this->request->getGet('entries') ?? 10);
        
        $data = $petugasModel->filterPetugas($search, $jabatan, $perPage, ($page - 1) * $perPage);
        return $this->response->setJSON($data);
    }
} 