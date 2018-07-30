<style>
    form {
        display: inline;
    }

    .word-suggestion-3 {
        margin: 2px;
        padding: 4px 8px;
        display: inline-block;
        background-color: #ec407a;
        background-color: #3097D1;
        color: white;
        border-radius: 8px;
        border: 0;
        outline: 0;
        cursor: pointer;
    }
</style>

@foreach($game_titles as $key => $value)
    {{ Form::open(array('url' => url('games'))) }}
        <input type="hidden" id="publisher_id" name="publisher_id" value="1">
        <input type="hidden" id="title" name="title" value="{{ $value['snippet'] }}">
        <input type="hidden" id="slug" name="slug" value="{{ $value['snippet'] }}">
        <input type="submit" class="word-suggestion-3" value="{{ $value['snippet'] }}">
    {{ Form::close() }}
@endforeach

{{--print_r($keywordWithTwoPrevWord);--}}
{{--echo '<br /><br />';--}}
{{--print_r($keywordWithNextWord);--}}
{{--echo '<br /><br />';--}}
{{--print_r($keywordWithTwoNextWord);--}}
{{--echo '<br /><br />';--}}
{{--print_r($keywordWithPrevNextWord);--}}
{{--echo '<br /><br />';--}}