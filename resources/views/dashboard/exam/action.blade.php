@switch($type)
    @case('action')
        @if (auth()->user()->hasPermission('edit_exam'))
            <a href="{{ route('admin.exam.edit', $exam->id) }}" title="Edit" class="btn btn-secondary"><i class="fa fa-pen"></i></a>
            <button title="Show Permissions" data-id="{{ $exam->id }}" class="btn btn-danger delete-btn"><i class="fa fa-trash"></i>
            </button>
        @endif
        @if (auth()->user()->hasRole('analyst') || auth()->user()->hasRole('superadmin'))
        @if($exam->paid == 0)
        <button title="Pay" data-id="{{ $exam->id }}" class="btn btn-warning paid-btn">
            Pay
        </button>
            @else
            <button class="btn btn-success">
                Paid
            </button>
            @endif
        @endif
    @break

    @case('status')
        @if ($status == 0)
            <p class="btn btn-warning">Active</p>
        @elseif ($status == 1)
            <p class="btn btn-info">Pending</p>
        @else
            <p class="btn btn-danger">Expire</p>
        @endif
    @break
    @case('type')
        @if ($data->type == 'public')
            <p class="btn btn-sm btn-primary">Access To All Centers</p>
        @else
            @foreach ($centers as $d )
                <p>{{$d->name}}</p>
            @endforeach
        @endif
    @break
    @case('centers')
            <a href="{{route('admin.exam.centers_show',['exam_id'=>$exam->id])}}">Centers</a>
    @break
    @case('shift')
            @foreach($data as $d)
            <span>{{$d->shift}} ,</span>
            @endforeach
    @break
    @case('Invigilator')
            @foreach($data as $d)
            <span>{{$d->num_of_observe}} ,</span>
            @endforeach
    @break
    @case('attendance')
    <a href="{{route('admin.exam.attendance_show',['exam_id'=>$exam->id])}}">Attendance</a>
    @break
    @case('attend')
        @if($data->is_come == 0 )
            <span class="text-danger" style="font-weight:bolder">Not Attend</span>
        @else
            <span class="text-success" style="font-weight:bolder">Attend</span>

        @endif
    @break
    @default
@endswitch
