@extends('layouts.app_template', ['nav' => false])
@section('content')
<div class="full_screen bg-white">
    <div class="owl-carousel owl-theme">
        <x-table-live.v1 :dashboardId="1" :header="$header" :content="$content" />
        <x-table-live.v2 :dashboardId="2" :header="$header2" :content="$content2" />
    </div>
</div>
@endsection
@push('script')
<script>
    $('.owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        margin: 10,
        dots: false,
        animateOut: 'fadeOut',
        autoplay: true,
        autoplayTimeout: 60000,
    });

    $(document).ready(function() {
        setInterval(function() {
            realtimeData();
        }, 5000);
    });

    const realtimeData = () => {
        realtimeServer({
            url: url + '/live_client',
            onSuccess: function(response) {
                responseContent(response);
                responseContent2(response);
            }
        });
    }
</script>
@endpush