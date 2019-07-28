<div class="col-md-12">
    @include('backend.components.error')
</div>

<div class="col-md-9">

    <div class="form-group">
        <label for="sidebar_title">Sidebar title</label><br>
        <input type="text" class="form-control" id="sidebar_title" name="sidebar_title" autocomplete="off" value="{{$page->sidebar_title}}">
    </div>

    <div class="form-group">
        <label for="sidebar_body">Sidebar body</label><br>
        <textarea type="text" class="form-control" id="sidebar_body" name="sidebar_body" autocomplete="off">{{$page->sidebar_body}}</textarea>
    </div>

</div>

<div class="col-md-3">

    <div class="form-group">
        <button type="submit" class="btn btn-primary button-full">Save</button>
    </div>

</div>