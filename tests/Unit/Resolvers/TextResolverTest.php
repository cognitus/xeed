<?php

namespace Cable8mm\Xeed\Tests\Unit\Resolvers;

use Cable8mm\Xeed\Column;
use Cable8mm\Xeed\DB;
use Cable8mm\Xeed\Resolvers\TextResolver;
use Cable8mm\Xeed\Support\Picker;
use PHPUnit\Framework\TestCase;

final class TextResolverTest extends TestCase
{
    public Column $column;

    protected function setUp(): void
    {
        $db = DB::getInstance();

        $this->column = Picker::of($db->attach()
            ->getTable('xeeds')
            ->getColumns()
        )->driver($db->driver)->field('text')->get();
    }

    public function test_column_can_not_null(): void
    {
        $this->assertNotNull($this->column);
    }

    public function test_resolver_can_be_created(): void
    {
        $resolver = new TextResolver($this->column);

        $this->assertNotNull($resolver);
    }

    public function test_fake_method_can_working_well(): void
    {
        $resolver = new TextResolver($this->column);

        $this->assertEquals('\'text\' => fake()->paragraph(),', $resolver->fake());

        $this->assertTrue(true);
    }

    public function test_migration_method_can_working_well(): void
    {
        $resolver = new TextResolver($this->column);

        $this->assertEquals('$table->text(\'text\')->nullable();', $resolver->migration());

        $this->assertTrue(true);
    }
}