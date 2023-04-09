@extends('layouts.dashboard')
@section('title', 'Categories ')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories </li>
@endsection
@section('content')
<div class="mb-5">
    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary">Add New Category</a>
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
                <th>parent</th>
                <th>status</th>
                <th>Created At</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($categories as $category)
                <tr>
                    <td> <img src=" {{ asset('storage/'.$category->image) }}" alt=""hieght="50" > </td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent_id }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.categories.edit',$category->id) }}" class="btn btn-sm btn-outline-primary">Edite</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.destroy',$category->id) }}" method="post"></form>
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>

            @empty
            <tr>
                <td colspan="7">no categories</td>
            </tr>
            @endforelse

        </tbody>
    </table>
    {{  $categories->withQueryString( )->links() }}



@endsection

@push('scripts')
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@endpush
