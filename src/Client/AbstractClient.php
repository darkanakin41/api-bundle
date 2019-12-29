<?php

namespace Darkanakin41\ApiBundle\Client;

abstract class AbstractClient
{
    /**
     * @var string
     */
    private $application_name;
    /**
     * @var string
     */
    private $application_key;
    /**
     * @var string
     */
    private $application_credentials_path;

    /**
     * @var String[]
     */
    private $scope;

    public function __construct()
    {
        $this->setScope([]);
    }


    /**
     * @return string
     */
    public function getApplicationName()
    {
        return $this->application_name;
    }

    /**
     * @param $application_name
     * @return AbstractClient
     */
    public function setApplicationName($application_name)
    {
        $this->application_name = $application_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getApplicationKey()
    {
        return $this->application_key;
    }

    /**
     * @param $application_key
     * @return AbstractClient
     */
    public function setApplicationKey($application_key)
    {
        $this->application_key = $application_key;

        return $this;
    }

    /**
     * @return string
     */
    public function getApplicationCredentialsPath()
    {
        return $this->application_credentials_path;
    }

    /**
     * @param $application_credentials_path
     * @return AbstractClient
     */
    public function setApplicationCredentialsPath($application_credentials_path)
    {
        $this->application_credentials_path = $application_credentials_path;

        return $this;
    }

    /**
     * @return String[]
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param String[] $scope
     * @return AbstractClient
     */
    public function setScope(array $scope)
    {
        $this->scope = $scope;

        return $this;
    }


    public function addScope($scope_or_scopes)
    {
        if (is_string($scope_or_scopes) && !in_array($scope_or_scopes, $this->scope)) {
            $this->scope[] = $scope_or_scopes;
        } elseif (is_array($scope_or_scopes)) {
            foreach ($scope_or_scopes as $scope) {
                $this->addScope($scope);
            }
        }
    }

    public abstract function execute($url, $parameters = array());
}
