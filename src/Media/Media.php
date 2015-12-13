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
    protected $appends = ['human_size', 'link'];

    /**
     * Returns the media link in the requested size
     * 
     * @return 
     */
    public function size($width = null, $height = null)
    {
        foreach (\Config::get('flare-config.media.resize') as $sizeArray) {

            if ($width && $height && ($width == $sizeArray[0]) && ($height == $sizeArray[1])) {
                return $this->path ? url('uploads/media/'.$sizeArray[0].'-'.(array_key_exists(1, $sizeArray) ? $sizeArray[1] : $sizeArray[0]).'-'.$this->path) : null;
            }

            if ($width && ($width == $sizeArray[0])) {
                return $this->path ? url('uploads/media/'.$sizeArray[0].'-'.(array_key_exists(1, $sizeArray) ? $sizeArray[1] : $sizeArray[0]).'-'.$this->path) : null;
            }

        }

        return $this->link;
    }

    /**
     * Return the Full Media Link
     * 
     * @return string
     */
    public function getLinkAttribute()
    {
        return $this->path ? url('uploads/media/'.$this->path) : null;
    }

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
