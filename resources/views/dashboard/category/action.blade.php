@switch($type)
    @case('action')
        <a href="{{ route('admin.category.edit', $category->id) }}" title="Edit" class="btn btn-secondary"><i
                class="fa fa-pen"></i></a>
        <button title="Show Permissions" data-id="{{ $category->id }}" class="btn btn-danger delete-btn"><i class="fa fa-trash"></i>
        </button>
    @break

    @default
@endswitch
