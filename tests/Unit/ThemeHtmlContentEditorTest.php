<?php

namespace Tests\Unit;

use App\Support\ThemeHtmlContentEditor;
use PHPUnit\Framework\TestCase;

class ThemeHtmlContentEditorTest extends TestCase
{
    public function test_image_replace_stays_on_the_chosen_picture(): void
    {
        $html = <<<'HTML'
<section id="one"><img src="data:image/png;base64,AAAA" alt="First"></section>
<section id="two"><div class="sbg" style="background-image:url('/media/keep.jpg')"></div></section>
HTML;

        $next = ThemeHtmlContentEditor::replaceMedia($html, [
            'm0' => ['url' => '/storage/service-media/one.jpg', 'alt' => 'First'],
        ]);

        $this->assertStringContainsString('/storage/service-media/one.jpg', $next);
        $this->assertStringNotContainsString('base64,AAAA', $next);
        $this->assertStringContainsString('/media/keep.jpg', $next);
    }

    public function test_text_edit_does_not_change_another_block(): void
    {
        $html = '<section><h2>Keep this heading</h2><p>Change this sentence.</p></section>';
        $fields = ThemeHtmlContentEditor::fields($html);
        $values = [];
        foreach ($fields as $field) {
            $values[$field['id']] = $field['value'];
        }
        $paragraph = null;
        foreach ($fields as $field) {
            if (str_contains($field['value'], 'Change this')) {
                $paragraph = $field['id'];
            }
        }
        $this->assertNotNull($paragraph);
        $values[$paragraph] = 'Updated sentence.';

        $next = ThemeHtmlContentEditor::apply($html, $values);

        $this->assertStringContainsString('Keep this heading', $next);
        $this->assertStringContainsString('Updated sentence.', $next);
        $this->assertStringNotContainsString('Change this sentence.', $next);
    }
}
