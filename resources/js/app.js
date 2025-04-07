import './bootstrap';

import * as bootstrap from 'bootstrap';

// JavaScript để toggle giữa Crawl Group và Crawl Fanpage
function toggleCrawlOptions() {
    const groupForm = document.getElementById("group_form");
    const fanpageForm = document.getElementById("fanpage_form");

    if (document.getElementById("crawl_group").checked) {
        groupForm.style.display = "block";
        fanpageForm.style.display = "none";
    } else {
        groupForm.style.display = "none";
        fanpageForm.style.display = "block";
    }
}
window.addEventListener("DOMContentLoaded", () => {
    toggleCrawlOptions(); // Hiển thị form đúng khi tải trang

    const groupRadio = document.getElementById("crawl_group");
    const fanpageRadio = document.getElementById("crawl_fanpage");

    groupRadio.addEventListener("change", toggleCrawlOptions);
    fanpageRadio.addEventListener("change", toggleCrawlOptions);

});

