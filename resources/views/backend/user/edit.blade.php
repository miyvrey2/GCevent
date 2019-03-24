@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Edit "{{$user->username}}"</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/users' => 'users', 'admin/users/' . $user->id . '/edit' => 'Edit "' . $user->username . '"']])
                @endcomponent
            </div>

            <form method="POST" action="{{url('/admin/users/' . $user->id)}}">

                {{--Set the post method to patch--}}
                {{ method_field('PATCH') }}

                {{--Load the form--}}
                @component('backend.user.form', compact('user', 'games'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection