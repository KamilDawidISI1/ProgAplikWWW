<?php

class CategoryManager
{
    private $db;

    // Konstruktor: Ustanawia połączenie z bazą danych
    public function __construct($host, $dbname, $user, $pass) {
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Błąd połączenia z bazą danych: " . $e->getMessage());
        }
    }

    // Dodaje nową kategorię do bazy danych
    public function addCategory($matka, $nazwa, $opis) {
        $stmt = $this->db->prepare("INSERT INTO categories (matka, nazwa, opis) VALUES (:matka, :nazwa, :opis)");
        $stmt->execute([':matka' => $matka, ':nazwa' => $nazwa, ':opis' => $opis]);
    }

    // Edytuje istniejącą kategorię
    public function editCategory($id, $nazwa, $opis) {
        $stmt = $this->db->prepare("UPDATE categories SET nazwa = :nazwa, opis = :opis WHERE id = :id");
        $stmt->execute([':nazwa' => $nazwa, ':opis' => $opis, ':id' => $id]);
    }

    // Usuwa kategorię i jej podkategorie
    public function deleteCategory($id) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = :id OR matka = :id");
        $stmt->execute([':id' => $id]);
    }

    // Pobiera wszystkie kategorie
    public function getAllCategories() {
        return $this->db->query("SELECT * FROM categories ORDER BY matka, id")->fetchAll(PDO::FETCH_ASSOC);
    }

    // Wyświetla drzewo kategorii
    public function showCategories() {
        $categories = $this->getAllCategories();
        $this->printCategoryTree($categories);
    }

    // Rekurencyjne wyświetlanie drzewa kategorii
    private function printCategoryTree($categories, $parentId = 0, $level = 0) {
        foreach ($categories as $category) {
            if ($category['matka'] == $parentId) {
                echo str_repeat("--", $level) . $category['nazwa'] . "<br>";
                $this->printCategoryTree($categories, $category['id'], $level + 1);
            }
        }
    }
}