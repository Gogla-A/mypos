@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}" ><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.users')</li>
            </ol>
        </section>

        <section class="content">

            {{--            @if($users->count() > 0)--}}
            <div class="box box-primary">
                {{--            @else--}}
                {{--            <h2>@lang('site.data_not_found')</h2>--}}
                {{--            @endif--}}
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 10px">@lang('site.users')  <small>{{ $users->total() }}</small></h3>

                    <form action="{{ route('dashboard.users.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                {{--                        @if (auth()->user()->hasPermission('create_users'))--}}
                                <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                {{--                        @else--}}
                                {{--                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>--}}
                                {{--                        @endif--}}
                            </div>
                        </div>
                    </form>
                </div>

                <div class="box-body">
                    @if ($users->count() > 0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.first_name')</th>
                                <th>@lang('site.last_name')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td style="vertical-align: middle">{{ $index + 1 }}</td>
                                    <td style="vertical-align: middle">{{ $user->first_name }}</td>
                                    <td style="vertical-align: middle">{{ $user->last_name }}</td>
                                    <td style="vertical-align: middle">{{ $user->email }}</td>
                                    <td style="vertical-align: middle"><img src="{{ $user->image_path }}" style="width: 70px;" class="img-thumbnail" alt=""></td>
                                    <td style="vertical-align: middle">
                                        {{--                                    @if (auth()->user()->hasPermission('update_users'))--}}
                                        <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        {{--                                    @else--}}
                                        {{--                                        <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>--}}
                                        {{--                                    @endif--}}
                                        {{--                                    @if (auth()->user()->hasPermission('delete_users'))--}}
                                        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="post" style="display: inline-block">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        </form><!-- end of form -->
                                        {{--                                    @else--}}
                                        {{--                                        <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>--}}
                                        {{--                                        @endif--}}

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div style="text-align: center">
                            {{ $users->links('pagination::bootstrap-4') }}
                        </div>

                    @else

                        <h2>@lang('site.no_data_found')</h2>

                    @endif
                </div>
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
@endsection
