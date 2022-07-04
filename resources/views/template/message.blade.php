{{--errors--}}
@if(isset($error))
    <script>
        Notiflix.Report.failure(
            'Failure',
            "{{ $error }}",
            'Okay',
        );
    </script>
@endif
@if(session()->has('error'))
    <script>
        Notiflix.Report.failure(
            'Failure',
            "{{ session()->get('error') }}",
            'Okay',
        );
    </script>
@endif

@if(isset($notify_error))
    <script>
        Notiflix.Notify.failure('{{ $notify_error }}');
    </script>
@endif
@if(session()->has('notify_error'))
    <script>
        Notiflix.Notify.failure('{{ session()->get('notify_error') }}');
    </script>
@endif

{{--success--}}

@if(isset($success))
    <script>
        Notiflix.Report.success(
            'Success',
            "{{ $success }}",
            'Okay',
        );
    </script>
@endif
@if(session()->has('success'))
    <script>
        Notiflix.Report.success(
            'Success',
            "{{ session()->get('success') }}",
            'Okay',
        );
    </script>
@endif

@if(isset($notify_success))
    <script>
        Notiflix.Notify.success('{{ $notify_success }}');
    </script>
@endif
@if(session()->has('notify_success'))
    <script>
        Notiflix.Notify.success("{{ session()->get('notify_success') }}");
    </script>
@endif
