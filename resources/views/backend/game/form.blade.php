<div class="col-md-12">
    @include('backend.components.error')
</div>

<div class="col-md-9">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="title">Title *</label><br>
        <input type="text" class="form-control" id="title" name="title" required autocomplete="off" value="{{$game->title}}">
    </div>

    <div class="form-group">
        <label for="slug">Slug *</label><br>
        <input type="text" class="form-control" id="slug" name="slug" required  autocomplete="off" value="{{$game->slug}}">
    </div>

    <div class="form-group">
        <label for="excerpt">Exerpt</label><br>
        <textarea type="text" class="form-control" id="excerpt" name="excerpt" autocomplete="off">{{$game->excerpt}}</textarea>
    </div>

    <div class="form-group">
        <label for="body">Body</label><br>
        <textarea type="text" class="form-control" id="body" name="body" autocomplete="off">{{$game->body}}</textarea>
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="publishers[]">Publishers</label><br>
        <select class="form-control js-example-basic-multiple form-control" id="publishers[]" name="publishers[]" multiple="multiple">
            @foreach($game->publishers as $publisher)
                <option value="{{$publisher->id}}" selected>{{$publisher->title}}</option>
            @endforeach

            @foreach($publishers as $publisher)
                <option value="{{$publisher->id}}">{{$publisher->title}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="developers[]">Developers</label><br>
        <select class="form-control js-example-basic-multiple form-control" id="developers[]" name="developers[]" multiple="multiple">
            @foreach($game->developers as $developer)
                <option value="{{$developer->id}}" selected>{{$developer->title}}</option>
            @endforeach

            @foreach($developers as $developer)
                <option value="{{$developer->id}}">{{$developer->title}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="released_at">Release date</label><br>
        <span class="note"><strong>note:</strong> "2018-00-00" notes as "in 2018"</span>
        <input type="text" class="form-control" id="released_at" name="released_at" autocomplete="off" value="{{$game->released_at}}">
    </div>

    <div class="form-group">
        <label for="platforms[]">Platforms</label><br>
        <select class="form-control js-example-basic-multiple form-control" id="platforms[]" name="platforms[]" multiple="multiple">
            @foreach($game->platforms as $platform)
                <option value="{{$platform->id}}" selected>{{$platform->title}}</option>
            @endforeach

            @foreach($platforms as $platform)
                <option value="{{$platform->id}}">{{$platform->title}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="aliases[]">Aliases</label><br>
        <select class="form-control js-example-basic-multiple form-control" id="aliases[]" name="aliases[]" multiple="multiple">

            @if($game->aliases != null)
                @foreach($game->aliases as $alias)
                    <option value="{{$alias}}" selected>{{$alias}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label for="genres[]">Genres</label><br>
        <select class="form-control js-example-basic-multiple form-control" id="genres[]" name="genres[]" multiple="multiple">

            @if($game->genres != null)
                @foreach($game->genres as $genre)
                    <option value="{{$genre->id}}" selected>{{$genre->title}}</option>
                @endforeach
            @endif

            @foreach($genres as $genre)
                <option value="{{$genre->id}}">{{$genre->title}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary button-full">Save</button>
    </div>

</div>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

{{-- jQuery --}}
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-3.4.1.slim.min.js"></script>

{{--Select 2--}}
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            tags: true
        });

        tinymce.init({
            selector:'textarea',
            menubar: false,
            plugins: "link",
            statusbar: false
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

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

        // Set slug
        $( document ).ready( function() {
            var sluggie = slug($('#title').val());

            $('#slug').val(sluggie);

        });

        // Set slug
        $('#title').change( function() {
            var sluggie = slug($('#title').val());

            $('#slug').val(sluggie);

        });
    });

    var slug = function(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆÍÌÎÏŇÑÓÖÒÔÕØŘŔŠŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇíìîïňñóöòôõøðřŕšťúůüùûýÿžþÞĐđßÆa·/_,:;";
        var to   = "AAAAAACCCDEEEEEEEEIIIINNOOOOOORRSTUUUUUYYZaaaaaacccdeeeeeeeeiiiinnooooooorrstuuuuuyyzbBDdBAa------";
        for (var i=0, l=from.length ; i<l ; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        return str;
    };

</script>