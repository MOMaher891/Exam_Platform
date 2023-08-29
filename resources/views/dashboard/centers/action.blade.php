@switch($type)
    @case('action')
    @if (auth()->user()->hasPermission('edit_exam'))
        <a  title="Show Exams" href="{{route('admin.center.exam_for_center_show',['center_id'=>$data->id])}}">Exams</a>
        <a href="{{route('admin.center.edit',$data->id)}}" title="Edit" class="btn btn-secondary"><i class="fa fa-pen"></i></a>
        <a onclick="DeleteData({{$data->id}})" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>

        @break
    @elseif(auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('analyst'))
    <a  title="Show Exams" href="{{route('admin.center.exam_for_center_show',['center_id'=>$data->id])}}">Exams</a>
    @endif
       @default

@endswitch
