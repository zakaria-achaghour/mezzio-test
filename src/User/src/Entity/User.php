<?php
declare(strict_types=1);

namespace User\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User 
{

  /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     * @var integer
     */
    protected $id;
   /**
     * @ORM\Column(name="name", type="string", length=255)
     * @var string
     */
    protected $name;
   /**
     * @ORM\Column(name="email", type="string", length=255)
     * @var string
     */
    protected $email;

  /**
     * @ORM\Column(name="password", type="string", length=255)
     * @var string
     */
    protected $password;

    public function getId (): int{
        return $this->id;
    }

    public function getName (): string{
        return $this->name;
    }

    public function setName(string $name): void 
    {
        $this->name = $name;
    }

    public function getEmail (): string{
        return $this->email;
    }

    public function setEmail(string $email): void 
    {
        $this->email = $email;
    }
    public function getPassword (): string{
        return $this->password;
    }

    public function setPassword(string $password): void 
    {
        $this->password = $password;
    }

    public function setUser(array $reuestBody) :void {
        $this->setName($reuestBody['name']);
        $this->setEmail($reuestBody['email']);
        $this->setPassword($reuestBody['password']);
       
    }
}