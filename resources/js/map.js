ymaps.ready(init);

function init(){

    var map = new ymaps.Map("map", {

        center: [52.43358324, 31.01031828],
        zoom: 16
    });

    var placemark = new ymaps.Placemark([52.43358324, 31.01031828],{
        hintContent: 'Мы находимся сдесь'
    });
    map.geoObjects.add(placemark);
}
