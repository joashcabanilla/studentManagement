@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div>
            <div class="card">
                <div class="card-header importUserHeader pdfviewHeader">
                    <p>Student Info Table</p>
                    <a href="savePDF" class="btn btn-primary">Save as PDF</a>
                    <a href="/admin/student" class="btn btn-primary">Student Account Table</a>
                </div>
                <div class="card-body">
                    <table class="table pdfviewTable">
                        <thead>
                            <th>Student No</th>
                            <th>Name</th>
                            <th>Birthday</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                        </thead>
                        <tbody>
                            @foreach ($collection as $item)
                            @php
                                $lastname = strtoupper($item['lastname']);
                                $firstname = strtoupper($item['firstname']);
                                $middlename = substr(strtoupper($item['middlename']),0,1);
                                $birthdate = substr($item['birthdate'],5,2) . "/" . substr($item['birthdate'],8,2) . "/" . substr($item['birthdate'],0,4);
                            @endphp
                            <tr>
                                <td>{{$item['studentNumber']}}</td>
                                <td>{{$lastname}}, {{$firstname}} {{$middlename}}.</td>
                                <td>{{$birthdate}}</td>
                                <td>{{$item['age']}}</td>
                                <td>{{$item['gender']}}</td>
                                <td>{{$item['email']}}</td>
                                <td>{{$item['phone_number']}}</td> 
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection