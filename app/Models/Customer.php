<?php

namespace App\Models;

use CodeIgniter\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'kode_customer',
        'nama_customer', 
        'alamat',
        'telepon',
        'kota'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'kode_customer' => [
            'rules' => 'required|max_length[20]|is_unique[customer.kode_customer,id,{id}]',
            'errors' => [
                'required' => 'Kode Customer harus diisi',
                'max_length' => 'Kode Customer maksimal 20 karakter',
                'is_unique' => 'Kode Customer sudah ada'
            ]
        ],
        'nama_customer' => [
            'rules' => 'required|max_length[100]',
            'errors' => [
                'required' => 'Nama Customer harus diisi',
                'max_length' => 'Nama Customer maksimal 100 karakter'
            ]
        ],
        'alamat' => [
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'Alamat harus diisi',
                'max_length' => 'Alamat maksimal 255 karakter'
            ]
        ],
        'telepon' => [
            'rules' => 'required|max_length[15]',
            'errors' => [
                'required' => 'Telepon harus diisi',
                'max_length' => 'Telepon maksimal 15 karakter'
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

    public function filterCustomer($search = '', $kota = '', $limit = 10, $offset = 0)
    {
        $builder = $this;
        
        if ($search) {
            $builder = $builder->groupStart()
                ->like('kode_customer', $search)
                ->orLike('nama_customer', $search)
                ->orLike('alamat', $search)
                ->orLike('telepon', $search)
                ->groupEnd();
        }
        
        if ($kota) {
            $builder = $builder->where('kota', $kota);
        }
        
        return $builder->orderBy('id', 'ASC')
                      ->findAll($limit, $offset);
    }

    // Dummy data untuk testing
    public function getDummyData()
    {
        return [
            [
                'kode_customer' => 'CUST001',
                'nama_customer' => 'PT Bangunan Maju',
                'alamat' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                'telepon' => '021-5550123',
                'kota' => 'Jakarta'
            ],
            [
                'kode_customer' => 'CUST002',
                'nama_customer' => 'CV Konstruksi Jaya',
                'alamat' => 'Jl. Gatot Subroto No. 45, Jakarta Selatan',
                'telepon' => '021-5550456',
                'kota' => 'Jakarta'
            ],
            [
                'kode_customer' => 'CUST003',
                'nama_customer' => 'UD Material Sukses',
                'alamat' => 'Jl. Asia Afrika No. 67, Bandung',
                'telepon' => '022-5550789',
                'kota' => 'Bandung'
            ],
            [
                'kode_customer' => 'CUST004',
                'nama_customer' => 'PT Proyek Bersama',
                'alamat' => 'Jl. Merdeka No. 89, Bandung',
                'telepon' => '022-5550321',
                'kota' => 'Bandung'
            ],
            [
                'kode_customer' => 'CUST005',
                'nama_customer' => 'CV Bangunan Sejahtera',
                'alamat' => 'Jl. Thamrin No. 12, Jakarta Pusat',
                'telepon' => '021-5550654',
                'kota' => 'Jakarta'
            ],
            [
                'kode_customer' => 'CUST006',
                'nama_customer' => 'PT Graha Konstruksi',
                'alamat' => 'Jl. Ahmad Yani No. 15, Surabaya',
                'telepon' => '031-5550124',
                'kota' => 'Surabaya'
            ],
            [
                'kode_customer' => 'CUST007',
                'nama_customer' => 'CV Mitra Bangunan',
                'alamat' => 'Jl. Pahlawan No. 78, Semarang',
                'telepon' => '024-5550457',
                'kota' => 'Semarang'
            ],
            [
                'kode_customer' => 'CUST008',
                'nama_customer' => 'UD Jaya Material',
                'alamat' => 'Jl. Veteran No. 34, Yogyakarta',
                'telepon' => '0274-5550789',
                'kota' => 'Yogyakarta'
            ],
            [
                'kode_customer' => 'CUST009',
                'nama_customer' => 'PT Cipta Karya',
                'alamat' => 'Jl. Diponegoro No. 56, Malang',
                'telepon' => '0341-5550322',
                'kota' => 'Malang'
            ],
            [
                'kode_customer' => 'CUST010',
                'nama_customer' => 'CV Sinar Konstruksi',
                'alamat' => 'Jl. Gajah Mada No. 90, Medan',
                'telepon' => '061-5550655',
                'kota' => 'Medan'
            ]
        ];
    }

    public function getKotaList()
    {
        return $this->select('kota')->distinct()->orderBy('kota', 'ASC')->findAll();
    }
} 