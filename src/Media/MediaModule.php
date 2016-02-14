<?php

namespace LaravelFlare\Media;

use LaravelFlare\Flare\Admin\Modules\ModuleAdmin;

class MediaModule extends ModuleAdmin
{
    /**
     * Admin Section Icon.
     *
     * Font Awesome Defined Icon, eg 'user' = 'fa-user'
     *
     * @var string
     */
    protected $icon = 'cloud-upload';

    /**
     * Title of Admin Section.
     *
     * @var string
     */
    protected $title = 'Media';

    /**
     * The Controller to be used by the Pages Module.
     * 
     * @var string
     */
    protected $controller = '\LaravelFlare\Media\Http\Controllers\MediaAdminController';
}
