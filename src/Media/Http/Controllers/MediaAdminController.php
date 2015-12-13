<?php

namespace LaravelFlare\Media\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFlare\Media\Media;
use LaravelFlare\Cms\Slugs\Slug;
use LaravelFlare\Flare\Admin\AdminManager;
use Intervention\Image\ImageManagerStatic as Image;
use LaravelFlare\Media\Http\Requests\MediaCreateRequest;
use LaravelFlare\Flare\Admin\Modules\ModuleAdminController;

class MediaAdminController extends ModuleAdminController
{
    /**
     * Admin Instance.
     * 
     * @var 
     */
    protected $admin;

    /**
     * __construct.
     * 
     * @param AdminManager $adminManager
     */
    public function __construct(AdminManager $adminManager)
    {
        // Must call parent __construct otherwise 
        // we need to redeclare checkpermissions
        // middleware for authentication check
        parent::__construct($adminManager);

        $this->admin = $this->adminManager->getAdminInstance();
    }

    /**
     * Index Media for Media Module.
     *
     * Lists the current media in the system.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('flare::admin.media.index', [
                                                    'media' => Media::orderBy('id', 'desc')->paginate(),
                                                    'totals' => [
                                                        'all' => Media::get()->count(),
                                                    ]
                                                ]);
    }

    /**
     * Create a new Media.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('flare::admin.media.create', ['media' => new Media()]);
    }

    /**
     * Processes a new Media Request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(MediaCreateRequest $request)
    {
        $media = Media::create($request->all());

        return redirect($this->admin->currentUrl('view/'.$media->id))->with('notifications_below_header', [['type' => 'success', 'icon' => 'check-circle', 'title' => 'Success!', 'message' => 'Your Media was successfully added.', 'dismissable' => false]]);
    }

    /**
     * This is not used.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getUpload()
    {
        return [];
    }

    /**
     * Process a File Upload from the Jquery File Uploader
     * 
     * @param  Request $request 
     * 
     * @return string
     */
    public function postUpload(Request $request)
    {
        if (!$request->file('file')) {
            return [];
        }

        $filename = time().'-'.$request->file('file')->getClientOriginalName();
        $request->file('file')->move('uploads/media', $filename);

        foreach (\Config::get('flare-config.media.resize') as $sizeArray) {
            $newfilename = $sizeArray[0].'-'.(array_key_exists(1, $sizeArray) ? $sizeArray[1] : $sizeArray[0]).'-'.$filename;
            Image::make('uploads/media/'.$filename)->fit($sizeArray[0], (array_key_exists(1, $sizeArray) ? $sizeArray[1] : $sizeArray[0]))->save('uploads/media/'.$newfilename);
        }

        $media = Media::create([
                            'name' => $request->file('file')->getClientOriginalName(),
                            'path' => $filename,
                            'extension' => $request->file('file')->getClientOriginalExtension(),
                            'mimetype' => $request->file('file')->getClientMimeType(),
                            'size' => $request->file('file')->getClientSize(),
            ]);

        $file = new \stdClass();
        $file->name = $media->name;
        $file->url = url('uploads/media/'.$media->path);
        $file->thumbnailUrl = url('uploads/media/100-100-'.$media->path);
        $file->type = $media->mimetype;
        $file->size = $media->size;

        $object = new \stdClass();
        $object->files = [$file];

        return json_encode($object);
    }

    /**
     * Delete Media.
     *
     * @param int $mediaId
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDelete($mediaId)
    {
        return view('flare::admin.media.delete', ['Media' => Media::findOrFail($mediaId)]);
    }

    /**
     * Process Delete Media Request.
     *
     * @param int $mediaId
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($mediaId)
    {
        $media = Media::findOrFail($mediaId);
        $media->delete();

        return redirect($this->admin->currentUrl())->with('notifications_below_header', [['type' => 'success', 'icon' => 'check-circle', 'title' => 'Success!', 'message' => 'The Media was successfully deleted.', 'dismissable' => false]]);
    }

    /**
     * Method is called when the appropriate controller
     * method is unable to be found or called.
     * 
     * @param array $parameters
     * 
     * @return
     */
    public function missingMethod($parameters = array())
    {
        parent::missingMethod();
    }
}
