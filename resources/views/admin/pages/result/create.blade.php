@extends('layout.master')
@section('title')
    <title>Result</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3 text-center">Result</h1>
            <div class="row">

                <div class="col">
                    <form method="post" action="{{route('admin.result.store')}}" >
                        @csrf
                            @foreach($batch->students as $row)
                            <div class="row g-2 mb-3">
                                <div class="col-md">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="Id" readonly name="id[]" placeholder="id" value="{{$row->id}}">
                                        <label for="Id">Id</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" readonly placeholder="name" value="{{$row->name}}">
                                        <label for="name">Name</label>
                                    </div>
                                </div>
                                <input type="hidden" name="mobile[]" value="{{$row->parent_contact_number}}">
                                <div class="col-md">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="subject" readonly value="{{$exam->subject->name}}">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating">
                                        <select class="form-select" id="attendance" aria-label="Attendance" name="attendance[]" required>
                                            <option selected value="present">Present</option>
                                            <option value="absent">Absent</option>
                                        </select>
                                        <label for="attendance">Attendance</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="result" placeholder="result" name="result[]" max="{{$exam->total_mark}}">
                                        <label for="result">Result</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="mark" id="mark" placeholder="mark" readonly value="{{$exam->total_mark}}">
                                        <label for="mark">Total Mark</label>
                                    </div>
                                </div>
                                <input type="hidden" value="{{$exam->id}}" name="exam_id">
                            </div>
                            @endforeach
                        <button type="submit" class="btn btn-success g-2 mt-3 float-right">Published</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')

@endsection
