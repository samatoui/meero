<?php

namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

use App\Entity\Order;


/**
 * Class FetchOrdersCommand
 * @package App\Command
 */
class FetchOrdersCommand extends ContainerAwareCommand
{
    /**
     * @brief configure options
     */
    protected function configure()
    {
        $this->setName('orders:FetchOrders')
             ->setDescription('Fetch orders and save them in database')
             ->addArgument('feed', InputArgument::REQUIRED, 'xml orders feed');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em      = $this->getContainer()->get('doctrine')->getManager();
        $logger  = $this->getContainer()->get('logger');
        $crawler = new Crawler();

        $crawler->addXmlContent(file_get_contents($input->getArgument('feed')));

        $items = $crawler->filterXPath('//statistics/orders/order');

        $logger->info('Start save orders');

        foreach ($items as $index => $item) {
            $order = new Order();

            $order->setMarketPlace(
                $item->getElementsByTagName('marketplace')->item(0)->nodeValue
            )->setFluxId(
                $item->getElementsByTagName('idFlux')->item(0)->nodeValue
            )->setOrderId(
                $item->getElementsByTagName('order_id')->item(0)->nodeValue
            )->setMrId(
                $item->getElementsByTagName('order_mrid')->item(0)->nodeValue
            )->setRefId(
                $item->getElementsByTagName('order_refid')->item(0)->nodeValue
            );

            $em->persist($order);

            if (0 === $index % 50) {
                $em->flush();
                $em->clear();
            }
        }

        $em->flush();
        $em->clear();

        $logger->info('Save orders is finished');
    }
}