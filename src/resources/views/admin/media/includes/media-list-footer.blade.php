<div class="box-footer clearfix">
    <div class="pull-left">
        <a href="{{ $moduleAdmin::currentUrl('create') }}" class="btn btn-success">
            <i class="fa fa-cloud-upload"></i>
            Add Media
        </a>
    </div>

    @if ($media->hasPages())
    <div class="pull-right" style="margin-top: -20px; margin-bottom: -20px;">
        {!! $media->render() !!}
    </div>
    @endif
</div>