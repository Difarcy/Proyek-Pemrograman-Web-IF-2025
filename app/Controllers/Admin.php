<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\User;
use App\Models\ProfilToko;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Customer;

class Admin extends Controller
{
    // Fungsi-fungsi khusus admin saja, tanpa dashboard dan index
    // Kelola Pengguna
    public function kelolaPengguna()
    {
        $userModel = new User();
        
        // Get filter parameters
        $search = $this->request->getGet('search');
        $status = $this->request->getGet('status');
        $perPage = $this->request->getGet('entries') ?: 10;
        $currentPage = $this->request->getGet('page') ?: 1;
        
        // Build query
        $query = $userModel->select('id, username, nama, status, last_login, created_at')
                           ->where('role', 'user');
        
        if ($search) {
            $query->groupStart()
                  ->like('username', $search)
                  ->orLike('nama', $search)
                ->groupEnd();
        }
        
        if ($status) {
            $query->where('status', $status);
        }
        
        // Get total count for pagination
        $total = $query->countAllResults(false);
        
        // Get paginated results
        $users = $query->orderBy('username', 'ASC')
                      ->limit($perPage, ($currentPage - 1) * $perPage)
                      ->findAll();
        
        $totalPages = ceil($total / $perPage);

        // Ambil data profil toko
        $profilTokoModel = new ProfilToko();
        $profil_toko = $profilTokoModel->getProfilToko();
        
        // Ambil semua status unik dari tabel users
        $statusOptions = $userModel->distinct()->select('status')->where('role', 'user')->findAll();
        $statusOptions = array_map(function($row) { return $row['status']; }, $statusOptions);
        $statusOptions = array_unique($statusOptions);
        sort($statusOptions);
        
        $data = [
            'users' => $users,
            'total' => $total,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'perPage' => $perPage,
            'filterSearch' => $search,
            'filterStatus' => $status,
            'profil_toko' => $profil_toko,
            'statusOptions' => $statusOptions
        ];
        
        return view('admin/kelola_pengguna', $data);
    }

    /**
     * Endpoint pencarian dinamis kelola pengguna (AJAX)
     * URL: /kelola-pengguna/search
     * Method: GET
     * Params: search, status
     * Return: JSON array data user
     */
    public function searchUser()
    {
        $userModel = new \App\Models\User();
        $search = $this->request->getGet('search');
        $status = $this->request->getGet('status');
        $query = $userModel->select('id, username, nama, status, last_login, created_at')->where('role', 'user');
        if ($search) {
            $query->groupStart()
                  ->like('username', $search)
                  ->orLike('nama', $search)
                ->groupEnd();
        }
        if ($status) {
            $query->where('status', $status);
        }
        $users = $query->orderBy('created_at', 'DESC')->findAll();
        return $this->response->setJSON($users);
    }

    public function storeUser()
    {
        $userModel = new User();
        
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|max_length[50]|is_unique[users.username]',
            'nama' => 'required|max_length[100]',
            'password' => 'required|min_length[6]'
        ], [
            'password' => [
                'required' => 'Password harus diisi',
                'min_length' => 'Password minimal 6 karakter'
            ]
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }
        
        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'user', // Pastikan selalu user
            'status' => 'active',
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $result = $userModel->insert($data);
        
        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Pengguna berhasil ditambahkan'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menambahkan pengguna'
            ]);
        }
    }

    public function getUser($id)
    {
        $userModel = new User();
        $user = $userModel->find($id);
        
        if ($user) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $user
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan'
            ]);
        }
    }

    public function updateUser($id)
    {
        $userModel = new User();
        
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|max_length[50]',
            'nama' => 'required|max_length[100]',
            'password' => 'min_length[6]'
        ], [
            'password' => [
                'min_length' => 'Password minimal 6 karakter'
            ]
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }
        
        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama')
        ];
        
        // Check if password is provided
        $password = $this->request->getPost('password');
        if ($password) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        
        // Check if username is unique (excluding current user)
        $existingUser = $userModel->where('username', $data['username'])
                                 ->where('id !=', $id)
                                 ->first();
        
        if ($existingUser) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Username sudah digunakan'
            ]);
        }
        
        $result = $userModel->update($id, $data);
        
        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Pengguna berhasil diperbarui'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memperbarui pengguna'
            ]);
        }
    }

    public function toggleUserStatus($id)
    {
        $userModel = new User();
        $user = $userModel->find($id);
        
        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan'
            ]);
        }
        
        $newStatus = $user['status'] === 'active' ? 'inactive' : 'active';
        $result = $userModel->update($id, [
            'status' => $newStatus,
            'force_logout' => $newStatus === 'inactive' ? 1 : 0
        ]);
        
        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Status pengguna berhasil diubah',
                'newStatus' => $newStatus
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengubah status pengguna'
            ]);
        }
    }

    public function deleteUser($id)
    {
        $userModel = new User();
        $result = $userModel->delete($id);
        
        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Pengguna berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menghapus pengguna'
            ]);
        }
    }

    public function exportUsers()
    {
        $userModel = new User();
        $search = $this->request->getGet('search') ?? '';
        $status = $this->request->getGet('status') ?? '';
        $format = $this->request->getGet('format') ?? 'excel';
        $builder = $userModel->select('username, nama, status, last_login, created_at')->where('role', 'user');
        if ($search !== '') {
            $builder = $builder->like('username', $search);
        }
        if ($status !== '') {
            $builder = $builder->like('status', $status);
        }
        $users = $builder->orderBy('created_at', 'DESC')->findAll();
        $exportData = [];
        $no = 1;
        foreach ($users as $u) {
            $exportData[] = [
                'No' => $no++,
                'Username' => $u['username'],
                'Nama' => $u['nama'],
                'Status' => $u['status'],
                'Last Login' => $u['last_login'],
                'Created At' => $u['created_at'],
            ];
        }
        if (empty($exportData)) {
            $exportData[] = [
                'No' => '',
                'Username' => '',
                'Nama' => '',
                'Status' => '',
                'Last Login' => '',
                'Created At' => '',
            ];
        }
        switch ($format) {
            case 'excel':
                return $this->exportToExcel($exportData, 'Data Pengguna');
            case 'pdf':
                return $this->exportToPDF($exportData, 'Data Pengguna');
            case 'csv':
                return $this->exportToCSV($exportData, 'data_pengguna');
            default:
                return $this->exportToExcel($exportData, 'Data Pengguna');
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

    private function exportToCSV($data, $title)
    {
        $filename = $title . '_' . date('Y-m-d') . '.csv';
        $f = fopen('php://memory', 'w');
        if (!empty($data)) {
            fputcsv($f, array_keys($data[0]));
            foreach ($data as $row) {
                fputcsv($f, $row);
            }
        }
        fseek($f, 0);
        $csv = stream_get_contents($f);
        fclose($f);
        $response = service('response');
        $response->setHeader('Content-Type', 'text/csv');
        $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        $response->setBody($csv);
        return $response;
    }

    private function exportToPDF($data, $title)
    {
        // Implementasi sederhana PDF (bisa gunakan library dompdf/mpdf sesuai kebutuhan)
        $html = '<h2>' . $title . '</h2><table border="1" cellpadding="5" cellspacing="0"><tr>';
        if (!empty($data)) {
            foreach (array_keys($data[0]) as $col) {
                $html .= '<th>' . htmlspecialchars($col) . '</th>';
            }
            $html .= '</tr>';
            foreach ($data as $row) {
                $html .= '<tr>';
                foreach ($row as $cell) {
                    $html .= '<td>' . htmlspecialchars($cell) . '</td>';
                }
                $html .= '</tr>';
            }
        }
        $html .= '</table>';
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $response = service('response');
        $response->setHeader('Content-Type', 'application/pdf');
        $response->setHeader('Content-Disposition', 'attachment; filename="' . $title . '_' . date('Y-m-d') . '.pdf"');
        $response->setBody($dompdf->output());
        return $response;
    }

    // Profil Toko
    public function profilToko()
    {
        $profilTokoModel = new ProfilToko();
        $profil_toko = $profilTokoModel->first();
        
        return view('admin/profil_toko', ['profil_toko' => $profil_toko]);
    }

    public function updateProfilToko()
    {
        $profilTokoModel = new ProfilToko();
        
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_toko' => 'required|max_length[100]',
            'nama_pemilik' => 'required|max_length[100]',
            'no_telepon' => 'required|max_length[25]',
            'alamat' => 'required|max_length[500]'
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }
        
        $data = [
            'nama_toko' => $this->request->getPost('nama_toko'),
            'nama_pemilik' => $this->request->getPost('nama_pemilik'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'alamat' => $this->request->getPost('alamat')
        ];

        $profil_toko = $profilTokoModel->first();
        
        if ($profil_toko) {
            $result = $profilTokoModel->update($profil_toko['id'], $data);
        } else {
            $result = $profilTokoModel->insert($data);
        }

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Profil toko berhasil diperbarui'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memperbarui profil toko'
            ]);
        }
    }

    public function updateFotoToko()
    {
        $profilTokoModel = new ProfilToko();
        
        $foto = $this->request->getFile('foto');
        if (!$foto || !$foto->isValid()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'File foto tidak valid'
            ]);
        }

        // Validasi tipe file
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!in_array($foto->getClientMimeType(), $allowedTypes)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tipe file tidak didukung. Gunakan JPG, PNG, atau GIF'
            ]);
        }

        // Validasi ukuran file (max 2MB)
        if ($foto->getSize() > 2 * 1024 * 1024) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Ukuran file terlalu besar. Maksimal 2MB'
            ]);
        }

        $newName = $foto->getRandomName();
        $foto->move(ROOTPATH . 'public/uploads/profil', $newName);

        $profil_toko = $profilTokoModel->first();
        
        if ($profil_toko) {
            $result = $profilTokoModel->update($profil_toko['id'], ['foto' => $newName]);
        } else {
            $result = $profilTokoModel->insert(['foto' => $newName]);
        }

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Foto toko berhasil diperbarui',
                'foto' => $newName
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memperbarui foto toko'
            ]);
        }
    }

    // Profil Admin
    public function profil()
    {
        // Ambil data admin yang sedang login dari session
        $userModel = new User();
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }
        
        $user = $userModel->find($userId);
        
        if (!$user) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Data user tidak ditemukan');
        }
        
        return view('profil', ['user' => $user, 'role' => 'admin']);
    }

    public function updateProfil()
    {
        $userModel = new User();
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Session tidak valid, silakan login ulang'
            ]);
        }
        
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|max_length[50]',
            'nama_lengkap' => 'required|max_length[100]',
            'no_telepon' => 'required|max_length[25]',
            'alamat' => 'required|max_length[500]'
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }
        
        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama_lengkap'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'alamat' => $this->request->getPost('alamat')
        ];

        // Validasi manual untuk username
        $existingUser = $userModel->where('username', $data['username'])
                                 ->where('id !=', $userId)
                                 ->first();
        
        if ($existingUser) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Username sudah digunakan oleh user lain'
            ]);
        }

        // Handle foto upload
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move(ROOTPATH . 'public/uploads/profil', $newName);
            $data['foto'] = $newName;
        }

        $result = $userModel->update($userId, $data);
        
        if ($result) {
            $user = $userModel->find($userId);
            session()->set('foto', $user['foto'] ?? null);
            if (session()->get('username') !== $data['username']) {
                session()->set('username', $data['username']);
            }
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Profil berhasil diperbarui',
                'foto' => $user['foto'] ?? null
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memperbarui profil'
            ]);
        }
    }

    public function updateFotoProfil()
    {
        $userModel = new User();
        $userId = session()->get('user_id');
        
        $foto = $this->request->getFile('foto');
        if (!$foto || !$foto->isValid()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'File foto tidak valid'
            ]);
        }

        // Validasi tipe file
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!in_array($foto->getClientMimeType(), $allowedTypes)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tipe file tidak didukung. Gunakan JPG, PNG, atau GIF'
            ]);
        }

        // Validasi ukuran file (max 2MB)
        if ($foto->getSize() > 2 * 1024 * 1024) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Ukuran file terlalu besar. Maksimal 2MB'
            ]);
        }

        $newName = $foto->getRandomName();
        $foto->move(ROOTPATH . 'public/uploads/profil', $newName);
        
        $result = $userModel->update($userId, ['foto' => $newName]);
        
        if ($result) {
            session()->set('foto', $newName);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Foto profil berhasil diperbarui',
                'foto' => $newName
            ]);
            } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memperbarui foto profil'
            ]);
        }
    }

    // Reset Password
    public function resetPassword()
    {
        $userModel = new User();
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }
        
        $user = $userModel->find($userId);
        
        if (!$user) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Data user tidak ditemukan');
        }
        
        return view('reset_password', ['user' => $user, 'role' => 'admin']);
    }

    public function resetPasswordAction()
    {
        $userModel = new User();
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Session tidak valid, silakan login ulang'
            ]);
        }
        
        $user = $userModel->find($userId);
        if (!$user) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Data user tidak ditemukan'
            ]);
        }
        
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'password_lama' => 'required',
            'password_baru' => 'required|min_length[6]',
            'konfirmasi_password' => 'required|matches[password_baru]'
        ], [
            'password_lama' => [
                'required' => 'Password lama harus diisi'
            ],
            'password_baru' => [
                'required' => 'Password baru harus diisi',
                'min_length' => 'Password baru minimal 6 karakter'
            ],
            'konfirmasi_password' => [
                'required' => 'Konfirmasi password harus diisi',
                'matches' => 'Konfirmasi password tidak cocok'
            ]
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
                return $this->response->setJSON([
                    'success' => false, 
                'message' => 'Validasi gagal',
                'errors' => $validation->getErrors()
            ]);
        }
        
        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');
        
        // Verifikasi password lama
        if (!password_verify($passwordLama, $user['password'])) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Password lama tidak sesuai'
            ]);
        }
        
        // Update password baru
        $result = $userModel->update($userId, [
            'password' => password_hash($passwordBaru, PASSWORD_DEFAULT)
        ]);
        
        if ($result) {
            // Logout otomatis setelah reset password berhasil
            session()->destroy();
            return $this->response->setJSON([
                'success' => true, 
                'message' => 'Password berhasil diubah. Anda akan dialihkan ke halaman login.',
                'logout' => true
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengubah password'
            ]);
        }
    }

    // Test Edit (jika masih diperlukan)
    public function testEdit() { /* ... existing code ... */ }
}
