<?php

declare(strict_types=1);

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
