<?php

namespace App\Form;

use App\Entity\Invoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('invoice_date', DateType::class, ['attr' => ['class' => 'w-50 d-flex justify-content-between']])
            ->add('customer_id', NumberType::class, ['attr' => ['class' => 'form-control']])
            ->add('invoicelines', CollectionType::class, [
                'entry_type' => InvoicelinesFormType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true
            ])
            ->add('save', SubmitType::class, ['attr' => ['class' => 'btn btn-success my-4'], 'label' => 'Create invoice'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
