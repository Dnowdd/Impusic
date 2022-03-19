function locationVerification() {
    var e = document.body.scrollTop || document.documentElement.scrollTop,
    o = e / (document.documentElement.scrollHeight - document.documentElement.clientHeight) * 100;
    console.log(o);
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