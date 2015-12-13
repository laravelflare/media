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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['human_size'];

    /**
     * Convert Media Size to a Human Readable Format
     * 
     * @return string
     */
    public function getHumanSizeAttribute()
    {
        $size = (int) $this->size;

        if($size >= 1<<30)
            return number_format($size/(1<<30),2)."GB";
        
        if($size >= 1<<20)
            return number_format($size/(1<<20),2)."MB";
        
        if($size >= 1<<10)
            return number_format($size/(1<<10),2)."KB";
            
        return number_format($size)." bytes";
    }
}
