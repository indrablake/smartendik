<?php defined('BASEPATH') or exit('No direct script access allowed');

class SekolahModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function rulesSekolah()
    {
        return [
            [
                'field' => 'grade_sekolah',
                'label' => 'Grade Sekolah',
                'rules' => 'required'
            ],

            [
                'field' => 'npsn_sekolah',
                'label' => 'NPSN Sekolah',
                'rules' => 'required'
            ],

            [
                'field' => 'nama_sekolah',
                'label' => 'Nama Sekolah',
                'rules' => 'required'
            ]
        ];
    }

    public function rulesGrade()
    {
        return [
            [
                'field' => 'gradeSekolah',
                'label' => 'Grade Sekolah',
                'rules' => 'required|is_unique[TBL_SCHOOLGRADE.GRADE_NAME]'
            ],

        ];
    }

    public function rulesKelas()
    {
        return [
            [
                'field' => 'namaSekolah',
                'label' => 'Nama Sekolah',
                'rules' => 'required'
            ],
            [
                'field' => 'levelKelas',
                'label' => 'Level Sekolah',
                'rules' => 'required'
            ],
            [
                'field' => 'namaKelas',
                'label' => 'Nama Kelas',
                'rules' => 'required'
            ],

        ];
    }

    function input_grade($data, $table)
    {
        $this->db->insert($table, $data);
    }
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function input_sekolah($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Ajax
    function grade_list()
    {
        $hasil = $this->db->query("SELECT * FROM TBL_SCHOOLGRADE");
        return $hasil->result();
    }

    public function hapusGrade_ajax($gradeID)
    {
        return $this->db->delete('TBL_SCHOOLGRADE', ['GRADE_ID' => $gradeID]);
    }

    public function hapusSTPPATK_ajax($stppatkID)
    {
        return $this->db->delete('TBL_STPPATK', ['STPPATK_ID' => $stppatkID]);
    }

    public function hapusKelas_ajax($classid)
    {
        return $this->db->delete('TBL_SCHOOLCLASS', ['CLASS_ID' => $classid]);
    }
}
