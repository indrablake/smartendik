<?php defined('BASEPATH') or exit('No direct script access allowed');

class BeritaModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function rulesBerita()
    {
        return [
            [
                'field' => 'file_berita',
                'label' => 'File Berita',
                'rules' => 'required'
            ]
        ];
    }

    function input_berita($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function getData($id)
    {
        $query = $this->db->query("SELECT *FROM TBL_NEWSPOST")->result_array();
        return $query;
    }

    function ambilData($id)
    {
        $query = $this->db->query("SELECT *FROM dat_berita WHERE berita_kd='$id'")->row();
        return $query;
    }


    function simpan_upload($judul, $user_kd, $tanggal, $expire, $isi, $image = '', $video = '')
    {
        if ($video == '') {
            $data = array(
                'user_kd' => $user_kd,
                'berita_judul' => $judul,
                'berita_tgl_kirim' => $tanggal,
                'berita_tgl_expired' => $expire,
                'berita_isi' => $isi,
                'berita_gambar' => $image,
                'berita_status' => 1
            );
        } else {
            $data = array(
                'user_kd' => $user_kd,
                'berita_judul' => $judul,
                'berita_tgl_kirim' => $tanggal,
                'berita_tgl_expired' => $expire,
                'berita_isi' => $isi,
                'berita_video' => $video,
                'berita_gambar' => $image,
                'berita_status' => 1
            );
        }

        $result = $this->db->insert('dat_berita', $data);
        return $result;
    }

    function updateData($judul, $user, $tanggal, $expire, $isi, $image = '', $video = '', $beritaID)
    {
        if ($image == '') {
            $data = array(
                'user_kd' => $user,
                'berita_judul' => $judul,
                'berita_tgl_kirim' => $tanggal,
                'berita_tgl_expired' => $expire,
                'berita_isi' => $isi,
                'berita_video' => $video
            );
        } else {
            $data = array(
                'user_kd' => $user,
                'berita_judul' => $judul,
                'berita_tgl_kirim' => $tanggal,
                'berita_tgl_expired' => $expire,
                'berita_isi' => $isi,
                'berita_gambar' => $image
            );
        }
        $this->db->where('berita_kd', $beritaID);
        $this->db->update('dat_berita', $data);
        return true;
    }


    public function hapusBerita_ajax($berita)
    {
        return $this->db->delete('TBL_NEWSPOST', ['NP_ID' => $berita]);
    }
}
