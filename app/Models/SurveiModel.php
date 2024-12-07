<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveiModel extends Model
{
    protected $table            = 'survei';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'judul',
        'dekripsi',
        'tgl_mulai',
        'tgl_selesai',
        'status',
        'id_unit_placeholder',
        'id_pertanyaan',
        'rata_rata_tertimbang',
        'ikm',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
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

    public function getSurveiWithUnitFilter()
    {
        return $this->select('survei.*, unit_placeholder_pertanyaan.nama_unit,unit_placeholder_pertanyaan.jenis_unit, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder', 'left')
            // ->where('survei.status', 'on')
            ->findAll();
    }

    public function getSurveiWithUnit()
    {
        return $this->select('survei.*, unit_placeholder_pertanyaan.nama_unit, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder', 'left')
            ->where('survei.status', 'on')
            ->where('unit_placeholder_pertanyaan.jenis_unit', 'Unit Layanan')
            ->where('survei.judul', 'Instrumen survei kepuasan Unit Layanan di lingkungan UMRAH')
            ->orderBy('unit_placeholder_pertanyaan.nama_unit', 'ASC')
            ->orderBy('unit_placeholder_pertanyaan.jenis_layanan_yang_diterima', 'ASC')
            ->findAll();
    }
    
    public function getSurveiWithUnitMahasiswa()
    {
        return $this->select('survei.*, unit_placeholder_pertanyaan.nama_unit, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder', 'left')
            ->where('survei.status', 'on')
            ->where('unit_placeholder_pertanyaan.jenis_unit', 'UPPS')
            ->where('survei.judul', 'Instrumen survei kepuasan mahasiswa di UPPS')
            ->orderBy('unit_placeholder_pertanyaan.nama_unit', 'ASC')
            ->orderBy('unit_placeholder_pertanyaan.jenis_layanan_yang_diterima', 'ASC')
            ->findAll();
    }
    
    public function getSurveiWithUnitDosen()
    {
        return $this->select('survei.*, unit_placeholder_pertanyaan.nama_unit, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder', 'left')
            ->where('survei.status', 'on')
            ->where('unit_placeholder_pertanyaan.jenis_unit', 'UPPS')
            ->where('survei.judul', 'Instrumen survei kepuasan dosen di UPPS')
            ->orderBy('unit_placeholder_pertanyaan.nama_unit', 'ASC')
            ->orderBy('unit_placeholder_pertanyaan.jenis_layanan_yang_diterima', 'ASC')
            ->findAll();
    }
    
    public function getSurveiWithUnitTendik()
    {
        return $this->select('survei.*, unit_placeholder_pertanyaan.nama_unit, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder', 'left')
            ->where('survei.status', 'on')
            ->where('unit_placeholder_pertanyaan.jenis_unit', 'UPPS')
            ->where('survei.judul', 'Instrumen survei kepuasan tenaga kependidikan di UPPS')
            ->orderBy('unit_placeholder_pertanyaan.nama_unit', 'ASC')
            ->orderBy('unit_placeholder_pertanyaan.jenis_layanan_yang_diterima', 'ASC')
            ->findAll();
    }
    
    public function getSurveiWithUnitMitra()
    {
        return $this->select('survei.*, unit_placeholder_pertanyaan.nama_unit, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder', 'left')
            ->where('survei.status', 'on')
            ->where('unit_placeholder_pertanyaan.jenis_unit', 'UPPS')
            ->where('survei.judul', 'Instrumen survei kepuasan mitra di UPPS')
            ->orderBy('unit_placeholder_pertanyaan.nama_unit', 'ASC')
            ->orderBy('unit_placeholder_pertanyaan.jenis_layanan_yang_diterima', 'ASC')
            ->findAll();
    }
}
