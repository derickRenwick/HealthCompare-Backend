<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalMaternity extends Model
{
    public $table = 'hospital_maternity';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hospital_id', 'total_responses', 'total_eligible', 'perc_response_rate', 'perc_recommended', 'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'hospital_id'           => 'integer',
        'total_responses'       => 'integer',
        'total_eligible'        => 'integer',
        'perc_response_rate'    => 'double',
        'perc_recommended'      => 'double',
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