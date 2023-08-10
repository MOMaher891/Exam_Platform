@switch($type)
    @case('action')
        <a href="{{route('admin.center.edit',$data->id)}}" title="Edit" class="btn btn-secondary"><i class="fa fa-pen"></i></a>
        <a onclick="DeleteData({{$data->id}})" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
        @break
    @case('times')
        @foreach ($data as $d )
            <p>{{$d->from}} - {{$d->to}}</p>
        @endforeach
    @break
    @case('observer_num')
        @for($i = 0 ; $i<count($data);$i++)
             <span>{{$data[$i]}}</span> 
        @endfor 

    @break
    @default
        
@endswitch