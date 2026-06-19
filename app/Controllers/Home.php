<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TokoModel;
use App\Models\RatingModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Home Controller
 * ELStore GIS — Sistem Informasi Geografis Toko Elektronik Sumatera Utara
 */
class Home extends BaseController
{
    protected TokoModel $tokoModel;
    protected RatingModel $ratingModel;

    public function __construct()
    {
        $this->tokoModel = new TokoModel();
        $this->ratingModel = new RatingModel();
    }

    // ----------------------------------------------------------------
    /** Landing Page */
    public function index(): string
    {
        $ratingInfo = $this->ratingModel->getAverageRating();
        $recentRatings = $this->ratingModel->getRatingsWithUser(5);
        $recentStores = $this->tokoModel->where('status', 'aktif')->orderBy('created_at', 'DESC')->limit(6)->findAll();

        $userReview = null;
        if (session()->get('is_logged_in')) {
            $userReview = $this->ratingModel->where('user_id', session()->get('user_id'))->first();
        }

        $data = [
            'page_title'   => 'Beranda',
            'lang'         => session()->get('lang') ?? 'id',
            'total_stores' => $this->tokoModel->countAktif(),
            'total_cities' => 2,
            'rating_info'  => $ratingInfo,
            'recent_ratings' => $recentRatings,
            'recent_stores' => $recentStores,
            'user_review'  => $userReview,
        ];

        return view('templates/header', $data)
             . view('pages/home_redesign', $data)
             . view('templates/footer', $data);
    }

    // ----------------------------------------------------------------
    /** Halaman Daftar Toko */
    public function toko(): string
    {
        $model = $this->tokoModel->search(
            $this->request->getGet('q') ?? '',
            $this->request->getGet('kategori') ?? '',
            $this->request->getGet('kota') ?? ''
        );

        $kotaData = $this->tokoModel->getUniqueCities();
        $kotas    = array_column($kotaData, 'kota');

        $data = [
            'page_title' => 'Daftar Toko Elektronik',
            'lang'       => session()->get('lang') ?? 'id',
            'stores'     => $model->paginate(6, 'stores'),
            'pager'      => $model->pager,
            'q'          => $this->request->getGet('q') ?? '',
            'kategori'   => $this->request->getGet('kategori') ?? '',
            'kota'       => $this->request->getGet('kota') ?? '',
            'kategoris'  => [
                'Smartphone', 'Komputer & Laptop', 'Audio & Video',
                'Peralatan Listrik', 'Elektronik Umum', 'Apple Authorized',
                'Gaming', 'Kamera & Optik', 'Lainnya',
            ],
            'kotas'      => $kotas,
        ];

        return view('templates/header', $data)
             . view('pages/toko', $data)
             . view('templates/footer', $data);
    }

    // ----------------------------------------------------------------
    /** Detail Toko */
    public function tokoDetail(int $id): string
    {
        $toko = $this->tokoModel->find($id);
        if (! $toko) {
            return redirect()->to(base_url('toko'))->with('error', 'Toko tidak ditemukan.');
        }

        $data = [
            'page_title' => $toko['nama_toko'],
            'lang'       => session()->get('lang') ?? 'id',
            'toko'       => $toko,
        ];

        return view('templates/header', $data)
             . view('pages/toko_detail', $data)
             . view('templates/footer', $data);
    }

    // ----------------------------------------------------------------
    /** Halaman Peta GIS */
    public function peta(): string
    {
        $data = [
            'page_title' => 'Peta GIS',
            'lang'       => session()->get('lang') ?? 'id',
        ];

        return view('templates/header', $data)
             . view('pages/peta', $data)
             . view('templates/footer', $data);
    }

    // ----------------------------------------------------------------
    /** Switch Language */
    public function switchLang(): ResponseInterface
    {
        $lang = $this->request->getPost('lang');
        if (in_array($lang, ['id', 'en'], true)) {
            session()->set('lang', $lang);
        }

        if ($this->request->isAJAX()) {
            return $this->response->setContentType('application/json')
                                  ->setJSON(['success' => true, 'lang' => $lang]);
        }

        $redirect = $this->request->getPost('redirect') ?? '/';
        return redirect()->to($redirect);
    }

    // ----------------------------------------------------------------
    /** GeoJSON API */
    public function apiStores(): ResponseInterface
    {
        $stores   = $this->tokoModel->getForMap();
        $features = [];

        foreach ($stores as $s) {
            $features[] = [
                'type'     => 'Feature',
                'geometry' => [
                    'type'        => 'Point',
                    'coordinates' => [(float)$s['longitude'], (float)$s['latitude']],
                ],
                'properties' => [
                    'id'          => $s['id'],
                    'name'        => $s['nama_toko'],
                    'category'    => $s['kategori'],
                    'address'     => $s['alamat'],
                    'kecamatan'   => $s['kecamatan'] ?? '',
                    'phone'       => $s['no_telepon'] ?? '',
                    'open'        => $s['jam_buka'] ?? '',
                    'rating'      => $s['rating'],
                    'total_ulasan'=> $s['total_ulasan'],
                    'foto'        => $s['foto'] ?? null,
                ],
            ];
        }

        return $this->response
                    ->setContentType('application/json')
                    ->setJSON(['type' => 'FeatureCollection', 'features' => $features]);
    }

    // ----------------------------------------------------------------
    /** POST /submit-rating */
    public function submitRating()
    {
        if (! session()->get('is_logged_in')) {
            return redirect()->to(base_url('auth/login'))->with('error', 'Silakan login terlebih dahulu untuk memberikan rating.');
        }

        $userId = session()->get('user_id');

        $existing = $this->ratingModel->where('user_id', $userId)->first();

        $rules = [
            'rating' => 'required|in_list[1,2,3,4,5]',
            'ulasan' => 'permit_empty|string',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(base_url('/#ulasan'))->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($existing) {
            $this->ratingModel->update($existing['id'], [
                'rating'     => $this->request->getPost('rating'),
                'ulasan'     => $this->request->getPost('ulasan'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->to(base_url('/#ulasan'))->with('success', 'Ulasan Anda berhasil diperbarui!');
        } else {
            $this->ratingModel->insert([
                'user_id'    => $userId,
                'rating'     => $this->request->getPost('rating'),
                'ulasan'     => $this->request->getPost('ulasan'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->to(base_url('/#ulasan'))->with('success', 'Terima kasih atas ulasan Anda!');
        }
    }
}