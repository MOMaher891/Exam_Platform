@switch($type)
    @case('action')
        @if (auth()->user()->hasPermission('edit_inspector'))
        <a href="{{ route('admin.inspector.edit', $inspector->id) }}" title="Edit" class="btn btn-secondary"><i
                class="fa fa-pen"></i></a>
        @endif
        <a href="{{ route('admin.inspector.show', $inspector->id) }}" title="Show" class="btn btn-info"><i
            class="fa fa-eye"></i></a>

            @if (auth()->user()->hasPermission('delete_inspector'))
            <button title="Show Permissions" data-id="{{ $inspector->id }}" class="btn btn-danger delete-btn"><i class="fa fa-trash"></i>
            </button>
            @endif
    @break

    @case('show_profile')

    @break
    @default
@endswitch
