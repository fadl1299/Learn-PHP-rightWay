<?php

$entityManager = EntityManager::create($params, 
setup::createAttributeMetodatoconfiguration([__DIR__ . '/app/Entity']));

$entityManager->wrapInTransaction(function() {

    
});

$quary = $entityManager->createQuery(
    'SELECT * FROM APP/Entity/Invoice WHERE i.amount > :amount 
    ORDER BY i.createdAt DESC'
);

$quary;


$queryBuilder = $entityManager->createQueryBuilder();

$quary = $queryBuilder 
    ->select('i.createdAt', 'i.amount')
    ->from(Invoice::class , 'i')
    ->join('i.items'. 'it')
    ->where(
        $queryBuilder->expr()->andX(
            $queryBuilder->expr()->gt('i.amount'. ':amount'),
            $queryBuilder->expr()->orx(
                $queryBuilder->expr()->eq('i.status'. ':status'),
                $queryBuilder->expr()->gte('i.createdAt'. ':data')
            )
        )
    )
    ->where('i.amount > .amount')
    ->andwhere('i.status = .status')
    ->setParameter('amount', 100)
    ->setParameter('status', \App\Enums\InvoiceStatus::Paid->value)
    ->orderBy('i.createdAt', 'desc')
    ->getQuery();

    $invoices = $quary->getResult();

    foreach($invoices as $invoice) {
        echo $invoice->getcreatedAt()->format('m/d/y g:ia') . '. ' . $invoice->getAmount() . 
        '. ' . $invoice->getStatus()->toString() . PHP_EOL;
    }