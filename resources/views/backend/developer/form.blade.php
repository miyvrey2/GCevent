<div class="col-md-12">
    @include('backend.components.error')
</div>

<div class="col-md-9">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="title">Title *</label><br>
        <input type="text" class="form-control" id="title" name="title" required autocomplete="off" value="{{ $developer->title }}">
    </div>

    <div class="form-group">
        <label for="slug">Slug *</label><br>
        <input type="text" class="form-control" id="slug" name="slug" required  autocomplete="off" value="{{ $developer->slug }}">
    </div>

    <div class="form-group">
        <label for="excerpt">Excerpt</label><br>
        <textarea type="text" class="form-control" id="excerpt" name="excerpt" autocomplete="off">{{ $developer->excerpt }}</textarea>
    </div>

    <div class="form-group">
        <label for="body">Body</label><br>
        <textarea type="text" class="form-control" id="body" name="body" autocomplete="off">{{ $developer->body }}</textarea>
    </div>

</div>

<div class="col-md-3">

    <div class="form-group">
        <label for="image">Image</label><br>
        <input type="text" class="form-control" id="image" name="image" autocomplete="off" value="{{ $developer->image }}">
    </div>

    <div class="form-group">
        <label for="url">url</label><br>
        <input type="text" class="form-control" id="url" name="url" autocomplete="off" value="{{ $developer->url }}">
    </div>

    <div class="form-group">
        <label for="found">found</label><br>
        <span class="note"><strong>note:</strong> "2018-00-00" notes as "in 2018"</span>
        <input type="text" class="form-control" id="found" name="found" autocomplete="off" value="{{ $developer->found_ymd }}">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary button-full">Save</button>
    </div>

</div>

{{-- TinyMCE --}}
<script type="text/javascript" src="//cloud.tinymce.com/stable/tinymce.min.js"></script>

{{--jQuery--}}
<script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>

{{-- jQuery UI --}}
<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

{{--Select 2--}}
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $( function() {

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