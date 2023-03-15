@extends('layout.main')
@section('content')
<div class="contenier table table-secondary mt-5 mb-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="md-4 text-center bg-secondary">
                <h3>User Document</h3>
            </div>
            @if (isset($document))
                <form action="{{ route('document.update',['id'=>$document->id]) }}" method="POST" class="p-4">
                    @method('patch')
            @else
                <form action="{{ route('document.store') }}" method="POST" class="p-4">
            @endif
                @csrf
                <div class="form-group mb-3">
                    <label for="" class="form-label">Document name</label>
                    <input type="text" name="name" class="form-control"  value="{{old('name',$document->name ?? '')}}">
                    <span class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                
                @if (isset($document))
                <div class="form-group mb-3">
                    <label for="" class="form-label">Status</label>
                    <input type="radio" name="is_active" class="form-check-input"  value="1"{{$document->is_active=='1' ? 'checked' : ''}}>
                    <label for="" class="form-label">True</label>
                    <input type="radio" name="is_active" class="form-check-input"  value="0"{{$document->is_active=='0' ? 'checked' : ''}}>
                    <label for="" class="form-label">False</label>
                    <span class="text-danger">
                        @error('is_active')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                @endif
                <div class="form-group d-grid">
                    <input type="submit" value="Add" class="btn btn-info bg-secondary-subtle b-block">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection