<?php

namespace LaravelFlare\Media;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'flare_media';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'name',
                            'path',
                            'extension',
                            'mimetype',
                            'size',
                        ];
}
