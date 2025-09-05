<?php

if (!function_exists('storage_url')) {
  function storage_url(string|null $path): string {
    return asset('storage/' . $path);
  }
}
