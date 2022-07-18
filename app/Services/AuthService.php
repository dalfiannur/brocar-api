<?

namespace App\Services;

use Kreait\Firebase\Contract\Auth;

class AuthService
{
    private Auth $auth;
    
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function createToken(String $uid)
    {
        return $this->auth->createCustomToken($uid);
    }
}
