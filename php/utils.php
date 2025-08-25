<?php declare(strict_types=1);


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

function bodyStart(string $title = "Title", string $styles = "") {
  echo <<<EOF
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>$title</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css" />
  <style>
    body {
      min-height: 100vh;
      max-width: 1000px;
    }

    pre>code {
      font-size: 1rem;
      padding-left: 1.2rem;
    }

    td {
      border-bottom: 1px solid #526980;
    }

    $styles
  </style>
</head>

<body>
EOF;
}

function bodyEnd() {
  echo "\n</body>\n</html>\n";
}
