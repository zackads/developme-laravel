@extends("app")
@section("content")
<form class="form card" method="post">
    @csrf
    <h2 class="card-header">New owner</h2>
    <fieldset class="card-body">
        <div class="form-group">
            <label>First name<input name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                    value="{{ old('first_name') }}" /></label>
        </div>
        @error('first_name')
        <p class="invalid-feedback d-block">
            {{ $message }} </p>
        @enderror
        <div class="form-group">
            <label>Last name<input name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                    value="{{ old('last_name') }}" /></label>
        </div>
        @error('last_name')
        <p class="invalid-feedback d-block">
            {{ $message }} </p>
        @enderror
        <div class="form-group">
            <label>Email<input name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" /></label>
        </div>
        @error('email')
        <p class="invalid-feedback d-block">
            {{ $message }} </p>
        @enderror
        <div class="form-group">
            <label>Telephone<input name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                    value="{{ old('telephone') }}" /></label>
        </div>
        @error('telephone')
        <p class="invalid-feedback d-block">
            {{ $message }} </p>
        @enderror
        <div class="form-group">
            <label>Address 1<input name="address_1" class="form-control @error('address_1') is-invalid @enderror"
                    value="{{ old('address_1') }}" /></label>
        </div>
        @error('address_1')
        <p class="invalid-feedback d-block">
            {{ $message }} </p>
        @enderror
        <div class="form-group">
            <label>Address 2<input name="address_2" class="form-control @error('address_2') is-invalid @enderror"
                    value="{{ old('address_2') }}" /></label>
        </div>
        @error('address_2')
        <p class="invalid-feedback d-block">
            {{ $message }} </p>
        @enderror
        <div class="form-group">
            <label>City/Town<input name="town" class="form-control @error('town') is-invalid @enderror"
                    value="{{ old('town') }}" /></label>
        </div>
        @error('town')
        <p class="invalid-feedback d-block">
            {{ $message }} </p>
        @enderror
        <div class="form-group">
            <label>Postcode<input name="postcode" class="form-control @error('postcode') is-invalid @enderror"
                    value="{{ old('postcode') }}" /></label>
        </div>
        @error('postcode')
        <p class="invalid-feedback d-block">
            {{ $message }} </p>
        @enderror
    </fieldset>
    <div class="card-footer text-right">
        <button class="btn btn-success">Create</button>
    </div>
</form>
@endsection