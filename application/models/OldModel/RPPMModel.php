<?php defined('BASEPATH') or exit('No direct script access allowed');

class RPPMMODEL extends CI_Model
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
                'field' => 'rppmProgram',
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
        $result = $this->db->query("SELECT sc.CLASS_ID,sc.CLASS_NAME, r.* FROM TBL_RPPM r INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID WHERE RPPM_ID=$id")->row();
        return $result;
    }

    function getData2($id)
    {
        $result = $this->db->query("SELECT sc.CLASS_ID,sc.CLASS_NAME,sc.CLASS_LEVEL, r.* FROM TBL_RPPM r INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=r.CLASS_ID WHERE RPPM_ID=$id");
        return $result;
    }

    // Data Table RPPM
    // start datatables
    var $column_order_rppm = array(null, 'TBL_SCHOOLCLASS.CLASS_NAME', 'TBL_RPPM.RPPM_STUDYYEAR', 'TBL_RPPM.RPPM_SEMESTER', 'TBL_RPPM.RPPM_WEEK', 'TBL_RPPM.RPPM_MONTH', 'TBL_RPPM.RPPM_THEME'); //set column field database for datatable orderable
    var $column_search_rppm = array('TBL_RPPM.RPPM_THEME', 'TBL_RPPM.RPPM_WEEK', 'TBL_RPPM.RPPM_SEMESTER'); //set column field database for datatable searchable
    var $order_rppm = array('TBL_RPPM.RPPM_ID' => 'desc'); // default order 


    private function _get_datatables_query_rppm()
    {
        $this->db->select('TBL_RPPM.*, TBL_SCHOOLCLASS.CLASS_LEVEL as CLASS_LEVEL, TBL_SCHOOLCLASS.CLASS_NAME as CLASS_NAME');
        $this->db->from('TBL_RPPM');
        $this->db->join('TBL_SCHOOLCLASS', 'TBL_RPPM.CLASS_ID = TBL_SCHOOLCLASS.CLASS_ID');
        $i = 0;

        foreach ($this->column_search_rppm as $item) // looping awal
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

                if (count($this->column_search_rppm) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_rppm[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_rppm)) {
            $order = $this->order_rppm;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_rppm()
    {
        $this->_get_datatables_query_rppm();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_rppm()
    {
        $this->_get_datatables_query_rppm();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_rppm()
    {
        $this->db->from('TBL_RPPM');
        return $this->db->count_all_results();
    }
    public function deleteMultiple_ajax($rppmID, $jmlData)
    {
        for ($i = 0; $i < $jmlData; $i++) {
            $this->db->delete('TBL_RPPM', ['RPPM_ID' => $rppmID[$i]]);
        }
        return true;
    }

    public function hapusRPPM_ajax($rppmID)
    {
        return $this->db->delete('TBL_RPPM', ['RPPM_ID' => $rppmID]);
    }
    public function hapusRPPMActivity_ajax($rppmActID)
    {
        return $this->db->delete('TBL_RPPMACTIVITY', ['RPPMACTIVITY_ID' => $rppmActID]);
    }
    public function hapusRPPMLearning_ajax($rppmLearnID)
    {
        return $this->db->delete('TBL_RPPMLEARNING', ['RPPMLEARNING_ID' => $rppmLearnID]);
    }
}
