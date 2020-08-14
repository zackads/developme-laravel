@extends("app")
@section("content")
<form class="form card" method="post">
    @csrf
    <h2 class="card-header">New owner</h2>
    <fieldset class="card-body">
        <div class="form-group">
            <label>First name<input name="first_name" class="form-control" /></label>
        </div>
        <div class="form-group">
            <label>Last name<input name="last_name" class="form-control" /></label>
        </div>
        <div class="form-group">
            <label>Email<input name="email" class="form-control" /></label>
        </div>
        <div class="form-group">
            <label>Telephone<input name="telephone" class="form-control" /></label>
        </div>
        <div class="form-group">
            <label>Address 1<input name="address_1" class="form-control" /></label>
        </div>
        <div class="form-group">
            <label>Address 2<input name="address_2" class="form-control" /></label>
        </div>
        <div class="form-group">
            <label>City/Town<input name="town" class="form-control" /></label>
        </div>
        <div class="form-group">
            <label>Postcode<input name="postcode" class="form-control" /></label>
        </div>
    </fieldset>
    <div class="card-footer text-right">
        <button class="btn btn-success">Create</button>
    </div>
</form>
@endsection