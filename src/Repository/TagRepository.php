<?php

namespace App\Repository;

use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tag>
 *
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

   /**
    * @return Tag[] Returns an array of Tag objects
    */
   public function findTagged($id): array
   {
    $sql = "SELECT t.* FROM tag t INNER JOIN ad_tag a ON t.id = a.tag_id WHERE a.ad_id != :id";
    $entityManager = $this->getEntityManager();
    $connection = $entityManager->getConnection();
    $request = $connection->prepare($sql);
    $result = $request->execute(['id' => $id]);
    return $result->fetchAll();
   }

   /**
    * @return Tag[] Returns an array of Tag objects
    */
   public function findNotTagged($id): array
   {
    $sql = "SELECT t.* FROM tag t INNER JOIN ad_tag a ON t.id = a.tag_id WHERE a.ad_id = :id";
    $entityManager = $this->getEntityManager();
    $connection = $entityManager->getConnection();
    $request = $connection->prepare($sql);
    $result = $request->execute(['id' => $id]);
    return $result->fetchAll();
   }
}
