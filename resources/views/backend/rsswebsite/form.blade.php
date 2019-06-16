<div class="col-md-12">
    @include('backend.components.error')
</div>

<div class="col-md-9">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="title">Title *</label><br>
        <input type="text" class="form-control" id="title" name="title" required autocomplete="off" value="{{$rss_website->title}}">
    </div>

    <div class="form-group">
        <label for="url">URL *</label><br>
        <input type="text" class="form-control" id="url" name="url" required  autocomplete="off" value="{{$rss_website->url}}">
    </div>

    <div class="form-group">
        <label for="rss_url">RSS URL *</label><br>
        <input type="text" class="form-control" id="rss_url" name="rss_url" required value="{{$rss_website->rss_url}}">
    </div>

</div>

<div class="col-md-3">

    <div class="form-group">
        <label for="game_id">Article format</label><br>
        <select id="article_format" name="article_format">
            @php($article_formats = ['guid', 'link'])
            @foreach($article_formats as $article_format)
                @if($article_format == $rss_website->article_format)
                    <option value="{{$article_format}}" selected>{{$article_format}}</option>
                @else
                    <option value="{{$article_format}}">{{$article_format}}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="game_id">Date format</label><br>
        <select id="date_format" name="date_format">
            @php($date_formats = ['D, d M Y H:i:s O', 'Y-m-d\TH:i:s O'])
            @foreach($date_formats as $date_format)
                @if($date_format == $rss_website->date_format)
                    <option value="{{$date_format}}" selected>{{$date_format}}</option>
                @else
                    <option value="{{$date_format}}">{{$date_format}}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <input type="hidden" class="form-control" id="decode_utf8_title" name="decode_utf8_title" value="0">
        <input type="checkbox" class="form-control" id="decode_utf8_title" name="decode_utf8_title" value="1" @if($rss_website->decode_utf8_title) checked @endif>
        <label for="decode_utf8_title">Decode title as UTF8</label><br>
    </div>

    <div class="form-group">
        <input type="hidden" class="form-control" id="date_reformat" name="date_reformat" value="0">
        <input type="checkbox" class="form-control" id="date_reformat" name="date_reformat" value="1" @if($rss_website->date_reformat) checked @endif>
        <label for="date_reformat">Add 2 extra hours to date</label><br>
    </div>

    <div class="form-group">
        <input type="hidden" class="form-control" id="active" name="active" value="0">
        <input type="checkbox" class="form-control" id="active" name="active" value="1" @if($rss_website->active) checked @endif>
        <label for="active">Active</label><br>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary button-full">Save</button>
    </div>

</div>

{{-- jQuery --}}
<script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>

{{-- jQuery UI --}}
<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

{{--Select 2--}}
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            tags: true
        });
    });
</script>