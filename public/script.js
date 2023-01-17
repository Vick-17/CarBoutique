$('#article_marque').change(function () {
    $('#article_modele').html('');
    $.ajax({
        method: "GET",
        dataType: "json",
        url: "/api/Marque/" + $('#article_marque').val(),
    }).done(function (data) {
        for (var i in data) {
            $('#article_modele').append('<option value="' + i + '">' + data[i] + '</option>');
        }
    }).fail(function (e) {
        console.log('fail');
    });
});

$('#search_annonce_marque').change(function () {
    $('#search_annonce_modele').html('');
    $.ajax({
        method: "GET",
        dataType: "json",
        url: "/api/Marque/" + $('#search_annonce_marque').val(),
    }).done(function (data) {
        for (var i in data) {
            $('#search_annonce_modele').append('<option value="' + i + '">' + data[i] + '</option>');
        }
    }).fail(function (e) {
        console.log('fail');
    });
});
$("#hiddenBlock").hide();
$("#revealButton").click(function () {
    if($("#hiddenBlock").is(':hidden')) {
        $("#hiddenBlock").show();
    } else {
        $("#hiddenBlock").hide();
    }
});
/*on sélectionne la fenetre*/
/* selection de tous les éléments de classe hidden */
/* On récupère la position de l'élément */
/* On calcule la position du bas de la fenêtre */
/* Si l'élement est dans la zone visible de la fenêtre */
/* On ajoute la classe pour lancer l'animation */

$(document).ready(function(){
    $(window).scroll(function(){
        $(".hidden").each(function(){
            var elementTop = $(this).offset().top;
            var windowBottom = $(window).scrollTop() + $(window).height();
            if( windowBottom > elementTop ){
                $(this).addClass("visible");
            }
        });
    });
});







