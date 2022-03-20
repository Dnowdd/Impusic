const player = new Plyr('#player');

function openInputThumbnail(){
    $("#selectThumbnailInput").click();
}

function openVideoThumbnail(){
    $("#selectVideoInput").click();
}

$('#videoTitle').keypress(function(e){
    e.stopPropagation();
});


function setPreviewThumbnail(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(thumbnailPreview).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#selectThumbnailInput").change(function(){
    setPreviewThumbnail(this);
});

$(document).on("change", "#selectVideoInput", function(evt) {
    var $source = $('#videoPreview');
    $source[0].src = URL.createObjectURL(this.files[0]);
    $source.parent()[0].load();
});