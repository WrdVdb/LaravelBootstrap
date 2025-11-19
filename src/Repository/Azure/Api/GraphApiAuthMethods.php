<?php


namespace App\Repository\Azure\Api;


use Beta\Microsoft\Graph\Model\AuthenticationMethod;

class GraphApiAuthMethods extends AbstractGraphApi
{
    /**
     * @return AuthenticationMethod[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Microsoft\Graph\Exception\GraphException
     */
    public function getList(string $upn): array
    {
        return $this->getGraph()->setApiVersion('beta')
            ->createRequest('GET', sprintf('/users/%s/authentication/methods', $upn))
            ->setReturnType(AuthenticationMethod::class)
            ->execute();
    }

    public function deleteFido2(string $userPrincipalName, string $id)
    {
        $this->delete($userPrincipalName, $id, 'fido2Methods', 'beta');

    }

    public function deleteMicrosoftAuthenticator(string $userPrincipalName, string $id)
    {
        $this->delete($userPrincipalName, $id, 'microsoftAuthenticatorMethods', 'beta');
    }
    public function deletePasswordlessMicrosoftAuthenticator(string $userPrincipalName, string $id)
    {
        $this->delete($userPrincipalName, $id, 'passwordlessMicrosoftAuthenticatorMethods', 'beta');
    }


    public function deletePhone(string $userPrincipalName, string $id)
    {
        $this->delete($userPrincipalName, $id, 'phoneMethods', 'beta');
    }

    public function deleteOAuthToken(string $userPrincipalName, string $id)
    {
        $this->delete($userPrincipalName, $id, 'softwareOathMethods', 'beta');
    }

    public function deleteWindowsHello(string $userPrincipalName, string $id)
    {
        $this->delete($userPrincipalName, $id, 'windowsHelloForBusinessMethods', 'beta');
    }

    public function deleteTemporaryAccessPass(string $userPrincipalName, string $id)
    {
        $this->delete($userPrincipalName, $id, 'temporaryAccessPassMethods', 'beta');
    }

    public function delete(string $userPrincipalName, string $id, string $authMethod, string $version)
    {
        $deleteUri = sprintf('/users/%s/authentication/%s/%s', $userPrincipalName, $authMethod, $id);
        $this->getGraph()
            ->setApiVersion($version)
            ->createRequest('DELETE', $deleteUri)
            ->execute();

    }


}
