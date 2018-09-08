@extends('cms::layouts.master')

@section('content')
    <h1>Hello SOME</h1>

    <p>
        This view is loaded from module: {!! config('cms.name') !!}
    </p>
@stop
