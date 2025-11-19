<?php


namespace App\Repository\Azure\Api;


use App\Entity\Azure\UGentUser;
use App\Exception\AzureADUserNotFound;
use App\Exception\AzureTenantException;
use Microsoft\Graph\Model\User;

class GraphApiProfile extends AbstractGraphApi
{

    public function findUserByEmail($email): ?User
    {
        $users = $this->findUsersByEmail($email);
        return $this->getUserMatch($users, $email);
    }

    public function findUsersByEmail(string $email): array
    {

        return $this->getGraph()
            ->createRequest("GET",
                sprintf('/users?$filter=%s&$select=id,userPrincipalName,mail',
                    urlencode(
                        sprintf(
                            "mail eq '%s'",
                            addslashes($email)
                        )
                    )
                )
            )
            ->setReturnType(User::class)
            ->execute();
    }


    public function getUserMatch($users, $email): User
    {
        $hits = count($users);
        return match ($hits) {
            1 => $users[0],
            0 => throw AzureTenantException::forNoEmailMatches($email),
            default => throw AzureTenantException::forMultipleEmailMatches($email),
        };
    }


}
