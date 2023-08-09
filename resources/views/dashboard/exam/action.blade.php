@switch($type)
    @case('action')
        <a href="{{ route('admin.exam.edit', $exam->id) }}" title="Edit" class="btn btn-secondary"><i class="fa fa-pen"></i></a>
        <button title="Show Permissions" data-id="{{ $exam->id }}" class="btn btn-danger delete-btn"><i class="fa fa-trash"></i>
        </button>
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

    @default
@endswitch
