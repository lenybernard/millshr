<?php
/**
 * Created by PhpStorm.
 * User: lenybernard
 * Date: 09/03/2016
 * Time: 10:50
 */

namespace AppBundle\Constraint\Validator;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AvoidStressValidator extends ConstraintValidator

{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * AvoidStressValidator constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed      $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $tenSecondsAgo = new \DateTime('-10 seconds');
        $entries = $this->entityManager->getRepository('AppBundle:Link')
            ->createQueryBuilder('l')
            ->where('l.createdAt >= :tenSecondsAgo')
            ->setParameter('tenSecondsAgo', $tenSecondsAgo->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult();

        if (count($entries)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value->getName())
                ->addViolation();
        }
    }
}