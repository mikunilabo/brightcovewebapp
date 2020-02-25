<div class="text-center" style="position: relative; display: block; max-width: 960px;">
    <div style="padding-top: 56.25%;">
        <video data-video-id="{{ $videoId }}"
            data-account="{{ $accountId }}"
            data-player="default"
            data-embed="default"
            data-application-id
            class="video-js"
            controls
            style="position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px; width: 720px; height: 100%;">
        </video>
        <script src="{{ sprintf('//players.brightcove.net/%s/default_default/index.min.js', $accountId) }}"></script>
    </div>
</div>
