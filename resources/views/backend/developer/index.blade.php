@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", ["title" => "Developers overview", "url" => url('admin/developers'), "description" => "Overview of all the developers on Enzow.org"] )
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
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/developers' => 'Developers']])
                @endcomponent

                <a class="button button-primary" href="{{ url('admin/developers/create')}}">Add a developer</a><br><br>

                <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-3.4.1.slim.min.js"></script>
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