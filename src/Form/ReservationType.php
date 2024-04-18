<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Title', TextType::class,["label" => 'Titre'])
            ->add('Slots', IntegerType::class,["label" => 'Nombre de place libre'])
            ->add('adress', TextType::class,["label" => 'L\'adresse'])
            ->add('Zipcode', TextType::class,["label" => 'Code postal'])
            ->add('City', TextType::class,["label" => 'Ville'])
            ->add('Description', TextareaType::class,["label" => 'Description'])
            ->add('Ingredient', TextareaType::class,["label" => 'Les Ingredients'])
            ->add('imageFile', VichImageType::class,['label' => 'Image du bon plan','label_attr' => ['class' => 'form-label mt-4']])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
