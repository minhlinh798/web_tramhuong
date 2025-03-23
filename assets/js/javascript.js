// CSS để tùy chỉnh tooltip
const style = document.createElement("style");
style.innerHTML = `
    .custom-tooltip {
        position: absolute;
        background-color: white;
        color: black;
        padding: 10px;
        border-radius: 5px;
        font-size: 14px;
        white-space: nowrap;
        box-shadow: 0px 2px 5px rgba(0,0,0,0.3);
        z-index: 1000;
        margin-top: 0px;
        border: 1px solid #ccc;
    }
`;
document.head.appendChild(style);


document.addEventListener("DOMContentLoaded", function () {
    const pageLinks = document.querySelectorAll(".pagination .page-item a");

    pageLinks.forEach(link => {
        if (link.href === window.location.href) {
            link.parentElement.classList.add("active");
        }
    });
});
