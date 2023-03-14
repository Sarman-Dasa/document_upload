@extends('layout.main')
@section('content')
<div class="container mt-5">
    <div class="table-responsive">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th colspan="6" class="text-center table-dark">Document Data</th>
            </tr>
            <tr class="table-info">
                <th>ID</th>
                <th>Document Name</th>
                <th>status</th>
                <th>Document</th>
                <th colspan="2" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($documentList as $document)
                       <tr>
                            <td>{{$document->id}}</td>
                            <td>{{$document->name}}</td>
                            <td>{{$document->is_active==1 ? 'Active' : 'Deactive'}}</td>
                            <td>
                                <form action="{{route('document.edit',$document->id)}}">
                                    @csrf
                                        <input type="submit" value="Edit" name="" class="btn btn-info">
                                </form>
                            </td>
                            <td>
                                <form action="{{route('document.delete',$document->id)}}" method="POST">
                                    @csrf
                                    @method("Delete")
                                        <input type="submit" value="Delete" name="delete" class="btn btn-danger">
                                </form>
                            </td>
                       </tr>
                    @endforeach
                </tr>
                <tr>
                    <th colspan="6" class="text-center table-dark">Total {{count($documentList)}} Department(s) </th>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection