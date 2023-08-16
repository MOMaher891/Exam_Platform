@extends('layouts.dashboard.layout')
@section('title','Apply Exam to Center')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Apply Exam {{$data->name}} to Center</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                            <li class="breadcrumb-item " ><a href="{{route('admin.exam_times.index')}}">Exams</a></li>
                            <li class="breadcrumb-item active">Apply</li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
        
                        <h4 class="card-title">Add Shifts to Exam</h4>
                        <form action="{{route('admin.exam_times.store',$data->id)}}" method="POST">
                            @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Center</label>
                                    <select name="center_id" class="form-control" id="center_id">
                                        @foreach ($centers as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="">Number Of Times</label>
                                <input type="number" class="form-control" name="" onchange="container()" id="input-number">
                            </div>

                            <div class="col-md-12" >
                                <div class="col-sm-6 mb-2">
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">from</label>
                                            <input type="time" name="from[]"  value="{{$time_from}}" class="form-control" id="first-from">    
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">to</label>
                                            <input type="time" name="to[]" value="{{$time_to}}" class="form-control" id="">    
                                        </div>
                                    </div>    
                                    </div>
                                    
                        
                                    <label for="">Number of Observes</label>
                        
                                    <input type="number"  name="num_of_observe[]" value="0" class="form-control" id="">
                                </div>
                                <div class="row" id="observe-content">
                                   
                                     
                                </div>
                                @error('time')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="row" id="observe_number"></div>
                                @error('num_of_observe')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{route('admin.exam_times.index')}}" class="btn btn-secondary">Cencel</a>
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
            <div class="col-sm-6 mb-2">
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">from</label>
                                <input type="time" name="from[]"  value="" onchange="addHours(event,{{$data->num_of_hours}},${i})" class="form-control" id="first-from-">    
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">to</label>
                                <input type="time" name="to[]" value="" class="form-control" id="time-from-${i}">    
                            </div>
                        </div>    
                </div>    
                <label for="">Number of Observes</label>
                    <input type="number"  name="num_of_observe[]"  value="0" class="form-control" id="">
            </div>
            `
           
        }

        $('#observe-content').html(html);

    }
</script>
<script>
    function addHours(event,hours,order)
    {
        // console.log(event.target.value);
        var timeFrom = event.target.value  ;
        const parsedTime = new Date(`2000-01-01T${timeFrom}`);
        parsedTime.setHours(parsedTime.getHours() +  parseInt(hours));
        const options = { hour: '2-digit', minute: '2-digit'};
        const formattedTime = parsedTime.toLocaleTimeString('it-IT', options);
        // console.log(formattedTime);
        // console.log(timeFrom);

        $(`#time-from-${order}`).val(`${formattedTime}`)
    }
</script>
@endsection