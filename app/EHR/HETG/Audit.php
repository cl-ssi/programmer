<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Audit extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    // /**
    //  * {@inheritdoc}
    //  */
    // protected $guarded = [];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'old_values'   => 'json',
        'new_values'   => 'json',
        'auditable_id' => 'integer',
        // Note: Please do not add 'auditable_id' in here, as it will break non-integer PK models
    ];

    /**
     * {@inheritdoc}
     */
    public function auditable()
    {
        return $this->morphTo()->withTrashed();
    }

    /**
     * {@inheritdoc}
     */
    public function user()
    {
        return $this->morphTo()->withTrashed();
    }
}
