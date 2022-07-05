@extends('layouts.admin')

@section('content')
<div class="student-content">
    <div class="add-user-container">
        <div>
            <button class="btn btn-primary">Add New Student</button>
        </div>
        <div class="student-importExport">
            <a href="user/import" class="btn btn-primary">Import Data</a>
            <a href="user/exportExcel" class="btn btn-primary">Export Excel</a>
            <a href="user/exportCSV" class="btn btn-primary">Export CSV</a>
            <a href="user/exportPDF" class="btn btn-primary">Export PDF</a>
        </div>
    </div>
        <div class="containerTable">
            <div class="table-container">
                <table class="table-striped table userTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Birthday</th>
                            <th>Age</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
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
                                <td>{{$lastname}}, {{$firstname}} {{$middlename}}.</td>
                                <td>{{$birthdate}}</td>
                                <td>{{$item['age']}}</td>
                                <td>{{$item['email']}}</td>
                                <td>{{$item['phone_number']}}</td>
                                <td class="action-td">
                                    <a class="btn btn-success" href="edit/{{$item['id']}}"><span class="material-symbols-rounded">edit</span></a>
                                    <button class="btn btn-danger" id="deletebtn-{{$item['id']}}"><span id="deletebtn-{{$item['id']}}" class="material-symbols-rounded">delete</span></button>
                                </td>   
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script src="/js/admin/table.js"></script>
    </div>
</div>
@endsection