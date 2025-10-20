<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'default'])->name('root');
Route::get('/kontak', [App\Http\Controllers\Frontend\FrontendController::class, 'contact'])->name('page.contact');
Route::get('/ptk', [App\Http\Controllers\Frontend\PtkController::class, 'index'])->name('ptk.index');

Route::prefix('page')->group(function () {
    Route::get('/detail/{slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'pagedetail'])->name('page.detail');
    // Route::get('/category/{slug}', App\Http\Livewire\Template\Frontend\Terasgreen\Page\Pagecategorylist::class)->name('page.category');
});
Route::prefix('program')->group(function () {
    Route::get('/detail/{slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'programdetail'])->name('program.detail');
});
Route::prefix('haribesar')->group(function () {
    Route::get('/detail/{slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'haribesardetail'])->name('haribesar.detail');
});

Route::prefix('fasilitas')->group(function () {
    Route::get('/detail/{slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'fasilitas'])->name('facility.detail');
});

Route::prefix('agenda')->group(function () {
    Route::get('/detail/{slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'agenda'])->name('agenda.detail');
});

Route::get('galleri-foto', [App\Http\Controllers\Frontend\FrontendController::class, 'fotoAll'])->name('foto.all');
Route::get('galleri-video', [App\Http\Controllers\Frontend\FrontendController::class, 'videoAll'])->name('video.all');

Route::prefix('editorial')->group(function () {
    Route::get('/detail/{slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'editorialdetail'])->name('editorial.detail');
    Route::get('', [App\Http\Controllers\Frontend\FrontendController::class, 'editorialall'])->name('editorial.all');
});

Route::get('berita/detail/{slug}',  [App\Http\Controllers\Frontend\PostController::class, 'beritadetail'])->name('post.detail');
Route::get('berita',  [App\Http\Controllers\Frontend\PostController::class, 'postnews'])->name('post.news');
Route::get('berita/kategori/{slug}',  [App\Http\Controllers\Frontend\PostController::class, 'postcategory'])->name('post.category');
Route::get('berita/tag/{slug}',  [App\Http\Controllers\Frontend\PostController::class, 'posttags'])->name('post.tag');

Route::get('blog/detail/{slug}',  [App\Http\Controllers\Frontend\BlogController::class, 'detail'])->name('blog.detail');
Route::get('blog',  [App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('blog.index');
Route::get('blog/kategori/{slug}',  [App\Http\Controllers\Frontend\BlogController::class, 'category'])->name('blog.category');

Route::middleware(['auth', 'verified', 'web'])->group(function () {
    Route::get('/backend/menu', [App\Http\Controllers\Backend\MenuController::class, 'index'])->name('backend.menu.index');

    // Dashboard
    Route::get('backend/home', [App\Http\Controllers\Backend\BackendController::class, 'index'])->name('backend.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Setting Web
    Route::get('backend/settings', [App\Http\Controllers\Backend\SettingController::class, 'setting'])->name('backend.settings');
    Route::post('backend/settings/create', [App\Http\Controllers\Backend\SettingController::class, 'createsetting'])->name('backend.settings.create');
    Route::post('backend/settings/store', [App\Http\Controllers\Backend\SettingController::class, 'storesetting'])->name('backend.settings.store');
    Route::get('backend/settings/{setting}/edit', [App\Http\Controllers\Backend\SettingController::class, 'editsetting'])->name('backend.settings.edit');
    Route::put('backend/settings/{setting}/update', [App\Http\Controllers\Backend\SettingController::class, 'updatesetting'])->name('backend.settings.update');

    // User
    Route::get('backend/users/index', [App\Http\Controllers\Backend\UserController::class, 'index'])->name('backend.users.index');
    Route::get('backend/users/create', [App\Http\Controllers\Backend\UserController::class, 'create'])->name('backend.users.create');
    Route::post('backend/users/store', [App\Http\Controllers\Backend\UserController::class, 'store'])->name('backend.users.store');
    Route::get('backend/users/{user}/edit', [App\Http\Controllers\Backend\UserController::class, 'edit'])->name('backend.users.edit');
    Route::put('backend/users/{user}/update', [App\Http\Controllers\Backend\UserController::class, 'update'])->name('backend.users.update');
    Route::get('backend/admin/profile', [App\Http\Controllers\Backend\BackendController::class, 'userprofile'])->name('backend.userprofile');

    // PTK
    Route::get('backend/pegawai/index', [App\Http\Controllers\Backend\PegawaiController::class, 'index'])->name('backend.pegawai.index');
    Route::get('backend/pegawai/create', [App\Http\Controllers\Backend\PegawaiController::class, 'create'])->name('backend.pegawai.create');
    Route::post('backend/pegawai/store', [App\Http\Controllers\Backend\PegawaiController::class, 'store'])->name('backend.pegawai.store');
    Route::get('backend/pegawai/{pegawai}/edit', [App\Http\Controllers\Backend\PegawaiController::class, 'edit'])->name('backend.pegawai.edit');
    Route::put('backend/pegawai/{pegawai}/update', [App\Http\Controllers\Backend\PegawaiController::class, 'update'])->name('backend.pegawai.update');

    // Hero
    Route::get('backend/heros', [App\Http\Controllers\Backend\HeroController::class, 'index'])->name('backend.heros.index');
    Route::get('backend/heros/create', [App\Http\Controllers\Backend\HeroController::class, 'create'])->name('backend.heros.create');
    Route::post('backend/heros/store', [App\Http\Controllers\Backend\HeroController::class, 'store'])->name('backend.heros.store');
    Route::get('backend/heros/{hero}/edit', [App\Http\Controllers\Backend\HeroController::class, 'edit'])->name('backend.heros.edit');
    Route::put('backend/heros/{hero}/update', [App\Http\Controllers\Backend\HeroController::class, 'update'])->name('backend.heros.update');

    // Permission
    Route::get('backend/permissions/index', [App\Http\Controllers\Backend\PermissionController::class, 'index'])->name('backend.permissions.index');

    // Role
    Route::get('backend/roles/index', [App\Http\Controllers\Backend\RoleController::class, 'index'])->name('backend.roles.index');
    Route::get('backend/roles/create', [App\Http\Controllers\Backend\RoleController::class, 'create'])->name('backend.roles.create');
    Route::post('backend/roles/store', [App\Http\Controllers\Backend\RoleController::class, 'store'])->name('backend.roles.store');
    Route::get('backend/roles/{role}/edit', [App\Http\Controllers\Backend\RoleController::class, 'edit'])->name('backend.roles.edit');
    Route::put('backend/roles/{role}/update', [App\Http\Controllers\Backend\RoleController::class, 'update'])->name('backend.roles.update');

    // Pagecategory
    Route::get('backend/pagecategories', [App\Http\Controllers\Backend\PageCategoryController::class, 'index'])->name('backend.pagecategories.index');
    Route::get('backend/pagecategories/create', [App\Http\Controllers\Backend\PageCategoryController::class, 'create'])->name('backend.pagecategories.create');
    Route::post('backend/pagecategories/store', [App\Http\Controllers\Backend\PageCategoryController::class, 'store'])->name('backend.pagecategories.store');
    Route::get('backend/pagecategories/{pagecategory}/edit', [App\Http\Controllers\Backend\PageCategoryController::class, 'edit'])->name('backend.pagecategories.edit');
    Route::post('backend/pagecategories/{pagecategory}/update', [App\Http\Controllers\Backend\PageCategoryController::class, 'update'])->name('backend.pagecategories.update');

    // Page
    Route::get('backend/pages', [App\Http\Controllers\Backend\PageController::class, 'index'])->name('backend.pages.index');
    Route::get('backend/pages/create', [App\Http\Controllers\Backend\PageController::class, 'create'])->name('backend.pages.create');
    Route::post('backend/pages/store', [App\Http\Controllers\Backend\PageController::class, 'store'])->name('backend.pages.store');
    Route::get('backend/pages/{page}/edit', [App\Http\Controllers\Backend\PageController::class, 'edit'])->name('backend.pages.edit');
    Route::post('backend/pages/{page}/update', [App\Http\Controllers\Backend\PageController::class, 'update'])->name('backend.pages.update');

    // PostCategory
    Route::get('backend/postcategories', [App\Http\Controllers\Backend\PostcategoryController::class, 'index'])->name('backend.postscategories.index');
    Route::get('backend/postcategories/create', [App\Http\Controllers\Backend\PostcategoryController::class, 'create'])->name('backend.postscategories.create');
    Route::post('backend/postcategories/store', [App\Http\Controllers\Backend\PostcategoryController::class, 'store'])->name('backend.postscategories.store');
    Route::get('backend/postcategories/{postcategory}/edit', [App\Http\Controllers\Backend\PostcategoryController::class, 'edit'])->name('backend.postscategories.edit');
    Route::post('backend/postcategories/{postcategory}/update', [App\Http\Controllers\Backend\PostcategoryController::class, 'update'])->name('backend.postscategories.update');

    // Tag
    Route::get('backend/tags', [App\Http\Controllers\Backend\TagController::class, 'index'])->name('backend.tags.index');

    // Socialmedia
    Route::get('backend/socialmedia', [App\Http\Controllers\Backend\SocialmediaController::class, 'index'])->name('backend.socialmedia.index');

    // Post
    Route::get('backend/posts', [App\Http\Controllers\Backend\PostController::class, 'index'])->name('backend.posts.index');
    Route::get('backend/posts/create', [App\Http\Controllers\Backend\PostController::class, 'create'])->name('backend.posts.create');
    Route::post('backend/posts/store', [App\Http\Controllers\Backend\PostController::class, 'store'])->name('backend.posts.store');
    Route::get('backend/posts/{post}/edit', [App\Http\Controllers\Backend\PostController::class, 'edit'])->name('backend.posts.edit');
    Route::put('backend/posts/{post}/update', [App\Http\Controllers\Backend\PostController::class, 'update'])->name('backend.posts.update');

    // Blog
    Route::get('backend/blog', [App\Http\Controllers\Backend\BlogController::class, 'index'])->name('backend.blog.index');
    Route::get('backend/blog/create', [App\Http\Controllers\Backend\BlogController::class, 'create'])->name('backend.blog.create');
    Route::post('backend/blog/store', [App\Http\Controllers\Backend\BlogController::class, 'store'])->name('backend.blog.store');
    Route::get('backend/blog/{blog}/edit', [App\Http\Controllers\Backend\BlogController::class, 'edit'])->name('backend.blog.edit');
    Route::put('backend/blog/{blog}/update', [App\Http\Controllers\Backend\BlogController::class, 'update'])->name('backend.blog.update');

    // Editorial
    Route::get('backend/editorials', [App\Http\Controllers\Backend\EditorialController::class, 'index'])->name('backend.editorials.index');
    Route::get('backend/editorials/create', [App\Http\Controllers\Backend\EditorialController::class, 'create'])->name('backend.editorials.create');
    Route::post('backend/editorials/store', [App\Http\Controllers\Backend\EditorialController::class, 'store'])->name('backend.editorials.store');
    Route::get('backend/editorials/{editorial}/edit', [App\Http\Controllers\Backend\EditorialController::class, 'edit'])->name('backend.editorials.edit');
    Route::put('backend/editorials/{editorial}/update', [App\Http\Controllers\Backend\EditorialController::class, 'update'])->name('backend.editorials.update');
    // Dukungan
    Route::get('backend/dukungan', [App\Http\Controllers\Backend\DukunganController::class, 'index'])->name('backend.dukungan.index');
    Route::get('backend/dukungan/create', [App\Http\Controllers\Backend\DukunganController::class, 'create'])->name('backend.dukungan.create');
    Route::post('backend/dukungan/store', [App\Http\Controllers\Backend\DukunganController::class, 'store'])->name('backend.dukungan.store');
    Route::get('backend/dukungan/{dukungan}/edit', [App\Http\Controllers\Backend\DukunganController::class, 'edit'])->name('backend.dukungan.edit');
    Route::put('backend/dukungan/{dukungan}/update', [App\Http\Controllers\Backend\DukunganController::class, 'update'])->name('backend.dukungan.update');
    // Pendampingan
    Route::get('backend/binaan', [App\Http\Controllers\Backend\BinaanController::class, 'index'])->name('backend.binaan.index');
    Route::get('backend/binaan/create', [App\Http\Controllers\Backend\BinaanController::class, 'create'])->name('backend.binaan.create');
    Route::post('backend/binaan/store', [App\Http\Controllers\Backend\BinaanController::class, 'store'])->name('backend.binaan.store');
    Route::get('backend/binaan/{spbinaan}/edit', [App\Http\Controllers\Backend\BinaanController::class, 'edit'])->name('backend.binaan.edit');
    Route::put('backend/binaan/{spbinaan}/update', [App\Http\Controllers\Backend\BinaanController::class, 'update'])->name('backend.binaan.update');
    Route::get('backend/binaan/{spbinaan}/show', [App\Http\Controllers\Backend\BinaanController::class, 'show'])->name('backend.binaan.show');

    // Album
    Route::get('backend/albums', [App\Http\Controllers\Backend\AlbumController::class, 'index'])->name('backend.albums.index');
    Route::get('backend/albums/create', [App\Http\Controllers\Backend\AlbumController::class, 'create'])->name('backend.albums.create');
    Route::post('backend/albums/store', [App\Http\Controllers\Backend\AlbumController::class, 'store'])->name('backend.albums.store');
    Route::get('backend/albums/{album}/edit', [App\Http\Controllers\Backend\AlbumController::class, 'edit'])->name('backend.albums.edit');
    Route::put('backend/albums/{album}/update', [App\Http\Controllers\Backend\AlbumController::class, 'update'])->name('backend.albums.update');
    Route::post('backend/albums/storefoto', [App\Http\Controllers\Backend\AlbumController::class, 'storefoto'])->name('backend.albums.storefoto');

    // Announcement
    Route::get('backend/announcement', [App\Http\Controllers\Backend\AnnouncementController::class, 'index'])->name('backend.announcement.index');
    Route::get('backend/announcement/create', [App\Http\Controllers\Backend\AnnouncementController::class, 'create'])->name('backend.announcement.create');
    Route::post('backend/announcement/store', [App\Http\Controllers\Backend\AnnouncementController::class, 'store'])->name('backend.announcement.store');
    Route::get('backend/announcement/{announcement}/edit', [App\Http\Controllers\Backend\AnnouncementController::class, 'edit'])->name('backend.announcement.edit');
    Route::put('backend/announcement/{announcement}/update', [App\Http\Controllers\Backend\AnnouncementController::class, 'update'])->name('backend.announcement.update');

    // Program
    Route::get('backend/program', [App\Http\Controllers\Backend\ProgramController::class, 'index'])->name('backend.program.index');
    Route::get('backend/program/create', [App\Http\Controllers\Backend\ProgramController::class, 'create'])->name('backend.program.create');
    Route::post('backend/program/store', [App\Http\Controllers\Backend\ProgramController::class, 'store'])->name('backend.program.store');
    Route::get('backend/program/{program}/edit', [App\Http\Controllers\Backend\ProgramController::class, 'edit'])->name('backend.program.edit');
    Route::put('backend/program/{program}/update', [App\Http\Controllers\Backend\ProgramController::class, 'update'])->name('backend.program.update');

    // Facility
    Route::get('backend/facility', [App\Http\Controllers\Backend\FacilityController::class, 'index'])->name('backend.facility.index');
    Route::get('backend/facility/create', [App\Http\Controllers\Backend\FacilityController::class, 'create'])->name('backend.facility.create');
    Route::post('backend/facility/store', [App\Http\Controllers\Backend\FacilityController::class, 'store'])->name('backend.facility.store');
    Route::get('backend/facility/{facility}/edit', [App\Http\Controllers\Backend\FacilityController::class, 'edit'])->name('backend.facility.edit');
    Route::put('backend/facility/{facility}/update', [App\Http\Controllers\Backend\FacilityController::class, 'update'])->name('backend.facility.update');

    // Haribesar
    Route::get('backend/haribesar', [App\Http\Controllers\Backend\HaribesarController::class, 'index'])->name('backend.haribesar.index');
    Route::get('backend/haribesar/create', [App\Http\Controllers\Backend\HaribesarController::class, 'create'])->name('backend.haribesar.create');
    Route::post('backend/haribesar/store', [App\Http\Controllers\Backend\HaribesarController::class, 'store'])->name('backend.haribesar.store');
    Route::get('backend/haribesar/{haribesar}/edit', [App\Http\Controllers\Backend\HaribesarController::class, 'edit'])->name('backend.haribesar.edit');
    Route::put('backend/haribesar/{haribesar}/update', [App\Http\Controllers\Backend\HaribesarController::class, 'update'])->name('backend.haribesar.update');

    // Video
    Route::get('backend/video', [App\Http\Controllers\Backend\VideoController::class, 'index'])->name('backend.video.index');
    Route::get('backend/video/create', [App\Http\Controllers\Backend\VideoController::class, 'create'])->name('backend.video.create');
    Route::post('backend/video/store', [App\Http\Controllers\Backend\VideoController::class, 'store'])->name('backend.video.store');
    Route::get('backend/video/{video}/edit', [App\Http\Controllers\Backend\VideoController::class, 'edit'])->name('backend.video.edit');
    Route::put('backend/video/{video}/update', [App\Http\Controllers\Backend\VideoController::class, 'update'])->name('backend.video.update');

    // Menu
    Route::get('backend/menu', [App\Http\Controllers\Backend\MenuController::class, 'index'])->name('backend.menu.index');
    Route::get('backend/menuitem', [App\Http\Controllers\Backend\MenuController::class, 'menuitem'])->name('backend.menuitem.index');
    Route::get('backend/menuitem/create', [App\Http\Controllers\Backend\MenuController::class, 'menuitemCreate'])->name('backend.menuitem.create');
    Route::get('backend/menuitem/structure', [App\Http\Controllers\Backend\MenuController::class, 'structure'])->name('backend.menuitem.structure');

    // Agenda
    Route::get('backend/agenda', [App\Http\Controllers\Backend\AgendaController::class, 'index'])->name('backend.agendas.index');
    Route::get('backend/agendas/create', [App\Http\Controllers\Backend\AgendaController::class, 'create'])->name('backend.agendas.create');
    Route::post('backend/agendas/store', [App\Http\Controllers\Backend\AgendaController::class, 'store'])->name('backend.agendas.store');
    Route::get('backend/agendas/{agenda}/edit', [App\Http\Controllers\Backend\AgendaController::class, 'edit'])->name('backend.agendas.edit');
    Route::put('backend/agendas/{agenda}/update', [App\Http\Controllers\Backend\AgendaController::class, 'update'])->name('backend.agendas.update');

    // Slider
    Route::get('backend/sliders', [App\Http\Controllers\Backend\SliderController::class, 'index'])->name('backend.sliders.index');
    Route::get('backend/sliders/create', [App\Http\Controllers\Backend\SliderController::class, 'create'])->name('backend.sliders.create');
    Route::post('backend/sliders/store', [App\Http\Controllers\Backend\SliderController::class, 'store'])->name('backend.sliders.store');
    Route::get('backend/sliders/{slider}/edit', [App\Http\Controllers\Backend\SliderController::class, 'edit'])->name('backend.sliders.edit');
    Route::put('backend/sliders/{slider}/update', [App\Http\Controllers\Backend\SliderController::class, 'update'])->name('backend.sliders.update');

     // Sekolah
    Route::get('backend/sekolah', [App\Http\Controllers\Backend\SekolahController::class, 'index'])->name('backend.sekolah.index');
    Route::post('backend/sekolah/create', [App\Http\Controllers\Backend\SekolahController::class, 'create'])->name('backend.sekolah.create');
    Route::post('backend/sekolah/store', [App\Http\Controllers\Backend\SekolahController::class, 'store'])->name('backend.sekolah.store');
    Route::get('backend/sekolah/{sekolah}/edit', [App\Http\Controllers\Backend\SekolahController::class, 'edit'])->name('backend.sekolah.edit');
    Route::put('backend/sekolah/{sekolah}/update', [App\Http\Controllers\Backend\SekolahController::class, 'update'])->name('backend.sekolah.update');
    Route::put('backend/sekolah/{sekolah}/updatelogo', [App\Http\Controllers\Backend\SekolahController::class, 'updatelogo'])->name('backend.sekolah.updatelogo');
    Route::post('backend/sekolah/import', [App\Http\Controllers\Backend\SekolahController::class, 'import'])->name('backend.sekolah.import');
 // Wilayah Indonesia
    Route::get('backend/indonesia', [App\Http\Controllers\Backend\WilayahController::class, 'index'])->name('backend.wilayah.index');

    // Agama
    Route::get('backend/agama', [App\Http\Controllers\Backend\AgamaController::class, 'index'])->name('backend.agama.index');

    // Bentuk Pendidikan
    Route::get('backend/bentukpendidikan', [App\Http\Controllers\Backend\BentukpendidikanController::class, 'index'])->name('backend.bentukpendidikan.index');

    // Jenjang Pendidikan
    Route::get('backend/jenjangpendidikan', [App\Http\Controllers\Backend\JenjangpendidikanController::class, 'index'])->name('backend.jenjangpendidikan.index');

    // Tingkat Pendidikan
    Route::get('backend/tingkatpendidikan', [App\Http\Controllers\Backend\TingkatpendidikanController::class, 'index'])->name('backend.tingkatpendidikan.index');

    // Status Kepemilikan
    Route::get('backend/statuskepemilikan', [App\Http\Controllers\Backend\StatuskepemilikanController::class, 'index'])->name('backend.statuskepemilikan.index');

    // Kebutuhan Khusus
    Route::get('backend/kebutuhankhusus', [App\Http\Controllers\Backend\KebutuhankhususController::class, 'index'])->name('backend.kebutuhankhusus.index');

    // Akreditasi
    Route::get('backend/akreditasi', [App\Http\Controllers\Backend\AkreditasiController::class, 'index'])->name('backend.akreditasi.index');

    // Jenis Rombel
    Route::get('backend/jenisrombel', [App\Http\Controllers\Backend\JenisrombelController::class, 'index'])->name('backend.jenisrombel.index');

    // Jenis PTK
    Route::get('backend/jenisptk', [App\Http\Controllers\Backend\JenisptkController::class, 'index'])->name('backend.jenisptk.index');

    // Jurusan
    Route::get('backend/jurusan', [App\Http\Controllers\Backend\JurusanController::class, 'index'])->name('backend.jurusan.index');

    // Kurikulum Controller
    Route::get('backend/kurikulum', [App\Http\Controllers\Backend\KurikulumController::class, 'index'])->name('backend.kurikulum.index');

    // Matapelajaran Controller
    Route::get('backend/matapelajaran', [App\Http\Controllers\Backend\MatapelajaranController::class, 'index'])->name('backend.matapelajaran.index');

    // Tahun ajaran Controller
    Route::get('backend/tahunajaran', [App\Http\Controllers\Backend\TahunajaranController::class, 'index'])->name('backend.tahunajaran.index');

    // SemesterController
    Route::get('backend/semester', [App\Http\Controllers\Backend\SemesterController::class, 'index'])->name('backend.semester.index');


});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

require __DIR__.'/auth.php';
