<?php

namespace App\Models;

use CodeIgniter\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'kode_petugas',
        'nama_petugas',
        'jabatan',
        'telepon',
        'alamat',
        'kota'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'kode_petugas' => [
            'rules' => 'required|max_length[20]|is_unique[petugas.kode_petugas,id,{id}]',
            'errors' => [
                'required' => 'Kode Petugas harus diisi',
                'max_length' => 'Kode Petugas maksimal 20 karakter',
                'is_unique' => 'Kode Petugas sudah ada'
            ]
        ],
        'nama_petugas' => [
            'rules' => 'required|max_length[100]',
            'errors' => [
                'required' => 'Nama Petugas harus diisi',
                'max_length' => 'Nama Petugas maksimal 100 karakter'
            ]
        ],
        'jabatan' => [
            'rules' => 'required|max_length[50]',
            'errors' => [
                'required' => 'Jabatan harus diisi',
                'max_length' => 'Jabatan maksimal 50 karakter'
            ]
        ],
        'telepon' => [
            'rules' => 'required|max_length[15]',
            'errors' => [
                'required' => 'Telepon harus diisi',
                'max_length' => 'Telepon maksimal 15 karakter'
            ]
        ],
        'alamat' => [
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'Alamat harus diisi',
                'max_length' => 'Alamat maksimal 255 karakter'
            ]
        ],
        'kota' => [
            'rules' => 'required|max_length[50]',
            'errors' => [
                'required' => 'Kota harus diisi',
                'max_length' => 'Kota maksimal 50 karakter'
            ]
        ]
    ];

    public function filterPetugas($search = '', $jabatan = '', $limit = 10, $offset = 0)
    {
        $builder = $this;
        
        if ($search) {
            $builder = $builder->groupStart()
                ->like('kode_petugas', $search)
                ->orLike('nama_petugas', $search)
                ->orLike('telepon', $search)
                ->orLike('alamat', $search)
                ->orLike('kota', $search)
                ->groupEnd();
        }
        
        if ($jabatan) {
            $builder = $builder->where('jabatan', $jabatan);
        }
        
        return $builder->orderBy('nama_petugas', 'ASC')
                      ->findAll($limit, $offset);
    }

    // Dummy data untuk testing
    public function getDummyData()
    {
        return [
            [
                'kode_petugas' => 'PET001',
                'nama_petugas' => 'Ahmad Supriadi',
                'jabatan' => 'Admin',
                'telepon' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 1',
                'kota' => 'Jakarta'
            ]
            // Tambahkan data lain jika perlu
        ];
    }

    public function getJabatanList()
    {
        return $this->select('jabatan')->distinct()->orderBy('jabatan', 'ASC')->findAll();
    }
} 