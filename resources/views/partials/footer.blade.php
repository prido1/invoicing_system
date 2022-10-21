<footer class="main-footer">
    <strong>Copyright &copy; {{\Carbon\Carbon::now()->format('Y')}} <a href="{{$global_settings['app_url'] ?? ''}}">{{$global_settings['app_name'] ?? ''}}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> {{config('config.app_version')}}
    </div>
</footer>
