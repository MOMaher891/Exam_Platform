@switch($type)
    @case('action')
        @if (auth()->user()->hasPermission('edit_inspector'))
        <a href="{{ route('admin.inspector.edit', $inspector->id) }}" title="Edit" class="btn btn-secondary"><i
                class="fa fa-pen"></i></a>
        @endif
        @if (auth()->user()->hasPermission('show_inspector'))
        <a href="{{ route('admin.inspector.show', $inspector->id) }}" title="Show" class="btn btn-info"><i
            class="fa fa-eye"></i></a>
        @endif

        @if (auth()->user()->hasRole('admin'))
            @if ($inspector->black_list != null)
            <a href="{{ route('admin.inspector.block', $inspector->id) }}" title="Unblock" class="btn btn-primary"><i
                class="fa fa-lock-open"></i></a>
            @else
            <a href="{{ route('admin.inspector.block', $inspector->id) }}" title="block" class="btn btn-danger"><i
                class="fa fa-lock"></i></a>
            @endif
        @endif


        @if (auth()->user()->hasPermission('delete_inspector'))
                <button title="Delete inspector" data-id="{{ $inspector->id }}" class="btn btn-danger delete-btn"><i class="fa fa-trash"></i>
                </button>
            @endif
    @break
@break
    @default
@endswitch
