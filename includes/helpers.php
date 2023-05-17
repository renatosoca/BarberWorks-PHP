<?php

function debugging($variable): string {
  echo "<pre>";
  var_dump($variable);
  echo "</pre>";
  exit;
}

function sanitize($html): string {
  $sanitized = htmlspecialchars($html);
  return $sanitized;
}

function isFinal(string $currency, string $next): bool {
  if ($currency !== $next) {
      return true;
  }
  return false;
}

function isAuth(): void {
  if (!isset($_SESSION['login'])) {
    header('Location: /');
  }
}

function isAdmin(): void {
  if (!isset($_SESSION['admin'])) {
    header('Location: /');
  }
}