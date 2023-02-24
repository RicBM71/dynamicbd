<?php

namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DynamicModel extends Model
{
    use HasFactory;

    public function getConnectionName()
    {

        $dynamic_database = session('dynamic_database');

        Config::set([
            'database.connections.mysql.database' => $dynamic_database,
        ]);

        return parent::getConnectionName();

    }
}
