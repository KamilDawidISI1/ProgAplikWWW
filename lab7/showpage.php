<?php
function getPageContent($alias, $conn)
{
    if (!preg_match('/^[a-zA-Z0-9_-]+$/', $alias)) {
        die("Nieprawidłowy alias strony.");
    }

    $stmt = $conn->prepare("SELECT * FROM `page_list` WHERE `alias` = ? AND `status` = 1 LIMIT 1");
    $stmt->bind_param("s", $alias);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["page_content"];
    }
    else {
        return "Strona nie istnieje lub jest nieaktywna";
    }
}
?>