<footer class="app-footer">
    <div>
        <span>&copy;{{ now()->year !== 2019 ? '2019 - ' : '' }}{{ now()->year }} {{ config('app.copyright') }}</span>
    </div>

    <div class="ml-auto">
        <span>Designed by</span>
        <a href="https://www.mikunilabo.com/" target="_blank">MikuniLabo</a>
    </div>
</footer>
