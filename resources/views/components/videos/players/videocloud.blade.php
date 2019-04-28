<div style="position: relative; display: block; max-width: 960px;">
    <div style="padding-top: 56.25%;">
        <video data-video-id="{{ $videoId }}"
            data-account="{{ $accountId }}"
            data-player="Q2yMP5VfB"
            data-embed="default"
            data-application-id
            class="video-js"
            controls
            style="position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px; width: 100%; height: 100%;">
        </video>
        <script src="{{ sprintf('//players.brightcove.net/%s/Q2yMP5VfB_default/index.min.js', $accountId) }}"></script>
    </div>
</div>
