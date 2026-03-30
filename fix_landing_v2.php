<?php
// FIX: Upload original madrid_landing.html with correct UTF-8 encoding
// The previous fix wrongly converted ✓ to &#10003; which breaks CSS content property

$conn = new mysqli('localhost', 'UsrDBespLu2015', 'spol2vi0xy1go', 'DBespLu2015');
if ($conn->connect_error) { die('DB Error: ' . $conn->connect_error); }

$conn->set_charset('utf8mb4');
$conn->query("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");

// Read the ORIGINAL file (not the clean one) - it has correct UTF-8
$content = file_get_contents('/tmp/madrid_landing_original.html');
if (!$content) { die('Cannot read file'); }

echo 'File length: ' . strlen($content) . "\n";

// Verify checkmark is there
$pos = strpos($content, 'checklist li::before');
if ($pos !== false) {
    $snippet = substr($content, $pos, 80);
    echo 'Checkmark CSS: ' . $snippet . "\n";
    // Check it has the actual ✓ char (UTF-8: e2 9c 93)
    $hex = bin2hex(substr($content, $pos + 20, 10));
    echo 'Checkmark hex: ' . $hex . "\n";
}

// Update post 67389
$stmt = $conn->prepare('UPDATE el_posts SET post_content=?, post_modified=NOW(), post_modified_gmt=NOW() WHERE ID=67389');
$stmt->bind_param('s', $content);
if ($stmt->execute()) {
    echo 'Updated rows: ' . $stmt->affected_rows . "\n";
} else {
    echo 'Error: ' . $stmt->error . "\n";
}

// Verify the checkmark stored correctly
$verify = $conn->query("SELECT HEX(SUBSTRING(post_content, LOCATE('checklist li::before', post_content), 60)) as h FROM el_posts WHERE ID=67389");
$row = $verify->fetch_assoc();
$bytes = hex2bin($row['h']);
echo 'Stored checkmark CSS: ' . $bytes . "\n";

// Also verify no double-encoding on Spanish chars
$verify2 = $conn->query("SELECT HEX(SUBSTRING(post_content, LOCATE('Confirmaci', post_content), 20)) as h FROM el_posts WHERE ID=67389");
$row2 = $verify2->fetch_assoc();
echo 'Confirmacion hex: ' . $row2['h'] . "\n";
echo 'Confirmacion text: ' . hex2bin($row2['h']) . "\n";

echo "Done!\n";
