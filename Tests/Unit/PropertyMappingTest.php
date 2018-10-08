<?php

namespace Codappix\Tests\Unit;

/*
 * Copyright (C) 2018 Daniel Siepmann <coding@daniel-siepmann.de>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301, USA.
 */

use PHPUnit\Framework\TestCase;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Property\PropertyMapper;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationInterface;
use TYPO3\CMS\Extbase\Property\TypeConverter;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

class PropertyMappingTest extends TestCase
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    public function setUp()
    {
        GeneralUtility::makeInstance(
            \TYPO3\CMS\Core\Cache\CacheManager::class
        )->setCacheConfigurations([
            'extbase_object' => [
                'backend' => \TYPO3\CMS\Core\Cache\Backend\NullBackend::class,
            ],
            'cache_runtime' => [
                'backend' => \TYPO3\CMS\Core\Cache\Backend\NullBackend::class,
            ],
        ]);

        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
    }

    /**
     * @test
     */
    public function mapStringToInt()
    {
        ExtensionUtility::registerTypeConverter(TypeConverter\IntegerConverter::class);
        $mapper = $this->objectManager->get(PropertyMapper::class);

        $stringInput = '10';

        $output = $mapper->convert($stringInput, 'integer');

        $this->assertSame(10, $output);
    }

    /**
     * @test
     */
    public function mapStringToDateTime()
    {
        ExtensionUtility::registerTypeConverter(TypeConverter\DateTimeConverter::class);
        $mapper = $this->objectManager->get(PropertyMapper::class);

        $stringInput = '16.09.2018';
        $propertyMappingConfiguration = $this->objectManager->get(PropertyMappingConfigurationInterface::class);
        $propertyMappingConfiguration->setTypeConverterOptions(
            TypeConverter\DateTimeConverter::class,
            [
                TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT => 'd.m.Y'
            ]
        );

        $output = $mapper->convert($stringInput, 'DateTime', $propertyMappingConfiguration);

        $this->assertInstanceOf(\DateTime::class, $output);
        $this->assertSame('16', $output->format('d'));
    }
}
