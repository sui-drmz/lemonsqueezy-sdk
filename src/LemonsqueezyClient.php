<?php

namespace Artbees\Lemonsqueezy;

use Artbees\Lemonsqueezy\Resource\CheckoutResource;
use Artbees\Lemonsqueezy\Resource\CustomerResource;
use Artbees\Lemonsqueezy\Resource\DiscountResource;
use Artbees\Lemonsqueezy\Resource\FileResource;
use Artbees\Lemonsqueezy\Resource\LicenseResource;
use Artbees\Lemonsqueezy\Resource\OrderResource;
use Artbees\Lemonsqueezy\Resource\PriceResource;
use Artbees\Lemonsqueezy\Resource\ProductResource;
use Artbees\Lemonsqueezy\Resource\StoreResource;
use Artbees\Lemonsqueezy\Resource\SubscriptionInvoiceResource;
use Artbees\Lemonsqueezy\Resource\SubscriptionItemResource;
use Artbees\Lemonsqueezy\Resource\SubscriptionResource;
use Artbees\Lemonsqueezy\Resource\UserResource;
use Artbees\Lemonsqueezy\Resource\UsageRecordResource;
use Artbees\Lemonsqueezy\Resource\VariantResource;
use Artbees\Lemonsqueezy\Resource\WebhookResource;

class LemonsqueezyClient
{
    protected Client $client;
    protected ?string $storeId = null;

    public function __construct(string $apiKey)
    {
        $this->client = new Client($apiKey);
    }

    /**
     * Set the store ID for all subsequent requests
     *
     * @param string $storeId
     * @return $this
     */
    public function forStore(string $storeId): self
    {
        $this->storeId = $storeId;
        $this->client->setStoreId($storeId);
        return $this;
    }

    /**
     * Get the underlying HTTP client
     *
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Get the users resource
     *
     * @return UserResource
     */
    public function users(): UserResource
    {
        return new UserResource($this->client);
    }

    /**
     * Get the stores resource
     *
     * @return StoreResource
     */
    public function stores(): StoreResource
    {
        return new StoreResource($this->client);
    }

    /**
     * Get the products resource
     *
     * @return ProductResource
     */
    public function products(): ProductResource
    {
        return new ProductResource($this->client);
    }

    /**
     * Get the variants resource
     *
     * @return VariantResource
     */
    public function variants(): VariantResource
    {
        return new VariantResource($this->client);
    }

    /**
     * Get the orders resource
     *
     * @return OrderResource
     */
    public function orders(): OrderResource
    {
        return new OrderResource($this->client);
    }

    /**
     * Get the subscriptions resource
     *
     * @return SubscriptionResource
     */
    public function subscriptions(): SubscriptionResource
    {
        return new SubscriptionResource($this->client);
    }

    /**
     * Get the customers resource
     *
     * @return CustomerResource
     */
    public function customers(): CustomerResource
    {
        return new CustomerResource($this->client);
    }

    /**
     * Get the discounts resource
     *
     * @return DiscountResource
     */
    public function discounts(): DiscountResource
    {
        return new DiscountResource($this->client);
    }

    /**
     * Get the files resource
     *
     * @return FileResource
     */
    public function files(): FileResource
    {
        return new FileResource($this->client);
    }

    /**
     * Get the licenses resource
     *
     * @return LicenseResource
     */
    public function licenses(): LicenseResource
    {
        return new LicenseResource($this->client);
    }

    /**
     * Get the checkouts resource
     *
     * @return CheckoutResource
     */
    public function checkouts(): CheckoutResource
    {
        return new CheckoutResource($this->client);
    }

    /**
     * Get the webhooks resource
     *
     * @return WebhookResource
     */
    public function webhooks(): WebhookResource
    {
        return new WebhookResource($this->client);
    }

    /**
     * Get the usage records resource
     *
     * @return UsageRecordResource
     */
    public function usageRecords(): UsageRecordResource
    {
        return new UsageRecordResource($this->client);
    }

    /**
     * Get the subscription invoices resource
     *
     * @return SubscriptionInvoiceResource
     */
    public function subscriptionInvoices(): SubscriptionInvoiceResource
    {
        return new SubscriptionInvoiceResource($this->client);
    }

    /**
     * Get the subscription items resource
     *
     * @return SubscriptionItemResource
     */
    public function subscriptionItems(): SubscriptionItemResource
    {
        return new SubscriptionItemResource($this->client);
    }

    /**
     * Get the prices resource
     *
     * @return PriceResource
     */
    public function prices(): PriceResource
    {
        return new PriceResource($this->client);
    }

    /**
     * Get a store by ID
     *
     * @param string $id
     * @return \Artbees\Lemonsqueezy\Entity\Store
     */
    public function getStore(string $id): \Artbees\Lemonsqueezy\Entity\Store
    {
        return $this->stores()->find($id);
    }

    /**
     * Get a product by ID
     *
     * @param string $id
     * @return \Artbees\Lemonsqueezy\Entity\Product
     */
    public function getProduct(string $id): \Artbees\Lemonsqueezy\Entity\Product
    {
        return $this->products()->find($id);
    }

    /**
     * Get an order by ID
     *
     * @param string $id
     * @return \Artbees\Lemonsqueezy\Entity\Order
     */
    public function getOrder(string $id): \Artbees\Lemonsqueezy\Entity\Order
    {
        return $this->orders()->find($id);
    }

    /**
     * Get a subscription by ID
     *
     * @param string $id
     * @return \Artbees\Lemonsqueezy\Entity\Subscription
     */
    public function getSubscription(string $id): \Artbees\Lemonsqueezy\Entity\Subscription
    {
        return $this->subscriptions()->find($id);
    }

    /**
     * Get a customer by ID
     *
     * @param string $id
     * @return \Artbees\Lemonsqueezy\Entity\Customer
     */
    public function getCustomer(string $id): \Artbees\Lemonsqueezy\Entity\Customer
    {
        return $this->customers()->find($id);
    }

    /**
     * Get a variant by ID
     *
     * @param string $id
     * @return \Artbees\Lemonsqueezy\Entity\Variant
     */
    public function getVariant(string $id): \Artbees\Lemonsqueezy\Entity\Variant
    {
        return $this->variants()->find($id);
    }

    /**
     * Get a license by ID
     *
     * @param string $id
     * @return \Artbees\Lemonsqueezy\Entity\License
     */
    public function getLicense(string $id): \Artbees\Lemonsqueezy\Entity\License
    {
        return $this->licenses()->find($id);
    }

    /**
     * Get a checkout by ID
     *
     * @param string $id
     * @return \Artbees\Lemonsqueezy\Entity\Checkout
     */
    public function getCheckout(string $id): \Artbees\Lemonsqueezy\Entity\Checkout
    {
        return $this->checkouts()->find($id);
    }

    /**
     * Get a webhook by ID
     *
     * @param string $id
     * @return \Artbees\Lemonsqueezy\Entity\Webhook
     */
    public function getWebhook(string $id): \Artbees\Lemonsqueezy\Entity\Webhook
    {
        return $this->webhooks()->find($id);
    }

    /**
     * Get a subscription invoice by ID
     *
     * @param string $id
     * @return \Artbees\Lemonsqueezy\Entity\SubscriptionInvoice
     */
    public function getSubscriptionInvoice(string $id): \Artbees\Lemonsqueezy\Entity\SubscriptionInvoice
    {
        return $this->subscriptionInvoices()->find($id);
    }

    /**
     * Get a subscription item by ID
     *
     * @param string $id
     * @return \Artbees\Lemonsqueezy\Entity\SubscriptionItem
     */
    public function getSubscriptionItem(string $id): \Artbees\Lemonsqueezy\Entity\SubscriptionItem
    {
        return $this->subscriptionItems()->find($id);
    }

    /**
     * Get a price by ID
     *
     * @param string $id
     * @return \Artbees\Lemonsqueezy\Entity\Price
     */
    public function getPrice(string $id): \Artbees\Lemonsqueezy\Entity\Price
    {
        return $this->prices()->find($id);
    }
} 