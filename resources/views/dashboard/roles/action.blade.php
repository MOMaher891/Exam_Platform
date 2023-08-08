@switch($type)
    @case('action')
        <a href="{{route('permission.edit',$role->id)}}" title="Show Permissions" class="btn btn-info"><i class="fa fa-eye"></i></a>
        <a href="{{route('role.edit',$role->id)}}" title="Edit" class="btn btn-secondary"><i class="fa fa-pen"></i></a>
        @break

    @default
        
@endswitch