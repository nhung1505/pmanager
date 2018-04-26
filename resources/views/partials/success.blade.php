@if(session()->has('success'))
    <div class="alert alert-dismissable alert-success">
        <button class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true"></span>
        </button>
        <strong>
            {!! session()->get('success') !!}
        </strong>

    </div>
    @endif