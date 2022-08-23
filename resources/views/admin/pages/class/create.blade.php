@extends('layout.master')
@section('title')
    <title>Add Class</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3 ">Add new Class
                <a href="{{route('admin.class.index')}}" class="float-end btn btn-sm btn-success">All Class</a>
            </h1>
            <div class="row">

                <div class="col">
                    <form method="post" action="{{route('admin.class.store')}}" >
                        @csrf
                        <fieldset class="border border-secondary p-2 mt-2">
                            <legend class="float-none w-auto p-2">Class</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="class_code">Class Code</label>
                                        <input type="number" class="form-control" id="class_code" name="class_code" min="0" max="99" value="00" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="admission_fee">Admission Fee</label>
                                        <input type="text" class="form-control" id="admission_fee" name="admission_fee" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="monthly_fee">Monthly Fee</label>
                                        <input type="text" class="form-control" id="monthly_fee" name="monthly_fee" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="other_fee">Other Fee</label>
                                        <input type="text" class="form-control" id="other_fee" name="other_fee" required>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="border border-secondary p-2 mt-2">
                            <legend class="float-none w-auto p-2">Subject</legend>
                                <div class="row sub" >
                                    <div class="col-md-6 mt-3" id="sub_1">
                                        <div class="form-inline">
                                            <div class="form-group mt-3">
                                                <label for="sub_name_1">Name</label>
                                                <input type="text" class="form-control mx-sm-3" id="sub_name_1" name="sub_name[]" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-primary g-2 mt-3 " id="add_sub"> <i class="align-middle" data-feather="plus"></i> </button>
                            </div>

                        </fieldset>

                        <fieldset class="border border-secondary p-2 mt-2">
                            <legend class="float-none w-auto p-2">Batch</legend>
                            <div id="batch">
                                <div class="row mt-3" id="batch_1">
                                    <div class="col-md-4">
                                        <div class="form-inline">
                                            <div class="form-group ">
                                                <label for="batch_name_1">Name</label>
                                                <input type="text" class="form-control mx-sm-3" id="batch_name_1" name="batch_name[]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-inline">
                                            <div class="form-group ">
                                                <label for="class_start_1">Class Start</label>
                                                <input type="time" class="form-control mx-sm-3" id="class_start_1" name="class_start[]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-inline">
                                            <div class="form-group ">
                                                <label for="class_end_1">Class End</label>
                                                <input type="time" class="form-control mx-sm-3" id="class_end_1" name="class_end[]" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <button type="button" class="btn btn-primary g-2 mt-3 " id="add_batch"> <i class="align-middle" data-feather="plus"></i> </button>
                            </div>

                        </fieldset>

                        <button type="submit" class="btn btn-info g-2 mt-3 float-right">Save</button>
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
            let sub_count = 2;
            let batch_count = 2;
            const sub = $(".sub");
            const batch = $("#batch");
            const class_code = $("#class_code");
            const add_sub = $("#add_sub");
            const add_batch = $("#add_batch");

            class_code.change(function(){
                let number = class_code.val();
                class_code.val(number.toString().padStart(2, '0'));
            });

            add_sub.click(function(){
                sub.append('<div class="col-md-6 mt-3" id="sub_'+sub_count+'"> <div class="form-inline"> <div class="form-group "> <label for="sub_name_'+sub_count+'">Name</label><input type="text" class="form-control mx-sm-3" id="sub_name_'+sub_count+'" name="sub_name[]" required> <button type="button" class="btn text-danger remove_sub fw-bold" id="'+sub_count+'" onclick="handle_remove_sub('+sub_count+')"> x </button> </div> </div> </div>');
                sub_count++;
            });

            add_batch.click(function(){
                batch.append('<div class="row mt-3" id="batch_'+batch_count+'"><div class="col-md-4"> <div class="form-inline"> <div class="form-group "> <label for="batch_name_'+batch_count+'">Name</label> <input type="text" class="mx-sm-3 form-control" id="batch_name_'+batch_count+'" name="batch_name[]" required></div> </div> </div> <div class="col-md-3"><div class="form-inline"> <div class="form-group "> <label for="class_start_'+batch_count+'">Class Start</label> <input type="time" class="form-control mx-sm-3" id="class_start_'+batch_count+'" name="class_start[]" required> </div> </div> </div> <div class="col-md-4"><div class="form-inline"> <div class="form-group "> <label for="class_end_'+batch_count+'">Class End</label> <input type="time" class="form-control mx-sm-3" id="class_end_'+batch_count+'" name="class_end[]" required></div> </div></div>  <div class="col-md-1 text-center"> <button type="button" class="btn text-danger remove_batch fw-bold" id="'+batch_count+'" onclick="handle_remove_batch('+batch_count+')"> x </button></div> </div>');
                batch_count++;
            });
        });
    });
    function handle_remove_sub(id){
        document.getElementById(`sub_${id}`).remove()
    }
    function handle_remove_batch(id){
        document.getElementById(`batch_${id}`).remove()
    }
</script>
@endsection
