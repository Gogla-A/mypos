@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.products')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}" ><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.products')</li>
            </ol>
        </section>

        <section class="content">

            {{--            @if($products->count() > 0)--}}
            <div class="box box-primary">
                {{--            @else--}}
                {{--            <h2>@lang('site.data_not_found')</h2>--}}
                {{--            @endif--}}
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 10px">@lang('site.products')  <small>{{ $products->total() }}</small></h3>


                    <form action="{{ route('dashboard.products.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>
                            <div class="col-md-4">
                                <select name="category_id" class="form-control">
                                    <option value="">@lang('site.all_categories')</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                {{--                        @if (auth()->user()->hasPermission('create_products'))--}}
                                <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                {{--                        @else--}}
                                {{--                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>--}}
                                {{--                        @endif--}}
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    @if ($products->count() > 0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: center">@lang('site.name')</th>
                                <th style="text-align: center">@lang('site.description')</th>
                                <th style="text-align: center">@lang('site.category')</th>
                                <th style="text-align: center">@lang('site.image')</th>
                                <th style="text-align: center">@lang('site.purchase_price')</th>
                                <th style="text-align: center">@lang('site.sale_price')</th>
                                <th style="text-align: center">@lang('site.profit_percent') %</th>
                                <th style="text-align: center">@lang('site.stock')</th>
                                <th style="text-align: center">@lang('site.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $index => $product)
                                <tr>
                                    <td style="vertical-align: middle;text-align: center">{{ $index + 1 }}</td>
                                    <td style="vertical-align: middle;text-align: center">{{ $product->name }}</td>
                                    <td style="vertical-align: middle;text-align: center">{!! $product->description !!}</td>
                                    <td style="vertical-align: middle;text-align: center">{{ $product->category->name }}</td>
                                    <td style="vertical-align: middle;text-align: center"><img src="{{ asset('upload/product_image/product2.png') }}"
                                                                            {{--                                             "{{ $product->image_path }}" --}}
                                                                            style="width: 70px"  class="img-thumbnail" alt=""></td>
                                    <td style="vertical-align: middle;text-align: center">{{ $product->purchase_price }}</td>
                                    <td style="vertical-align: middle;text-align: center">{{ $product->sale_price }}</td>
                                    <td style="vertical-align: middle;text-align: center">{{ $product->profit_percent }} %</td>
                                    <td style="vertical-align: middle;text-align: center">{{ $product->stock }}</td>
                                    <td style="vertical-align: middle;text-align: center">
                                        {{--                                    @if (auth()->user()->hasPermission('update_products'))--}}
                                        <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        {{--                                    @else--}}
                                        {{--                                        <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>--}}
                                        {{--                                    @endif--}}
                                        {{--                                    @if (auth()->user()->hasPermission('delete_products'))--}}
                                        <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post" style="display: inline-block">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        </form><!-- end of form -->
                                        {{--@else--}}
                                        {{--<button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>--}}
                                        {{--@endif--}}

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div style="text-align: center">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                    @else


                        <h2>@lang('site.no_data_found')</h2>

                    @endif
                </div>
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
@endsection
