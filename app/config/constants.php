<?php

define("DBDRIVER", "driver");
define("DBHOST", "host");
define("DBNAME", "dbname");
define("DBUSER", "user");
define("DBPASSWORD", "password");

define("TOKEN_SECRET", $_ENV["TOKEN_SECRET"]);
define("TOKEN_EXPIRE", $_ENV["TOKEN_EXPIRE"]);
define("TOKEN_ISSUER", $_ENV["TOKEN_ISSUER"]);