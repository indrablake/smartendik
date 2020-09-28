<?php defined('BASEPATH') or exit('No direct script access allowed');

class RPPHMODEL extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function rulesProgramSemester()
    {
        return [
            [
                'field' => 'namaSekolah',
                'label' => 'Nama Sekolah',
                'rules' => 'required'
            ],

            [
                'field' => 'namaKelas',
                'label' => 'Nama Kelas',
                'rules' => 'required'
            ],

            [
                'field' => 'semesterProgram',
                'label' => 'Program Semester',
                'rules' => 'required'
            ],

            [
                'field' => 'temaProgram',
                'label' => 'Tema Program Semester',
                'rules' => 'required'
            ],

            [
                'field' => 'evaluasiNilaiProgram',
                'label' => 'Evaluasi Nilai Program Semester',
                'rules' => 'required'
            ]
        ];
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

    function getData($id)
    {
        $result = $this->db->query("SELECT sc.CLASS_ID,sc.CLASS_NAME, r.* FROM TBL_RPPH r INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID WHERE RPPH_ID=$id")->row();
        return $result;
    }

    function getData2($id)
    {
        $result = $this->db->query("SELECT sc.CLASS_ID,sc.CLASS_LEVEL,sc.CLASS_NAME, r.* FROM TBL_RPPH r INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID WHERE RPPH_ID=$id");
        return $result;
    }


    // Ajax

    // Data Table RPPH
    // start datatables
    var $column_order_rpph = array(null, 'TBL_SCHOOLCLASS.CLASS_NAME', 'TBL_RPPH.RPPH_STUDYYEAR', 'TBL_RPPH.RPPH_SEMESTER', 'TBL_RPPH.RPPH_WEEK', 'TBL_RPPH.RPPH_MONTH', 'TBL_RPPH.RPPH_THEME'); //set column field database for datatable orderable
    var $column_search_rpph = array('TBL_RPPH.RPPH_THEME', 'TBL_RPPH.RPPH_SUBTHEME', 'TBL_RPPH.RPPH_WEEK', 'TBL_RPPH.RPPH_SEMESTER'); //set column field database for datatable searchable
    var $order_rpph = array('TBL_RPPH.RPPH_ID' => 'desc'); // default order 


    private function _get_datatables_query_rpph()
    {
        $this->db->select('TBL_RPPH.*, TBL_SCHOOLCLASS.CLASS_LEVEL as CLASS_LEVEL, TBL_SCHOOLCLASS.CLASS_NAME as CLASS_NAME');
        $this->db->from('TBL_RPPH');
        $this->db->join('TBL_SCHOOLCLASS', 'TBL_RPPH.CLASS_ID = TBL_SCHOOLCLASS.CLASS_ID');
        $i = 0;

        foreach ($this->column_search_rpph as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search_rpph) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_rpph[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_rpph)) {
            $order = $this->order_rpph;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_rpph()
    {
        $this->_get_datatables_query_rpph();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_rpph()
    {
        $this->_get_datatables_query_rpph();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_rpph()
    {
        $this->db->from('TBL_RPPH');
        return $this->db->count_all_results();
    }
    public function deleteMultiple_ajax($rpphID, $jmlData)
    {
        for ($i = 0; $i < $jmlData; $i++) {
            $this->db->delete('TBL_RPPH', ['RPPH_ID' => $rpphID[$i]]);
        }
        return true;
    }

    public function hapusRPPH_ajax($rpphID)
    {
        return $this->db->delete('TBL_RPPH', ['RPPH_ID' => $rpphID]);
    }
    public function hapusRPPHActivity_ajax($rpphActID)
    {
        return $this->db->delete('TBL_RPPHACTIVITY', ['RPPHACTIVITY_ID' => $rpphActID]);
    }
    public function hapusRPPHLearning_ajax($rpphLearnID)
    {
        return $this->db->delete('TBL_RPPHLEARNING', ['RPPHLEARNING_ID' => $rpphLearnID]);
    }

    public function hapusRPPHTechnique_ajax($rpphTeknikID)
    {
        return $this->db->delete('TBL_RPPHVALUATIONTECHNIQUE', ['RPPHVALTECH_ID' => $rpphTeknikID]);
    }
}
