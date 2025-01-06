<?php
class ProductManager {
    private $db;

    public function __construct($host, $dbname, $user, $pass) {
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Błąd połączenia z bazą danych: " . $e->getMessage());
        }
    }

    // Dodaj nowy produkt
    public function addProduct($tytul, $opis, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc, $status_dostepnosci, $kategoria, $gabaryt, $zdjecie) {
        $stmt = $this->db->prepare("
        INSERT INTO products (tytul, opis, data_wygasniecia, cena_netto, podatek_vat, ilosc, status_dostepnosci, kategoria, gabaryt, zdjecie)
        VALUES (:tytul, :opis, :data_wygasniecia, :cena_netto, :podatek_vat, :ilosc, :status_dostepnosci, :kategoria, :gabaryt, :zdjecie)
    ");
        $stmt->execute([
            ':tytul' => $tytul,
            ':opis' => $opis,
            ':data_wygasniecia' => $data_wygasniecia,
            ':cena_netto' => $cena_netto,
            ':podatek_vat' => $podatek_vat,
            ':ilosc' => $ilosc,
            ':status_dostepnosci' => $status_dostepnosci,
            ':kategoria' => $kategoria,
            ':gabaryt' => $gabaryt,
            ':zdjecie' => $zdjecie
        ]);
    }

    // Edytuj istniejący produkt
    public function editProduct($id, $tytul, $opis, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc, $status_dostepnosci, $kategoria, $gabaryt, $zdjecie) {
        $stmt = $this->db->prepare("
            UPDATE products
            SET tytul = :tytul, opis = :opis, data_wygasniecia = :data_wygasniecia, cena_netto = :cena_netto,
                podatek_vat = :podatek_vat, ilosc = :ilosc, status_dostepnosci = :status_dostepnosci, kategoria = :kategoria, gabaryt = :gabaryt, zdjecie = :zdjecie
            WHERE id = :id
        ");
        $stmt->execute([
            ':id' => $id,
            ':tytul' => $tytul,
            ':opis' => $opis,
            ':data_wygasniecia' => $data_wygasniecia,
            ':cena_netto' => $cena_netto,
            ':podatek_vat' => $podatek_vat,
            ':ilosc' => $ilosc,
            ':status_dostepnosci' => $status_dostepnosci,
            ':kategoria' => $kategoria,
            ':gabaryt' => $gabaryt,
            ":zdjecie" => $zdjecie
        ]);
    }

    // Usuń produkt
    public function deleteProduct($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }

    // Pobierz wszystkie produkty
    public function getAllProducts() {
        $stmt = $this->db->query("SELECT * FROM products ORDER BY data_utworzenia DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
