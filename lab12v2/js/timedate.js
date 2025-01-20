/**
 * Pobiera bieżącą datę i wyświetla ją w elemencie o ID "data".
 */
function gettheDate()
{
    Todays = new Date(); // Tworzy nowy obiekt Date z bieżącą datą i godziną.
    TheDate = "" + (Todays.getMonth()+ 1) + " / " + Todays.getDate() + " / " +(Todays.getYear()+1900); // Formatuje datę w postaci MM / DD / YYYY.
    document.getElementById("data").innerHTML = TheDate; // Wstawia sformatowaną datę do elementu HTML o ID "data".
}

var timerID = null; // Zmienna do przechowywania identyfikatora timera.
var timerRunning = false; // Flaga wskazująca, czy zegar jest aktualnie uruchomiony.

/**
 * Zatrzymuje zegar, jeśli jest uruchomiony.
 */
function stopClock()
{
    if(timerRunning)
        clearTimeout(timerID); // Zatrzymuje timer na podstawie identyfikatora `timerID`.
    timerRunning = false; // Ustawia flagę `timerRunning` na false, wskazując, że zegar nie działa.
}

/**
 * Uruchamia zegar, wyświetlając aktualną datę i czas.
 */
function startClock()
{
    stopClock(); // Najpierw zatrzymuje istniejący zegar, aby uniknąć wielu jednoczesnych timerów.
    gettheDate();  // Wyświetla bieżącą datę w elemencie HTML.
    showtime(); // Rozpoczyna odliczanie i wyświetlanie czasu.
}

/**
 * Wyświetla bieżący czas w formacie 12-godzinnym (z oznaczeniem AM/PM).
 * Automatycznie aktualizuje czas co sekundę.
 */
function showtime()
{
    var now = new Date(); // Pobiera bieżącą godzinę, minuty i sekundy.
    var hours = now.getHours(); // Godzina (0-23)
    var minutes = now.getMinutes(); // Minuty (0-59)
    var seconds = now.getSeconds(); // Sekundy (0-59)
    var timeValue = "" + ((hours >12) ? hours -12 :hours) // Formatuje godzinę w systemie 12-godzinnym.
    timeValue += ((minutes < 10) ? ":0" : ":") + minutes // Dodaje minuty z wiodącym zerem, jeśli potrzeba.
    timeValue += ((seconds < 10) ? ":0" : ":") + seconds // Dodaje sekundy z wiodącym zerem, jeśli potrzeba.
    timeValue += (hours >= 12) ? " P.M." : " A.M."  // Dodaje oznaczenie AM/PM w zależności od godziny.
    document.getElementById("zegarek").innerHTML = timeValue; // Wyświetla sformatowany czas w elemencie HTML o ID "zegarek".
    timerID = setTimeout("showtime()",1000); // Ustawia timer, aby funkcja `showtime` była wywoływana co 1 sekundę.
    timerRunning = true; // Ustawia flagę `timerRunning` na true, wskazując, że zegar działa.
}

