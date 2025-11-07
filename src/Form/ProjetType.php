<?php

namespace App\Form;

use App\Entity\Projet;
use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du projet'
            ])
            ->add('budget', NumberType::class, [
                'label' => 'Budget'
            ])
            ->add('seuilAlerte', NumberType::class, [
                'label' => 'Seuil d\'alerte'
            ])
            ->add('plan', TextType::class, [
                'label' => 'Plan'
            ])
            ->add('listeDiffusion', TextType::class, [
                'label' => 'Liste de diffusion'
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'nom', 
                'label' => 'Client associé',
                'placeholder' => 'Sélectionnez un client',
                'required' => true
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn btn-primary']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
