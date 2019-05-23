@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{ $rss_website->title }} <a href="{{ url('/admin/rsswebsites/' . $rss_website->id . '/edit') }}"> <i class="fa fa-pencil"></i></a></h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/rsswebsites' => 'RSS Websites', 'admin/rsswebsites/' . $rss_website->id => $rss_website->title]])
                @endcomponent

                <h2>Info</h2>
                Title: {{ $rss_website->title }} <br>
                Website URL: <a href="{{ $rss_website->url }}" title="{{ $rss_website->title }}">{{ $rss_website->url }}</a> <br>
                RSS URL: <a href="{{ $rss_website->rss_url }}" title="{{ $rss_website->title }} rss feed">{{ $rss_website->rss_url }}</a> <br>
                <br>
            </div>

            <div class="col-md-12">

                <h2>Articles</h2>

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
                        <th class="align-center-center">
                            <input type="checkbox" title="selectAll">
                        </th>
                        <th>Crawled news items</th>
                        <th class="align-right">Tools</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($rss_articles as $rss_article)
                        <tr>
                            <td class="align-center-center">
                                <input type="checkbox" title="id" value="{{$rss_article->id}}"/>
                            </td>
                            <td>
                                <a href="{{$rss_article->url}}" title="{{$rss_article->title}}" target="_blank">{{substr($rss_article->title, 0, 80)}}@if(strlen($rss_article->title) >= 80)...@endif</a>
                            </td>

                            <td class="align-right">&nbsp;
                                <a href="{{$rss_article->url}}"><i class="fa fa-window-maximize"></i></a> &nbsp;
                                <a href="{{url('/admin/feed/'.$rss_article->id . '/edit')}}"><i class="fa fa-pencil"></i></a> &nbsp;
                                {{ Form::open(array('url' => url('/admin/feed/' . $rss_article->id), "class" => 'delete-row' )) }}
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