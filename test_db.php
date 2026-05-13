<?php
$connections = [
    'localhost:3306'  => ['localhost',  3306],
    '127.0.0.1:3306' => ['127.0.0.1', 3306],
];

foreach ($connections as $label => [$host, $port]) {
    try {
        $pdo = new PDO(
            "mysql:host={$host};port={$port};charset=utf8mb4",
            'root', '',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        $dbs = $pdo->query("SHOW DATABASES")->fetchAll(PDO::FETCH_COLUMN);
        $has = in_array('a200368', $dbs) ? '✓ HAS a200368' : '✗ NO a200368';
        echo "<p><strong>{$label}</strong> — {$has}<br>";
        echo implode(', ', $dbs) . "</p>";
    } catch (Exception $e) {
        echo "<p><strong>{$label}</strong> FAILED: " . $e->getMessage() . "</p>";
    }
}