<div class="col-md-12">

    <div class="table-plain-box">
        <table id="example" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Developer</th>
                <th>Publisher</th>
                <th>Hall</th>
                <th>Booth</th>
                <th>Submit</th>
            </tr>
            </thead>
            <tbody>
            @foreach($games as $game)

                <form method="POST" action="{{url('/admin/exhibitions/game/add')}}">

                {{ csrf_field() }}

                <tr>
                    <td>
                        {{ $game->id }}
                        <input type="hidden" class="form-control" id="exhibition_id" name="exhibition_id" value="{{ $exhibition->id }}">
                        <input type="hidden" class="form-control" id="game_id" name="game_id" value="{{ $game->id }}">
                    </td>
                    <td>{{ $game->title }}</td>
                    <td>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="developer_id-{{ $game->id }}" name="developer_id-{{ $game->id }}" value="">
                            <select class="form-control js-example-basic-multiple form-control" id="developer_id-{{ $game->id }}[]" name="developer_id-{{ $game->id }}[]" multiple="multiple">
                                @foreach($game->developers as $developer)
                                    <option value="{{$developer->id}}" selected>{{$developer->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <input type="hidden" class="form-control" id="publisher_id-{{ $game->id }}" name="publisher_id-{{ $game->id }}" value="">
                        <select class="form-control js-example-basic-multiple form-control" id="publisher_id-{{ $game->id }}[]" name="publisher_id-{{ $game->id }}[]" multiple="multiple">
                            @foreach($game->publishers as $publisher)
                                <option value="{{$publisher->id}}" selected>{{$publisher->title}}</option>
                            @endforeach
                        </select>
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
            @endforeach
            </tbody>
        </table>
    </div>


</div>