<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{


    public function index()
    {
        $this->load->library('mypdf');
        $query[] = null;
        unset($query[0]);
        $query['promes'] = "
					select p.PROMES_SEMESTER as 'semester',p.PROMES_YEAR as 'tahun_semester',pt.THEME_THEME as 'tema',pt.THEME_TIME_ALLOCATION as 'alokasi_waktu',
					ps.SUBTHEME_NAME as 'sub_tema',
					pt.THEME_MONTHLY_EVALUATION as 'evaluasi_penilaian' 
					from tbl_promes p
					left join tbl_promes_theme pt on pt.PROMES_ID = p.PROMES_ID  
					left join tbl_promes_subtheme ps on ps.THEME_ID = pt.THEME_ID 
					where pt.THEME_ID = 1000
					";
        $data['promes'] = $this->db->query($query['promes'])->result_array();
        $query['goal'] = "
		select pg.SUBTHEME_ID,COUNT(pg.SUBTHEME_ID) as 'cnt',pg.GOAL_ID,
		pg.GOAL_DESC as 'pencapaian'							
		from tbl_promes_goal pg
		left join tbl_promes_subtheme ps on pg.SUBTHEME_ID = ps.SUBTHEME_ID 
		where ps.SUBTHEME_ID =  '2000'
		GROUP BY pg.GOAL_ID
		ORDER BY COUNT(pg.SUBTHEME_ID) DESC
					";
        $data['goal'] = $this->db->query($query['goal'])->result_array();
        foreach ($data['goal'] as $key => $value) {
            $query['kompentensi'] = "select * FROM tbl_promes_competency WHERE GOAL_ID='" . $value['GOAL_ID'] . "'";
            $data['kompentensi'][$key] = $this->db->query($query['kompentensi'])->result_array();
        }
        #header("Content-Type: application/json");
        #echo json_encode($data['kompentensi']);
        $data['nama_file'] = "ok";
        $html = $this->load->view('Laporan/LapPromes', $data, TRUE);
        $this->mypdf->generate($html, $data['nama_file']);
    }
}
