@extends('layouts.admin')

@section('content')
<div class="student-content">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header importUserHeader">
                    Import Student Data
                </div>
                <div class="card-body">
                    <form  class="importUserForm" enctype="multipart/form-data" action="{{route('studentImport')}}" method="POST">
                        @csrf
                        <div class="form-group importUserFormDiv">
                            <label for="file">Import Student Excel File</label>
                            <input type="file" name="file" class="form-control" required />
                        </div>
                        <div class="importUserSubmit"> 
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button id="studentTableBtn" class="btn btn-primary">Student Account Table</button>
                        </div
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/admin/importExport.js"></script>
@endsection
