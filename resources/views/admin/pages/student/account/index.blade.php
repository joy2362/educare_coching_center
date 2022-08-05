@extends('layout.master')
@section('title')
    <title>Payment History</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Student Payment History
                <a href="{{route('admin.student-account.create')}}" class="float-end btn btn-sm btn-success rounded" >Make new payment</a>
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
                                            <td>{{ $debit->status ?? ""}}</td>
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
            $(document).ready(function() {
                $('#data').DataTable();
            });
        });
    </script>
@endsection
