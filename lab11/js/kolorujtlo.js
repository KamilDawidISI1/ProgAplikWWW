/**
 * Zmienia kolor tła i tekstu strony, a także kolory linków.
 */
 //@param {string} bc - Kolor tła (background color) strony.
 //@param {string} c - Kolor tekstu (text color) strony.

function  changeBackground(bc, c) {
    // Ustawia kolor tła całej strony.
    document.body.style.backgroundColor = bc;
    // Ustawia kolor tekstu na całej stronie.
    document.body.style.color = c;

    var links = document.getElementsByTagName("a"); // Pobiera wszystkie elementy typu <a> (linki) na stronie.
    for (var i = 0; i < links.length; i++) {
        if (!links[i].classList.contains('static')){ // Sprawdza, czy dany link NIE ma klasy 'static'. Jeśli link ma klasę 'static', jego kolor pozostaje niezmieniony.
            links[i].style.color = c; // Ustawia kolor tekstu dla linków.
        }
    }
}


