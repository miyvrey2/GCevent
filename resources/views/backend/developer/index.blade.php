@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", ["title" => "developers overview", "url" => url('admin/developers'), "description" => "Overview of all the developers on Enzow.org"] )
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
                <h1>Developers</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/developers' => 'developers']])
                @endcomponent

                <a class="button button-primary" href="{{ url('admin/developers/create')}}">Add a developer</a><br><br>

                <style>

                    .dataTables_length {
                        display: none;
                    }

                    .paging_numbers a {
                        width: 25px;
                        height: 25px;
                        line-height: 25px;
                        display: inline-block;
                        background-color: #DDDDDD;
                        color: white;
                        text-align: center;
                        margin: 8px 8px 0 0;
                        text-decoration: none;
                    }

                    .paging_numbers a.current {
                        background-color: #BBBBBB;
                    }

                    .paging_numbers a:hover {
                        background-color: #BBBBBB;
                        text-decoration: none;
                        cursor: pointer;
                    }

                    #example_filter input[type="search"] {
                        height: 30px;
                        width: 100%;
                        margin: 5px 0 10px;
                    }

                    #example thead{
                        text-align: left;
                        background-color: #EEEEEE;
                    }

                    #example thead th,
                    #example tr td {
                        padding: 6px 0;
                        vertical-align: top;
                        border-bottom: 1px solid #CCCCCC;
                    }

                    #example thead th {
                        border-top: 1px solid #CCCCCC;
                    }

                    #example tr td span.tags {
                        font-style: italic;
                        font-size: 12px;
                    }

                    #example tr td span.status {
                        color: #888888;
                    }

                    #example tr th input[type="checkbox"],
                    #example tr td input[type="checkbox"] {
                        margin: 0;
                    }

                    #example tr td:last-of-type,
                    #example tr th:last-of-type {
                        padding-right: 10px;
                    }
                </style>

                <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>
                <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.js')}}"></script>
                <script type="text/javascript" language="javascript" class="init">
                    $(document).ready(function() {
                        $('#example').DataTable({

                            "paging":       true,
                            "pagingType":   "numbers",
                            "lengthMenu":   [[100, 250, -1], [100, 250, "All"]],
                            "ordering":     true,
                            "info":         false,
                            "searching":    true

                        });
                    } );
                </script>

                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="align-center-center">
                            <input type="checkbox" title="selectAll">
                        </th>
                        <th>Title</th>
                        <th class="align-right not-on-mobile"></th>
                        <th class="align-right">Tools</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($developers as $developer)
                        <tr>
                            <td class="align-center-center">
                                <input type="checkbox" title="id" value="{{$developer->id}}"/>
                            </td>
                            <td><a href="{{url('developers/' . $developer->slug)}}">{{$developer->title}}</a><br><span class="tags"></span></td>
                            <td class="align-right developer-attributes not-on-mobile">
                                <a @if($developer->released != "") class="filled-attribute" @endif title="{{$developer->released}}"><i class="fa fa-calendar"></i></a>&nbsp;
                                {{--<a @if(!$developer->genres->isEmpty()) class="filled-attribute" @endif title="Genres: @foreach($developer->genres as $genreA) {{$genreA->title}}, @endforeach"><i class="fa fa-book"></i></a>&nbsp;--}}
                                <a @if(!$developer->games->isEmpty()) class="filled-attribute" @endif title="Games: {{count($developer->games)}}"><i class="fa fa-gamepad"></i></a>&nbsp;
                            </td>
                            <td class="align-right">
                                <a href="{{url('/developers/' . $developer->slug)}}"><i class="fa fa-window-maximize"></i></a> &nbsp;
                                <a href="{{url('/admin/developers/' . $developer->slug . '/edit')}}"><i class="fa fa-pencil"></i></a> &nbsp;
                                {{ Form::open(array('url' => url('/admin/developers/' . $developer->slug), "class" => 'delete-row' )) }}
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