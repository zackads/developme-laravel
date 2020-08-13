@extends("app")

@section("title") "Owners" @endsection

@section("content")
<h1>Owners</h1>
<p>These are the people we exploit for money.<p>
        @include("partials/owners_table")

        @endsection