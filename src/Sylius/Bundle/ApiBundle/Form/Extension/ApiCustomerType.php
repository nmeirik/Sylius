<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ApiBundle\Form\Extension;

use Sylius\Bundle\ApiBundle\Form\EventSubscriber\AddUserFormSubscriber;
use Sylius\Bundle\CoreBundle\Form\Type\User\ShopUserType;
use Sylius\Bundle\CustomerBundle\Form\Type\CustomerGroupChoiceType;
use Sylius\Bundle\CustomerBundle\Form\Type\CustomerProfileType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Valid;

/**
 * @author Anna Walasek <anna.walasek@lakion.com>
 */
final class ApiCustomerType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('group', CustomerGroupChoiceType::class, [
                'required' => false,
            ])
        ;

        $builder->addEventSubscriber(new AddUserFormSubscriber(ShopUserType::class));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return CustomerProfileType::class;
    }
}