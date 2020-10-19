<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'old','new','diferences','model_id', 'model_type', 'user_id'
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function setDiferencesAttribute(){
        $old = json_decode($this->old, TRUE);
        $new = json_decode($this->new, TRUE);

        if(is_array($old) AND is_array($new)){
            $aReturn = array();
            foreach ($new as $mKey => $mValue) {
                if (array_key_exists($mKey, $old)) {
                    if (is_array($mValue)) {
                        $aRecursiveDiff = arrayRecursiveDiff($mValue, $old[$mKey]);
                        if (count($aRecursiveDiff)) { $aReturn[$mKey] = $aRecursiveDiff; }
                    } else {
                        if ($mValue != $old[$mKey]) {
                            $aReturn[$mKey] = $mValue;
                        }
                    }
                } else {
                    $aReturn[$mKey] = $mValue;
                }
            }
            $this->attributes['diferences'] = json_encode($aReturn);
        }
        else if(is_array($new)){
            $this->attributes['diferences'] = json_encode($new);
        }
        else {
            $this->attributes['diferences'] = json_encode($old);
        }

    }

    public function getDiferencesArrayAttribute(){
        $diferences = json_decode($this->diferences,TRUE);
        unset($diferences['updated_at']);
        unset($diferences['created_at']);
        unset($diferences['id']);
        // if(isset($diferences['updated_at'])){
        //     unset($diferences['updated_at']);
        // }
        return $diferences;
    }

    /* this is executed after $log->save() method */
    protected static function booted()
    {
        static::creating(function ($log) {
            if($log->new) {
                $log->model_id = $log->new->id;
                $log->model_type = get_class($log->new);
            }
            else { // ($log->old)
                $log->model_id = $log->old->id;
                $log->model_type = get_class($log->old);
            }

            $log->user_id = Auth::id();

            $log->new = json_encode($log->new, JSON_PRETTY_PRINT);
            $log->old = json_encode($log->old, JSON_PRETTY_PRINT);
            $log->diferences = null;
        });
    }

    // /**
    //  * The table associated with the model.
    //  *
    //  * @var string
    //  */
    // protected $table = 'audits';
}
