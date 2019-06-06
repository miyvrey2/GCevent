<div class="col-md-12">
    @include('backend.components.error')
</div>

<div class="col-md-9">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="title">Title *</label><br>
        <input type="text" class="form-control" id="title" name="title" required autocomplete="off" value="{{$rss_item->title}}">
    </div>

    <div class="form-group">
        <label for="url">url  *</label><br>
        <input type="text" class="form-control" id="url" name="url" required  autocomplete="off" value="{{$rss_item->url}}">
    </div>

    <div class="form-group">
        <label for="site">site  *</label><br>
        <input type="text" class="form-control" id="site" name="site" required  autocomplete="off" value="{{$rss_item->site}}">
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="game_id">Game</label><br>
        <select id="game_id" name="game_id">
            @foreach($games as $game)
                @if($game->id == $rss_item->game_id)
                    <option value="{{$game->id}}" selected>{{$game->title}}</option>
                @else
                    <option value="{{$game->id}}">{{$game->title}}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary button-full">Save</button>
    </div>

</div>

{{--jQuery--}}
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

{{--jQuery ui--}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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