<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commodity extends Model
{
    //
    use SoftDeletes;
    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     */
    protected $guarded = ['deleted_at'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];


    public function getTagIdsAttribute()
    {
        return json_decode($this->attributes['tag_ids'], true);

    }

    public function getPicIdsAttribute()
    {
        return json_decode($this->attributes['pic_ids'], true);
    }


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
