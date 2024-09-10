@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>
                <small>@lang('site.It all starts here')</small> <br>
            </h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
            </ol>
        </section>

        <section class="content">

            <h1>@lang('site.This is dashboard')</h1>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
