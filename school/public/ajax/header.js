$(document).ready(function(){
    $("#bodytag").load(function (){
        var wrapper = $("#wrapper").html();
        $.post("headerbar", {
            wrapper: wrapper,
        },
        function (data, status){
            $("#wrapper").empty();  
            $("#wrapper").append(data);
        });
    });
});