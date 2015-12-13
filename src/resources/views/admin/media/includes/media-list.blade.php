<div class="box-body no-padding">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Thumb
                </th>
                <th>
                    Name
                </th>
                <th>
                    Extension
                </th>
                <th>
                    Mime Type
                </th>
                <th>
                    Size
                </th>
                <th>
                    Created On
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @if ($media->count() > 0)    
            @foreach($media as $item)    
                <tr>
                    <td>
                        {{ $item->id }}
                    </td>
                    <td style="width: 1%">
                        <div class="attachment-block clearfix no-margin">
                            <img alt="attachment image" src="{{ asset('uploads/media/100-100-'.$item->path) }}" class="attachment-img">
                        </div>
                    </td>
                    <td>
                        {{ $item->name }}
                    </td>
                    <td>
                        {{ $item->extension }}
                    </td>
                    <td>
                        {{ $item->mimetype }}
                    </td>
                    <td>
                        {{ $item->human_size }}
                    </td>
                    <td>
                        {{ $item->created_at->diffForHumans() }}
                    </td>
                    <td style="width: 1%; white-space:nowrap">
                        <a class="btn btn-success btn-xs" href="{{ $moduleAdmin::currentUrl('view/'.$item->id) }}">
                            <i class="fa fa-eye"></i>
                            View
                        </a>
                        <a class="btn btn-danger btn-xs" href="{{ $moduleAdmin::currentUrl('delete/'.$item->id) }}">
                            <i class="fa fa-trash"></i>
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        @else 
            <tr>
                <td colspan="7">
                    No Media Found
                </td>
            </tr>
        @endif
        </tbody>
    </table>
</div>