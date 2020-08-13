@if ($owners->isEmpty())
<em>There are no owners sad_face.jpg</em>
@else
@foreach ($owners as $owner)
<div class="list-group">

    <a href="/owners/{{ $owner->id }}" class="list-group-item 􏰀→ list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ $owner->fullName() }}</h5>
            <small>{{ $owner->fullAddress() }}</small>
        </div>
    </a>
</div>
@endforeach
{{ $owners->links() }}
@endif