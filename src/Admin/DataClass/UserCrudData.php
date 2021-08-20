<?php

namespace App\Admin\DataClass;

use App\Admin\DataClass\AutomaticCrudData;
use App\Admin\Form\UserForm;
use App\Entity\Attachment;
use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

/** @var User $entity */
class UserCrudData extends AutomaticCrudData
{
    /**
     * @Assert\NotBlank()
     * 
     * @var string
     */
    public string $username = '';

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * 
     * @var string
     */
    public string $email = '';
    
    /**
     * @Assert\NotBlank()
     */
    public string $password = '';

    public ?bool $newsletter = true;

    public ?Attachment $image = null;

    public function getFormClass(): string
    {
        return UserForm::class;
    }
}