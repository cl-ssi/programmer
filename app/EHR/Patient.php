<?php

namespace App\EHR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'dv', 'name', 'fathers_family','mothers_family',
        'birthDate', 'gender', 'nationality'
    ];

    public function entries() {
        return $this->hasMany('App\EHR\HFA\Entry');
    }

    public function fullName() {
        return $this->name.' '.$this->fathers_family.' '.$this->mothers_family;
    }

    public function run() {
        return $this->id.'-'.$this->dv;
    }

    public function runFormat() {
        return number_format($this->id, 0,'.','.') . '-' . $this->dv;
    }

    public function scopeSearch($query, $id) {
        if($id != "") {
            return $query->where('id', "LIKE", "%$id%")
                         ->orWhere('name', "LIKE", "%$id%");
        }
    }

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'birthDate'];

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'ehr_patients';
}
