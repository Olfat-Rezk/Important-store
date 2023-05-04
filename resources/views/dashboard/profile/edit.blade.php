@extends('layouts.dashboard')
@section('title', 'Categories ')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit profil </li>
@endsection
@section('content')
    <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        @include('dashboard.categories._form',['button'=>'update'])
    </form>

@endsection

@push('scripts')
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@endpush
