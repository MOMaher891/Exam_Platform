@switch($type)
    @case('action')
        <a href="{{ route('admin.staff.edit', $staff->id) }}" title="Edit" class="btn btn-secondary"><i class="fa fa-pen"></i></a>
        <a href="{{ route('admin.staff.delete', $staff->id) }}" title="Show Permissions" class="btn btn-danger"><i
                class="fa fa-trash"></i></a>
    @break

    @default
@endswitch
