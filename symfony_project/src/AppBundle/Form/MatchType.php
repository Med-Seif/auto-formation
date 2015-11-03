<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MatchType extends AbstractType {

    /**
     *
     * @var Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct($em) {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('date')
                ->add('buts')
                ->add('terrain', 'entity', ['class' => 'AppBundle:Terrain'])
                ->add('type', 'entity', ['class' => 'AppBundle:Type'])
                ->add('classe', 'choice', ['choices' => [1 => 1, 2 => 2, 3 => 3, 4 => 4]])
                ->add('res', 'choice', ['label' => 'Résultat', 'choices' => ['d' => "Défaite", 'v' => "Victoire", 'n' => "Nul"]])
                ->add('note')
                ->add('comment', null, ['label' => 'Commentaire'])
                ->add('saison', 'choice', array('choices' => $this->em->getRepository("AppBundle:Match")->getSeasons()))
                ->add('injury', null, ['label' => 'Blessure'])
                ->add('save', 'submit', array('label' => 'Enregistrer'));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Match'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'appbundle_match';
    }

}
