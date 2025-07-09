<?php
namespace App\Models;
use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'nama', 'role', 'status', 'no_telepon', 'alamat', 'foto', 'last_login', 'created_at', 'updated_at'];
    protected $returnType = 'array';
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation - hanya untuk field yang ada di form
    protected $validationRules = [
        'username' => 'required|max_length[50]',
        'nama' => 'required|max_length[100]'
    ];
    protected $validationMessages = [
        'username' => [
            'required' => 'Username harus diisi',
            'max_length' => 'Username maksimal 50 karakter',
            'is_unique' => 'Username sudah digunakan'
        ],
        'nama' => [
            'required' => 'Nama lengkap harus diisi',
            'max_length' => 'Nama lengkap maksimal 100 karakter'
        ]
    ];

    public function filterUsers($search = '', $role = '', $status = '', $limit = 10, $offset = 0)
    {
        $builder = $this->builder();
        
        if ($search) {
            $builder->groupStart()
                ->like('username', $search)
                ->orLike('nama', $search)
                ->groupEnd();
        }
        
        if ($role) {
            $builder->where('role', $role);
        }
        
        if ($status) {
            $builder->where('status', $status);
        }
        
        return $builder->orderBy('created_at', 'DESC')
                      ->limit($limit, $offset)
                      ->get()
                      ->getResultArray();
    }

    public function filterUsersOnly($search = '', $status = '', $limit = 10, $offset = 0)
    {
        $builder = $this->builder()->where('role', 'user');
        
        if ($search) {
            $builder->groupStart()
                ->like('username', $search)
                ->orLike('nama', $search)
                ->groupEnd();
        }
        
        if ($status) {
            $builder->where('status', $status);
        }
        
        return $builder->orderBy('created_at', 'DESC')
                      ->limit($limit, $offset)
                      ->get()
                      ->getResultArray();
    }
} 