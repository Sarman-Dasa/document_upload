@include('layout.link')
<div class="contenier table table-secondary mt-5 mb-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="md-4 text-center bg-secondary">
                <h3>User Login</h3>
            </div>
            <form action="{{ route('login') }}" method="POST" class="p-4">
                @csrf

                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control"  value="{{old('email')}}">
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control">
                    <span class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group d-grid">
                    <input type="submit" value="Login" class="btn btn-info bg-secondary-subtle b-block">
                </div>
            </form>
        </div>
    </div>
</div>
