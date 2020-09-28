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
        $query = $this->db->query("SELECT *FROM TBL_NEWSPOST WHERE NP_ID='$id'")->row();
        return $query;
    }


    function simpan_upload($judul, $tanggal, $expire, $isi, $image = '', $video = '')
    {
        if ($image == '') {
            $data = array(
                'NP_TITLE' => $judul,
                'NP_POSTDATE' => $tanggal,
                'NP_EXPDATE' => $expire,
                'NP_CONTENT' => $isi,
                'NP_VIDEOLINK' => $video,
                'NP_IMAGELINK' => $image
            );
        } else {
            $data = array(
                'NP_TITLE' => $judul,
                'NP_POSTDATE' => $tanggal,
                'NP_EXPDATE' => $expire,
                'NP_CONTENT' => $isi,
                'NP_IMAGELINK' => $image
            );
        }

        $result = $this->db->insert('TBL_NEWSPOST', $data);
        return $result;
    }


    public function hapusBerita_ajax($berita)
    {
        return $this->db->delete('TBL_NEWSPOST', ['NP_ID' => $berita]);
    }
}
