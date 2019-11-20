<?php
session_start();
require 'vendor/autoload.php';

use App\Models\Database;
//Initialize Illuminate Database Connection
new Database();

/*
     "psr-4": {
                   "Controllers\\": "app/Controllers/",
                    "Models\\": "app/Models/"

                 },
*/