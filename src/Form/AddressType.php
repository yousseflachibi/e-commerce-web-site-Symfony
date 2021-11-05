<?php

namespace App\Form;

use App\Entity\Address;
use Doctrine\DBAL\Types\TelType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TelType as TypeTelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName',TextType::class,['label'=> "Nom Complet"])
            #->add('campany')
            ->add('address',TextType::class,['label'=> 'Adresse'])
            ->add('complement')
            ->add("phone",TextType::class,['label'=> 'N° de téléphone'])
            ->add('city',TextType::class,['label'=> 'Ville'])
            ->add('codePostal',TextType::class,['label'=> 'Code postale'])
            ->add('country', CountryType::class,['label'=> 'Pays'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
