<?php
/**
 * Created by PhpStorm.
 * User: bennet
 * Date: 12.10.18
 * Time: 22:51
 */

namespace Objects;

class User {

    private $id;
    private $name;
    private $email;
    private $domains = array();

    /**
     * User constructor.
     * @param int $id
     * @param string $name
     * @param string $email
     */
    public function __construct(int $id, string $name, string $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return int the id of the user
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param void $id new id
     */
    public function setId($id): void {
        $this->id = $id;
    }

    /**
     * @return string name of the user
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param void $name new name
     */
    public function setName($name): void {
        $this->name = $name;
    }

    /**
     * @return string Email of the user
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param void $email new email
     */
    public function setEmail($email): void {
        $this->email = $email;
    }

    /**
     * @return array of Domains the User owns
     */
    public function getDomains(): array {
        return $this->domains;
    }

    /**
     * @param void $domains
     */
    public function setDomains($domains): void {
        $this->domains = $domains;
    }

    /**
     * save the current object to the session
     */
    public function __destruct() {
        $_SESSION['b_user'] = serialize($this);
    }
}