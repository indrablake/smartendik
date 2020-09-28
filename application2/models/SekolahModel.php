<?php defined('BASEPATH') or exit('No direct script access allowed');

class SekolahModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;


    function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    // Sekolah
    function simpanSekolah($jenjang_Sekolah = '', $npsn_sekolah = '', $nama_sekolah = '', $status_sekolah = '', $yayasan_sekolah = '', $provinsi = '', $kecamatan = '', $kabupaten = '', $alamat_sekolah = '', $kelurahan = '', $kode_pos = '', $telp_sekolah = '', $fax_sekolah = '', $email_sekolah = '', $website_sekolah = '', $facebook_sekolah = '', $instagram_sekolah = '', $twitter_sekolah = '', $image, $header1 = '', $header2 = '', $header3 = '')
    {

        $data = array(
            'jenjang_kd' => $jenjang_Sekolah,
            'sekolah_npsn' => $npsn_sekolah,
            'sekolah_nm' => $nama_sekolah,
            'sekolah_alamat' => $alamat_sekolah,
            'sekolah_status' => $status_sekolah,
            'sekolah_yayasan' => $yayasan_sekolah,
            'propinsi_kd' => $provinsi,
            'dati2_kd' => $kabupaten,
            'kecamatan_kd' => $kecamatan,
            'sekolah_alamat' => $alamat_sekolah,
            'sekolah_kelurahan' => $kelurahan,
            'sekolah_kd_pos' => $kode_pos,
            'sekolah_telp' => $telp_sekolah,
            'sekolah_fax' => $fax_sekolah,
            'sekolah_email' => $email_sekolah,
            'sekolah_website' => $website_sekolah,
            'sekolah_facebook' => $facebook_sekolah,
            'sekolah_instagram' => $instagram_sekolah,
            'sekolah_twitter' => $twitter_sekolah,
            'sekolah_logo' => $image,
            'sekolah_header1' => $header1,
            'sekolah_header2' => $header2,
            'sekolah_header3' => $header3,
        );

        $result = $this->db->insert('dat_sekolah', $data);
        return $result;
    }


    function updateSekolah($jenjang_Sekolah = '', $npsn_sekolah = '', $nama_sekolah = '', $status_sekolah = '', $yayasan_sekolah = '', $provinsi = '', $kecamatan = '', $kabupaten = '', $alamat_sekolah = '', $kelurahan = '', $kode_pos = '', $telp_sekolah = '', $fax_sekolah = '', $email_sekolah = '', $website_sekolah = '', $facebook_sekolah = '', $instagram_sekolah = '', $twitter_sekolah = '', $image, $header1 = '', $header2 = '', $header3 = '', $sekolahID = '')
    {

        $data = array(
            'jenjang_kd' => $jenjang_Sekolah,
            'sekolah_npsn' => $npsn_sekolah,
            'sekolah_nm' => $nama_sekolah,
            'sekolah_alamat' => $alamat_sekolah,
            'sekolah_status' => $status_sekolah,
            'sekolah_yayasan' => $yayasan_sekolah,
            'propinsi_kd' => $provinsi,
            'dati2_kd' => $kabupaten,
            'kecamatan_kd' => $kecamatan,
            'sekolah_alamat' => $alamat_sekolah,
            'sekolah_kelurahan' => $kelurahan,
            'sekolah_kd_pos' => $kode_pos,
            'sekolah_telp' => $telp_sekolah,
            'sekolah_fax' => $fax_sekolah,
            'sekolah_email' => $email_sekolah,
            'sekolah_website' => $website_sekolah,
            'sekolah_facebook' => $facebook_sekolah,
            'sekolah_instagram' => $instagram_sekolah,
            'sekolah_twitter' => $twitter_sekolah,
            'sekolah_logo' => $image,
            'sekolah_header1' => $header1,
            'sekolah_header2' => $header2,
            'sekolah_header3' => $header3,
        );

        $this->db->where('sekolah_kd', $sekolahID);
        $this->db->update('dat_sekolah', $data);
        return true;
    }


    public function hapusSekolah_ajax($sekolahID)
    {
        return $this->db->delete('dat_sekolah', ['sekolah_kd' => $sekolahID]);
    }
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
