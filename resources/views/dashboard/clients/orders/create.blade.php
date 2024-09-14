@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>
                <small>@lang('site.clients')</small> <br>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.clients.index') }}">@lang('site.clients')</a></li>
{{--                <li><a href="{{ route('dashboard.orders') }}">@lang('site.orders')</a></li>--}}
                <li class="active"> @lang('site.add')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3>@lang('site.add')</h3>
                </div>

                <div class="box-body">
                   <h2>Body</h2>
                </div>

            </div>


        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
@endsection
