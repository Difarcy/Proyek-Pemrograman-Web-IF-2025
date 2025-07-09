<?php
namespace App\Models;

use CodeIgniter\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'no_surat_jalan',
        'tanggal_terima',
        'supplier',
        'nama_barang',
        'jumlah',
        'satuan',
        'petugas'
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
            'no_surat_jalan' => [
                'rules' => 'required|max_length[30]',
                'errors' => [
                    'required' => 'No Surat Jalan harus diisi',
                    'max_length' => 'No Surat Jalan maksimal 30 karakter'
                ]
            ],
            'tanggal_terima' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal terima harus diisi',
                    'valid_date' => 'Format tanggal tidak valid'
                ]
            ],
            'supplier' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Supplier harus diisi',
                    'max_length' => 'Supplier maksimal 100 karakter'
                ]
            ],
            'nama_barang' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama barang harus diisi',
                    'max_length' => 'Nama barang maksimal 100 karakter'
                ]
            ],
            'jumlah' => [
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'Jumlah harus diisi',
                    'numeric' => 'Jumlah harus berupa angka',
                    'greater_than' => 'Jumlah harus lebih dari 0'
                ]
            ],
            'satuan' => [
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => 'Satuan harus diisi',
                    'max_length' => 'Satuan maksimal 20 karakter'
                ]
            ],
            'petugas' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Petugas harus diisi',
                    'max_length' => 'Petugas maksimal 100 karakter'
                ]
            ]
        ];
    }

    /**
     * Filter barang masuk berdasarkan pencarian dan range tanggal
     */
    public function filterBarangMasuk($search = '', $tanggal_awal = '', $tanggal_akhir = '', $limit = null, $offset = null)
    {
        $builder = $this;
        if ($search) {
            $builder = $builder->groupStart()
                ->like('no_surat_jalan', $search)
                ->orLike('nama_barang', $search)
                ->orLike('supplier', $search)
                ->orLike('petugas', $search)
                ->groupEnd();
        }
        if ($tanggal_awal && $tanggal_akhir) {
            $builder = $builder->where('tanggal_terima >=', $tanggal_awal)
                               ->where('tanggal_terima <=', $tanggal_akhir);
        } elseif ($tanggal_awal) {
            $builder = $builder->where('tanggal_terima >=', $tanggal_awal);
        } elseif ($tanggal_akhir) {
            $builder = $builder->where('tanggal_terima <=', $tanggal_akhir);
        }
        if ($limit !== null) {
            $builder = $builder->limit($limit);
        }
        if ($offset !== null) {
            $builder = $builder->offset($offset);
        }
        return $builder->orderBy('tanggal_terima', 'ASC')->findAll();
    }
} 