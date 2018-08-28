@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>News</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/news' => 'News']])
                @endcomponent

                <style>
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
                        <th class="align-center"><input type="checkbox" title="selectAll"></th>
                        <th>Title</th>
                        <th class="align-right">Date</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($articles as $article)
                        <tr>
                            <td class="align-center-center"><input type="checkbox" ></td>
                            <td><a href="{{url('article/' . $article->slug)}}">{{$article->title}}</a><br><span class="tags"><i class="fa fa-gamepad"></i> {{$article->game->title}}, <i class="fa fa-user"></i> {{$article->author->username}}</span></td>
                            <td class="align-right">{{$article->published_at}}<br><span class="status">{{$article->status}}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>

        </div>
    </div>
@endsection