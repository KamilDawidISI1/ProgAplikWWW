var computed = false;
var decimal = 0;

function convert(entryform, from, to) {
    convertfrom = from.selectedIndex;
    convertto = to.selectedIndex;
    entryform.display.value = (entryform.input.value * from[convertfrom].value / to[convertto].value);
}

function addchar (input, character) {
    if ((character == "." && decimal == "0") || character != ".") {
        (input.value == "" || input.value == "0") ? input.value = character : input.value += character;
        convert(input.from, input.from.measure1, input.from.measure2)
        computed = true;
        if(character == ".") {
            decimal = 1;
        }
    }
}

function openVothcom() {
    window.open("", "Display window", "toolbar=no,directories=no,menubar=no")
}

function clear(from) {
    from.input.value = 0;
    from.display.value = 0;
    decimal = 0;
}

function  changeBackground(bc, c) {
    document.body.style.backgroundColor = bc;
    document.body.style.color = c;


    var links = document.getElementsByTagName("a");
    for (var i = 0; i < links.length; i++) {
        if (!links[i].classList.contains('static')){
            links[i].style.color = c;
        }
    }
}


