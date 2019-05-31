@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", ["title" => "Crawled news", "url" => url('admin/news/incoming'), "description" => "Overview of all the crawled news items from the world wide web."] )
    @endcomponent
@endsection

@section('content')

    <style>
        #example tr td:last-of-type,
        #example tr th:last-of-type {
            width: 120px;
        }
    </style>

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Crawled feeds</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/news/incoming' => 'Crawled feeds']])
                @endcomponent

                <a class="button button-primary" href="{{ url('admin/articles/create')}}">Create an article</a>&nbsp;
                <a class="button button-primary" href="{{ url('crawler/crawl')}}" target="_blank"><i class="fa fa-refresh"></i></a>
                <a class="button button-primary" href="{{ url('admin/rssitems/find-keywords')}}" target="_blank">Find keywords</a>
                <a class="button button-primary" href="{{ url('admin/rssitems/suggest-game-title')}}" target="_blank">Suggest game title</a><br><br>

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

                        $('#selectAll').change(function(){
                            $("#example td input[type=checkbox]").each(function(){

                                if($('#selectAll').is(':checked')) {
                                    $(this).prop('checked', true);
                                } else {
                                    $(this).prop('checked', false);
                                }
                            })
                        });
                    } );
                </script>

                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="align-center-center">
                            <input type="checkbox" title="selectAll" id="selectAll">
                        </th>
                        <th>Crawled news items</th>
                        <th class="align-right not-on-mobile">Bron</th>
                        <th class="align-right not-on-mobile"></th>
                        <th class="align-right">Tools</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($feed_items as $feed_item)
                        <tr>
                            <td class="align-center-center"><input type="checkbox" title="id" value="{{$feed_item->id}}"/></td>
                            <td>
                                <a href="{{$feed_item->url}}" title="{{$feed_item->title}}" target="_blank">{{substr($feed_item->title, 0, 80)}}@if(strlen($feed_item->title) >= 80)...@endif</a>
                            </td>
                            <td class="align-right article-attributes not-on-mobile">
                                <span class="status">@if(isset($feed_item->website->title)){{$feed_item->website->title}} @endif</span>
                            </td>
                            <td class="align-right article-attributes not-on-mobile">
                                &nbsp;<a @if($feed_item->game_id != "") class="filled-attribute" title="{{$feed_item->game->title}}"@endif><i class="fa fa-gamepad"></i></a>&nbsp;
                            </td>
                            <td class="align-right">
                                <a href="{{url('/admin/articles/create')}}"><i class="fa fa-newspaper-o"></i></a> &nbsp;
                                <a href="{{$feed_item->url}}"><i class="fa fa-window-maximize"></i></a> &nbsp;
                                <a href="{{url('/admin/feed/'.$feed_item->id . '/edit')}}"><i class="fa fa-pencil"></i></a> &nbsp;
                                {{ Form::open(array('url' => url('/admin/feed/' . $feed_item->id), "class" => 'delete-row' )) }}
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