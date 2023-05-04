@extends('layouts.dashboard')
@section('title', 'Categories ')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">Categories </li>
    <li class="breadcrumb-item active">Trash </li>
@endsection
@section('content')
<div class="mb-5">
    <a href="{{ route('dashboard.categories.index') }}" class="btn btn-sm btn-outline-primary">Back</a>
</div>
<x-alert type="success"/>
<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
    <x-form.input name="name" placeholder="name" class="mx-2"/>
    {{-- value={{"request('name')"}} --}}
    <select name="status" class="form-control mx-2">
        <option value="">All</option>
        <option value="active"@selected(request('status')=='active')>Active</option>
        <option value="archived"@selected(request('status'=='archived'))>Archived</option>
    </select>
    <button class="btn btn-dark mx-2">Filter</button>
</form>
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Id</th>
                <th>Name</th>
                <th>status</th>
                <th>deleted At</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($categories as $category)
                <tr>
                    <td> <img src=" {{ asset('storage/'.$category->image) }}" alt=""hieght="50" > </td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->deleted_at }}</td>
                    <td>
                        <form action="{{ route('dashboard.categories.restore',$category->id) }}" method="post">
                            @csrf
                            @method('put')
                        <button type="submit" class="btn btn-sm btn-outline-primary">Restore</button>
                    </form>

                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.force-delete',$category->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Force Delete</button>
                    </form>
                    </td>
                </tr>

            @empty
            <tr>
                <td colspan="7">no categories</td>
            </tr>
            @endforelse

        </tbody>
    </table>
    {{  $categories->withQueryString()->links() }}



@endsection

@push('scripts')
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@endpush
