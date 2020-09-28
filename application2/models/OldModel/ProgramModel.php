<?php defined('BASEPATH') or exit('No direct script access allowed');

class ProgramModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;



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
        $result = $this->db->query("SELECT sc.CLASS_NAME,sc.CLASS_LEVEL, pm.* FROM TBL_PROMES pm  INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=pm.CLASS_ID WHERE PROMES_ID=$id")->row();
        return $result;
    }


    function getDataKelas()
    {
        $result = $this->db->query("SELECT
        *
    FROM
        tbl_schoolclass
        INNER JOIN
        tbl_school
        ON 
        -- Where Berdasarkan Session
            tbl_schoolclass.SCH_ID = tbl_school.SCH_ID ")->result_array();
        return $result;
    }

    function getDataPromes()
    {
        $result = $this->db->query("SELECT
        *
        FROM
            tbl_promes
            INNER JOIN
            tbl_schoolclass
            ON 
            tbl_promes.CLASS_ID = tbl_schoolclass.CLASS_ID")->result_array();
        return $result;
    }

    function getDataTheme()
    {
        $result = $this->db->query("SELECT
        *
        FROM
            tbl_promes_theme
            INNER JOIN
            tbl_promes
            ON 
            tbl_promes_theme.PROMES_ID = tbl_promes.PROMES_ID")->result_array();
        return $result;
    }



    function getTablePromes()
    {
        $result = $this->db->query("SELECT
        *
        FROM
            tbl_promes
            INNER JOIN
            tbl_schoolclass
            ON 
            tbl_promes.CLASS_ID = tbl_schoolclass.CLASS_ID");
        return $result;
    }



    // Hapus Ajax
    public function hapusdataProgram($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('TBL_PROMES');
    }

    public function promesEdit($id)
    {
        $query = $this->db->query("SELECT sc.CLASS_NAME,sc.CLASS_LEVEL, pm.* FROM TBL_PROMES pm  INNER JOIN TBL_SCHOOLCLASS sc ON sc.CLASS_ID=pm.CLASS_ID WHERE PROMES_ID=$id");
        return $query->row_array();
    }



    // start datatables
    var $column_order = array(null, 'TBL_PROMES.CLASS_ID', 'TBL_PROMES.PROMES_SEMESTER', 'TBL_PROMES.PROMES_YEAR', 'TBL_PROMES.PROMES_STRATEGY'); //set column field database for datatable orderable
    var $column_search = array('TBL_PROMES.PROMES_SEMESTER', 'TBL_PROMES.PROMES_YEAR', 'TBL_PROMES.PROMES_STRATEGY'); //set column field database for datatable searchable
    var $order = array('TBL_PROMES.CLASS_ID' => 'asc'); // default order 


    private function _get_datatables_query()
    {

        $this->db->select('TBL_PROMES.*, TBL_SCHOOLCLASS.CLASS_NAME as CLASS_NAME, TBL_SCHOOLCLASS.CLASS_LEVEL as CLASS_LEVEL');
        $this->db->from('TBL_PROMES');
        $this->db->join('TBL_SCHOOLCLASS', 'TBL_PROMES.CLASS_ID = TBL_SCHOOLCLASS.CLASS_ID');
        $i = 0;

        foreach ($this->column_search as $item) // looping awal
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

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('TBL_PROMES');
        return $this->db->count_all_results();
    }

    public function hapusData_ajax($promesID)
    {
        return $this->db->delete('TBL_PROMES', ['PROMES_ID' => $promesID]);
    }

    public function deleteMultiple_ajax($promesID, $jmlData)
    {
        for ($i = 0; $i < $jmlData; $i++) {
            $this->db->delete('TBL_PROMES', ['PROMES_ID' => $promesID[$i]]);
        }
        return true;
    }


    // Tema Model

    // start datatables
    var $column_order_tema = array(null, 'TBL_SCHOOLCLASS.CLASS_NAME', 'TBL_PROMES_THEME.THEME_THEME', 'TBL_PROMES_THEME.THEME_MONTHLY_EVALUATION'); //set column field database for datatable orderable
    var $column_search_tema = array('TBL_PROMES.PROMES_SEMESTER', 'TBL_PROMES.PROMES_YEAR', 'TBL_PROMES.PROMES_STRATEGY'); //set column field database for datatable searchable
    var $order_tema = array('TBL_PROMES_THEME.THEME_ID' => 'asc'); // default order 


    private function _get_datatables_query_tema()
    {
        $this->db->select('TBL_PROMES_THEME.*, TBL_PROMES.*, TBL_SCHOOLCLASS.CLASS_LEVEL as CLASS_LEVEL, TBL_SCHOOLCLASS.CLASS_NAME as CLASS_NAME');
        $this->db->from('TBL_PROMES_THEME');
        $this->db->join('TBL_PROMES', 'TBL_PROMES.PROMES_ID = TBL_PROMES_THEME.PROMES_ID');
        $this->db->join('TBL_SCHOOLCLASS', 'TBL_PROMES.CLASS_ID = TBL_SCHOOLCLASS.CLASS_ID');
        $i = 0;

        foreach ($this->column_search_tema as $item) // looping awal
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

                if (count($this->column_search_tema) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_tema[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_tema)) {
            $order = $this->order_tema;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_tema()
    {
        $this->_get_datatables_query_tema();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_tema()
    {
        $this->_get_datatables_query_tema();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_tema()
    {
        $this->db->from('TBL_PROMES_THEME');
        return $this->db->count_all_results();
    }

    public function hapusTemaData_ajax($themeID)
    {
        return $this->db->delete('TBL_PROMES_THEME', ['THEME_ID' => $themeID]);
    }

    public function deleteTemaMultiple_ajax($themeID, $jmlData)
    {
        for ($i = 0; $i < $jmlData; $i++) {
            $this->db->delete('TBL_PROMES_THEME', ['THEME_ID' => $themeID[$i]]);
        }
        return true;
    }


    // Sub Tema
    public function hapusSubTemaData_ajax($subTheme)
    {
        return $this->db->delete('TBL_PROMES_SUBTHEME', ['SUBTHEME_ID' => $subTheme]);
    }
    // Tujuans
    public function hapusTujuanData_ajax($goal)
    {
        return $this->db->delete('TBL_PROMES_GOAL', ['GOAL_ID' => $goal]);
    }
    public function hapusKompetensiData_ajax($competency)
    {
        return $this->db->delete('TBL_PROMES_COMPETENCY', ['COMPETENCY_ID' => $competency]);
    }
}
