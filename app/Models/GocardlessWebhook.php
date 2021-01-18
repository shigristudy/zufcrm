<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GocardlessWebhook extends Model
{
    use HasFactory;

    protected $table = 'gocardless_webhook_calls';
}
