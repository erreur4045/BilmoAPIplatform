<?php


namespace App\Datapersister;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserPersister implements DataPersisterInterface
{

    protected TokenStorageInterface $token;
    protected EntityManagerInterface $manager;

    /**
     * UserPersister constructor.
     * @param TokenStorageInterface $token
     * @param EntityManagerInterface $manager
     */
    public function __construct(TokenStorageInterface $token, EntityManagerInterface $manager)
    {
        $this->token = $token;
        $this->manager = $manager;
    }


    /**
     * @param $data
     * @return bool
     */
    public function supports($data): bool
    {
        // TODO: Implement supports() method.
        return $data instanceof User;
    }

    /**
     * @param $data
     * @return object|void
     */
    public function persist($data)
    {
        /** @var User $data */
        $data->setDistibutor($this->token->getToken()->getUser());

        $this->manager->persist($data);
        $this->manager->flush();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function remove($data)
    {
        // TODO: Implement remove() method.
    }
}