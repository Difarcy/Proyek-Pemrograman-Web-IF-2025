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
        'jenis_barang',
        'merek_barang',
        'stok',
        'keterangan'
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
                    'is_unique' => 'Kode barang sudah ada'
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
            'jenis_barang' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Jenis barang harus diisi',
                    'max_length' => 'Jenis barang maksimal 50 karakter'
                ]
            ],
            'merek_barang' => [
                'rules' => 'max_length[50]',
                'errors' => [
                    'max_length' => 'Merek barang maksimal 50 karakter'
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
            'keterangan' => [
                'rules' => 'max_length[500]',
                'errors' => [
                    'max_length' => 'Keterangan maksimal 500 karakter'
                ]
            ]
        ];
    }
} 