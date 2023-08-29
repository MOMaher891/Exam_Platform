@switch($type)
    @case('attendance')
    <a href="{{route('admin.center.inspector_for_exam_show',['exam_time_id'=>$data->id])}}">Attendance</a>
    @break
    @default
@endswitch
