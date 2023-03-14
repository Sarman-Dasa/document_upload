@extends('layout.main')
@section('content')
<div class="contenier table table-secondary mt-5 mb-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="md-4 text-center bg-secondary">
                <h3>User Document</h3>
            </div>
            <form action="{{ route('document.store') }}" method="POST" class="p-4">
                @csrf

                <div class="form-group mb-3">
                    <label for="" class="form-label">Document name</label>
                    <input type="text" name="name" class="form-control"  value="{{old('name')}}">
                    <span class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group d-grid">
                    <input type="submit" value="Add" class="btn btn-info bg-secondary-subtle b-block">
                </div>
            </form>
        </div>
    </div>
</div>
@ends