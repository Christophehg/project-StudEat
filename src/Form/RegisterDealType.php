<?php

namespace App\Form;

use App\Entity\Topdeal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RegisterDealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brandName', TextType::class,['label' => 'La marque du produit'])
            ->add('productName', TextType::class,['label' => 'Le nom du produit'])
            ->add('description', TextareaType::class,['label' => 'La description du produit'])
            ->add('adress', TextType::class,['label' => 'L\'adresse'])
            ->add('zipCode', TextType::class,['label' => 'Code postal'])
            ->add('city', TextType::class,['label' => 'La ville'])
            ->add('storeName', TextType::class,['label' => 'Le nom du magasin'])
            ->add('price', TextType::class,['label' => 'Le prix du produit'])
            ->add('imageFile', VichImageType::class,['label' => 'Image du bon plan','label_attr' => ['class' => 'form-label mt-4']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Topdeal::class,
        ]);
    }
}
