<?php
// Temporary server check. Delete this file as soon as the site works.
// Open it with ?fix=1 to write the two .htaccess files Laravel needs.
header('Content-Type: text/plain; charset=utf-8');
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Works from the Laravel folder itself or from its public folder
$root = is_file(__DIR__ . '/artisan') ? __DIR__ : dirname(__DIR__);
$line = fn (string $label, bool $ok, string $note = '') => print(($ok ? '[OK]   ' : '[FAIL] ') . $label . ($note ? ' - ' . $note : '') . "\n");

$rootHtaccess = <<<'TXT'
<IfModule mod_rewrite.c>
    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Files that exist in Laravel's public folder are served from there
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteCond %{DOCUMENT_ROOT}/public/$1 -f
    RewriteRule ^(.*)$ public/$1 [L]

    # Everything else goes to Laravel
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^ public/index.php [L]
</IfModule>

TXT;

$publicHtaccess = <<<'TXT'
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Handle X-XSRF-Token Header
    RewriteCond %{HTTP:x-xsrf-token} .
    RewriteRule .* - [E=HTTP_X_XSRF_TOKEN:%{HTTP:X-XSRF-Token}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

TXT;

echo 'PHP ' . PHP_VERSION . "\n\n";
echo 'This file is in: ' . __DIR__ . "\n";
echo 'Laravel folder:  ' . $root . (is_file($root . '/artisan') ? '' : '  (artisan not found here)') . "\n\n";

if (isset($_GET['fix'])) {
    echo ".htaccess fix\n";
    foreach (['.htaccess' => $rootHtaccess, 'public/.htaccess' => $publicHtaccess] as $file => $content) {
        $path = $root . '/' . $file;
        if (is_file($path)) {
            copy($path, $path . '.old');
        }
        $line('written ' . $file, file_put_contents($path, $content) !== false);
    }
    echo "\n";
}

$line('PHP 8.2 or newer', version_compare(PHP_VERSION, '8.2.0', '>='));

foreach (['pdo_mysql', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'fileinfo', 'curl'] as $ext) {
    $line('extension ' . $ext, extension_loaded($ext));
}

echo "\nFiles\n";
foreach (['.env', 'public/index.php', 'vendor/autoload.php', 'vendor/laravel/framework/src/Illuminate/Foundation/Application.php', 'bootstrap/app.php', 'routes/web.php'] as $file) {
    $line($file, file_exists($root . '/' . $file));
}
$current = is_file($root . '/.htaccess') ? file_get_contents($root . '/.htaccess') : '';
$line('.htaccess sends requests to public/index.php', str_contains($current, 'public/index.php'), $current === '' ? 'missing' : (str_contains($current, 'public/index.php') ? '' : 'wrong file here, open this page with ?fix=1'));
$line('public/.htaccess', is_file($root . '/public/.htaccess'), is_file($root . '/public/.htaccess') ? '' : 'missing, open this page with ?fix=1');
foreach (['bootstrap/cache/config.php', 'bootstrap/cache/routes-v7.php'] as $file) {
    $line($file . ' is absent', !file_exists($root . '/' . $file), file_exists($root . '/' . $file) ? 'delete this file' : '');
}

echo "\nFolders (must exist and be writable)\n";
foreach (['storage', 'storage/logs', 'storage/framework', 'storage/framework/views', 'storage/framework/cache', 'storage/framework/cache/data', 'storage/framework/sessions', 'bootstrap/cache'] as $dir) {
    $path = $root . '/' . $dir;
    $line($dir, is_dir($path) && is_writable($path), !is_dir($path) ? 'missing' : (is_writable($path) ? '' : 'not writable'));
}

echo "\nDatabase\n";
$env = [];
foreach (is_file($root . '/.env') ? file($root . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [] as $row) {
    if ($row[0] !== '#' && str_contains($row, '=')) {
        [$key, $value] = explode('=', $row, 2);
        $env[trim($key)] = trim($value, " \"'");
    }
}
try {
    $pdo = new PDO('mysql:host=' . ($env['DB_HOST'] ?? '') . ';port=' . ($env['DB_PORT'] ?? '3306') . ';dbname=' . ($env['DB_DATABASE'] ?? ''), $env['DB_USERNAME'] ?? '', $env['DB_PASSWORD'] ?? '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
    $line('connection', true, count($tables) . ' tables');
    foreach (['sessions', 'cache', 'migrations'] as $table) {
        $line('table ' . $table, in_array($table, $tables), in_array($table, $tables) ? '' : 'import the database');
    }
} catch (Throwable $e) {
    $line('connection', false, $e->getMessage());
}

// Ask Laravel for the home page the same way a browser request would
echo "\nHome page through Laravel\n";
try {
    require $root . '/vendor/autoload.php';
    $app = require $root . '/bootstrap/app.php';
    $response = $app->make(Illuminate\Contracts\Http\Kernel::class)->handle(Illuminate\Http\Request::create('/', 'GET'));
    $status = $response->getStatusCode();
    $line('GET / gives ' . $status, $status === 200, 'Laravel ' . $app->version());
    if ($status !== 200) {
        $error = $response->exception ?? null;
        echo $error
            ? get_class($error) . ': ' . $error->getMessage() . "\n  at " . $error->getFile() . ':' . $error->getLine() . "\n"
            : substr(trim(strip_tags((string) $response->getContent())), 0, 800) . "\n";
    }
} catch (Throwable $e) {
    $line('GET /', false, get_class($e) . ': ' . $e->getMessage() . "\n  at " . $e->getFile() . ':' . $e->getLine());
}

$log = $root . '/storage/logs/laravel.log';
if (is_file($log)) {
    echo "\nLast error in laravel.log\n";
    $rows = array_values(array_filter(file($log, FILE_IGNORE_NEW_LINES), fn ($row) => preg_match('/^\[\d{4}-\d{2}-\d{2}/', $row)));
    echo substr(end($rows) ?: '(empty)', 0, 600) . "\n";
}
