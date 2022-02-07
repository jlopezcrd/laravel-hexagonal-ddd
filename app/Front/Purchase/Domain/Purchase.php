<?php
declare(strict_types = 1);

namespace Developez\Front\Purchase\Domain;

use Developez\Front\Cart\Domain\Cart;
use Developez\Shared\Domain\OrderId;
use Developez\Shared\Domain\Serializable;

class Purchase implements Serializable
{
    private $orderId;
    private $cart;

    public function __construct(OrderId $orderId, Cart $cart)
    {
        $this->orderId = $orderId;
        $this->cart    = $cart;
    }

    public function orderId(): OrderId
    {
        return $this->orderId;
    }

    public function toJson(): string
    {
        // TODO: Implement toJson() method.
    }

    public function toArray(): array
    {
        return [
            'orderId' => $this->orderId->value(),
            'cart'    => json_encode($this->cart->toArray(), JSON_THROW_ON_ERROR)
        ];
    }

    public static function fromCart(Cart $cart): Purchase
    {
        return new self($cart->orderId(), $cart);
    }

    public static function fromJson(string $serialized): Purchase
    {
        // TODO: Implement fromJson() method.
    }

    public static function fromArray(array $data): Purchase
    {
        $cart = Cart::fromJson($data['cart']);
        return new self($cart->orderId(), $cart);
    }
}
