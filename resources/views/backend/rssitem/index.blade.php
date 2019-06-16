@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", ["title" => "RSS Items", "url" => url('admin/rssitems'), "description" => "Overview of all the crawled news items from the world wide web."] )
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
                <h1>RSS Items</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/rssitems' => 'RSS Items']])
                @endcomponent

                <a class="button button-primary" href="{{ url('admin/articles/create')}}">Create an article</a>&nbsp;
                <a class="button button-primary" href="{{ url('crawler/crawl')}}" target="_blank"><i class="fa fa-refresh"></i></a>
                <a class="button button-primary" href="{{ url('admin/rssitems/find-keywords')}}" target="_blank">Find keywords</a>
                <a class="button button-primary" href="{{ url('admin/rssitems/suggest-game-title')}}" target="_blank">Suggest game title</a><br><br>

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

                        @foreach($rss_items as $rss_item)
                        <tr>
                            <td class="align-center-center"><input type="checkbox" title="id" value="{{$rss_item->id}}"/></td>
                            <td>
                                @if(isset($rss_item['suggestions']))

                                    <form id="{{ $rss_item->id }}">
                                        <a href="{{$rss_item->url}}" title="{{$rss_item->title}}" target="_blank">{{substr($rss_item->title, 0, 80)}}@if(strlen($rss_item->title) >= 80)...@endif</a>

                                        <br>

                                        @foreach($rss_item['suggestions'] as $key => $word)
                                            <input id="{{ $rss_item->id . $key }}" class="suggest" type="checkbox" value="{{ $word }}"><label for="{{ $rss_item->id . $key }}"><span class="suggestion">{{ $word }}</span></label>
                                        @endforeach
                                    </form>
                                    <a id="url-{{ $rss_item->id }}" class="button primary-button" href="{{ url("admin/games/create/") }}">Create game</a>
                                @else
                                    <a href="{{$rss_item->url}}" title="{{$rss_item->title}}" target="_blank">{{substr($rss_item->title, 0, 80)}}@if(strlen($rss_item->title) >= 80)...@endif</a>
                                @endif

                            </td>
                            <td class="align-right article-attributes not-on-mobile">
                                <span class="status">@if(isset($rss_item->website->title)){{$rss_item->website->title}} @endif</span>
                            </td>
                            <td class="align-right article-attributes not-on-mobile">
                                &nbsp;<a @if($rss_item->game_id != "") class="filled-attribute" title="{{$rss_item->game->title}}"@endif><i class="fa fa-gamepad"></i></a>&nbsp;
                            </td>
                            <td class="align-right">
                                <a href="{{url('/admin/articles/create')}}"><i class="fa fa-newspaper-o"></i></a> &nbsp;
                                <a href="{{$rss_item->url}}"><i class="fa fa-window-maximize"></i></a> &nbsp;
                                <a href="{{url('/admin/rssitems/'.$rss_item->id . '/edit')}}"><i class="fa fa-pencil"></i></a> &nbsp;
                                {{ Form::open(array('url' => url('/admin/rssitems/' . $rss_item->id), "class" => 'delete-row' )) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <button type='submit' value="delete"><i class="fa fa-trash"></i></button>
                                {{ Form::close() }}
                            </td>

                            <script>
                                $("form#{{ $rss_item->id }} :input").change(function() {

                                    var base_url = "{{ url("admin/games/create") }}/";
                                    var add_on = "";

                                    $('form#{{ $rss_item->id }} input:checkbox:checked').each(function () {
                                        if(add_on !== "") {
                                            add_on += "%20";
                                        }
                                        add_on += (this.checked ? $(this).val() : "");
                                    });

                                    $("#url-{{ $rss_item->id }}").attr("href", base_url + add_on)
                                });
                            </script>
                        </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>

        </div>
    </div>
@endsection