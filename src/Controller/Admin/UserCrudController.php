<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;

/**
 * Class UserCrudController
 * @package App\Controller\Admin
 *
 * This class is responsible for managing the administration interface of User entities.
 */
class UserCrudController extends AbstractCrudController
{
    /**
     * Returns the fully-qualified class name of the entity that this CRUD controller is managing.
     *
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

     /**
     * Configures the fields that are displayed in the CRUD forms.
     *
     * @param string $pageName The name of the page being rendered ("new", "edit", "index", "detail").
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            ArrayField::new('roles'),
            TextField::new('password'),
            BooleanField::new('isVerified'),
        ];
    }
}
