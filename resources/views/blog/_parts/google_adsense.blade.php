@if($client && $slot)
    <div class="lb-adsense">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="{{ $client }}"
             data-ad-slot="{{ $slot }}"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
@endif
