@extends('layout.main')
<script>
    function preview_image() {
        var total_file = document.getElementById("document").files.length;
        for (var i = 0; i < total_file; i++) {
            $('#image_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) +
                "' style='width: 200px;height: 50px;margin-bottom:5px'><br>");
        }
    }
</script>
@section('content')
    <div class="contenier table table-secondary mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="md-4 text-center bg-secondary">
                    <h3>Update Document</h3>
                </div>
                <form action="{{ route('userDocument.update',['id'=>$userDocument->id]) }}" method="POST" enctype="multipart/form-data" class="p-4">
                    @csrf
                    @method('patch')
                    <div class="form-group mb-3">
                        <label for="">Select Document</label>
                        <select name="document_id" id="" class="form-select">
                            <option value="" selected disabled>---Select One---</option>
                            @foreach ($documentList as $document)
                                @if ($document->id == $userDocument->document_id)
                                    <option value="{{ $document->id }}" selected>{{ $document->name }}</option>
                                @else
                                    <option value="{{ $document->id }}">{{ $document->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('document_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Upload Document</label>
                        <input type="file" name="document[]" id="document" onchange="preview_image();"
                            class="form-control" multiple>
                        <span class="text-danger">
                            @error('document')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div id="image_preview" class="mb-2">
                        @isset($userDocument->path)
                            @foreach ($userDocument->path as $image)
                                <img src="{{ asset($image) }}" alt="" name="oldImage" class="img-thumbnail"
                                    style="width: 100px;height: 100px;">
                            @endforeach
                        @endisset
                    </div>
                    <div class="form-group d-grid">
                        <input type="submit" value="Upload" class="btn btn-info bg-secondary-subtle b-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            $('#document').change(function() {
                var file = this.files.length;
               $('.img-thumbnail').hide();
            });
        });
    </script>
@endsection
