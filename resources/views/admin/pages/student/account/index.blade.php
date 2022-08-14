@extends('layout.master')
@section('title')
    <title>Payment History</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3"> Payment History
                <a href="{{route('admin.student-account.create')}}" class="float-end btn btn-sm btn-success rounded mx-2" >Make new payment</a>
                <a href="{{route('admin.student.credit.add')}}" class="float-end btn btn-sm btn-info rounded mx-2 " id="addCredit" >Add Debit</a>
            </h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-border" id="data">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student id</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($debits as $debit)
                                        <tr>
                                            <td>{{ $loop->index + 1}}</td>
                                            <td>{{ $debit->student->username ?? ""}}</td>
                                            <td>{{ $debit->amount ?? ""}}</td>
                                            <td>
                                                <span class="badge @if($debit->status == "paid") badge-success @else badge-danger @endif">{{ucfirst($debit->status)}}</span>
                                            </td>
                                            <td><a href="{{route('admin.student-account.show',$debit->id)}}" class="btn btn-sm btn-success rounded"><i class="align-middle" data-feather="eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $(document).ready(function () {
                $('#data').DataTable();

                $(document).on("click", "#addCredit", function (e) {
                    e.preventDefault();
                    var link = $(this).attr("href");
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, do it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = link;
                        }
                    });
                });
            });
        });

    </script>
@endsection
