<div class="col-md-12">
    @include('backend.components.error')
</div>

<div class="col-md-9">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="title">Title *</label><br>
        <input type="text" class="form-control" id="title" name="title" required autocomplete="off" value="{{$article->title}}">
    </div>

    <div class="form-group">
        <label for="slug">Slug *</label><br>
        <input type="text" class="form-control" id="slug" name="slug" required  autocomplete="off" value="{{$article->slug}}">
    </div>

    <div class="form-group">
        <label for="excerpt">Exerpt</label><br>
        <textarea type="text" class="form-control" id="excerpt" name="excerpt" autocomplete="off">{{$article->excerpt}}</textarea>
    </div>

    <div class="form-group">
        <label for="body">Body</label><br>
        <textarea type="text" class="form-control" id="body" name="body" autocomplete="off">{{$article->body}}</textarea>
    </div>

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            menubar: false,
            plugins: "link",
            statusbar: false
        });
    </script>

    <div class="form-group">
        <label for="source">Source URL</label><br>
        <input type="text" class="form-control" id="source" name="source" autocomplete="off" value="{{$article->source}}">
    </div>

</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="game_id">Game</label><br>
        <select id="game_id" name="game_id">
            @foreach($games as $game)
                @if($game->id == $article->game_id)
                    <option value="{{$game->id}}" selected>{{$game->title}}</option>
                @else
                    <option value="{{$game->id}}">{{$game->title}}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="published_at">publish date</label><br>
        <span class="note"><strong>note:</strong> any date before now is an concept</span>
        <input type="datetime-local" class="form-control" id="published_at" name="published_at" autocomplete="off" value="@if($article->published_at){{$article->published_at->format('Y-m-d\TH:i')}}@endif">
    </div>

    <div class="form-group">
        <label for="keywords[]">Tags</label><br>
        <select class="form-control js-example-basic-multiple form-control" id="keywords[]" name="keywords[]" multiple="multiple">
            @if($article->keywords != null)
                @foreach($article->keywords as $keyword)
                    <option value="{{$keyword}}" selected>{{$keyword}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary button-full">Save</button>
    </div>

</div>

{{--jQuery--}}
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>

{{--Select 2--}}
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            tags: true
        });
    });
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

{{--jQuery ui--}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
    $( function() {

        {{--var games = [--}}
        {{--@foreach($games as $game)--}}
        {{--"{{$game->title}}",--}}
        {{--@endforeach--}}
        {{--];--}}

        {{--// Help by autocomplete to prevent doubles--}}
        {{--$('#title').autocomplete({--}}
        {{--source: games--}}
        {{--});--}}

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