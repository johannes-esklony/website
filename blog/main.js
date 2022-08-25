

function load_article() {
    let params = new URLSearchParams(document.location.search);
    let id = params.get('ID');
    document.getElementById("content").innerHTML=`<object type="text/html" data="/Artikel/${id}.html" style="width:70%; height: 100vh"></object>`;
}

function get_params_curr(){
    let params = new URLSearchParams(document.location.search);
    let id = params.get('ID');
    return id;
}