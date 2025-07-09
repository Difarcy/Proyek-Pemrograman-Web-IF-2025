<?php

namespace App\Models;

use CodeIgniter\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'kode_supplier',
        'nama_supplier',
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
        'kode_supplier' => [
            'rules' => 'required|max_length[20]|is_unique[supplier.kode_supplier,id,{id}]',
            'errors' => [
                'required' => 'Kode Supplier harus diisi',
                'max_length' => 'Kode Supplier maksimal 20 karakter',
                'is_unique' => 'Kode Supplier sudah ada'
            ]
        ],
        'nama_supplier' => [
            'rules' => 'required|max_length[100]',
            'errors' => [
                'required' => 'Nama Supplier harus diisi',
                'max_length' => 'Nama Supplier maksimal 100 karakter'
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

    public function filterSupplier($search = '', $kota = '', $limit = 10, $offset = 0)
    {
        $builder = $this;
        
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
        
        return $builder->orderBy('kode_supplier', 'ASC')
                      ->orderBy('nama_supplier', 'ASC')
                      ->findAll($limit, $offset);
    }

    // Dummy data untuk testing
    public function getDummyData()
    {
        return [
            [
                'kode_supplier' => 'SUP001',
                'nama_supplier' => 'PT Semen Indonesia',
                'alamat' => 'Jl. Raya Gresik No. 1, Gresik',
                'telepon' => '031-3981111',
                'kota' => 'Gresik'
            ],
            [
                'kode_supplier' => 'SUP002',
                'nama_supplier' => 'CV Bata Merah Jaya',
                'alamat' => 'Jl. Industri No. 15, Bandung',
                'telepon' => '022-5550123',
                'kota' => 'Bandung'
            ],
            [
                'kode_supplier' => 'SUP003',
                'nama_supplier' => 'UD Pasir Bangunan',
                'alamat' => 'Jl. Tambang Pasir No. 8, Cirebon',
                'telepon' => '0231-5550456',
                'kota' => 'Cirebon'
            ],
            [
                'kode_supplier' => 'SUP004',
                'nama_supplier' => 'PT Besi Beton Maju',
                'alamat' => 'Jl. Industri Besi No. 25, Jakarta Utara',
                'telepon' => '021-5550789',
                'kota' => 'Jakarta'
            ],
            [
                'kode_supplier' => 'SUP005',
                'nama_supplier' => 'CV Kayu Jati Premium',
                'alamat' => 'Jl. Hutan Jati No. 12, Jepara',
                'telepon' => '0291-5550321',
                'kota' => 'Jepara'
            ],
            [
                'kode_supplier' => 'SUP006',
                'nama_supplier' => 'PT Krakatau Steel',
                'alamat' => 'Jl. Industri No. 5, Cilegon',
                'telepon' => '0254-5550125',
                'kota' => 'Cilegon'
            ],
            [
                'kode_supplier' => 'SUP007',
                'nama_supplier' => 'CV Cat Warna Indah',
                'alamat' => 'Jl. Industri Kimia No. 22, Tangerang',
                'telepon' => '021-5550458',
                'kota' => 'Tangerang'
            ],
            [
                'kode_supplier' => 'SUP008',
                'nama_supplier' => 'UD Pipa Sejahtera',
                'alamat' => 'Jl. Industri Logam No. 18, Bekasi',
                'telepon' => '021-5550790',
                'kota' => 'Bekasi'
            ],
            [
                'kode_supplier' => 'SUP009',
                'nama_supplier' => 'PT Keramik Nusantara',
                'alamat' => 'Jl. Industri Keramik No. 33, Karawang',
                'telepon' => '0267-5550323',
                'kota' => 'Karawang'
            ],
            [
                'kode_supplier' => 'SUP010',
                'nama_supplier' => 'CV Aluminium Maju',
                'alamat' => 'Jl. Industri Aluminium No. 7, Serang',
                'telepon' => '0254-5550656',
                'kota' => 'Serang'
            ]
        ];
    }
} 