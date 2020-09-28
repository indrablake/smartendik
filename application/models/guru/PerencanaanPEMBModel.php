<?php defined('BASEPATH') or exit('No direct script access allowed');

class PerencanaanPEMBModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function hapusPROTA_ajax($protaID)
    {
        return $this->db->delete('prota', ['prota_id' => $protaID]);
    }
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function simpan_upload($nama_prota, $tanggal, $dokumen = '', $kelas, $jenjang_kd, $thn_ajar_kd, $semester)
    {

        $data = array(
            'prota_name' => $nama_prota,
            'prota_upload' => $dokumen,
            'prota_tanggal' => $tanggal,
            'prota_status' => 1,
            'kelas' => $kelas,
            'jenjang_kd' => $jenjang_kd,
            'thn_ajar_kd' => $thn_ajar_kd,
            'semester' => $semester
        );

        $result = $this->db->insert('prota', $data);
        return $result;
    }

    function updateData($prota, $dokumen, $protaID, $kelas, $semester, $thn_ajar_kd, $jenjang_kd)
    {
        $data = array(
            'prota_name' => $prota,
            'prota_upload' => $dokumen,
            'kelas' => $kelas,
            'semester' => $semester,
            'thn_ajar_kd' => $thn_ajar_kd,
            'jenjang_kd' => $jenjang_kd
        );
        $this->db->where('prota_id', $protaID);
        $this->db->update('prota', $data);
        return true;
    }

    function updateDataProsem($prosem, $dokumen, $prosemID, $kelas, $semester, $thn_ajar_kd, $jenjang_kd)
    {
        $data = array(
            'prosem_name' => $prosem,
            'prosem_upload' => $dokumen,
            'kelas' => $kelas,
            'semester' => $semester,
            'thn_ajar_kd' => $thn_ajar_kd,
            'jenjang_kd' => $jenjang_kd
        );
        $this->db->where('prosem_id', $prosemID);
        $this->db->update('prosem', $data);
        return true;
    }

    function updateDataSKL($skl, $dokumen, $sklID, $kelas, $semester, $thn_ajar_kd, $jenjang_kd)
    {
        $data = array(
            'skl_name' => $skl,
            'skl_upload' => $dokumen,
            'kelas' => $kelas,
            'semester' => $semester,
            'thn_ajar_kd' => $thn_ajar_kd,
            'jenjang_kd' => $jenjang_kd
        );
        $this->db->where('skl_id', $sklID);
        $this->db->update('skl', $data);
        return true;
    }
    function updateDataAnalisisKD($analisisKD, $dokumen, $analisisKDID, $kelas, $semester, $thn_ajar_kd, $jenjang_kd)
    {
        $data = array(
            'analisisKD_name' => $analisisKD,
            'analisisKD_upload' => $dokumen,
            'kelas' => $kelas,
            'semester' => $semester,
            'thn_ajar_kd' => $thn_ajar_kd,
            'jenjang_kd' => $jenjang_kd
        );
        $this->db->where('analisisKD_id', $analisisKDID);
        $this->db->update('analisisKD', $data);
        return true;
    }

    function updateDatarpp($rpp, $dokumen, $rppID, $kelas, $semester, $thn_ajar_kd, $jenjang_kd)
    {
        $data = array(
            'rpp_name' => $rpp,
            'rpp_upload' => $dokumen,
            'kelas' => $kelas,
            'semester' => $semester,
            'thn_ajar_kd' => $thn_ajar_kd,
            'jenjang_kd' => $jenjang_kd
        );
        $this->db->where('rpp_id', $rppID);
        $this->db->update('rpp_new', $data);
        return true;
    }
}
