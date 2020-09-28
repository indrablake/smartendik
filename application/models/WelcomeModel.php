<?php
class WelcomeModel extends CI_Model
{

    function get_kabupaten($id)
    {
        $hasil = $this->db->query("SELECT * FROM ref_dati2 where propinsi_kd='$id' ORDER BY dati2_nm ASC");
        return $hasil->result();
    }
    function get_kecamatan($id_provinsi, $id_kabupaten)
    {
        $hasilKecamatan = $this->db->query("SELECT * FROM ref_kecamatan where propinsi_kd='$id_provinsi' and dati2_kd='$id_kabupaten' ORDER BY kecamatan_nm ASC");
        return $hasilKecamatan->result();
    }

    function simpanProfile($userGroup = '', $nip, $nik = '', $nama_depan = '', $nama_tengah = '', $nama_belakang = '', $agama = '', $tempat_lahir = '', $tanggalLahir = '', $jenisKelamin = '', $provinsi = '', $kabupaten = '', $kecamatan = '', $alamat = '', $kelurahan = '', $kodePos = '', $telp = '', $email = '', $pendidikanTerakhir = '', $nuptk, $nrg)
    {

        $data = array(
            'jns_user_kd' => $userGroup,
            'profile_nomor_id' => $nik,
            'profile_nip' => $nip,
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
            'pendidikan_terakhir' => $pendidikanTerakhir,
            'profile_nuptk' => $nuptk,
            'profile_nrg' => $nrg,
            'profile_status' => 0
        );

        $result = $this->db->insert('dat_profile', $data);
        return $result;
    }
}
