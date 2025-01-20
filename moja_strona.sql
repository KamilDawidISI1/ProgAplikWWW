-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 20, 2025 at 11:59 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moja_strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `matka` int(11) DEFAULT 0,
  `nazwa` varchar(255) NOT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `matka`, `nazwa`, `opis`) VALUES
(1, 0, 'Koszulki', 'Wszystkie koszulki dostępne w sklepie'),
(2, 0, 'Kubki', 'Wszystkie kubki dostępne w sklepie'),
(3, 0, 'Plakaty', 'Wszystkie notesy dostępne w sklepie'),
(4, 1, 'tank_shirt', 'Koszulka na ramiaczkach (zonobijka)'),
(5, 1, 't-shirt', 'zwykla koszulka'),
(6, 1, 'shirt', 'koszulka z dlugimi ramionami'),
(7, 1, 'polo', 'koszulka polo'),
(8, 1, 'v-neck_shirt', 'koszulka z dekoltem w ksztalcie V'),
(9, 2, 'EKO', 'Kubki wykonane z ekologicznych materiałow'),
(10, 2, 'A', 'Kubki w rozmiarze A'),
(11, 2, 'A+', 'Kubki w rozmiarze A+'),
(12, 2, 'AA+', 'Kubki w rozmiarze AA+'),
(13, 2, 'premium', 'Kubki z podpisem podcasterów'),
(14, 3, 'A5', 'Plakat w rozmiarze A5'),
(15, 3, 'A4', 'Plakaty w rozmiarze A4'),
(16, 3, 'A3', 'Plakaty w rozmiarze A3'),
(17, 3, 'B2', 'Plakaty w rozmiarze B2'),
(18, 3, 'B3', 'Plakaty w rozmiarze B3'),
(19, 3, 'B4', 'Plakaty w rozmiarze B4');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_list`
--

CREATE TABLE `page_list` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `alias` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`, `alias`) VALUES
(1, 'Dama', '\r\n\r\n<!DOCTYPE html>\r\n\r\n<head>\r\n    <title>Dama Kier</title>\r\n    <link rel=\"stylesheet\" href=\"css/stylesub.css\">\r\n    <script src=\"js/kolorujtlo.js\" type=\"text/javascript\"></script>\r\n    <script src=\"js/timedate.js\" type=\"text/javascript\"></script>\r\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\r\n    <script>\r\n        $(document).ready(function () {\r\n            $(\"header\").click(function (){\r\n                $(this).toggleClass(\"header_animation\")\r\n            });\r\n        });\r\n    </script>\r\n</head>\r\n\r\n<div class=\"all\">\r\n    <header>\r\n        <div id=\"zegarek\"></div>\r\n        <div id=\"data\"></div>\r\n        <div class=\"sub-header\">\r\n            <h1>Dama Kier</h1>\r\n            <p>Historie z przestrzeni internetowej</p>\r\n        </div>\r\n    </header>\r\n\r\n    <div class=\"block\">\r\n        <img src=\"img/Dama/Dama1.png\" alt=\"Zdjęcie 1\" class=\"left-img\">\r\n        <p>Opis ze Spotify: <br> porozmawiajmy sobie o tym, co ludzie robią w przestrzeni internetowej, o zagrożeniach,\r\n        o historii stron i o tym, jak bardzo wszyscy jesteśmy poje..ni. <br> Odcinki są wersją audio filmów z yt, więc znajdź mnie tam,\r\n        jeśli dodatkowo chcesz sobie popatrzeć na obrazki 🖤</p>\r\n        <img src=\"img/Dama/Dama2.png\" alt=\"Zdjęcie 2\" class=\"right-img\">\r\n        <p>Na Damy Kier trafiłem zupełnie przypadkowo, ale tajemnicze tematy poruszane w podcaście szybko mnie zaciekawiły.\r\n            Choć niektóre fragmenty opowieści mrożą krew w żyłach, trudno się od nich oderwać. Twórczyni potrafi\r\n            wciągnąć w swoje historie, które często odkrywają mroczne strony internetu. Pomimo ciężkiej tematyki, podcast jest prowadzony\r\n            bardzo rzetelnie – zawsze podkreślane jest, czy dana informacja pochodzi z potwierdzonego źródła, czy jest tylko przypuszczeniem.\r\n            Corem tego podcastu są historie z takich miejsc jak Reddit, Dark Net czy 4chan. Opowiadają o mrocznych zakątkach świata internetu,\r\n            odsłaniając tajemnice, które są dla wielu niedostępne lub ukryte. Twórczyni podcastu świetnie balansuje pomiędzy szokującymi\r\n            faktami a odpowiedzialnym podejściem do omawianych tematów, co sprawia, że choć tematy są często trudne,\r\n            słucha się ich z zainteresowaniem i poczuciem, że wszystko zostało przygotowane z najwyższą starannością.</p>\r\n    </div>\r\n\r\n    <footer>\r\n        <p><i><a href=\"index.php?idp=glowna\" class=\"static\">Powrót do strony głównej</a></i></p>\r\n        <p><i><a href=\"index.php?idp=Form\" class=\"static\">Kontakt</a></i></p>\r\n    </footer>\r\n</div>\r\n\r\n<button class=\"bntdark\" type=\"button\" onclick=\"changeBackground(\'#4E4545FF\', \'#fff\')\">Dark</button>\r\n<button class=\"bntlight\" type=\"button\" onclick=\"changeBackground(\'#fff\', \'#4E4545FF\')\">Light</button>\r\n\r\n', 1, 'Dama'),
(2, 'DTP', '\r\n\r\n<!DOCTYPE html>\r\n\r\n<head>\r\n\r\n    <title>Dwóch Typów Podcast</title>\r\n    <link rel=\"stylesheet\" href=\"css/stylesub.css\">\r\n    <script src=\"js/kolorujtlo.js\" type=\"text/javascript\"></script>\r\n    <script src=\"js/timedate.js\" type=\"text/javascript\"></script>\r\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\r\n    <script>\r\n        $(document).ready(function () {\r\n            $(\"header\").click(function (){\r\n                $(this).toggleClass(\"header_animation\")\r\n            });\r\n        });\r\n    </script>\r\n</head>\r\n\r\n\r\n<div class=\"all\">\r\n    <header>\r\n        <div id=\"zegarek\"></div>\r\n        <div id=\"data\"></div>\r\n        <div class=\"sub-header\">\r\n            <h1>Dwóch Typów Podcast</h1>\r\n            <p>Dwóch kolegów rozmawia ze sobą o wszystkim i niczym</p>\r\n        </div>\r\n    </header>\r\n\r\n    <div class=\"block\">\r\n        <img src=\"img/DTP/DTP1.png\" alt=\"Zdjęcie 1\" class=\"left-img\">\r\n        <p>Opis ze Spotify: <br> Podcast prowadzony przez Dwóch Typów - Kubę i Bartka, znanych szerzej z kanałów GargamelVlog i Generator Frajdy.</p>\r\n\r\n        <img src=\"img/DTP/DTP2.png\" alt=\"Zdjęcie 2\" class=\"right-img\">\r\n        <p>Podobnie jak w NI3 WIEM Podcast, prowadzący z niezwykłą lekkością i humorem potrafili omawiać bieżące wydarzenia,\r\n            łącząc codzienne informacje z ciekawostkami z Polski i świata. Ten podcast towarzyszył mi w trudnych chwilach,\r\n            wielokrotnie poprawiając nastrój, kiedy najbardziej tego potrzebowałem. Chemia między prowadzącymi była nie do podrobienia —\r\n            ich rozmowy płynęły naturalnie, a godziny mijały, pozostawiając uczucie, że chciałoby się więcej.\r\n            Ich unikalny styl był kluczem do tego, że każdy odcinek stanowił przyjemność – z jednej strony wciągające żarty,\r\n            z drugiej umiejętność poruszania poważnych tematów z odpowiednim szacunkiem. To właśnie ten balans sprawiał,\r\n            że podcast tak dobrze rezonował z jego słuchaczami, dając nie tylko rozrywkę, ale i wartościową refleksję.\r\n            Niestety, już od ponad roku podcast nie jest kontynuowany. Wszystko zakończyło się skandalem związanym z jednym\r\n            z prowadzących, co na zawsze przerwało ich wspólne nagrania. Choć rozumiem, że nie wrócą, często wracam do starych odcinków,\r\n            które nadal potrafią wywołać uśmiech na mojej twarzy. Brakuje mi tych coniedzielnych odsłuchów, tej cotygodniowej dawki\r\n            humoru i rozmów, które pozwalały odciąć się na chwilę od codzienności. Jednak wspomnienia i te nagrania pozostaną\r\n            ze mną na długo — jako forma wsparcia w najtrudniejszych chwilach i przypomnienie o tym, jak ważna jest bliskość i\r\n            dobra energia między ludźmi.</p>\r\n\r\n    </div>\r\n\r\n    <footer>\r\n        <p><i><a href=\"index.php?idp=glowna\" class=\"static\">Powrót do strony głównej</a></i></p>\r\n        <p><i><a href=\"index.php?idp=Form\" class=\"static\">Kontakt</a></i></p>\r\n    </footer>\r\n</div>\r\n\r\n<button class=\"bntdark\" type=\"button\" onclick=\"changeBackground(\'#4E4545FF\', \'#fff\')\">Dark</button>\r\n<button class=\"bntlight\" type=\"button\" onclick=\"changeBackground(\'#fff\', \'#4E4545FF\')\">Light</button>\r\n\r\n', 1, 'DTP'),
(3, 'Form', '\r\n\r\n<!DOCTYPE html>\r\n\r\n<head>\r\n\r\n    <title>Kontakt</title>\r\n    <link rel=\"stylesheet\" href=\"css/styleform.css\">\r\n    <script src=\"js/kolorujtlo.js\" type=\"text/javascript\"></script>\r\n    <script src=\"js/timedate.js\" type=\"text/javascript\"></script>\r\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\r\n    <script>\r\n        $(document).ready(function () {\r\n            $(\"header\").click(function (){\r\n                $(this).toggleClass(\"header_animation\")\r\n            });\r\n        });\r\n    </script>\r\n</head>\r\n\r\n\r\n<div class=\"all\">\r\n    <header>\r\n        <div id=\"zegarek\"></div>\r\n        <div id=\"data\"></div>\r\n        <div class=\"form-header\">\r\n            <h1>Kontakt</h1>\r\n            <p>Podziel się swoimi opiniami poprzez formularz</p>\r\n        </div>\r\n    </header>\r\n\r\n    <div class=\"form-contact\">\r\n        <form action=\"mailto:dawid.cytrox1234@gmail.com\" method=\"post\" enctype=\"text/plain\">\r\n            <label for=\"name\">Imie Nazwisko/Nick</label>\r\n            <input type=\"text\" id=\"name\" name=\"name\" placeholder=\"Wpisz tutaj imienazwisko/nick\" required>\r\n\r\n            <label for=\"email\">Email</label>\r\n            <input type=\"email\" id=\"email\" name=\"email\" placeholder=\"Wpisz tutaj email\" required>\r\n\r\n            <label for=\"message\">Wiadomość</label>\r\n            <textarea id=\"message\" rows=\"5\" placeholder=\"Twoja wiadomość\" required></textarea>\r\n\r\n            <button type=\"submit\">Wyślij</button>\r\n        </form>\r\n    </div>\r\n\r\n    <footer>\r\n        <p>Kamil Dawid</p>\r\n        <p><i><a href=\"index.php?idp=glowna\" class=\"static\">Powrót do strony głownej</a></i></p>\r\n    </footer>\r\n</div>\r\n\r\n<button class=\"bntdark\" type=\"button\" onclick=\"changeBackground(\'#4E4545FF\', \'#fff\')\">Dark</button>\r\n<button class=\"bntlight\" type=\"button\" onclick=\"changeBackground(\'#fff\', \'#4E4545FF\')\">Light</button>\r\n', 1, 'Form'),
(4, 'glowna', '\r\n\r\n<!DOCTYPE html>\r\n\r\n<head>\r\n  <title>Moje hobby to podcasty</title>\r\n  <link rel=\"stylesheet\" href=\"css/style.css\">\r\n  <script src=\"js/kolorujtlo.js\" type=\"text/javascript\"></script>\r\n  <script src=\"js/timedate.js\" type=\"text/javascript\"></script>\r\n  <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\r\n  <script>\r\n    $(document).ready(function () {\r\n      $(\"header\").click(function (){\r\n        $(this).toggleClass(\"header_animation\")\r\n      });\r\n    });\r\n  </script>\r\n</head>\r\n\r\n<div class=\"all\">\r\n  <header>\r\n    <div id=\"zegarek\"></div>\r\n    <div id=\"data\"></div>\r\n    <div class=\"block-header\">\r\n      <h1>Oto moje ulubione podcasty</h1>\r\n      <p>O każdym coś opowiem i dlaczego go słucham/słuchałem</p>\r\n    </div>\r\n  </header>\r\n\r\n  <div class=\"block\">\r\n    <div class=\"block-item\">\r\n      <a href=\"index.php?idp=NWP\"><img src=\"img/NWP/NWP.png\" alt=\"NI3 WIEM PODCAST\"></a>\r\n      <p><b><a href=\"index.php?idp=NWP\" >NI3 WIEM PODCAST</a></b></p>\r\n    </div>\r\n    <div class=\"block-item\">\r\n      <a href=\"index.php?idp=DTP\"><img src=\"img/DTP/DTP.png\" alt=\"Dwóch Typów Podcast\"></a>\r\n      <p><b><a href=\"index.php?idp=DTP\" class=\"text\">Dwóch Typów Podcast</a></b></p>\r\n    </div>\r\n    <div class=\"block-item\">\r\n      <a href=\"index.php?idp=Krym\"><img src=\"img/Krym/Krym.png\" alt=\"Kryminatorium\"></a>\r\n      <p><b><a href=\"index.php?idp=Krym\" class=\"text\">Kryminatorium</a></b></p>\r\n    </div>\r\n    <div class=\"block-item\">\r\n      <a href=\"index.php?idp=Dama\"><img src=\"img/Dama/Dama.png\" alt=\"Dama Kier\"></a>\r\n      <p><b><a href=\"index.php?idp=Dama\" class=\"text\">Dama Kier</a></b></p>\r\n    </div>\r\n    <div class=\"block-item\">\r\n      <a href=\"index.php?idp=Slow\"><img src=\"img/Slow/Slow.png\" alt=\"Słowiańskie Demony\"></a>\r\n      <p><b><a href=\"index.php?idp=Slow\" class=\"text\">Słowiańskie Demony</a></b></p>\r\n    </div>\r\n\r\n  </div>\r\n  <footer>\r\n<p><i><a href=\"product.php\" class=\"static\">Nasz sklep</a></i></p>\r\n    <p><i><a href=\"index.php?idp=film\" class=\"static\">Filmy</a></i></p>\r\n    <p><i><a href=\"index.php?idp=Form\" class=\"static\">Kontakt</a></i></p>\r\n    <p> Autor: Kamil Dawid 169232 grupa: ISI 1.</p>\r\n\r\n  </footer>\r\n</div>\r\n\r\n<button class=\"bntdark\" type=\"button\" onclick=\"changeBackground(\'#4E4545FF\', \'#fff\')\">Dark</button>\r\n<button class=\"bntlight\" type=\"button\" onclick=\"changeBackground(\'#fff\', \'#4E4545FF\')\">Light</button>\r\n\r\n', 1, 'glowna'),
(5, 'Krym', '\r\n\r\n<!DOCTYPE html>\r\n\r\n<head>\r\n\r\n    <title>Kryminatorium</title>\r\n    <link rel=\"stylesheet\" href=\"css/stylesub.css\">\r\n    <script src=\"js/kolorujtlo.js\" type=\"text/javascript\"></script>\r\n    <script src=\"js/timedate.js\" type=\"text/javascript\"></script>\r\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\r\n    <script>\r\n        $(document).ready(function () {\r\n            $(\"header\").click(function (){\r\n                $(this).toggleClass(\"header_animation\")\r\n            });\r\n        });\r\n    </script>\r\n</head>\r\n\r\n\r\n<div class=\"all\">\r\n    <header>\r\n        <div id=\"zegarek\"></div>\r\n        <div id=\"data\"></div>\r\n        <div class=\"sub-header\">\r\n            <h1>Kryminatorium</h1>\r\n            <p>Podcast True Crime</p>\r\n        </div>\r\n    </header>\r\n\r\n    <div class=\"block\">\r\n        <img src=\"img/Krym/Krym1.png\" alt=\"Zdjęcie 1\" class=\"left-img\">\r\n        <p>Opis ze Spotify: <br> Posłuchaj o zabójcach, tajemniczych zaginięciach i zbrodniach z Archiwum X. W każdy poniedziałek\r\n        przedstawiam inną sprawę kryminalną. Słuchasz na Sporify? Pamiętaj o zaobserwowaniu podcastu. Zachęcam też do wystawienia oceny\r\n        i włączenia powiadomień (przycisk dzwoneczka).</p>\r\n        <img src=\"img/Krym/Krym2.png\" alt=\"Zdjęcie 2\" class=\"right-img\">\r\n        <p class=\"text\">Zacząłem słuchać Kryminatorium w przedostatniej klasie technikum. Pamiętam spotkanie z wykładowcą, który opowiadał\r\n            o nowo otwieranym wydziale kryminalnym. Tematyka ta zainteresowała mnie na tyle, że postanowiłem zgłębiać ją bardziej.\r\n            Fascynacja światem kryminalistyki była na tyle silna, że nawet rozważałem podjęcie studiów na kierunku kryminologia,\r\n            choć ostatecznie ten plan nie doszedł do skutku. Podcast Marcina Myszki, w którym omawia różne sprawy kryminalne,\r\n            od początku mnie wciągnął. Jego narracja jest tak sugestywna i przemyślana, że każda opowieść staje się czymś więcej\r\n            niż tylko słuchowiskiem — to wciągająca podróż w głąb ludzkich historii, zbrodni i tajemnic. Prowadzący potrafi\r\n            stworzyć atmosferę, która przenosi słuchacza w sam środek wydarzeń. Towarzyszą mi wtedy silne emocje:\r\n            ciarki na plecach, strach, niepokój, a także zaskoczenie na koniec gdy dowiadujesz się już wszytkiego.\r\n            To właśnie te uczucia sprawiają, że Kryminatorium dostarcza niesamowitych wrażeń każdemu miłośnikowi gatunku True Crime.\r\n            Jestem przekonany, że każdy fan tego rodzaju historii znajdzie tu coś dla siebie i będzie w pełni usatysfakcjonowany\r\n            każdym kolejnym odcinkiem. Każda sprawa jest dogłębnie analizowana, a sposób, w jaki Marcin\r\n            prowadzi swoje narracje, czyni je wyjątkowymi i angażującymi na najwyższym poziomie.</p>\r\n    </div>\r\n\r\n    <footer>\r\n        <p><i><a href=\"index.php?idp=glowna\" class=\"static\">Powrót do strony głównej</a></i></p>\r\n        <p><i><a href=\"index.php?idp=Form\" class=\"static\">Kontakt</a></i></p>\r\n    </footer>\r\n</div>\r\n\r\n<button class=\"bntdark\" type=\"button\" onclick=\"changeBackground(\'#4E4545FF\', \'#fff\')\">Dark</button>\r\n<button class=\"bntlight\" type=\"button\" onclick=\"changeBackground(\'#fff\', \'#4E4545FF\')\">Light</button>\r\n\r\n', 1, 'Krym'),
(6, 'NWP', '\r\n<!DOCTYPE html>\r\n\r\n<head>\r\n\r\n    <title>NI3 WIEM PODCAST</title>\r\n    <link rel=\"stylesheet\" href=\"css/stylesub.css\">\r\n    <script src=\"js/kolorujtlo.js\" type=\"text/javascript\"></script>\r\n    <script src=\"js/timedate.js\" type=\"text/javascript\"></script>\r\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\r\n    <script>\r\n        $(document).ready(function () {\r\n            $(\"header\").click(function (){\r\n                $(this).toggleClass(\"header_animation\")\r\n            });\r\n        });\r\n    </script>\r\n</head>\r\n\r\n\r\n<div class=\"all\">\r\n    <header>\r\n        <div id=\"zegarek\"></div>\r\n        <div id=\"data\"></div>\r\n        <div class=\"sub-header\">\r\n            <h1>NI3 WIEM PODCAST</h1>\r\n            <p>Trzech kolegów rozmawia ze sobą o wszystkim i niczym</p>\r\n        </div>\r\n    </header>\r\n\r\n    <div class=\"block\">\r\n        <img src=\"img/NWP/NWP1.png\" alt=\"Zdjęcie 1\" class=\"left-img\">\r\n        <p>Opis ze Spotify: <br> Witam w Ni3 Wiem Podcast. <br> Jest to podcast o totalnych głupotach. Czasami obgadujemy dramy influenserów, jeszcze częściej wydarzenia z ostatnich dni.\r\n            Nie zamykamy się na żadne tematy. Żartujemy sobie ze wszystkiego i z niczego. Jakby to określić... \"nie wiem\".\r\n            Odcinki pojawiają się co tydzień w niedzielę o godzinie 14:00. Czasem dodatkowo wypuścimy jakiś specjal ale to zależy</p>\r\n\r\n        <img src=\"img/NWP/NWP2.png\" alt=\"Zdjęcie 2\" class=\"right-img\">\r\n        <p>Jest to podcast komediowy nastawiony na rozmowę 3 kolegów na przeróżne tematy związane m. in. z polską muzyką, filmami Marvel\'a, itp.\r\n            Trójka prowadzących czyli: Czarek \"czarekbut\" Butkiewicz (ten trzeci, dyktator Czaruch, ten co nie ma czasu bo zaraz do pracy idzie, siłowniany świr),\r\n            Zbychu \"Kozack97\" Skowroński (Skawiński, Skowyrski, ten gruby, bezrobotny, leń, nie potrafi wstać na 10 na nagrywki) oraz\r\n            Piotrek \"Piotrek Parking\" Parking (polski Spiderman, właściciel kanału commentary, ukrywa się pod maską, wielki wróg Gimpera)</p>\r\n\r\n        <p>Słucham NI3 WIEM Podcastu już od ponad dwóch lat i za każdym razem potrafi on poprawić mi humor. Uwielbiam sposób,\r\n            w jaki prowadzący omawiają wydarzenia z ostatniego tygodnia, potrafiąc z wyczuciem balansować między powagą a komizmem\r\n            sytuacji. Szczególnie doceniam ich recenzje nowych filmów oraz premiery kinowe, na które często brakuje mi czasu, by obejrzeć je\r\n            samodzielnie. Dzięki temu mam przegląd najnowszych produkcji i mogę poczuć się na bieżąco. A te półtorej czy dwie godziny,\r\n            które spędzam z podcastem, mijają błyskawicznie, bo atmosfera, jaką tworzą Piotrek, Czarek i Zbychu, jest pełna pozytywnej\r\n            energii. Każdy odcinek dostarcza śmiechu i relaksu, a oczekiwanie na nową niedzielną premierę stało się dla\r\n            mnie prawdziwą tradycją.</p>\r\n    </div>\r\n\r\n    <footer>\r\n        <p><i><a href=\"index.php?idp=glowna\" class=\"static\">Powrót do strony głównej</a></i></p>\r\n        <p><i><a href=\"index.php?idp=Form\" class=\"static\">Kontakt</a></i></p>\r\n    </footer>\r\n</div>\r\n\r\n<button class=\"bntdark\" type=\"button\" onclick=\"changeBackground(\'#4E4545FF\', \'#fff\')\">Dark</button>\r\n<button class=\"bntlight\" type=\"button\" onclick=\"changeBackground(\'#fff\', \'#4E4545FF\')\">Light</button>\r\n\r\n', 1, 'NWP'),
(7, 'Slow', '\r\n<!DOCTYPE html>\r\n\r\n<head>\r\n\r\n    <title>Słowiańskie Demony</title>\r\n    <link rel=\"stylesheet\" href=\"css/stylesub.css\">\r\n    <script src=\"js/kolorujtlo.js\" type=\"text/javascript\"></script>\r\n    <script src=\"js/timedate.js\" type=\"text/javascript\"></script>\r\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\r\n    <script>\r\n        $(document).ready(function () {\r\n            $(\"header\").click(function (){\r\n                $(this).toggleClass(\"header_animation\")\r\n            });\r\n        });\r\n    </script>\r\n</head>\r\n\r\n\r\n<div class=\"all\">\r\n    <header>\r\n        <div id=\"zegarek\"></div>\r\n        <div id=\"data\"></div>\r\n        <div class=\"sub-header\">\r\n            <h1>Słowiańskie Demony</h1>\r\n            <p>Podcast o mitologii słowiańskiej</p>\r\n        </div>\r\n    </header>\r\n\r\n    <div class=\"block\">\r\n        <img src=\"img/Slow/Slow1.png\" alt=\"Zdjęcie 1\" class=\"left-img\">\r\n        <p>Opis ze Spotify: <br> Podcast o mitologii słowiańskiej, ze szczegółnym uwzględnieniem demonologii i odrobiną historii. Czemu\r\n        topiono Marzannę? Dlaczego nasi dziadkowie bali się południc? Co różniło Swaroga i Swarożyca> Jakie tałatajstwa nie dawały spać\r\n        po nocach naszym przodkom i w co tak ogólnie wierzyli dawni Słowianie?</p>\r\n        <img src=\"img/Slow/Slow2.png\" alt=\"Zdjęcie 2\" class=\"right-img\">\r\n        <p>Na Słowiańskie Demony natknąłem się w czasach technikum, dzięki dobremu znajomemu. W tamtym czasie na kanale były dostępne zaledwie\r\n            trzy odcinki, więc nie miałem wiele do nadrabiania. Już od pierwszego odsłuchu tematyka dawnych wierzeń słowiańskich mnie\r\n            zafascynowała, zwłaszcza że w szkole nie mieliśmy okazji zgłębiać takich zagadnień. Podcast otworzył przede mną drzwi do mało\r\n            znanego świata wierzeń przodków, a wszystko to przedstawione było w niezwykle wciągający sposób.\r\n            Prowadzący potrafił nie tylko zainteresować słuchacza, ale również wprowadzić go w temat z wielką starannością.\r\n            Każdy odcinek opierał się na rzetelnych materiałach, popartych licznymi źródłami, w tym książkami, zapisami z archiwów i\r\n            innymi historycznymi dokumentami. Dzięki temu, słuchając, miałem pewność, że przedstawiane informacje są wiarygodne.\r\n            Podcast umożliwiał poznanie historii, która rzadko pojawia się w szkolnych programach nauczania. W przystępny sposób\r\n            ukazywał świat dawnych Słowian i ich wierzeń, zanim nastało chrześcijaństwo, odkrywając przed słuchaczami fascynujący\r\n            świat mitologii, obrzędów i postaci, które kształtowały tożsamość przedchrześcijańskiej Europy Wschodniej.\r\n            Każdy odcinek był dla mnie podróżą w czasie, podczas której mogłem zgłębiać tę mało znaną część historii Polski\r\n            i innych krajów słowiańskich. Niestety podcast nie jest już kontynuowany, ale z przyjemnością wracam do starych odcinków,\r\n            by jeszcze raz zagłębić się w świat wierzeń słowiańskich</p>\r\n    </div>\r\n\r\n    <footer>\r\n        <p><i><a href=\"index.php?idp=glowna\" class=\"static\">Powrót do strony głównej</a></i></p>\r\n        <p><i><a href=\"index.php?idp=Form\" class=\"static\">Kontakt</a></i></p>\r\n    </footer>\r\n</div>\r\n\r\n<button class=\"bntdark\" type=\"button\" onclick=\"changeBackground(\'#4E4545FF\', \'#fff\')\">Dark</button>\r\n<button class=\"bntlight\" type=\"button\" onclick=\"changeBackground(\'#fff\', \'#4E4545FF\')\">Light</button>\r\n\r\n', 1, 'Slow'),
(8, 'Filmy', '<!DOCTYPE html>\r\n\r\n<head>\r\n\r\n    <link rel=\"stylesheet\" href=\"css/stylesub.css\">\r\n    <script src=\"js/kolorujtlo.js\" type=\"text/javascript\"></script>\r\n    <script src=\"js/timedate.js\" type=\"text/javascript\"></script>\r\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\r\n    <script>\r\n        $(document).ready(function () {\r\n            $(\"header\").click(function () {\r\n                $(this).toggleClass(\"header_animation\");\r\n            });\r\n        });\r\n    </script>\r\n</head>\r\n\r\n<div class=\"all\">\r\n    <header>\r\n        <div id=\"zegarek\"></div>\r\n        <div id=\"data\"></div>\r\n        <div class=\"sub-header\">\r\n            <h1>Linki do YouTube</h1>\r\n            <p>Przydatne linki do kanałów wspominanych podcastów na YouTube</p>\r\n        </div>\r\n    </header>\r\n\r\n    <div class=\"block\">\r\n        <ul>\r\n            <li><a href=\"https://www.youtube.com/@ni3wiempodcast432\" target=\"_blank\">NI3 WIEM PODCAST</a></li>\r\n            <li><a href=\"https://www.youtube.com/c/Dw%C3%B3chTyp%C3%B3wPodcast/featured\" target=\"_blank\">Dwóch Typów Podcast</a></li>\r\n            <li><a href=\"https://www.youtube.com/@Kryminatorium\" target=\"_blank\">Kryminatorium</a></li>\r\n            <li><a href=\"https://www.youtube.com/@Dama_Kier/featured\" target=\"_blank\">Dama Kier</a></li>\r\n            <li><a href=\"https://www.youtube.com/@slowianskiedemony\" target=\"_blank\">Słowiańskie Demony</a></li>\r\n        </ul>\r\n    </div>\r\n\r\n    <footer>\r\n        <p><i><a href=\"index.php?idp=glowna\" class=\"static\">Powrót do strony głównej</a></i></p>\r\n        <p><i><a href=\"index.php?idp=Form\" class=\"static\">Kontakt</a></i></p>\r\n    </footer>\r\n</div>\r\n\r\n<button class=\"bntdark\" type=\"button\" onclick=\"changeBackground(\'#4E4545FF\', \'#fff\')\">Dark</button>\r\n<button class=\"bntlight\" type=\"button\" onclick=\"changeBackground(\'#fff\', \'#4E4545FF\')\">Light</button>\r\n\r\n</html>', 1, 'film'),
(9, 'Sklep', '<?php\r\n// Sprawdzamy, czy sesja jest już rozpoczęta, jeśli nie, rozpoczynamy ją.\r\nif (session_status() === PHP_SESSION_NONE) {\r\n    session_start();\r\n}\r\n    include \'cart.php\';\r\n    include \'ProductManager.php\';\r\n\r\n    $productManager = new ProductManager(\'localhost\', \'moja_strona\', \'root\', \'\');\r\n\r\n    //Obsługa akcjji związamych z koszykiem\r\n    if ($_SERVER[\"REQUEST_METHOD\"] == \"POST\") {\r\n        //Dodanie produktu do koszyka\r\n        if (isset($_POST[\'add_to_cart\'])) {\r\n            addToCartFromDB($productManager, $_POST[\'product_id\'], $_POST[\'ilosc\']);\r\n        }\r\n\r\n        //Usuniecie produktu z koszyka\r\n        if (isset($_POST[\'remove_product\'])) {\r\n            removeFromCart($_POST[\'remove_id\']);\r\n        }\r\n\r\n        //Zmiana ilości produktu w koszyku\r\n        if (isset($_POST[\'update_quantity\'])) {\r\n            updateCartQuantity($_POST[\'update_id\'], $_POST[\'ilosc\']);\r\n        }\r\n    }\r\n\r\n    //Pobieramie produktów z bazy danych\r\n    $products = $productManager->getAllProducts();\r\n?>\r\n\r\n<!DOCTYPE html>\r\n<html lang=\"pl\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>Produkty i Koszyk</title>\r\n    <link rel=\"stylesheet\" href=\"css/stylecartproduct.css\">\r\n</head>\r\n<body>\r\n<header>\r\n    <h1>Produkty i Koszyk</h1>\r\n</header>\r\n\r\n<main>\r\n    <section class=\"products-section\">\r\n        <h2>Produkty</h2>\r\n        <div class=\"products\">\r\n            <?php foreach ($products as $product): ?>\r\n                <div class=\"product\">\r\n                    <h3><?php echo htmlspecialchars($product[\'tytul\']); ?></h3>\r\n                    <p><?php echo htmlspecialchars($product[\'opis\']); ?></p>\r\n                    <p>Cena netto: <?php echo number_format($product[\'cena_netto\'], 2); ?> zł</p>\r\n                    <p>VAT: <?php echo $product[\'podatek_vat\']; ?>%</p>\r\n                    <form method=\"POST\">\r\n                        <input type=\"hidden\" name=\"product_id\" value=\"<?php echo $product[\'id\']; ?>\">\r\n                        <label for=\"ilosc\">Ilość:</label>\r\n                        <input type=\"number\" name=\"ilosc\" value=\"1\" min=\"1\">\r\n                        <button type=\"submit\" name=\"add_to_cart\">Dodaj do koszyka</button>\r\n                    </form>\r\n                </div>\r\n            <?php endforeach; ?>\r\n        </div>\r\n    </section>\r\n\r\n    <section class=\"cart-section\">\r\n        <h2>Koszyk</h2>\r\n        <?php showCart(); ?>\r\n    </section>\r\n</main>\r\n\r\n<footer>\r\n    <p><i><a href=\"index.php?idp=glowna\">Powrót do strony głównej</a></i></p>\r\n</footer>\r\n</body>\r\n</html>\r\n', 1, 'sklep');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `tytul` varchar(255) NOT NULL,
  `opis` text DEFAULT NULL,
  `data_utworzenia` datetime DEFAULT current_timestamp(),
  `data_modyfikacji` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `data_wygasniecia` datetime DEFAULT NULL,
  `cena_netto` decimal(10,2) NOT NULL,
  `podatek_vat` decimal(5,2) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `status_dostepnosci` tinyint(1) NOT NULL,
  `kategoria` int(11) NOT NULL,
  `gabaryt` varchar(255) DEFAULT NULL,
  `zdjecie` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `tytul`, `opis`, `data_utworzenia`, `data_modyfikacji`, `data_wygasniecia`, `cena_netto`, `podatek_vat`, `ilosc`, `status_dostepnosci`, `kategoria`, `gabaryt`, `zdjecie`) VALUES
(1, 'Koszulka szara', 'Szara koszulka', '2025-01-06 12:09:38', '2025-01-20 23:24:07', '2025-01-26 00:00:00', 49.50, 23.00, 13, 1, 5, 'średni', 'uploads/678ecd07f07da_koszulka-szary-melanz.jpg'),
(2, 'Kubek EKO', 'Kubek wykonany z materiałów z odzysku z nadrukiem podcastu', '2025-01-06 12:09:38', '2025-01-20 23:48:29', '2025-01-26 00:00:00', 39.99, 23.00, 12, 1, 9, 'mały', 'uploads/678ed2bd6a174_eko_kubek.jpg'),
(3, 'Kubek A', 'Kubek w standardowym rozmiarze z nadrukiem podcastu', '2025-01-06 12:09:38', '2025-01-20 23:50:02', '2025-01-26 00:00:00', 34.50, 23.00, 32, 1, 10, 'mały', 'uploads/678ed31accfa2_kubek_a.jpg'),
(4, 'Kubek Premium', 'Ekskluzywny kubek z podpisem podcastu', '2025-01-06 12:09:38', '2025-01-20 23:50:59', '2025-01-26 00:00:00', 45.99, 23.00, 34, 1, 13, 'mały', 'uploads/678ed3537c437_premium_kubek.jpg'),
(5, 'Plakat A3', 'Plakat z grafiką w rozmiarze A3 z nadrukiem podcastu', '2025-01-06 12:09:38', '2025-01-20 23:52:42', '2025-01-26 00:00:00', 24.99, 23.00, 23, 1, 16, 'duży', 'uploads/678ed3ba92530_plakat_a3.jpg'),
(6, 'Plakat A4', 'Plakat w rozmiarze A4 z nadrukiem podcastu', '2025-01-06 12:09:38', '2025-01-20 23:54:02', '2025-01-26 00:00:00', 19.99, 23.00, 24, 1, 15, 'mały', 'uploads/678ed40a5a7e7_plakat_a4.jpg'),
(8, 'Polo Wierdolo', 'Koszulka polo', '2025-01-06 13:09:18', '2025-01-20 23:54:59', '2025-01-26 00:00:00', 55.99, 23.00, 43, 1, 7, 'średni', 'uploads/678ed4437da77_polo.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`kategoria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`kategoria`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
