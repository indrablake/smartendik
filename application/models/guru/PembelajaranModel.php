<?php defined('BASEPATH') or exit('No direct script access allowed');

class PembelajaranModel extends CI_Model
{




    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function hapusBuku_ajax($bukuID)
    {
        return $this->db->delete('buku', ['buku_id' => $bukuID]);
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

    function simpan_upload($nama_buku, $tanggal, $dokumen = '')
    {

        $data = array(
            'buku_name' => $nama_buku,
            'buku_upload' => $dokumen,
            'buku_tanggal' => $tanggal,
            'buku_status' => 1
        );

        $result = $this->db->insert('buku', $data);
        return $result;
    }

    function updateDataBuku($buku, $dokumen, $bukuID)
    {
        $data = array(
            'buku_name' => $buku,
            'buku_upload' => $dokumen
        );
        $this->db->where('buku_id', $bukuID);
        $this->db->update('buku', $data);
        return true;
    }
    function updateDataMediaPembelajaran($mediaPembelajaran, $dokumen, $mediaPembelajaranID)
    {
        $data = array(
            'mediaPembelajaran_name' => $mediaPembelajaran,
            'mediaPembelajaran_upload' => $dokumen
        );
        $this->db->where('mediaPembelajaran_id', $mediaPembelajaranID);
        $this->db->update('mediaPembelajaran', $data);
        return true;
    }

    function updateDataMateriPembinaan($materiPembinaan, $dokumen, $materiPembinaanID)
    {
        $data = array(
            'materiPembinaan_name' => $materiPembinaan,
            'materiPembinaan_upload' => $dokumen
        );
        $this->db->where('materiPembinaan_id', $materiPembinaanID);
        $this->db->update('materiPembinaan', $data);
        return true;
    }

    function updateDataBankSoal($bankSoal, $dokumen, $bankSoalID)
    {
        $data = array(
            'bankSoal_name' => $bankSoal,
            'bankSoal_upload' => $dokumen
        );
        $this->db->where('bankSoal_id', $bankSoalID);
        $this->db->update('bankSoal', $data);
        return true;
    }
}
