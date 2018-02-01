@foreach ($errors -> all() as $e)
    @component('layouts.commons.error')
        {{ $e }}
    @endcomponent
@endforeach
@push('addjs')
<script>
    $(function () {
        $('.alert-dismissible').mouseout(function () {
            $this = $(this);
            setTimeout(function () {
                $this.fadeOut(500);
            }, 800);
        });
    });
</script>
@endpush
@push('addcss')
@endpush