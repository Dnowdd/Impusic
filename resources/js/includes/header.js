function locationVerification() {
    var e = document.body.scrollTop || document.documentElement.scrollTop,
    o = e / (document.documentElement.scrollHeight - document.documentElement.clientHeight) * 100;
    if(e > 0){
        $('#header').addClass("sticky");
    }
    else{
        $('#header').removeClass("sticky");
    }
}

window.onload = function() {
    locationVerification()
}

window.onscroll = function() {
    locationVerification()
}


function openForm(id){
    $('#'+id).css("display", "grid");
}
function closeForm(id){
    $('#'+id).css("display", "none");
}