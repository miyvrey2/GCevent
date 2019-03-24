@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Create an user</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/users' => 'User', 'admin/users/create' => 'Create a user']])
                @endcomponent

            </div>

            <form method="POST" action="{{url('/admin/users')}}">

                {{--Load the form--}}
                @component('backend.user.form', compact('user'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection