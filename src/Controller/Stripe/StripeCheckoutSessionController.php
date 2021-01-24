<?php

namespace App\Controller\Stripe;

use Stripe\Stripe;
use App\Entity\Cart;
use Stripe\Checkout\Session;
use App\Services\CartServices;
use App\Services\OrderServices;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeCheckoutSessionController extends AbstractController
{
    /**
     * @Route("/create-checkout-session/{reference}", name="create_checkout_session")
     */
    public function index(?Cart $cart, OrderServices $orderServices): Response
    {
        $user = $this->getUser();
        if(!$cart){
          return $this->redirectToRoute('home');
        }

        $orderServices->createOrder($cart);
        Stripe::setApiKey('sk_test_51ICmCqGJ92ssJiXR4l1iFoCWAOfcaDdafvg6DVxbzYZFub1W6OrcS26OYw5SZo2GMOaRi5oZxNFyH4KoFynYDMie00lI9dv2C3');
  
        $checkout_session = Session::create([
            'customer_email' => $user->getEmail(),
            'payment_method_types' => ['card'],
            'line_items' => $orderServices->getLineItems($cart),
            'mode' => 'payment',
            'success_url' => $_ENV['YOUR_DOMAIN'] . '/stripe-payment-success',
            'cancel_url' => $_ENV['YOUR_DOMAIN'] . '/stripe-payment-cancel',
          ]);
        
        
          

        return $this->json(['id' => $checkout_session->id]);
    }
}
