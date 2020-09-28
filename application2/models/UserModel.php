<?php defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{


    public $product_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function hapusAgama_ajax($agamaID)
    {
        return $this->db->delete('ref_agama', ['agama_kd' => $agamaID]);
    }
<<<<<<< HEAD
=======


    function get_data($data){
        $this->db->join('dat_profile', 'dat_profile.profile_kd = dat_user.profile_kd', 'left');
        // $this->db->join('ref_jenis_user', 'dat_profile.jns_user_kd = ref_jenis_user.jns_user_kd', 'left');
        $this->db->join('ref_agama', 'dat_profile.agama_kd = ref_agama.agama_kd', 'left');
        $this->db->join('ref_kecamatan', 'dat_profile.kecamatan_kd = ref_kecamatan.kecamatan_kd', 'left');
        $this->db->join('anggota_kelas', 'anggota_kelas.profile_kd = dat_profile.profile_kd', 'left');
        $this->db->join('ref_jenis_user', 'dat_profile.jns_user_kd = ref_jenis_user.jns_user_kd', 'left');
        return $this->db->get_where('dat_user', $data)->row();
    }

>>>>>>> 1425fa7f19ec4b3b216007223877c59eace7f5b7
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function hapusUserPermanen_ajax($userID)
    {
        return $this->db->delete('dat_user', ['user_kd' => $userID]);
    }

    function simpanProfile($userGroup = '', $nik = '', $nama_depan = '', $nama_tengah = '', $nama_belakang = '', $agama = '', $tempat_lahir = '', $tanggalLahir = '', $jenisKelamin = '', $provinsi = '', $kabupaten = '', $kecamatan = '', $alamat = '', $kelurahan = '', $kodePos = '', $telp = '', $email = '', $keterangan_jabatan = '', $image)
    {

        $data = array(
            'jns_user_kd' => $userGroup,
            'profile_nomor_id' => $nik,
            'profile_nm_1' => $nama_depan,
            'profile_nm_2' => $nama_tengah,
            'profile_nm_3' => $nama_belakang,
            'agama_kd' => $agama,
            'profile_tempat_lahir' => $tempat_lahir,
            'profile_tgl_lahir' => $tanggalLahir,
            'profile_jns_kelamin' => $jenisKelamin,
            'propinsi_kd' => $provinsi,
            'dati2_kd' => $kabupaten,
            'kecamatan_kd' => $kecamatan,
            'profile_alamat' => $alamat,
            'profile_kelurahan' => $kelurahan,
            'profile_kd_pos' => $kodePos,
            'profile_telp' => $telp,
            'profile_email' => $email,
            'profile_foto' => $image,
            'profile_ket_jabatan' => $keterangan_jabatan,
            'profile_status' => 1
        );

        $result = $this->db->insert('dat_profile', $data);
        return $result;
    }

    function updateProfile($userGroup = '', $nik = '', $nama_depan = '', $nama_tengah = '', $nama_belakang = '', $agama = '', $tempat_lahir = '', $tanggalLahir = '', $jenisKelamin = '', $provinsi = '', $kabupaten = '', $kecamatan = '', $alamat = '', $kelurahan = '', $kodePos = '', $telp = '', $email = '', $keterangan_jabatan = '', $image = '', $profile)
    {

        $data = array(
            'jns_user_kd' => $userGroup,
            'profile_nomor_id' => $nik,
            'profile_nm_1' => $nama_depan,
            'profile_nm_2' => $nama_tengah,
            'profile_nm_3' => $nama_belakang,
            'agama_kd' => $agama,
            'profile_tempat_lahir' => $tempat_lahir,
            'profile_tgl_lahir' => $tanggalLahir,
            'profile_jns_kelamin' => $jenisKelamin,
            'propinsi_kd' => $provinsi,
            'dati2_kd' => $kabupaten,
            'kecamatan_kd' => $kecamatan,
            'profile_alamat' => $alamat,
            'profile_kelurahan' => $kelurahan,
            'profile_kd_pos' => $kodePos,
            'profile_telp' => $telp,
            'profile_email' => $email,
            'profile_foto' => $image,
            'profile_ket_jabatan' => $keterangan_jabatan,
            'profile_status' => 1
        );
        $this->db->where('profile_kd', $profile);
        $this->db->update('dat_profile', $data);
        return true;
    }
}