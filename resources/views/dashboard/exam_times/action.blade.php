@switch($type)
    @case('action')
        <a href="{{ route('admin.exam_times.create', $data->id) }}" title="Apply in Exam" class="btn btn-primary"><i class="fa fa-plus"></i></a>
    @break
    @default
@endswitch
