<?php

function getDatabaseConfig(): array {
  return [
    "database" => [
      "test" => [
        "url" => "postgresql://localhost:5432/phpmvc_test",
        "username" => "postgres",
        "password" => ""
      ],
      "prod" => [
        "url" => "postgresql://localhost:5432/phpmvc",
        "username" => "postgres",
        "password" => ""
      ]
    ]
  ];
}
