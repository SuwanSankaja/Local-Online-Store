<?php
#[AllowDynamicProperties]
class Customer extends Model
{
    private string $_cookieName;
    private string $_sessionName;
    public static Customer|null $currentLoggedInUser = null;

    public function __construct($user = '')
    {
        $table = 'customer';
        parent::__construct($table);
        $this->_sessionName = CURRENT_USER_SESSION_NAME;
        $this->_cookieName = REMEMBER_ME_COOKIE_NAME;
        $this->_softDelete = true;

        if ($user != '') {
            if (is_int($user)) {
                $this->id = $user;
                $u = $this->_db->findFirst('customer', ['conditions' => 'customer_id = ?', 'bind' => [$user]]);
            } else {
                $u = $this->_db->findFirst('customer', ['conditions' => 'username = ? or email = ?', 'bind' => [$user, $user]]);
            }
            if ($u) {
                foreach ($u as $key => $val) {
                    $this->$key = $val;
                }
            }
        }
    }

    public function findByUsername($username): bool|stdClass|Customer
    {
        return $this->findFirst(['conditions' => "username = ? or email = ?", 'bind' => [$username, $username]]);
    }

    public function signin($rememberMe = false)
    {
        Session::set($this->_sessionName, $this->id);

        if ($rememberMe) {
            $hash = md5(uniqid() . rand(0, 100));
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session_id' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id];
            $this->_db->query("DELETE FROM user_session WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);
            $this->_db->insert('user_session', $fields);
        }
        $_SESSION['isLoggedIn'] = true;
    }

    public static function signinUserFromCookie(): Customer
    {
        $userSessionModel = new userSession();
        $userSession = $userSessionModel->findFirst([
            'conditions' => "user_session.session_id = ? AND user_session.user_agent = ?",
            'bind' => [Cookie::get(REMEMBER_ME_COOKIE_NAME), Session::uagent_no_version()]
        ]);

        if ($userSession->user_id != '') {
            $currentLoggedInUser = new self((int)$userSession->user_id);
        }
        $currentLoggedInUser->signin();
        return $currentLoggedInUser;
    }

    /**
     * If the current logged-in user is not set, and the session exists, then set the current logged-in user to the user
     * with the id stored in the session
     *
     * @return ?Customer The current logged-in user.
     */
    public static function currentLoggedInUser(): ?Customer
    {
        if (!isset(self::$currentLoggedInUser)) {
            if (Session::exists(CURRENT_USER_SESSION_NAME)) {
                $u = new self((int)Session::get(CURRENT_USER_SESSION_NAME));
                self::$currentLoggedInUser = $u;
            }
        }
        return self::$currentLoggedInUser;
    }

    /**
     * > Delete the current user's session from the database and delete the session and cookie from the browser
     *
     * @return bool A boolean value.
     */
    public function logout(): bool
    {
        $user_agent = Session::uagent_no_version();
        $this->_db->query("DELETE FROM user_session WHERE user_id = ? AND user_agent = ?", [$this->customer_id, $user_agent]);
        Session::delete(CURRENT_USER_SESSION_NAME);
        if (Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
            Cookie::delete(REMEMBER_ME_COOKIE_NAME);
        }
        self::$currentLoggedInUser = null;
        $_SESSION['isLoggedIn'] = false;
        return true;
    }

    /**
     * This function returns the session name
     *
     * @return string The session name.
     */
    public function getSessionName(): string
    {
        return $this->_sessionName;
    }
}
