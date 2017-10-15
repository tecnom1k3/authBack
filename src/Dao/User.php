<?php
namespace Digitec\Dao;

use App\User as UserModel;
use Illuminate\Support\Facades\Log;

/**
 * Class User
 * @package Digitec\Dao
 */
class User
{

    /**
     * @param string $email
     * @return bool
     */
    public function checkEmailExists(string $email): bool
    {
        Log::info('Invoked [' . __FUNCTION__ . '] in [' . self::class . '] with email [' . $email . ']');
        /** @var \Illuminate\Database\Eloquent\Collection $collection */
        $collection = UserModel::where('email', $email)->get();
        if ($collection->count() > 0) {
            return true;
        }
        return false;
    }

}