@extends('layouts.dashboard')
@section('title', $category->name)
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories </li>
    <li class="breadcrumb-item active">{{ $category->name }} </li>
@endsection
@section('content')

<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>parent</th>
            <th>status</th>
            <th>Created At</th>

        </tr>
    </thead>
    <tbody>
        @php
            $products = $category->products()->with('store')->paginate(5);
        @endphp

        @forelse (  $products as $product)
            <tr>
                <td> <img src=" {{ asset('storage/'.$product->image) }}" alt=""hieght="50" > </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->parent_id }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->created_at }}</td>

            </tr>

        @empty
        <tr>
            <td colspan="5">no categories</td>
        </tr>
        @endforelse

    </tbody>
</table>
{{   $products->links() }}

@endsection

