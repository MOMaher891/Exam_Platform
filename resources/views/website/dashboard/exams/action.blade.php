@switch($type)
    @case('action')
        <a onclick="Apply({{$data->id}})" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        @break

    @default
        
@endswitch