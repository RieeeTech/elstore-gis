<?php

namespace App\Models;

use CodeIgniter\Model;

class RatingModel extends Model
{
    protected $table            = 'app_ratings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'rating', 'ulasan', 'created_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get Ratings with User Info
     */
    public function getRatingsWithUser($limit = 10)
    {
        return $this->select('app_ratings.*, users.nama_lengkap, users.foto_profil')
                    ->join('users', 'users.id = app_ratings.user_id')
                    ->orderBy('app_ratings.created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    /**
     * Get Average Rating
     */
    public function getAverageRating()
    {
        $result = $this->selectAvg('rating', 'avg_rating')
                       ->selectCount('id', 'total_reviews')
                       ->first();
        
        return [
            'avg_rating' => $result['avg_rating'] ? round($result['avg_rating'], 1) : 0,
            'total_reviews' => $result['total_reviews']
        ];
    }
}
