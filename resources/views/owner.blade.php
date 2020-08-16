@extends("app")
@section("content")
<div class="card">
    <h2 class="card-header">{{ $owner->fullName() }}</h2>
    <article class="card-body">
        {{ $owner->fullAddress() }}
        <h3>Animals</h3>
        <ul>
            @foreach ($owner->animals as $animal)
            <li>
                Name: {{ $animal->name }}
                <ul>
                    <li>Type: {{ $animal->type}}</li>
                    <li>Date of birth: {{ $animal->dob}}</li>
                    <li>Weight {{ $animal->weight}}</li>
                    <li>Height: {{ $animal->height}}</li>
                    <li>Biteyness: {{ $animal->biteyness}}</li>
                    <li>Dangerous: {{ $animal->dangerous() ? "True" : "False" }}</li>
                </ul>
            </li>
            @endforeach
        </ul>
    </article>
</div>
@endsection