@extends('flare::admin.sections.wrapper')
@section('page_title', 'Add Media')
@section('content')

<div class="row"> 
    <form action="" method="post" id="fileupload" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="col-md-9">
            <div class="box box-default">
                <div class="box-header with-border">
                    Upload New Media
                </div>
                <div class="box-body">
                    <div class="row fileupload-buttonbar">
                        <div class="col-lg-7">
                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Add files...</span>
                                <input type="file" name="file" multiple>
                            </span>
                            <button type="submit" class="btn btn-primary start">
                                <i class="glyphicon glyphicon-upload"></i>
                                <span>Start upload</span>
                            </button>
                            <button type="reset" class="btn btn-warning cancel">
                                <i class="glyphicon glyphicon-ban-circle"></i>
                                <span>Cancel upload</span>
                            </button>
                            <button type="button" class="btn btn-danger delete">
                                <i class="glyphicon glyphicon-trash"></i>
                                <span>Delete</span>
                            </button>
                            <input type="checkbox" class="toggle">
                            <span class="fileupload-process"></span>
                        </div>
                        <div class="col-lg-5 fileupload-progress fade">
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                            </div>
                            <div class="progress-extended">&nbsp;</div>
                        </div>
                    </div>
                    <table role="presentation" class="table table-striped">
                        <tbody class="files"></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-info">
                <div class="box-header with-border">
                    Media Upload Info
                </div>
                <div class="box-body">
                    <ul>
                        <li>
                            The maximum file size for uploads is <strong>? KB</strong>.
                        </li>
                        <li>
                            You can <strong>drag &amp; drop</strong> files to upload from your desktop on to this page.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

@stop

@section('enqueued-css')

<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<link rel="stylesheet" href="{{ asset('vendor/flare/jquery-file-upload/css/jquery.fileupload.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/flare/jquery-file-upload/css/jquery.fileupload-ui.css') }}">

@append

@section('enqueued-js')

<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

<script src="{{ asset('vendor/flare/jquery-file-upload/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>->
<script src="{{ asset('vendor/flare/jquery-file-upload/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('vendor/flare/jquery-file-upload/js/jquery.fileupload.js') }}"></script>
<script src="{{ asset('vendor/flare/jquery-file-upload/js/jquery.fileupload-process.js') }}"></script>
<script src="{{ asset('vendor/flare/jquery-file-upload/js/jquery.fileupload-image.js') }}"></script>
<script src="{{ asset('vendor/flare/jquery-file-upload/js/jquery.fileupload-audio.js') }}"></script>
<script src="{{ asset('vendor/flare/jquery-file-upload/js/jquery.fileupload-video.js') }}"></script>
<script src="{{ asset('vendor/flare/jquery-file-upload/js/jquery.fileupload-validate.js') }}"></script>
<script src="{{ asset('vendor/flare/jquery-file-upload/js/jquery.fileupload-ui.js') }}"></script>
<script src="{{ asset('vendor/flare/js/media.js') }}"></script>

@append