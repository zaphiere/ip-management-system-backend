<?php

namespace App\Services\AuditLog;

use App\Enums\{
    Action,
    EntityType,
};
use App\Interfaces\{
    AuditLogInterface,
    UserInterface,
    IpRecordInterface,
};

class OptionAuditLogService
{
    /**
     * AuditLogInterface instance
     *
     * @var \App\Interfaces\AuditLogInterface $auditLogInterface
     */
    protected AuditLogInterface $auditLogInterface;

    /**
     * UserInterface instance
     *
     * @var \App\Interfaces\UserInterface $userInterface
     */
    protected UserInterface $userInterface;

    /**
     * IpRecordInterface instance
     *
     * @var \App\Interfaces\IpRecordInterface $ipRecordInterface
     */
    protected IpRecordInterface $ipRecordInterface;

    /**
     * Initializing interfaces
     */
    public function __construct(
        AuditLogInterface $auditLogInterface,
        UserInterface $userInterface,
        IpRecordInterface $ipRecordInterface,
    ) {
        $this->auditLogInterface = $auditLogInterface;
        $this->userInterface = $userInterface;
        $this->ipRecordInterface = $ipRecordInterface;
    }

    /**
     * Return list of IP Addresses
     *
     * @param string $search
     *
     * @return mixed
     */
    public function getIp(string $search)
    {
        return $this->ipRecordInterface->getIp($search);
    }

    /**
     * Return list of Emails
     *
     * @param string $search
     *
     * @return mixed
     */
    public function getEmail(string $search)
    {
        return $this->userInterface->getEmail($search);
    }

    /**
     * Return list of Session IDs
     *
     * @param string $search
     *
     * @return mixed
     */
    public function getSessionId(string $search)
    {
        return $this->auditLogInterface->getSessionId($search);
    }

    /**
     * Return list of Actions
     *
     * @return \Illuminate\Support\Collection<string|int, mixed>
     */
    public function getAction()
    {
        return collect(Action::cases())->pluck('value');
    }

    /**
     * Return list of Entity Types
     *
     * @return \Illuminate\Support\Collection<string|int, mixed>
     */
    public function getEntityType()
    {
        return collect(EntityType::cases())->pluck('value');
    }
}
