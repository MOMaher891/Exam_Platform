@switch($type)
    @case('action')
        <a href="{{route('admin.center.edit',$data->id)}}" title="Edit" class="btn btn-secondary"><i class="fa fa-pen"></i></a>
        <a onclick="DeleteData({{$data->id}})" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
        @break
       @default
        
@endswitch