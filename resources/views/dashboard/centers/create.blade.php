@extends('layouts.dashboard.layout')
@section('title','Centers')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add Centers</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                            <li class="breadcrumb-item " ><a href="{{route('admin.center.index')}}">Centers</a></li>
                            <li class="breadcrumb-item active">Add</li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
        
                        <h4 class="card-title">Add Centers</h4>
                        <form action="{{route('admin.center.store')}}" method="POST">
                            @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="">
                                </div>
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control" id="">
                                </div>
                                @error('phone')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>



                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Owner <span class="text-danger">*</span></label>
                                    <select name="user_id" class="form-control"  id="user_id">
                                        @foreach ($data as $user )
                                            <option value="{{old('user_id',$user->id)}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_id')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="">Number Of Times</label>
                                <input type="number" class="form-control" name="" onchange="container()" id="input-number">
                            </div>
                            <div class="col-md-12" >
                                <div class="row" id="observe-content"></div>
                                @error('time_ids')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="row" id="observe_number"></div>
                                @error('observer_num')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea name="address" class="form-control" id="address" cols="30" rows="10">{{old('address')}}</textarea>
                                </div>
                            </div>
                            

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{route('admin.center.index')}}" class="btn btn-secondary">Cencel</a>
                                </div>
                            </div>
                        </div>
                        </form>
                     
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>
@endsection
@section('scripts')
<script>
     function container()
    {
        let inputval = $('#input-number').val();
      
        html = ''
        for(let i = 0; i<inputval ; i++)
        {
            html += `
            <div class="col-sm-4 mb-2">
            <label for="">Times</label>

            <select class="form-control mb-2 mt-2" name="time_ids[]">
                @foreach ($times as $time )
                    <option value="{{$time->id}}">{{$time->from}} - {{$time->to}}</option>
                @endforeach
            </select>

            <label for="">Number of Observes</label>

            <input type="number"  name="observer_num[]" class="form-control" id="">
            </div>
            `
           
        }

        $('#observe-content').html(html);

    }
</script>
@endsection