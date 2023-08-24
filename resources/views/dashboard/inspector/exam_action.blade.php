@switch($type)
    @case('action')

        @if (auth()->user()->hasPermission('show_inspector'))
        <a href="{{ route('admin.inspector.exam_observe', ['exam_id'=>$inspector->id]) }}" title="Show Inspector" class="btn btn-info"><i
            class="fa fa-eye"></i></a>
        @endif

    @break

    @default
@endswitch
