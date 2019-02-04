@extends('adminlte::page')

@section('title', 'Portfolio')

@section('content_header')
    <h1>Portfolio</h1>
@stop


@section('content')

    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Filter</h3>
        </div>

        <div class="box-body">
            {{ \Form::open(['route' => 'admin.portfolio.index', 'method' => 'GET']) }}

            <div class="row">
                <div class="col-md-6">
                    <b>Categories</b>
                    @foreach(\App\Models\Category::whereHas('portfolios')->get() as $category)
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    {{ \Form::checkbox('categories[]', $category->id, in_array($category->id, $_GET['categories'] ?? [])) }}
                                    {{ $category->title }}
                                </label>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="col-md-6">
                    <b>Title</b>
                    <div class="form-group">
                        {{ Form::text('title', $_GET['title'] ?? '') }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {{ Form::submit('Filter!', ['class' => 'btn btn-block btn-success btn-sm']) }}
                </div>
                <div class="col-md-6">
                    <a href="{{ route('admin.portfolio.index') }}">
                        {{ Form::button('Reset', ['class' => 'btn btn-block btn-info btn-sm']) }}
                    </a>
                </div>
            </div>


            {{ \Form::close() }}
        </div>
    </div>

    <div class="box">

        <div class="box-body">

            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Categories</th>
                    <th>User</th>
                    <th colspan="2"></th>
                </tr>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}.</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            @foreach($item->categories as $category)
                                <div style="white-space: nowrap">{{ $category->title }}</div>
                            @endforeach
                        </td>
                        <td>{{ $item->user->name }}</td>
                        <td>
                            <a href="{{ route('admin.portfolio.edit', $item->id) }}">
                                <button type="button" class="btn btn-block btn-info btn-sm">Edit</button>
                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-block btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{ $items->links() }}
        </div>
    </div>

@endsection