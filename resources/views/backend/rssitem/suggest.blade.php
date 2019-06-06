@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", ["title" => "Suggest game title from RSS Items", "url" => url('admin/rssitems/suggest-game-title'), "description" => "Overview of all the crawled news items from the world wide web."] )
    @endcomponent
@endsection

@section('content')

    <style>
        #example tr td:last-of-type,
        #example tr th:last-of-type {
            width: 200px;
            padding-top: 20px;
            text-align: right;
            padding-right: 0;
        }
    </style>

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Suggest game title from RSS Items</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/rssitems/suggest-game-title' => 'Suggest game title from RSS Items']])
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
                        <th>Crawled RSS Items</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($suggestions as $sug_id => $suggestion)
                        <tr>
                            <td>
                                <form id="{{ $sug_id }}">
                                {{ $suggestion['title'] }} <br>
                                @foreach($suggestion['words'] as $key => $word)
                                    <input id="{{ $sug_id . $key }}" class="suggest" type="checkbox" value="{{ $word }}"><label for="{{ $sug_id . $key }}"><span class="suggestion">{{ $word }}</span></label>
                                @endforeach
                                </form>
                            </td>
                            <td>
                                <a id="url-{{ $sug_id }}" class="button primary-button" href="{{ url("admin/games/create/") }}">Create game</a>
                            </td>
                        </tr>
                        <script>
                            $("form#{{ $sug_id }} :input").change(function() {

                                var base_url = "{{ url("admin/games/create") }}/";
                                var add_on = "";

                                $('form#{{ $sug_id }} input:checkbox:checked').each(function () {
                                    if(add_on !== "") {
                                        add_on += "%20";
                                    }
                                    add_on += (this.checked ? $(this).val() : "");
                                });

                                $("#url-{{ $sug_id }}").attr("href", base_url + add_on)
                            });
                        </script>
                    @endforeach

                    </tbody>
                </table>


            </div>

        </div>
    </div>
@endsection