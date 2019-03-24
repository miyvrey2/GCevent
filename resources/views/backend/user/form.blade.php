<div class="col-md-12">
    @include('backend.components.error')
</div>

<div class="col-md-9">

    {{ csrf_field() }}

    <div class="form-group">
        <label for="username">Username *</label><br>
        <input type="text" class="form-control" id="username" name="username" required autocomplete="off" value="{{$user->username}}">
    </div>

    <div class="form-group">
        <label for="email">Email address *</label><br>
        <input type="email" class="form-control" id="email" name="email" required autocomplete="off" value="{{$user->email}}">
    </div>

    <div class="form-group">
        <label for="password">New password</label><br>
        <input type="password" class="form-control" id="password" name="password" autocomplete="off">
    </div>

    <div class="form-group">
        <label for="password-confirm" class="control-label">Confirm Password</label>
        <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
    </div>

    <div class="form-group">
        <label for="active">Active *</label><br>
        <input type="hidden" class="form-control" name="active" value="0">
        <input type="checkbox" class="form-control" id="active" name="active" value="1"
            @if($user->active)
                checked
            @endif
        >
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary button-full">Save</button>
    </div>

</div>

{{--jQuery--}}
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>

{{--jQuery ui--}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">