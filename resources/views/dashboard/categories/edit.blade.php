@extends('layouts.dashboard')
@section('title', 'Categories ')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories </li>
@endsection
@section('content')
    <form action="{{ route('dashboard.categories.update',$categories->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.categories._form',['button'=>'update'])
    </form>

@endsection

@push('scripts')
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@endpush
