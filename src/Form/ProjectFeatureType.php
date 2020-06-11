<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Feature;
use App\Entity\Project;
use App\Entity\ProjectFeature;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectFeatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('feature', EntityType::class, ['class'=> Feature::class, 'choice_label'=>'name'])
            ->add('description')
            ->add('day')
            ->add('category', EntityType::class, ['class'=> Category::class, 'choice_label'=>'name'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProjectFeature::class,
        ]);
    }
}