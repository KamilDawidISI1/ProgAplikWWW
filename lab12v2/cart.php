<?php
// Sprawdzamy, czy sesja jest już rozpoczęta, jeśli nie, rozpoczynamy ją.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//dodaje produkt do koszyka
function addToCart($id, $nazwa, $cena_netto, $vat, $ilosc = 1) {
    $productKey = 'product_' . $id;

    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if(isset($_SESSION['cart'][$productKey])) {
        //Jesli produkt jest juz w koszyku, zwiekszy ilosc
        $_SESSION['cart'][$productKey]['ilosc'] += $ilosc;
    } else {
        $_SESSION['cart'][$productKey] = [
            'id' => $id,
            'nazwa' => $nazwa,
            'cena_netto' => $cena_netto,
            'vat' => $vat,
            'ilosc' => $ilosc
        ];
    }

}

function addToCartFromDB($productManager, $productId, $ilosc = 1) {
    // Pobierz produkt z bazy danych na podstawie jego ID
    $product = $productManager->getProductById($productId);

    // Jeśli produkt nie istnieje, wyświetl komunikat i zakończ działanie
    if (!$product) {
        echo '<p class="error">Produkt nie istnieje!</p>';
        return;
    }

    // Klucz dla produktu w sesji koszyka
    $productKey = "product_" . $product['id'];

    // Inicjalizacja koszyka w sesji, jeśli nie istnieje
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Jeśli produkt już jest w koszyku, zwiększ ilość
    if (isset($_SESSION['cart'][$productKey])) {
        $_SESSION['cart'][$productKey]['ilosc'] += $ilosc;
    } else {
        // Dodaj nowy produkt do koszyka
        $_SESSION['cart'][$productKey] = [
            'id' => $product['id'],
            'nazwa' => $product['tytul'],
            'cena_netto' => $product['cena_netto'],
            'vat' => $product['podatek_vat'],
            'ilosc' => $ilosc,
        ];
    }
}

//Usuwa produkt z koszyka
function removeFromCart($id) {
    $productKey = 'product_' . $id;

    if(isset($_SESSION['cart'][$productKey])) {
        unset($_SESSION['cart'][$productKey]);
    }
}

//Zmienia ilosc produktów w koszyku

function updateCartQuantity($id, $ilosc) {
    $productKey = 'product_' . $id;

    if(isset($_SESSION['cart'][$productKey])) {
        if($ilosc <= 0) {
            removeFromCart($id); //Usuwa produkty gdy ilość jest mniejsza lub równa 0
        } else {
            $_SESSION['cart'][$productKey]['ilosc'] = $ilosc;
        }

    }
}

//Wyświetlanie koszyka
function showCart() {
    if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<p>Twój koszyk jes pusty! Napraw to :)</p>";
        return;
    }

    $total = 0;

    echo '<table>';
    echo '<tr>
            <th>Nazwa produktu</th>
            <th>Cena netto</th>
            <th>VAT (%)</th>
            <th>Cena brutto</th>
            <th>Ilość</th>
            <th>Wartość brutto</th>
            <th>Akcje</th>
          </tr>';

    foreach($_SESSION['cart'] as $product) {
        $cena_brutto = $product['cena_netto'] + ($product['cena_netto'] * $product['vat'] / 100);
        $wartosc_brutto = $cena_brutto * $product['ilosc'];
        $total += $wartosc_brutto;

        echo '<tr>
                <td>'.htmlspecialchars($product['nazwa']).'</td>
                <td>'.number_format($product['cena_netto'], 2).'</td>
                <td>'.$product['vat'].'%</td>
                <td>'.number_format($cena_brutto, 2).'</td>
                <td>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="update_id" value="'.$product['id'].'">
                        <input type="number" name="ilosc" value="'.$product['ilosc'].'" min="0">
                        <button type="submit" name="update_quantity">Zmień</button>
                    </form>
                </td>
                <td>'.number_format($wartosc_brutto, 2).' zł</td>
                <td>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="remove_id" value="'.$product['id'].'">
                        <button type="submit" name="remove_product">Usuń</button>
                    </form>
                </td>
              </tr>';
    }

    echo '<tr>
            <td colspan="5" style="text-align: right;">Razem:</td>
            <td>'.number_format($total, 2).' zł</td> 
          </tr>';
    echo '</table>';
}

//Czyszczenie koszyka
function clearCart() {
    unset($_SESSION['cart']);
}

?>
