document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('taci').style.transform="rotate(20deg)";
    document.getElementById('checkPage').addEventListener('click',changePage,false);
    function changePage(){
        chrome.tabs.create({"url": "http://silviuilas.go.ro"});
    }

    },false);