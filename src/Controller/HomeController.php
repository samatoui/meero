<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Order;


class HomeController extends Controller
{
    /**
     * @Route(
     *     name="order_home",
     *     methods={"GET"},
     * )
     * @Template("home.html.twig")
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $pagination = $this->get('knp_paginator')->paginate(
            $this->get('doctrine')->getManager()
                 ->getRepository(Order::class)->findAll(),
            $request->query->getInt('page', 1),
            20
        );

        return compact('pagination');
    }

    /**
     * @Route(
     *     "detail/{id}",
     *     name="order_detail",
     *     requirements={"id": "\d+"},
     *     methods={"GET"},
     * )
     * @Template("detail.html.twig")
     * @param int $id
     * @return array
     */
    public function detail(int $id)
    {
        $order = $this->get('doctrine')->getManager()
                       ->find(Order::class, $id);

        if (!$order) {
            throw $this->createNotFoundException('No order found for id '. $id);
        }

        return compact('order');
    }

    /**
     * @Route(
     *     "search",
     *     name="order_search",
     *     methods={"POST"},
     * )
     * @Template("partials/_result_search.html.twig")
     * @param Request $request
     * @return array
     */
    public function search(Request $request)
    {
        $pagination = $this->get('knp_paginator')->paginate(
            $this->get('doctrine')->getManager()
                 ->getRepository(Order::class)
                 ->getOrdersByCriteria($request->request->get('search')),
            $request->query->getInt('page', 1),
            20
        );

        return compact('pagination');
    }
}
