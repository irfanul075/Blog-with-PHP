$(document).ready(function (e) {
    // SideNav Initialization
    $(".button-collapse").sideNav();

    /*load status message*/
    var status = $(".statusMsg").text();
    var stType = Number($(".statusType").text());
    if (status.length === 0){

    }else{
        var statusType;
        if(stType === 1){
            statusType = "success";
        }else if(stType === 2){
            statusType = "warning";
        }else if(stType === 3){
            statusType = "error";
        }else{
            statusType = "info";
        }
        toastr[statusType](status,'', {
            timeOut: 3000,
            "showDuration": 100,
            positionClass:"toast-top-full-width",
            "preventDuplicates": true,
            "progressBar": true,
        });
    }
    /*load status message*/
});