var _URL = "https://compit.dev";
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('checkPage').addEventListener('click',changePage,false);
    function make_request() {
            chrome.tabs.getSelected(null, function(tab) {
            let _current_url = _URL + "/API/api.php?name=DJI&uri="+tab.uri;
            $.ajax({
                url: _current_url,
                contentType: "application/json",
                dataType: 'json',
                success: function (result) {
                    console.log(result.data);
                }
            })
        });
    }
    make_request();
    },false);
function changePage(){
    chrome.tabs.create({"url": _URL});
}