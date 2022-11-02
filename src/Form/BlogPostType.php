<?php

namespace App\Form;

use App\Entity\BlogCategories;
use App\Entity\BlogPost;
use App\Entity\Tags;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Title')
            ->add('Description')
            ->add('Content', TextareaType::class, array(
                'label'=> false
            ))
            ->add('BlogCategory', EntityType::class,[
                'class'=> BlogCategories::class,
                'choice_label' => 'CategoryName',
                'multiple' => 'true'
            ])
            ->add('BlogTags',EntityType::class,[
                'class' =>Tags::class,
                'choice_label' =>'Title',
                'multiple' => 'true'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BlogPost::class,
        ]);
    }
}