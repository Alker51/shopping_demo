<?php

namespace App\Factory;

use App\Entity\CreditCard;
use App\Repository\CreditCardRepository;
use Faker\Factory;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<CreditCard>
 *
 * @method        CreditCard|Proxy create(array|callable $attributes = [])
 * @method static CreditCard|Proxy createOne(array $attributes = [])
 * @method static CreditCard|Proxy find(object|array|mixed $criteria)
 * @method static CreditCard|Proxy findOrCreate(array $attributes)
 * @method static CreditCard|Proxy first(string $sortedField = 'id')
 * @method static CreditCard|Proxy last(string $sortedField = 'id')
 * @method static CreditCard|Proxy random(array $attributes = [])
 * @method static CreditCard|Proxy randomOrCreate(array $attributes = [])
 * @method static CreditCardRepository|RepositoryProxy repository()
 * @method static CreditCard[]|Proxy[] all()
 * @method static CreditCard[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static CreditCard[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static CreditCard[]|Proxy[] findBy(array $attributes)
 * @method static CreditCard[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CreditCard[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CreditCardFactory extends ModelFactory
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
     */
    protected function getDefaults(): array
    {
        $faker = Factory::create('fr_FR');

        $name = $faker->name();
        $cvv = $faker->numberBetween(100, 999);
        $date = $faker->creditCardExpirationDate();
        $number = (string) $faker->numberBetween(1000000000000000, 9999999999999999);
        $valid = $faker->boolean();

        return [
            'CardVerificationValue' => $cvv,
            'ExpirationDate' => $date,
            'cardHolderName' => $name,
            'cardNumber' => $number,
            'valid' => $valid
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(CreditCard $creditCard): void {})
        ;
    }

    protected static function getClass(): string
    {
        return CreditCard::class;
    }
}
