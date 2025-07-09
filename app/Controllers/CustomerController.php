<?php
namespace App\Controllers;

use App\Models\Customer;
use App\Models\ProfilToko;

class CustomerController extends BaseController
{
    protected $role;

    public function __construct()
    {
        $this->role = session('role') ?? 'user';
    }

    public function index()
    {
        $customerModel = new Customer();
        $filterSearch = $this->request->getGet('search');
        $filterKota = $this->request->getGet('kota');
        $perPage = $this->request->getGet('entries') ?? 10;
        $currentPage = $this->request->getGet('page') ?? 1;
        $total = $customerModel->countAllResults();
        $customers = $customerModel->filterCustomer($filterSearch, $filterKota, $perPage, ($currentPage-1)*$perPage);
        $kotaList = $customerModel->getKotaList();
        $totalPages = ceil($total / $perPage);

        // Ambil data profil toko
        $profilTokoModel = new ProfilToko();
        $profil_toko = $profilTokoModel->getProfilToko();

        $data = [
            'customers' => $customers,
            'filterSearch' => $filterSearch,
            'filterKota' => $filterKota,
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'total' => $total,
            'kotaList' => $kotaList,
            'totalPages' => $totalPages,
            'role' => $this->role,
            'profil_toko' => $profil_toko
        ];
        return view('data_customer', $data);
    }

    public function create()
    {
        return view('data_customer', ['action' => 'create', 'role' => $this->role]);
    }

    public function store()
    {
        $customerModel = new \App\Models\Customer();
        $data = [
            'kode_customer' => $this->request->getPost('kode_customer'),
            'nama_customer' => $this->request->getPost('nama_customer'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
            'kota' => $this->request->getPost('kota')
        ];
        if ($this->request->isAJAX()) {
            if ($customerModel->insert($data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Customer berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan customer']);
            }
        } else {
            $redirect = $this->role === 'admin' ? '/admin/data-customer' : '/user/data-customer';
            if ($customerModel->insert($data)) {
                return redirect()->to($redirect)->with('success', 'Customer berhasil ditambahkan');
            } else {
                return redirect()->back()->withInput()->with('errors', $customerModel->errors());
            }
        }
    }

    public function edit($id)
    {
        $customerModel = new \App\Models\Customer();
        $customer = $customerModel->find($id);
        if (!$customer) {
            $redirect = $this->role === 'admin' ? '/admin/data-customer' : '/user/data-customer';
            return redirect()->to($redirect)->with('error', 'Customer tidak ditemukan');
        }
        return view('data_customer', ['customer' => $customer, 'action' => 'edit', 'role' => $this->role]);
    }

    public function update($id)
    {
        $customerModel = new \App\Models\Customer();
        $fields = ['kode_customer', 'nama_customer', 'alamat', 'telepon', 'kota'];
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
            if ($customerModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Customer berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui customer']);
            }
        } else {
            $redirect = $this->role === 'admin' ? '/admin/data-customer' : '/user/data-customer';
            if ($customerModel->update($id, $data)) {
                return redirect()->to($redirect)->with('success', 'Customer berhasil diperbarui');
            } else {
                return redirect()->back()->withInput()->with('errors', $customerModel->errors());
            }
        }
    }

    public function get($id)
    {
        $customerModel = new \App\Models\Customer();
        $customer = $customerModel->find($id);
        if (!$customer) {
            return $this->response->setJSON(['success' => false, 'message' => 'Customer tidak ditemukan']);
        }
        return $this->response->setJSON(['success' => true, 'data' => $customer]);
    }

    public function delete($id)
    {
        $customerModel = new \App\Models\Customer();
        if ($this->request->isAJAX()) {
            if ($customerModel->delete($id)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Customer berhasil dihapus']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus customer']);
            }
        } else {
            $redirect = $this->role === 'admin' ? '/admin/data-customer' : '/user/data-customer';
            if ($customerModel->delete($id)) {
                return redirect()->to($redirect)->with('success', 'Customer berhasil dihapus');
            } else {
                return redirect()->to($redirect)->with('error', 'Gagal menghapus customer');
            }
        }
    }

    public function export()
    {
        $customerModel = new \App\Models\Customer();
        $search = $this->request->getGet('search');
        $kota = $this->request->getGet('kota');
        $format = $this->request->getGet('format') ?? 'excel';
        $customers = $customerModel->filterCustomer($search, $kota, 1000, 0);
        $exportData = [];
        $no = 1;
        foreach ($customers as $c) {
            $exportData[] = [
                'No' => $no++,
                'Kode Customer' => $c['kode_customer'],
                'Nama Customer' => $c['nama_customer'],
                'Alamat' => $c['alamat'],
                'Telepon' => $c['telepon'],
                'Kota' => $c['kota'],
                'Terdaftar' => isset($c['created_at']) ? date('d/m/Y', strtotime($c['created_at'])) : ''
            ];
        }
        if (empty($exportData)) {
            $exportData[] = [
                'No' => '',
                'Kode Customer' => '',
                'Nama Customer' => '',
                'Alamat' => '',
                'Telepon' => '',
                'Kota' => '',
                'Terdaftar' => ''
            ];
        }
        switch ($format) {
            case 'excel':
                return $this->exportToExcel($exportData, 'Data Customer');
            case 'pdf':
                return $this->exportToPDF($exportData, 'Data Customer');
            case 'csv':
                return $this->exportToCSV($exportData, 'data_customer');
            default:
                return $this->exportToExcel($exportData, 'Data Customer');
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
     * Endpoint pencarian dinamis customer (AJAX)
     * URL: /data-customer/search
     * Method: GET
     * Params: search, kota
     * Return: JSON array data customer
     */
    public function search()
    {
        $customerModel = new \App\Models\Customer();
        $search = $this->request->getGet('search');
        $kota = $this->request->getGet('kota');
        $page = (int)($this->request->getGet('page') ?? 1);
        $perPage = (int)($this->request->getGet('entries') ?? 10);
        
        $data = $customerModel->filterCustomer($search, $kota, $perPage, ($page - 1) * $perPage);
        return $this->response->setJSON($data);
    }
} 