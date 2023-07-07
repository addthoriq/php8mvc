<?php

function getDatabaseConfig(): array {
  return [
    "database" => [
      "test" => [
        "url" => "pgsql:host=localhost;port=5432;dbname=phpmvc_test",
        "username" => "postgres",
        "password" => null
      ],
      "prod" => [
        "url" => "pgsql:host=localhost;port=5432;dbname=phpmvc",
        "username" => "postgres",
        "password" => null
      ]
    ]
  ];
}
