<?php

namespace App\Factory;

use App\Entity\StateOrder;
use App\Repository\StateOrderRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<StateOrder>
 *
 * @method        StateOrder|Proxy create(array|callable $attributes = [])
 * @method static StateOrder|Proxy createOne(array $attributes = [])
 * @method static StateOrder|Proxy find(object|array|mixed $criteria)
 * @method static StateOrder|Proxy findOrCreate(array $attributes)
 * @method static StateOrder|Proxy first(string $sortedField = 'id')
 * @method static StateOrder|Proxy last(string $sortedField = 'id')
 * @method static StateOrder|Proxy random(array $attributes = [])
 * @method static StateOrder|Proxy randomOrCreate(array $attributes = [])
 * @method static StateOrderRepository|RepositoryProxy repository()
 * @method static StateOrder[]|Proxy[] all()
 * @method static StateOrder[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static StateOrder[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static StateOrder[]|Proxy[] findBy(array $attributes)
 * @method static StateOrder[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static StateOrder[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class StateOrderFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(StateOrder $stateOrder): void {})
        ;
    }

    protected static function getClass(): string
    {
        return StateOrder::class;
    }
}
