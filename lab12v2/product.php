<?php
// Sprawdzamy, czy sesja jest już rozpoczęta, jeśli nie, rozpoczynamy ją.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    include 'cart.php';
    include 'ProductManager.php';

    $productManager = new ProductManager('localhost', 'moja_strona', 'root', '');

    //Obsługa akcjji związamych z koszykiem
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Dodanie produktu do koszyka
        if (isset($_POST['add_to_cart'])) {
            addToCartFromDB($productManager, $_POST['product_id'], $_POST['ilosc']);
        }

        //Usuniecie produktu z koszyka
        if (isset($_POST['remove_product'])) {
            removeFromCart($_POST['remove_id']);
        }

        //Zmiana ilości produktu w koszyku
        if (isset($_POST['update_quantity'])) {
            updateCartQuantity($_POST['update_id'], $_POST['ilosc']);
        }
    }

    //Pobieramie produktów z bazy danych
    $products = $productManager->getAllProducts();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkty i Koszyk</title>
    <link rel="stylesheet" href="css/stylecartproduct.css">
</head>
<body>
<header>
    <h1>Produkty i Koszyk</h1>
</header>

<main>
    <section class="products-section">
        <h2>Produkty</h2>
        <div class="products">
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <h3><?php echo htmlspecialchars($product['tytul']); ?></h3>
                    <img src="<?php echo $product['zdjecie'] ? 'admin/' . htmlspecialchars($product['zdjecie']) : 'admin/uploads/default.jpg'; ?>" alt="Zdjęcie produktu" class="product-image">
                    <p><?php echo htmlspecialchars($product['opis']); ?></p>
                    <p>Cena netto: <?php echo number_format($product['cena_netto'], 2); ?> zł</p>
                    <p>VAT: <?php echo $product['podatek_vat']; ?>%</p>
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <label for="ilosc">Ilość:</label>
                        <input type="number" name="ilosc" value="1" min="1">
                        <button type="submit" name="add_to_cart">Dodaj do koszyka</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="cart-section">
        <h2>Koszyk</h2>
        <?php showCart(); ?>
    </section>
</main>

<footer>
    <p><i><a href="index.php?idp=glowna">Powrót do strony głównej</a></i></p>
</footer>
</body>
</html>
