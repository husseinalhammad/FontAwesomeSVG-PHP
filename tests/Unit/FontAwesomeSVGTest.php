<?php

namespace Husseinalhammad\FontawesomeSvg\Tests;

use Exception;
use FontAwesomeSVG;
use PHPUnit\Framework\TestCase;

final class FontAwesomeSVGTest extends TestCase
{
    static public function icons(): array
    {
        return [
            ['fab fa-500px'],
            ['fad fa-calculator'],
            ['fal fa-calculator'],
            ['far fa-calculator'],
            ['fas fa-calculator'],
        ];
    }

    private function createInstance(): FontAwesomeSVG
    {
        return new FontAwesomeSVG(__DIR__ . '/../Fixtures/FA5');
    }

    public function test_it_requires_an_existing_svg_dir(): void
    {
        $this->expectException(Exception::class);

        new FontAwesomeSVG('path/does/not/exist');
    }

    /**
     * @dataProvider icons
     */
    public function test_it_can_get_an_svg($icon): void
    {
        $fa = $this->createInstance();

        $svg = $fa->get_svg($icon);

        $this->assertStringContainsString('class="svg-inline--fa"', $svg);
        $this->assertStringContainsString('style="color:currentColor"', $svg);
        $this->assertStringContainsString('fill="currentColor"', $svg);
        $this->assertStringContainsString('role="img"', $svg);
        $this->assertStringContainsString('aria-hidden="true"', $svg);
    }

    /**
     * @dataProvider icons
     */
    public function test_it_can_add_a_custom_class($icon): void
    {
        $fa = $this->createInstance();

        $svg = $fa->get_svg($icon, ['class' => 'my-custom-class another-class']);

        $this->assertStringContainsString('class="svg-inline--fa my-custom-class another-class"', $svg);
    }

    /**
     * @dataProvider icons
     */
    public function test_it_can_remove_the_custom_class($icon): void
    {
        $fa = $this->createInstance();

        $svg = $fa->get_svg($icon, ['default_class' => false]);

        $this->assertStringNotContainsString('svg-inline--fa', $svg);
    }

    /**
     * @dataProvider icons
     */
    public function test_it_can_change_path_fill($icon): void
    {
        $fa = $this->createInstance();

        $svg = $fa->get_svg($icon, ['fill' => '#f44336']);

        $this->assertStringContainsString('fill="#f44336"', $svg);
    }

    /**
     * @dataProvider icons
     */
    public function test_it_can_add_title_tag($icon): void
    {
        $fa = $this->createInstance();

        $svg = $fa->get_svg($icon, ['title' => 'My accessible icon']);

        $this->assertStringContainsString('<title>My accessible icon</title>', $svg);
    }

    /**
     * @dataProvider icons
     */
    public function test_it_can_add_title_id_attribute($icon): void
    {
        $fa = $this->createInstance();

        $svg = $fa->get_svg($icon, [
            'title' => 'My accessible icon',
            'title_id' => 'my-accessible-attribute',
        ]);

        $this->assertStringContainsString('aria-labelledby="my-accessible-attribute"', $svg);
        $this->assertStringContainsString('<title id="my-accessible-attribute">', $svg);
    }

    /**
     * @dataProvider icons
     */
    public function test_it_can_change_role($icon): void
    {
        $fa = $this->createInstance();

        $svg = $fa->get_svg($icon, ['role' => 'presentation']);

        $this->assertStringContainsString('role="presentation"', $svg);
    }

    /**
     * @dataProvider icons
     */
    public function test_it_can_add_aria_labels($icon): void
    {
        $fa = $this->createInstance();

        $svg = $fa->get_svg($icon, ['aria-label' => 'File']);

        $this->assertStringContainsString('aria-label="File"', $svg);
    }

    public function test_it_can_change_duotone_colors(): void
    {
        $fa = $this->createInstance();

        $svg = $fa->get_svg('fad fa-calculator', [
            'primary' => [
                'fill'    => '#e64980',
                'opacity' => '.1',
            ],
            'secondary' => [
                'fill'    => '#fcc417',
                'opacity' => '.2',
            ],
        ]);

        $this->assertStringContainsString('--fa-primary-color:#e64980', $svg);
        $this->assertStringContainsString('--fa-secondary-color:#fcc417', $svg);
        $this->assertStringContainsString('--fa-primary-opacity:.1', $svg);
        $this->assertStringContainsString('--fa-secondary-opacity:.2', $svg);
        $this->assertStringContainsString('fill="#e64980"', $svg);
        $this->assertStringContainsString('fill="#fcc417"', $svg);
        $this->assertStringContainsString('opacity=".1"', $svg);
        $this->assertStringContainsString('opacity=".2"', $svg);
    }

    public function test_it_can_remove_duotone_inline_styles(): void
    {
        $fa = $this->createInstance();

        $svg = $fa->get_svg('fad fa-calculator', [
            'inline_style' => false,
        ]);

        $this->assertStringNotContainsString('--fa-primary-color', $svg);
        $this->assertStringNotContainsString('--fa-primary-opacity', $svg);
        $this->assertStringNotContainsString('--fa-secondary-color', $svg);
        $this->assertStringNotContainsString('--fa-secondary-opacity', $svg);
    }
}
