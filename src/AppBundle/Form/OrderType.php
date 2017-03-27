<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date')->add('payerName')->add('payerSurname')->add('payerGender')->add('payerDni')->add('payerPhone')->add('payerEmail')->add('payerStreet')->add('payerStreetNumber')->add('payerFloor')->add('payerDepartment')->add('payerPostalCode')->add('payerLocality')->add('payerCity')->add('payerAdditionalInfo')->add('paymentMethod')->add('shipmentMethod')->add('units')->add('amount')->add('isPayed')->add('isFinished')->add('noteId')->add('isBuspack')->add('isTrash')->add('attendedBy')->add('payerProvince')->add('shipmentPoint');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Order',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getBlockPrefix()."')")
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_order';
    }


}
