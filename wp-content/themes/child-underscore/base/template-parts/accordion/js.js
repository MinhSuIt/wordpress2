const items = document.querySelectorAll(".accordion-item");

items.forEach(item => {
    const header = item.querySelector(".accordion-header");
    const content = item.querySelector(".accordion-content");

    header.addEventListener("click", () => {
        // đóng tất cả
        items.forEach(i => {
            if (i !== item) {
                i.classList.remove("active");
                i.querySelector(".accordion-content").style.maxHeight = null;
            }
        });

        // toggle item hiện tại
        item.classList.toggle("active");

        if (item.classList.contains("active")) {
            content.style.maxHeight = content.scrollHeight + "px";
        } else {
            content.style.maxHeight = 0;
        }
    });
});