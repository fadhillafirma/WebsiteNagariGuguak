@extends('layout.sidebar')

@section('content')
<div class="container">
    <h1>Edit Data Lahan</h1>
    <form action="{{ route('demografi-lahan.update', $lahan_data->id_lahan_data) }}" method="POST">
        @csrf
        @method('PUT')
        @include('lahan_data._form', ['button' => 'Update'])
    </form>
</div>
@endsection
