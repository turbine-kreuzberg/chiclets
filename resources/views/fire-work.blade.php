<x-html>
    <script src="https://unpkg.com/fireworks-js@2.x/dist/index.umd.js"></script>
    <script>
        window.setTimeout(function() {
            const container = document.querySelector('.fireworks')
            const fireworks = new Fireworks.default(container)
            fireworks.start()
        }, 1_000);

        window.setTimeout(function() {
            window.close();
        }, 11_000);
    </script>
    <div class="fireworks" style="width: 100vw; height: 100vh"></div>
</x-html>
