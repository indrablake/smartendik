<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['Rumah'] = 'Home/index';
// Sekolah
$route['listSekolah'] = 'Sekolah/listSekolah';
$route['tambahSekolah'] = 'Sekolah/tambahSekolah';
$route['listGrade'] = 'Sekolah/listGrade';
$route['tambahGrade'] = 'Sekolah/tambahGrade';
$route['simpanSekolah'] = 'Sekolah/simpanSekolah';
$route['simpanGrade'] = 'Sekolah/simpanGrade';
$route['editGrade'] = 'Sekolah/editGrade';

$route['listKelas'] = 'Sekolah/listKelas';
$route['tambahKelas'] = 'Sekolah/tambahKelas';
$route['simpanKelas'] = 'Sekolah/simpanKelas';
$route['editKelas'] = 'Sekolah/editKelas';
// User
$route['listUser'] = 'User/listUser';
$route['deleteUser'] = 'User/deleteUser';
$route['tambahUser'] = 'User/tambahUser';
$route['tambahProfile'] = 'User/tambahProfile';
$route['simpanUser'] = 'User/simpanUser';
$route['detailProfile'] = 'User/detailProfile';
$route['simpanProfile'] = 'User/updateProfile';

$route['listUserGroup'] = 'User/listUserGroup';
$route['tambahUserGroup'] = 'User/tambahUserGroup';
$route['simpanUserGroup'] = 'User/simpanUserGroup';
$route['editUserGroup'] = 'User/editUserGroup';

// Berita
$route['listBerita'] = 'Berita/listBerita';
$route['tambahBerita'] = 'Berita/tambahBerita';
$route['simpanBerita'] = 'Berita/simpanBeritaAksi';
$route['editBerita'] = 'Berita/editBerita';
$route['editBeritaAksi'] = 'Berita/editBeritaAksi';
$route['deleteBerita'] = 'Berita/deleteBerita';


// Program Semester
$route['listProgramSemester'] = 'Program/listProgram';
$route['tambahProgramSemester'] = 'Program/tambahProgram';
$route['simpanProgramSemester'] = 'Program/simpanProgram';
$route['editProgramSemester'] = 'Program/editProgram';
$route['updateProgramSemester'] = 'Program/updateProgram';
$route['deleteProgramSemester'] = 'Program/deleterogram';



// Tema Program Semester
$route['listTemaProgramSemester'] = 'Program/listTemaProgram';
$route['tambahTemaProgramSemester'] = 'Program/tambahTemaProgram';
$route['simpanTemaProgramSemester'] = 'Program/simpanTemaProgram';
$route['editTemaProgramSemester'] = 'Program/editTemaProgram';
$route['updateTemaProgramSemester'] = 'Program/updateTemaProgram';
$route['deleteTemaProgramSemester'] = 'Program/deleteTemaProgram';

// Sub Tema Program Semester
$route['listSubTemaProgramSemester'] = 'Program/listSubTemaProgram';
$route['tambahSubTemaProgramSemester'] = 'Program/tambahSubTemaProgram';
$route['simpanSubTemaProgramSemester'] = 'Program/simpanSubTemaProgram';
$route['editSubTemaProgramSemester'] = 'Program/editSubTemaProgram';
$route['updateSubTemaProgramSemester'] = 'Program/updateSubTemaProgram';
$route['deleteSubTemaProgramSemester'] = 'Program/deleteSubTemaProgram';


// Program Semester
$route['listTujuanProgramSemester'] = 'Program/listTujuanProgram';
$route['tambahTujuanProgramSemester'] = 'Program/tambahTujuanProgram';
$route['simpanTujuanProgramSemester'] = 'Program/simpanTujuanProgram';
$route['editTujuanProgramSemester'] = 'Program/editTujuanProgram';
$route['updateTujuanProgramSemester'] = 'Program/updateTujuanProgram';
$route['deleteTujuanProgramSemester'] = 'Program/deleteTujuanProgram';

// Kompetensi Semester
$route['listKompetensiProgramSemester'] = 'Program/listKompetensiProgram';
$route['tambahKompetensiProgramSemester'] = 'Program/tambahKompetensiProgram';
$route['simpanKompetensiProgramSemester'] = 'Program/simpanKompetensiProgram';
$route['editKompetensiProgramSemester'] = 'Program/editKompetensiProgram';
$route['updateKompetensiProgramSemester'] = 'Program/updateKompetensiProgram';
$route['deleteKompetensiProgramSemester'] = 'Program/deleteKompetensiProgram';



// RPPM 
$route['listRPPM'] = 'RPPM/listRPPM';
$route['tambahRPPM'] = 'RPPM/tambahRPPM';
$route['simpanRPPM'] = 'RPPM/simpanRPPM';
$route['editRPPM'] = 'RPPM/editRPPM';
$route['updateRPPM'] = 'RPPM/updateRPPM';
$route['deleteRPPM'] = 'RPPM/deleteRPPM';

// RPPM Activity
$route['listRPPMActivity'] = 'RPPM/listRPPMActivity';
$route['tambahRPPMActivity'] = 'RPPM/tambahRPPMActivity';
$route['simpanRPPMActivity'] = 'RPPM/simpanRPPMActivity';
$route['editRPPMActivity'] = 'RPPM/editRPPMActivity';
$route['updateRPPMActivity'] = 'RPPM/updateRPPMActivity';
$route['deleteRPPMActivity'] = 'RPPM/deleteRPPMActivity';

// RPPM Learning
$route['listRPPMLearning'] = 'RPPM/listRPPMLearning';
$route['tambahRPPMLearning'] = 'RPPM/tambahRPPMLearning';
$route['simpanRPPMLearning'] = 'RPPM/simpanRPPMLearning';
$route['editRPPMLearning'] = 'RPPM/editRPPMLearning';
$route['updateRPPMLearning'] = 'RPPM/updateRPPMLearning';
$route['deleteRPPMLearning'] = 'RPPM/deleteRPPMLearning';




// RPPH 
$route['listRPPH'] = 'RPPH/listRPPH';
$route['tambahRPPH'] = 'RPPH/tambahRPPH';
$route['simpanRPPH'] = 'RPPH/simpanRPPH';
$route['editRPPH'] = 'RPPH/editRPPH';
$route['updateRPPH'] = 'RPPH/updateRPPH';
$route['deleteRPPH'] = 'RPPH/deleteRPPH';

// RPPH Activity
$route['listRPPHActivity'] = 'RPPH/listRPPHActivity';
$route['tambahRPPHActivity'] = 'RPPH/tambahRPPHActivity';
$route['simpanRPPHActivity'] = 'RPPH/simpanRPPHActivity';
$route['editRPPHActivity'] = 'RPPH/editRPPHActivity';
$route['updateRPPHActivity'] = 'RPPH/updateRPPHActivity';
$route['deleteRPPHActivity'] = 'RPPH/deleteRPPHActivity';

// RPPH Learning
$route['listRPPHLearning'] = 'RPPH/listRPPHLearning';
$route['tambahRPPHLearning'] = 'RPPH/tambahRPPHLearning';
$route['simpanRPPHLearning'] = 'RPPH/simpanRPPHLearning';
$route['editRPPHLearning'] = 'RPPH/editRPPHLearning';
$route['updateRPPHLearning'] = 'RPPH/updateRPPHLearning';
$route['deleteRPPHLearning'] = 'RPPH/deleteRPPHLearning';


// RPPH Material
$route['listRPPHMaterial'] = 'RPPH/listRPPHMaterial';
$route['tambahRPPHMaterial'] = 'RPPH/tambahRPPHMaterial';
$route['simpanRPPHMaterial'] = 'RPPH/simpanRPPHMaterial';
$route['editRPPHMaterial'] = 'RPPH/editRPPHMaterial';
$route['updateRPPHMaterial'] = 'RPPH/updateRPPHMaterial';
$route['deleteRPPHMaterial'] = 'RPPH/deleteRPPHMaterial';


// RPPH ValIndicator
$route['listRPPHValIndicator'] = 'RPPH/listRPPHValIndicator';
$route['tambahRPPHValIndicator'] = 'RPPH/tambahRPPHValIndicator';
$route['simpanRPPHValIndicator'] = 'RPPH/simpanRPPHValIndicator';
$route['editRPPHValIndicator'] = 'RPPH/editRPPHValIndicator';
$route['updateRPPHValIndicator'] = 'RPPH/updateRPPHValIndicator';
$route['updateRPPHValDetail'] = 'RPPH/updateRPPHValDetail';
$route['simpanRPPHValDetail'] = 'RPPH/simpanRPPHValDetail';
$route['deleteRPPHValIndicator'] = 'RPPH/deleteRPPHValIndicator';

// RPPH ValTechnique
$route['listRPPHValTechnique'] = 'RPPH/listRPPHValTechnique';
$route['tambahRPPHValTechnique'] = 'RPPH/tambahRPPHValTechnique';
$route['simpanRPPHValTechnique'] = 'RPPH/simpanRPPHValTechnique';
$route['editRPPHValTechnique'] = 'RPPH/editRPPHValTechnique';
$route['updateRPPHValTechnique'] = 'RPPH/updateRPPHValTechnique';
$route['deleteRPPHValTechnique'] = 'RPPH/deleteRPPHValTechnique';


// RPPH Val Indicator Detail
$route['listRPPHValIndicatorDetail'] = 'RPPH/listRPPHValIndicatorDetail';
$route['tambahRPPHValIndicatorDetail'] = 'RPPH/tambahRPPHValIndicatorDetail';
$route['simpanRPPHValIndicatorDetail'] = 'RPPH/simpanRPPHValIndicatorDetail';
$route['editRPPHValIndicatorDetail'] = 'RPPH/editRPPHValIndicatorDetail';
$route['updateRPPHValIndicatorDetail'] = 'RPPH/updateRPPHValIndicatorDetail';
$route['deleteRPPHValIndicatorDetail'] = 'RPPH/deleteRPPHValIndicatorDetail';

// RPPH Val Activity Detail
$route['listRPPHActivityDetail'] = 'RPPH/listRPPHActDetail';
$route['tambahRPPHActivityDetail'] = 'RPPH/tambahRPPHActDetail';
$route['simpanRPPHActivityDetail'] = 'RPPH/simpanRPPHActDetail';
$route['simpanDetailRPPHActivity'] = 'RPPH/simpanDetailRPPHActivity';
$route['editRPPHActivityDetail'] = 'RPPH/editRPPHActDetail';
$route['updateRPPHActivityDetail'] = 'RPPH/updateRPPHActDetail';
$route['deleteRPPHActivityDetail'] = 'RPPH/deleteRPPHActDetail';
$route['deleteRowDetail'] = 'RPPH/delete_detail_activity';

// Siswa 
$route['listSiswa'] = 'Siswa/listSiswa';
$route['tambahSiswa'] = 'Siswa/tambahSiswa';
$route['simpanSiswa'] = 'Siswa/simpanSiswa';
$route['editSiswa'] = 'Siswa/editSiswa';
$route['updateSiswa'] = 'Siswa/updateSiswa';
$route['deleteSiswa'] = 'Siswa/deleteSiswa';

// Religion
$route['listReligion'] = 'Siswa/listReligion';
$route['tambahReligion'] = 'Siswa/tambahReligion';
$route['simpanReligion'] = 'Siswa/simpanReligion';
$route['editReligion'] = 'Siswa/editReligion';
$route['updateReligion'] = 'Siswa/updateReligion';
$route['deleteReligion'] = 'Siswa/deleteReligion';

// Kelas Siswa
$route['listKelasSiswa'] = 'Siswa/listKelasSiswa';
$route['tambahKelasSiswa'] = 'Siswa/tambahKelasSiswa';
$route['simpanKelasSiswa'] = 'Siswa/simpanKelasSiswa';
$route['editKelasSiswa'] = 'Siswa/editKelasSiswa';
$route['updateKelasSiswa'] = 'Siswa/updateKelasSiswa';
$route['deleteKelasSiswa'] = 'Siswa/deleteKelasSiswa';


// Sekolah
$route['listSTPPATK'] = 'Sekolah/listSTPPATK';
$route['tambahSTPPATK'] = 'Sekolah/tambahSTPPATK';
$route['simpanSTPPATK'] = 'Sekolah/simpanSTPPATK';
$route['editSTPPATK'] = 'Sekolah/editSTPPATK';
$route['updateSTPPATK'] = 'Sekolah/updateSTPPATK';
$route['deleteSTPPATK'] = 'Sekolah/deleteSTPPATK';



// Login
$route['user_login'] = 'User/login';
$route['login'] = 'Welcome/login';
$route['logout'] = 'User/logout';
$route['dashboard'] = 'User/dashboard';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
