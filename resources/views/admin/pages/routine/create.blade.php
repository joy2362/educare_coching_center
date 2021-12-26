@extends('layout.master')
@section('title')
    <title>Routine</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Routine</h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add new Routine  </h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{url('/admin/routine/store/'.$batch->id)}}">
                                @csrf
                                    @foreach($subject as $row)
                                        <input type="hidden" name="subject[]" value="{{$row->id}}">
                                        <div class="row mt-3">
                                            <div class="col-md-6 g-2">
                                                <label for="subject">Subject</label>
                                                <input type="text" class="form-control"  id="subject" value="{{$row->name}}" readonly>
                                            </div>
                                            <div class="col-md-6 g-2">
                                                <label for="teacher_initial">Teacher Initial</label>
                                                <input type="text" class="form-control"  id="teacher_initial" name="teacher_initial_{{$row->id}}" required>
                                            </div>
                                            <div class="col-md-12 g-2 ">
                                                <label for="day">Day</label>
                                                <select class="form-select" multiple id="day" required name="day_{{$row->id}}[]" >
                                                    <option value="saturday">Saturday</option>
                                                    <option value="sunday">Sunday</option>
                                                    <option value="monday">Monday</option>
                                                    <option value="tuesday">Tuesday</option>
                                                    <option value="wednesday">Wednesday</option>
                                                    <option value="thursday">Thursday</option>
                                                    <option value="friday">Friday</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 g-2">
                                                <label for="start">Class Start</label>
                                                <input type="time" class="form-control" min="06:00" max="20:00"  name="startTime_{{$row->id}}" id="start" required>
                                            </div>
                                            <div class="col-md-6 g-2">
                                                <label for="end">Class End</label>
                                                <input type="time" class="form-control"  min="06:00" max="20:00" name="endTime_{{$row->id}}" id="end"  required>
                                            </div>
                                        </div>
                                    @endforeach
                                <div class=" mt-4">
                                    <button type="submit" class="btn btn-primary">Add Routine</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')


@endsection
