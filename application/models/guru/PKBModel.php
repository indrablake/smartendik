<?php defined('BASEPATH') or exit('No direct script access allowed');

class PKBModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function hapusPengembanganDiri_ajax($pengembanganDiriID)
    {
        return $this->db->delete('pengembanganDiri', ['pengembanganDiri_id' => $pengembanganDiriID]);
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

    function simpan_upload($nama_pengembanganDiri, $tanggal, $dokumen = '')
    {

        $data = array(
            'pengembanganDiri_name' => $nama_pengembanganDiri,
            'pengembanganDiri_upload' => $dokumen,
            'pengembanganDiri_tanggal' => $tanggal,
            'pengembanganDiri_status' => 1
        );

        $result = $this->db->insert('pengembanganDiri', $data);
        return $result;
    }

    function updateDataPengembanganDiri($pengembanganDiri, $dokumen, $pengembanganDiriID)
    {
        $data = array(
            'pengembanganDiri_name' => $pengembanganDiri,
            'pengembanganDiri_upload' => $dokumen
        );
        $this->db->where('pengembanganDiri_id', $pengembanganDiriID);
        $this->db->update('pengembanganDiri', $data);
        return true;
    }

    function updateDataPublikasiIlmiah($publikasiIlmiah, $dokumen, $publikasiIlmiahID)
    {
        $data = array(
            'publikasiIlmiah_name' => $publikasiIlmiah,
            'publikasiIlmiah_upload' => $dokumen
        );
        $this->db->where('publikasiIlmiah_id', $publikasiIlmiahID);
        $this->db->update('publikasiIlmiah', $data);
        return true;
    }

    function updateDataKarya($karya, $dokumen, $karyaID)
    {
        $data = array(
            'karya_name' => $karya,
            'karya_upload' => $dokumen
        );
        $this->db->where('karya_id', $karyaID);
        $this->db->update('karya', $data);
        return true;
    }
}
