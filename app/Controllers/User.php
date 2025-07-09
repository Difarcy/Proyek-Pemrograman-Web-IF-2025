<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Customer;

class User extends Controller
{
    // Fungsi-fungsi khusus user saja, tanpa dashboard dan index
    // Profil User
    public function profil()
    {
        // Ambil data user yang sedang login dari session
        $userModel = new \App\Models\User();
        $userId = session()->get('user_id');
        
        // Debug: Check if user_id exists in session
        if (!$userId) {
            // Redirect to login if no user_id in session
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }
        
        $user = $userModel->find($userId);
        
        // Debug: Check if user exists in database
        if (!$user) {
            // Clear session and redirect to login
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Data user tidak ditemukan');
        }
        
        return view('profil', ['user' => $user, 'role' => 'user']);
    }

    public function updateProfil()
    {
        $userModel = new \App\Models\User();
        $userId = session()->get('user_id');
        
        // Check if user_id exists
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
        ], [
            'username' => [
                'required' => 'Username harus diisi',
                'max_length' => 'Username maksimal 50 karakter'
            ],
            'nama_lengkap' => [
                'required' => 'Nama lengkap harus diisi',
                'max_length' => 'Nama lengkap maksimal 100 karakter'
            ],
            'no_telepon' => [
                'required' => 'No telepon harus diisi',
                'max_length' => 'No telepon maksimal 25 karakter'
            ],
            'alamat' => [
                'required' => 'Alamat harus diisi',
                'max_length' => 'Alamat maksimal 500 karakter'
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
            'nama' => $this->request->getPost('nama_lengkap'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'alamat' => $this->request->getPost('alamat')
        ];

        // Validasi manual untuk username (cek apakah username sudah digunakan oleh user lain)
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
            // Update session jika username berubah
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
                'message' => 'Gagal memperbarui profil',
                'errors' => $userModel->errors()
            ]);
        }
    }

    public function updateFotoProfil()
    {
        $userModel = new \App\Models\User();
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

        if ($userModel->update($userId, ['foto' => $newName])) {
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
        $userModel = new \App\Models\User();
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }
        
        $user = $userModel->find($userId);
        
        if (!$user) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Data user tidak ditemukan');
        }
        
        return view('reset_password', ['user' => $user, 'role' => 'user']);
    }

    public function resetPasswordAction()
    {
        $userModel = new \App\Models\User();
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
}
