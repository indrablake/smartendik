<?php defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function rulesUser()
    {
        return [
            [
                'field' => 'nik',
                'label' => 'NIK',
                'rules' => 'required'
            ],

            [
                'field' => 'nama_lengkap',
                'label' => 'Nama',
                'rules' => 'required'
            ],

            [
                'field' => 'phone',
                'label' => 'Telp',
                'rules' => 'required'
            ],
            [
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'required'
            ],
            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required'
            ],
        ];
    }
    // public function rulesUser()
    // {
    //     return [
    //         [
    //             'field' => 'nik',
    //             'label' => 'NIK',
    //             'rules' => 'required'
    //         ],

    //         [
    //             'field' => 'nama_lengkap',
    //             'label' => 'Nama',
    //             'rules' => 'required'
    //         ],

    //         [
    //             'field' => 'phone',
    //             'label' => 'Telp',
    //             'rules' => 'required'
    //         ],
    //         [
    //             'field' => 'email',
    //             'label' => 'E-mail',
    //             'rules' => 'required'
    //         ],
    //         [
    //             'field' => 'alamat',
    //             'label' => 'Alamat',
    //             'rules' => 'required'
    //         ],
    //     ];
    // }

    public function rulesUser2()
    {
        return [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|is_unique[TBL_USER.USER_NAME]'
            ],

            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            ]
        ];
    }

    public function rulesGrade()
    {
        return [
            [
                'field' => 'gradeUser',
                'label' => 'Grade User',
                'rules' => 'required|is_unique[tbl_schoolgrade.grade_name]'
            ],

        ];
    }

    public function rulesUserGroup()
    {
        return [
            [
                'field' => 'groupUser',
                'label' => 'Group User',
                'rules' => 'required|is_unique[TBL_USERGROUP.UG_NAME]'
            ],

        ];
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function input_user_group($data, $table)
    {
        $this->db->insert($table, $data);
    }
}
