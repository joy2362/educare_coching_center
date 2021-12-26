@extends('layout.master')
@section('title')
    <title>Notice</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3 ">Notice</h1>
            <div class="row">
                <div class="col-12">
                    <form method="post" action="{{route('admin.notice.student.store')}}" >
                        @csrf
                        <div class="card ">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating g-2 mb-3">
                                            <select class="form-select @error('class') is-invalid @enderror" id="class" aria-label="Class" name="class" >
                                                <option selected>....</option>
                                                @foreach($classes as $row)
                                                    <option  value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="class">Class</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating g-2 mb-3 batch_class">
                                            <select class="form-select @error('batch') is-invalid @enderror" id="batch" aria-label="batch" name="batch" >
                                                <option selected>....</option>
                                            </select>
                                            <label for="batch">Batch</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating g-2 mb-3">
                                    <textarea class="form-control @error('message') is-invalid @enderror" placeholder="Message" id="permanent-address" name="message" style="height: 100px">{{ old('message')}}</textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary g-2 float-right">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
    $(document).ready(function() {
    function ajaxsetup(){
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    }


    $(document).on('change','#class',function(e){
    let id = e.target.value;
    ajaxsetup();
    $.ajax({
    type:'get',
    url:"/admin/batch/fetch/"+id,
    dataType:'json',
    success: function(response){
    if(response.status == 404){
    Swal.fire(
    'Error!',
    response.message,
    'error'
    )
    }
    else{
    let batches =  $('#batch').empty();
    $.each(response.batches,function(key,val){
    batches.append('<option value ="'+val.id+'">'+val.name + " - "+val.batch_start+ " - " + val.batch_end +'</option>');
    });

    }
    }
    })

    });
    });
    });
</script>
@endsection
