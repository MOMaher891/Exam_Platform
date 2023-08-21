@switch($type)
    @case('action')
        <a href="{{ route('admin.inspector.edit', $inspector->id) }}" title="Edit" class="btn btn-secondary"><i
                class="fa fa-pen"></i></a>
        <a href="{{ route('admin.inspector.show', $inspector->id) }}" title="Show" class="btn btn-info"><i
                class="fa fa-eye"></i></a>
        <button title="Show Permissions" data-id="{{ $inspector->id }}" class="btn btn-danger delete-btn"><i class="fa fa-trash"></i>
        </button>
    @break

    @case('show_profile')

    @break
    @default
@endswitch
