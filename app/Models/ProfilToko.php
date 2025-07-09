<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilToko extends Model
{
    protected $table            = 'profil_toko';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_toko', 'nama_pemilik', 'no_telepon', 'alamat', 'foto'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'nama_toko'     => 'required|max_length[100]',
        'nama_pemilik'  => 'required|max_length[100]',
        'no_telepon'    => 'required|max_length[25]',
        'alamat'        => 'required|max_length[500]'
    ];
    protected $validationMessages   = [
        'nama_toko'     => [
            'required'   => 'Nama toko harus diisi',
            'max_length' => 'Nama toko maksimal 100 karakter'
        ],
        'nama_pemilik'  => [
            'required'   => 'Nama pemilik harus diisi',
            'max_length' => 'Nama pemilik maksimal 100 karakter'
        ],
        'no_telepon'    => [
            'required'   => 'No telepon harus diisi',
            'max_length' => 'No telepon maksimal 25 karakter'
        ],
        'alamat'        => [
            'required'   => 'Alamat harus diisi',
            'max_length' => 'Alamat maksimal 500 karakter'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Mendapatkan data profil toko (hanya 1 record)
     */
    public function getProfilToko()
    {
        return $this->first();
    }

    /**
     * Update profil toko
     */
    public function updateProfilToko($data)
    {
        $profil = $this->first();
        if ($profil) {
            log_message('debug', 'Updating profile ID: ' . $profil['id']);
            return $this->update($profil['id'], $data);
        } else {
            log_message('debug', 'No profile found, inserting new record');
            return $this->insert($data);
        }
    }
} 