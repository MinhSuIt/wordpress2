
(() => {
    document.addEventListener("DOMContentLoaded", function () {
        const delay_events = [
            "scroll",
            "mousemove",
            "touchstart",
            "click"
        ]
        if (!window.scripts || !Array.isArray(scripts)) return;

        function loadDelayedScripts() {
            scripts.forEach(item => {
                if (!item.src) return;

                const script = document.createElement("script");
                if (item.id) script.id = item.id;
                script.src = item.src;
                script.async = true;

                document.body.appendChild(script);
            });
            removeListeners();
        }
        function removeListeners() {
            delay_events.forEach(evt =>
                window.removeEventListener(evt, loadDelayedScripts)
            );
        }
        delay_events.forEach(evt => {
            window.addEventListener(evt, loadDelayedScripts, {
                once: true,
                passive: true
            })
        }
        );
    });
})();
