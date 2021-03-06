<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalRating extends Model
{
    public $table = 'hospital_ratings';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hospital_id', 'avg_user_rating', 'total_ratings', 'latest_rating', 'friends_family_rating', 'safe', 'effective', 'caring', 'responsive', 'well_led', 'report_url', 'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'hospital_id'           => 'integer',
        'avg_user_rating'       => 'double',
        'total_ratings'         => 'integer',
        'latest_rating'         => 'string',
        'friends_family_rating' => 'string',
        'safe'                  => 'string',
        'effective'             => 'string',
        'caring'                => 'string',
        'responsive'            => 'string',
        'well_led'              => 'string',
        'report_url'            => 'string',
        'status'                => 'string'
    ];

    /**
     * hospital() belongs to Hospital
     * @return mixed
     */
    public function hospital() {
        return $this->belongsTo( '\App\Models\Hospital', 'hospital_id');
    }

    /**
     * Used to build Queries
     *
     * @param $query
     * @param $hospital
     * @return mixed
     */
    public function scopeByHospital($query, $hospital){
        return $query->where('hospital_id', $hospital);
    }
}
