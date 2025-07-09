<?php
namespace App\Models;

use CodeIgniter\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kode_barang',
        'nama_barang',
        'kategori_barang',
        'stok',
        'satuan'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    /**
     * Get validation rules
     */
    public function getValidationRules(array $options = []): array
    {
        return [
            'kode_barang' => [
                'rules' => 'required|min_length[3]|max_length[20]|is_unique[barang.kode_barang,id,{id}]',
                'errors' => [
                    'required' => 'Kode barang harus diisi',
                    'min_length' => 'Kode barang minimal 3 karakter',
                    'max_length' => 'Kode barang maksimal 20 karakter',
                    'is_unique' => 'Gagal mengedit input'
                ]
            ],
            'nama_barang' => [
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Nama barang harus diisi',
                    'min_length' => 'Nama barang minimal 3 karakter',
                    'max_length' => 'Nama barang maksimal 100 karakter'
                ]
            ],
            'kategori_barang' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Kategori barang harus diisi',
                    'max_length' => 'Kategori barang maksimal 50 karakter'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'Stok harus diisi',
                    'numeric' => 'Stok harus berupa angka',
                    'greater_than_equal_to' => 'Stok tidak boleh negatif'
                ]
            ],
            'satuan' => [
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => 'Satuan harus diisi',
                    'max_length' => 'Satuan maksimal 20 karakter'
                ]
            ]
        ];
    }

    /**
     * Filter barang berdasarkan pencarian dan kategori
     */
    public function filterBarang($search = '', $kategori = '', $limit = null, $offset = null)
    {
        $builder = $this;
        if ($search) {
            $builder = $builder->groupStart()
                ->like('kode_barang', $search)
                ->orLike('nama_barang', $search)
                ->groupEnd();
        }
        if ($kategori) {
            $builder = $builder->where('kategori_barang', $kategori);
        }
        
        if ($limit !== null) {
            $builder = $builder->limit($limit);
        }
        if ($offset !== null) {
            $builder = $builder->offset($offset);
        }
        
        return $builder->findAll();
    }
} 