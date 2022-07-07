<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    <style>
        .pdfviewHeader p{
            font-family: Arial;
            font-weight: 600;
            font-size: 1.2rem;
            text-align: center;
            margin-bottom: 2rem;
        }
        .pdfviewTable{
            font-family: Arial;
            display: table;
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6;
            caption-side: bottom;
            font-size: 0.9rem;
            border-collapse: collapse;
        }
        .table > thead {
             vertical-align: bottom;
        }
        .table thead th{
            text-align: center;
            padding: 0.2rem;
            width: 100%;
        }
        .table tbody td{
            text-align: center;
            padding: 0.2rem;
            width: 100%;
        }
        .table tbody td:nth-child(1){
            text-align: left;
        }
        table, th, td {
             border: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div>
                <div class="card">
                    <div class="card-header importUserHeader pdfviewHeader">
                        <p>Student Information Report</p>
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
</body>
</html>