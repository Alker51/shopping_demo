<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function search(int|string $value = ''): array
    {
        $querybuilder = $this->createQueryBuilder('p');

        if(!empty($value)) {
            if(is_string($value)) {
                $querybuilder->andWhere($querybuilder->expr()->like('p.productName', ':val'));
            } elseif(is_int($value)) {
                $querybuilder->andWhere('p.id = :val');
            }

            $querybuilder->setParameter('val', "%$value%");
        }

        $querybuilder ->orderBy('p.id', 'ASC');
        $query = $querybuilder->getQuery();

        return $query->execute();
    }
}
