@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", ["title" => "Users", "url" => url('admin/users'), "description" => "Overview of all the users on ishetalvakantie.nl"] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Users</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/users' => 'Users']])
                @endcomponent

                <a class="button button-primary" href="{{ url('admin/users/create')}}">Create a user</a><br><br>

                <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-3.4.1.slim.min.js"></script>
                <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.js')}}"></script>
                <script type="text/javascript" language="javascript" class="init">
                    $(document).ready(function() {
                        $('#example').DataTable({

                            "paging":   false,
                            "ordering": true,
                            "info":     false,
                            "searching":   true

                        });
                    } );
                </script>

                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="align-center-center">
                            <input type="checkbox" title="selectAll">
                        </th>
                        <th>Users</th>
                        <th class="align-right">Tools</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($users as $user)
                        <tr>
                            <td class="align-center-center">
                                <input type="checkbox" title="id" value="{{$user->id}}"/>
                            </td>
                            <td><a href="{{url($user->id)}}">{{$user->username}}</a></td>
                            <td class="align-right">
                                <a href="{{url('/user/' . $user->id)}}"><i class="fa fa-window-maximize"></i></a> &nbsp;
                                <a href="{{url('/admin/users/' . $user->id . '/edit')}}"><i class="fa fa-pencil"></i></a> &nbsp;
                                {{ Form::open(array('url' => url('/admin/users/' . $user->id), "class" => 'delete-row' )) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <button type='submit' value="delete"><i class="fa fa-trash"></i></button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>

        </div>
    </div>
@endsection