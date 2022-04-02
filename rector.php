<?php

declare(strict_types=1);

use App\Infra\Symfony\Persistence\Doctrine\Annotation\Filterable;
use Doctrine\ORM\Mapping as ORM;
use Rector\CodingStyle\Rector\ClassMethod\OrderAttributesRector;
use Rector\Core\Configuration\Option;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\Nette\Set\NetteSetList;
use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Rector\Symfony\Set\SensiolabsSetList;
use Rector\Symfony\Set\SymfonySetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\Validator\Constraints as Assert;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src'
    ]);

    // Define what rule sets will be applied
    //$containerConfigurator->import(LevelSetList::UP_TO_PHP_81);

    $containerConfigurator->import(DoctrineSetList::ANNOTATIONS_TO_ATTRIBUTES);
    $containerConfigurator->import(SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES);
    $containerConfigurator->import(NetteSetList::ANNOTATIONS_TO_ATTRIBUTES);
    $containerConfigurator->import(SensiolabsSetList::FRAMEWORK_EXTRA_61);
    //$containerConfigurator->import(SetList::CODING_STYLE);

    // get services (needed for register a single rule)
    $services = $containerConfigurator->services();

    /*
    $services->set(OrderAttributesRector::class)
        ->configure([
            Assert\Bic::class,
            Assert\NotBlank::class,
            Assert\NotNull::class,
            Assert\Type::class,
            Assert\Url::class,
            Assert\Valid::class,
            Filterable::class,
            JMS\Groups::class,
            JMS\VirtualProperty::class,
            JMS\SerializedName::class,
            ORM\Column::class,
            ORM\JoinColumn::class,
            ORM\InverseJoinColumn::class,
        ]);
    */
    /*
    $services->set(AttributeKeyToClassConstFetchRector::class)
        ->configure([
            new AttributeKeyToClassConstFetch('Doctrine\ORM\Mapping\Column', 'type', 'Doctrine\DBAL\Types\Types', [
                'array' => 'ARRAY',
                'ascii_string' => 'ASCII_STRING',
                'bigint' => 'BIGINT',
                'binary' => 'BINARY',
                'blob' => 'BLOB',
                'boolean' => 'BOOLEAN',
                'date' => 'DATE_MUTABLE',
                'date_immutable' => 'DATE_IMMUTABLE',
                'dateinterval' => 'DATEINTERVAL',
                'datetime' => 'DATETIME_MUTABLE',
                'datetime_immutable' => 'DATETIME_IMMUTABLE',
                'datetimetz' => 'DATETIMETZ_MUTABLE',
                'datetimetz_immutable' => 'DATETIMETZ_IMMUTABLE',
                'decimal' => 'DECIMAL',
                'float' => 'FLOAT',
                'guid' => 'GUID',
                'integer' => 'INTEGER',
                'json' => 'JSON',
                'object' => 'OBJECT',
                'simple_array' => 'SIMPLE_ARRAY',
                'smallint' => 'SMALLINT',
                'string' => 'STRING',
                'text' => 'TEXT',
                'time' => 'TIME_MUTABLE',
                'time_immutable' => 'TIME_IMMUTABLE',
            ]),
        ]);
    */

    //$services->set(\Rector\PostRector\Rector\NameImportingPostRector::class);
    $services->set(\Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector::class);
};
