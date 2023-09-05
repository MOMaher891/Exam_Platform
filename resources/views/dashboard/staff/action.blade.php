@switch($type)
    @case('action')
        <a href="{{ route('admin.staff.edit', $staff->id) }}" title="Edit" class="btn btn-secondary"><i class="fa fa-pen"></i></a>
        <a href="{{ route('admin.staff.delete', $staff->id) }}" title="Show Permissions" class="btn btn-danger"><i
                class="fa fa-trash"></i></a>
        <a href="{{route('admin.staff.change-password-view',$staff->id)}}" title="Change Password"  class="btn btn-info"><i class="fa fa-key"></i></a>
    @break

    @default
@endswitch
