@extends('layout.main')
@section('content')
<div class="container mt-5">
    <div class="table-responsive">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th colspan="6" class="text-center table-dark">User Document Data</th>
            </tr>
            <tr class="table-info">
                <th>ID</th>
                <th>Document Name</th>
                <th>Expired Date</th>
                <th>Document</th>
                <th colspan="2" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($documentList as $document)
                       <tr>
                            <td>{{$document->id}}</td>
                            <td>{{$document['document']->name}}</td>
                            <td>{{$document->expired_date}}</td>
                            <td>
                                @foreach ($document->path as $image)
                                    <img src="{{ asset($image) }}" alt="" class="img-thumbnail" style="width: 100px;height: 100px;">
                                @endforeach
                            </td>
                            <td>
                                <form action="{{route('userDocument.edit',$document->id)}}">
                                    @csrf
                                        <input type="submit" value="Edit" name="" class="btn btn-info">
                                </form>
                            </td>
                            <td>
                                <form action="{{route('userDocument.delete',$document->id)}}" method="POST">
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