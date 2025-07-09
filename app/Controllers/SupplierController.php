<?php
namespace App\Controllers;

use App\Models\Supplier;
use App\Models\ProfilToko;

class SupplierController extends BaseController
{
    protected $role;

    public function __construct()
    {
        $this->role = session('role') ?? 'user';
    }

    public function index()
    {
        $supplierModel = new Supplier();
        $search = $this->request->getGet('search');
        $kota = $this->request->getGet('kota');
        $page = (int)($this->request->getGet('page') ?? 1);
        $perPage = (int)($this->request->getGet('entries') ?? 10);
        $builder = $supplierModel;
        if ($search) {
            $builder = $builder->groupStart()
                ->like('kode_supplier', $search)
                ->orLike('nama_supplier', $search)
                ->orLike('alamat', $search)
                ->orLike('telepon', $search)
                ->groupEnd();
        }
        if ($kota) {
            $builder = $builder->where('kota', $kota);
        }
        $total = $builder->countAllResults();
        $suppliers = $supplierModel->filterSupplier($search, $kota, $perPage, ($page - 1) * $perPage);
        $totalPages = ceil($total / $perPage);

        // Ambil data profil toko
        $profilTokoModel = new ProfilToko();
        $profil_toko = $profilTokoModel->getProfilToko();

        $data = [
            'suppliers' => $suppliers,
            'filterSearch' => $search,
            'filterKota' => $kota,
            'total' => $total,
            'currentPage' => $page,
            'perPage' => $perPage,
            'totalPages' => $totalPages,
            'role' => $this->role,
            'profil_toko' => $profil_toko
        ];
        return view('data_supplier', $data);
    }

    public function create()
    {
        return view('data_supplier', ['action' => 'create', 'role' => $this->role]);
    }

    public function store()
    {
        $supplierModel = new \App\Models\Supplier();
        $data = [
            'kode_supplier' => $this->request->getPost('kode_supplier'),
            'nama_supplier' => $this->request->getPost('nama_supplier'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
            'kota' => $this->request->getPost('kota')
        ];
        if ($this->request->isAJAX()) {
            if ($supplierModel->insert($data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Supplier berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => implode(', ', $supplierModel->errors())]);
            }
        } else {
            $redirect = $this->role === 'admin' ? '/admin/data-supplier' : '/user/data-supplier';
            if ($supplierModel->insert($data)) {
                return redirect()->to($redirect)->with('success', 'Supplier berhasil ditambahkan');
            } else {
                return redirect()->back()->withInput()->with('errors', $supplierModel->errors());
            }
        }
    }

    public function edit($id)
    {
        $supplierModel = new \App\Models\Supplier();
        $supplier = $supplierModel->find($id);
        if (!$supplier) {
            $redirect = $this->role === 'admin' ? '/admin/data-supplier' : '/user/data-supplier';
            return redirect()->to($redirect)->with('error', 'Supplier tidak ditemukan');
        }
        return view('data_supplier', ['supplier' => $supplier, 'action' => 'edit', 'role' => $this->role]);
    }

    public function update($id)
    {
        $supplierModel = new \App\Models\Supplier();
        $data = [];
        $fields = ['kode_supplier', 'nama_supplier', 'alamat', 'telepon', 'kota'];
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
            if ($supplierModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Supplier berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => implode(', ', $supplierModel->errors())]);
            }
        } else {
            $redirect = $this->role === 'admin' ? '/admin/data-supplier' : '/user/data-supplier';
            if ($supplierModel->update($id, $data)) {
                return redirect()->to($redirect)->with('success', 'Supplier berhasil diperbarui');
            } else {
                return redirect()->back()->withInput()->with('errors', $supplierModel->errors());
            }
        }
    }

    public function get($id)
    {
        $supplierModel = new \App\Models\Supplier();
        $supplier = $supplierModel->find($id);
        if (!$supplier) {
            return $this->response->setJSON(['success' => false, 'message' => 'Supplier tidak ditemukan']);
        }
        return $this->response->setJSON(['success' => true, 'data' => $supplier]);
    }

    public function delete($id)
    {
        $supplierModel = new \App\Models\Supplier();
        if ($this->request->isAJAX()) {
            if ($supplierModel->delete($id)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Supplier berhasil dihapus']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus supplier']);
            }
        } else {
            $redirect = $this->role === 'admin' ? '/admin/data-supplier' : '/user/data-supplier';
            if ($supplierModel->delete($id)) {
                return redirect()->to($redirect)->with('success', 'Supplier berhasil dihapus');
            } else {
                return redirect()->to($redirect)->with('error', 'Gagal menghapus supplier');
            }
        }
    }

    public function export()
    {
        $supplierModel = new \App\Models\Supplier();
        $search = $this->request->getGet('search');
        $kota = $this->request->getGet('kota');
        $format = $this->request->getGet('format') ?? 'excel';
        $suppliers = $supplierModel->filterSupplier($search, $kota, 1000, 0);
        $exportData = [];
        foreach ($suppliers as $s) {
            $exportData[] = [
                'Kode Supplier' => $s['kode_supplier'],
                'Nama Supplier' => $s['nama_supplier'],
                'Alamat' => $s['alamat'],
                'Telepon' => $s['telepon'],
                'Kota' => $s['kota']
            ];
        }
        $title = 'Data Supplier';
        switch ($format) {
            case 'excel':
                return $this->exportToExcel($exportData, $title);
            case 'pdf':
                return $this->exportToPDF($exportData, $title);
            case 'csv':
                return $this->exportToCSV($exportData, 'data_supplier');
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
     * Endpoint pencarian dinamis supplier (AJAX)
     * URL: /data-supplier/search
     * Method: GET
     * Params: search, kota
     * Return: JSON array data supplier
     */
    public function search()
    {
        $supplierModel = new \App\Models\Supplier();
        $search = $this->request->getGet('search');
        $kota = $this->request->getGet('kota');
        $page = (int)($this->request->getGet('page') ?? 1);
        $perPage = (int)($this->request->getGet('entries') ?? 10);
        
        $data = $supplierModel->filterSupplier($search, $kota, $perPage, ($page - 1) * $perPage);
        return $this->response->setJSON($data);
    }
} 