<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Cli;

use Sylius\Component\Core\Repository\OrderRepositoryInterface;
use Sylius\InvoicingPlugin\Creator\MassInvoicesCreatorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class GenerateInvoicesCommand extends Command
{
    /** @var string */
    protected static $defaultName = 'sylius-invoicing:generate-invoices';

    /** @var MassInvoicesCreatorInterface */
    private $massInvoicesCreator;

    /** @var OrderRepositoryInterface */
    private $orderRepository;

    public function __construct(
        MassInvoicesCreatorInterface $massInvoicesCreator,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->massInvoicesCreator = $massInvoicesCreator;
        $this->orderRepository = $orderRepository;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Generates invoices for orders placed before InvoicingPlugin installation');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var array $orders */
        $orders = $this->orderRepository
            ->createListQueryBuilder()
            ->andWhere('o.number IS NOT NULL')
            ->getQuery()
            ->getResult();

        $this->massInvoicesCreator->__invoke($orders);

        $output->writeln('Invoices generated successfully');

        return 0;
    }
}
