<?php declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";

function stringify(mixed $arg): string {
  if ($arg === null) return 'null';
  if (is_bool($arg)) return $arg ? 'true' : 'false';
  if (is_scalar($arg)) return (string) $arg;
  return var_export($arg, true);
}

function println(mixed ...$args): void {
  $isCli = PHP_SAPI === 'cli';

  $out = [];

  foreach ($args as $arg) {
    $out[] = stringify($arg);
  }

  $separator = ' ';
  $lineBreak = $isCli ? "\n" : "<br>";
  $content = implode($separator, $out);

  if ($isCli) {
    echo "$content $lineBreak";
  } else {
    echo "<pre><code>" . htmlspecialchars($content) . $lineBreak . "</code></pre>";
  }
}

function preStart(): void {
  echo "<pre><code>";
}

function preEnd(): void {
  echo "</code></pre>\n";
}


function tag(string $tag, string|int|bool $content): void {
  echo "<$tag>$content</$tag>\n";
}

function heading(int $level, string|int|bool $content): void {
  tag("h$level", $content);
}

function bodyStart(string $title = "Title", string $styles = "", bool $useWater = true) {
  $cdnLink = $useWater
    ? "https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css"
    : "https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.slate.min.css";

  $picoColors = $useWater
    ? ''
    : '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.colors.min.css">';

  $style =
    <<<CSS
    .fixed-img {
      height: 200px;
      aspect-ratio: 1;
      object-fit: scale-down;
    }

    body {
      min-height: 100vh;
      /* max-width: 1400px; */
      margin-right: auto;
      margin-left: auto;
    }

    code {
      background: #1a1f28 !important;
      color: #ffbe85;
      padding: 2.5px 5px;
      border-radius: 6px;
      font-size: 1em;
    }

    pre > code {
      font-size: 18px;
      padding: 12px;
      padding-left: 1.2rem;
      display: block;
      overflow-x: auto;
    }

    pre {
      padding: 1rem;
      background: transparent;
    }

    a, button, option, select {
      cursor: pointer;
    }
CSS;

  echo <<<EOF
<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="color-scheme" content="light dark">
  <title>$title</title>

  $picoColors
  <link rel="stylesheet" href="$cdnLink" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    $style
    $styles
  </style>
</head>

<body>
EOF;
}

function bodyEnd() {
  echo "\n</body>\n</html>\n";
}
