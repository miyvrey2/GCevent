@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", ["title" => "RSS websites", "url" => url('admin/rsswebsites'), "description" => "Overview of all the rss websites on gamescomevent.com"] )
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
                <h1>RSS Websites</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/rsswebsites' => 'RSS Websites']])
                @endcomponent

                <a class="button button-primary" href="{{ url('admin/rsswebsites/create')}}">Create an RSS website</a><br><br>

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
                        <th>RSS website names</th>
                        <th class="align-right" style="width: 40px;"><i class="fa fa-newspaper-o"></i></th>
                        <th class="align-right" style="width: 40px;"><i class="fa fa-newspaper-o"></i></th>
                        <th class="align-right">Tools</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($rss_websites as $rss_website)
                        <tr>
                            <td class="align-center-center">
                                <input type="checkbox" title="id" value="{{$rss_website->id}}"/>
                            </td>
                            <td><a href="{{url('/admin/rsswebsites/' . $rss_website->id)}}">{{$rss_website->title}}</a></td>
                            <td class="align-right rsswebsite-attributes">
                                <a title="Amount of articles last 2 days">{{ $rss_website->count }} </a>
                            </td>
                            <td class="align-right rsswebsite-attributes"  style="width: 40px;">
                                <a title="Amount of articles last 2 days">{{ $rss_website->all }}</a>
                            </td>
                            <td class="align-right">
                                <a href="{{url('/admin/rsswebsites/' . $rss_website->id . '/edit')}}"><i class="fa fa-pencil"></i></a> &nbsp;
                                {{ Form::open(array('url' => url('/admin/rsswebsites/' . $rss_website->id), "class" => 'delete-row' )) }}
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