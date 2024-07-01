---
permalink: 404.html
---

@extends('_layouts.main')

@section('content')
    <div class="bg-indigo-50 p-4 shadow rounded | dark:bg-indigo-900">
        <h1 class="font-extrabold text-4xl border-b border-indigo-100 pb-2 mb-2 | dark:border-indigo-950">That's a 404!</h1>

        <p>
            Looks like you took a wrong turn somewhere. Care to <a href="{{ $page->link('/') }}">go back home</a>?
        </p>
    </div>
@endsection
