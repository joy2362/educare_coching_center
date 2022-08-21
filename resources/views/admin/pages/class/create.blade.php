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
                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label for="sub_name">Name</label>
                                            <input type="text" class="form-control" id="sub_name" name="sub_name[]" required>
                                        </div>
                                    </div>
                                </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-primary g-2 mt-3 " id="add_sub"> <i class="align-middle" data-feather="plus"></i> </button>
                                <button type="button" class="btn btn-danger g-2 mt-3 d-none" id="remove_sub"> <i class="align-middle" data-feather="minus"></i> </button>
                            </div>

                        </fieldset>
                        <fieldset class="border border-secondary p-2 mt-2">
                            <legend class="float-none w-auto p-2">Batch</legend>
                            <div id="batch">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="batch_name">Name</label>
                                            <input type="text" class="form-control" id="batch_name" name="batch_name[]" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="class_start">Class Start</label>
                                            <input type="time" class="form-control" id="class_start" name="class_start[]" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="class_end">Class End</label>
                                            <input type="time" class="form-control" id="class_end" name="class_end[]" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-primary g-2 mt-3 " id="add_batch"> <i class="align-middle" data-feather="plus"></i> </button>
                                <button type="button" class="btn btn-danger g-2 mt-3 d-none" id="remove_batch"> <i class="align-middle" data-feather="minus"></i> </button>
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

            const sub = $(".sub");
            const batch = $("#batch");
            const class_code = $("#class_code");
            const add_sub = $("#add_sub");
            const remove_sub = $("#remove_sub");
            const add_batch = $("#add_batch");
            const remove_batch = $("#remove_batch");

            class_code.change(function(){
                let number = class_code.val();
                class_code.val(number.toString().padStart(2, '0'));
            });
            add_sub.click(function(){
                sub.append('<div class="col-md-3"> <div class="form-group "> <label for="sub_name">Name</label><input type="text" class="form-control" id="sub_name" name="sub_name[]" required> </div> </div>');
                if( remove_sub.hasClass("d-none")){
                    remove_sub.removeClass("d-none");
                }
            });
            remove_sub.click(function(){

                sub.find(".col-md-3:last").remove();
                const value = sub.find(".col-md-3").length;

                if(value === 1){
                    remove_sub.addClass("d-none");
                }
            });

            add_batch.click(function(){
                batch.append('<div class="row"><div class="col-md-4"><div class="form-group "> <label for="batch_name">Name</label> <input type="text" class="form-control" id="batch_name" name="batch_name[]" required> </div> </div> <div class="col-md-4"> <div class="form-group "> <label for="class_start">Class Start</label> <input type="time" class="form-control" id="class_start" name="class_start[]" required> </div> </div> <div class="col-md-4"> <div class="form-group "> <label for="class_end">Class End</label> <input type="time" class="form-control" id="class_end" name="class_end[]" required> </div> </div> </div>');
                if( remove_batch.hasClass("d-none")){
                    remove_batch.removeClass("d-none");
                }
            });
            remove_batch.click(function(){
                batch.find(".row:last").remove();
                const value = batch.find(".row").length;

                if(value === 1){
                    remove_batch.addClass("d-none");
                }
            });
        });
    });
</script>
@endsection
