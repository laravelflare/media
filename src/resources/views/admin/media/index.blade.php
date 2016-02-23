@extends('flare::admin.sections.wrapper')

@section('page_title', 'Media')

@section('content')

<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="btn-group">
                        <a href="{{ $moduleAdmin->currentUrl() }}" class="btn btn-default btn-flat">
                            All Media
                            <span class="badge bg-green" style="margin-left: 15px">{{ $totals['all'] }}</span>
                        </a>
                    </div>
                </div>
                
                @include('flare::admin.media.includes.media-list')
                
                @include('flare::admin.media.includes.media-list-footer')

            </div>
        </div>
    </div>
</div>

@stop
