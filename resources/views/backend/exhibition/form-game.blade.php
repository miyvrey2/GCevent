<div class="col-md-12">

    <div class="table-plain-box">
        <table id="example" cellspacing="0">
            <thead>
            <tr>
                <th></th>
                <th>Game</th>
                <th>Developer</th>
                <th>Publisher</th>
                <th>Hall</th>
                <th>Booth</th>
                <th>Submit</th>
            </tr>
            </thead>
            <tbody>

            <form method="POST" action="{{url('/admin/exhibitions/game/add')}}">

                {{ csrf_field() }}

                <tr>
                    <td>+</td>
                    <td>
                        <input type="hidden" class="form-control" id="exhibition_id" name="exhibition_id" value="{{ $exhibition->id }}">
                        <select class="form-control js-example-basic-multiple form-control" id="game_id" name="game_id">
                            @foreach($games as $game)
                                <option value="{{$game->id}}" selected>{{$game->title}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="developer_id" name="developer_id" value="">
                            <select class="form-control js-example-basic-multiple form-control" id="developer_id" name="developer_id">
                                <option value="null">---</option>

                                @foreach($developers as $developer)
                                    <option value="{{$developer->id}}">{{$developer->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="publisher_id" name="publisher_id" value="">
                            <select class="form-control js-example-basic-multiple form-control" id="publisher_id" name="publisher_id">
                                <option value="null">---</option>

                                @foreach($publishers as $publisher)
                                    <option value="{{$publisher->id}}">{{$publisher->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="hall" name="hall" />
                    </td>
                    <td>
                        <input type="text" class="form-control" id="booth" name="booth" />
                    </td>
                    <td>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary button-full">Save</button>
                        </div>
                    </td>
                </tr>
            </form>

            @foreach($exhibition->booths as $booth)

                    <form method="POST" action="{{url('/admin/exhibitions/game/update')}}">

                    {{ csrf_field() }}

                    <tr>
                        <td>⚪</td>
                        <td>
                            <input type="hidden" class="form-control" id="id" name="id" value="{{ $booth->id }}">
                            <input type="hidden" class="form-control" id="exhibition_id" name="exhibition_id" value="{{ $booth->exhibition_id }}">
                            <input type="hidden" class="form-control" id="game_id" name="game_id" value="{{ $booth->game_id }}">
                            {{ $booth->game->title }}
                        </td>
                        <td>
                            <select class="form-control js-example-basic-multiple form-control" id="developer_id-{{ $booth->id }}" name="developer_id-{{ $booth->id }}">
                                <option value="null">---</option>

                                @foreach($developers as $developer)
                                    @if($booth->developer_id != null && $developer->id == $booth->developer_id)
                                        <option value="{{ $developer->id }}" selected>{{ $developer->title }}</option>
                                    @else
                                        <option value="{{ $developer->id }}">{{ $developer->title }}</option>
                                    @endif
                                @endforeach

                            </select>
                        </td>
                        <td>
                            <select class="form-control js-example-basic-multiple form-control" id="publisher_id-{{ $booth->id }}" name="publisher_id-{{ $booth->id }}">
                                <option value="null">---</option>

                                @foreach($publishers as $publisher)
                                    @if($booth->publisher_id != null && $publisher->id == $booth->publisher_id)
                                        <option value="{{ $publisher->id }}" selected>{{ $publisher->title }}</option>
                                    @else
                                        <option value="{{ $publisher->id }}">{{ $publisher->title }}</option>
                                    @endif
                                @endforeach

                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="hall" name="hall" value="{{ $booth->hall }}" />
                        </td>
                        <td>
                            <input type="text" class="form-control" id="booth" name="booth" value="{{ $booth->booth }}" />
                        </td>
                        <td>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary button-full">Update</button>
                            </div>
                        </td>
                    </tr>
                    </form>
                @endforeach
            </tbody>
        </table>
    </div>

    {{--<table id="aa" cellspacing="0">--}}
        {{--<thead>--}}
        {{--<tr>--}}
            {{--<th>Title</th>--}}
            {{--<th>Developer</th>--}}
            {{--<th>Publisher</th>--}}
            {{--<th>Hall</th>--}}
            {{--<th>Booth</th>--}}
            {{--<th>Submit</th>--}}
        {{--</tr>--}}
        {{--</thead>--}}
        {{--<tbody>--}}

            {{--<form method="POST" action="{{url('/admin/exhibitions/game/add')}}">--}}

                {{--{{ csrf_field() }}--}}

                {{--<tr>--}}
                    {{--<td>--}}
                        {{--<input type="hidden" class="form-control" id="exhibition_id" name="exhibition_id" value="{{ $exhibition->id }}">--}}
                        {{--<select class="form-control js-example-basic-multiple form-control" id="game_id" name="game_id">--}}
                            {{--@foreach($games as $game)--}}
                                {{--<option value="{{$game->id}}" selected>{{$game->title}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</td>--}}
                    {{--<td>--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="hidden" class="form-control" id="developer_id" name="developer_id" value="">--}}
                            {{--<select class="form-control js-example-basic-multiple form-control" id="developer_id" name="developer_id">--}}
                                {{--<option value="null">---</option>--}}

                                {{--@foreach($developers as $developer)--}}
                                {{--<option value="{{$developer->id}}">{{$developer->title}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</td>--}}
                    {{--<td>--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="hidden" class="form-control" id="publisher_id" name="publisher_id" value="">--}}
                            {{--<select class="form-control js-example-basic-multiple form-control" id="publisher_id" name="publisher_id">--}}
                                {{--<option value="null">---</option>--}}

                                {{--@foreach($publishers as $publisher)--}}
                                    {{--<option value="{{$publisher->id}}">{{$publisher->title}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</td>--}}
                    {{--<td>--}}
                        {{--<input type="text" class="form-control" id="hall" name="hall" />--}}
                    {{--</td>--}}
                    {{--<td>--}}
                        {{--<input type="text" class="form-control" id="booth" name="booth" />--}}
                    {{--</td>--}}
                    {{--<td>--}}
                        {{--<div class="form-group">--}}
                            {{--<button type="submit" class="btn btn-primary button-full">Save</button>--}}
                        {{--</div>--}}
                    {{--</td>--}}
                {{--</tr>--}}
            {{--</form>--}}
        {{--</tbody>--}}
    {{--</table>--}}

</div>


{{-- TinyMCE --}}
<script type="text/javascript" src="//cloud.tinymce.com/stable/tinymce.min.js"></script>

{{-- jQuery --}}
<script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>

{{-- jQuery UI --}}
<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

{{-- Select 2 --}}
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $( function() {

        var games = [
            @foreach($games as $game)
                "{{$game->title}}",
            @endforeach
        ];

        // Help by autocomplete to prevent doubles
        $('#title').autocomplete({
            source: games
        });
    });
</script>