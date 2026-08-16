<?php

namespace App\Support;

class ContentTemplates
{
    /**
     * Default section templates for a new service page.
     *
     * @return list<array{key:string,label:string,sort_order:int,data:array}>
     */
    public static function servicePageSections(): array
    {
        return self::servicePageSectionsForTheme('digital-marketing');
    }

    /**
     * Theme-aware starter sections for new service / sub-service pages.
     *
     * @return list<array{key:string,label:string,sort_order:int,data:array}>
     */
    public static function servicePageSectionsForTheme(string $theme): array
    {
        $base = self::digitalMarketingSectionTemplates();

        if ($theme === 'seo-service') {
            return array_values(array_filter(
                array_merge(
                    array_filter($base, fn ($s) => ! in_array($s['key'], ['trust', 'playbook', 'platforms'], true)),
                    [
                        self::sectionTemplate('included', 'What\'s included', 3, [
                            'eyebrow' => 'Deliverables',
                            'title' => 'What\'s included',
                            'title_html' => '',
                            'lede' => '',
                            'cards' => [
                                ['title' => 'Deliverable', 'body' => 'Description', 'icon_key' => 'onpage'],
                            ],
                        ]),
                        self::sectionTemplate('compare', 'Compare', 5, [
                            'eyebrow' => 'Compare',
                            'title' => 'Us vs others',
                            'title_html' => '',
                            'lede' => '',
                            'columns' => [
                                [
                                    'title' => 'Typical agency',
                                    'subtitle' => '',
                                    'items' => [['mark' => 'x', 'text' => 'Generic approach']],
                                ],
                                [
                                    'title' => 'KodRank',
                                    'subtitle' => '',
                                    'items' => [['mark' => 'v', 'text' => 'Senior-led strategy']],
                                ],
                            ],
                        ]),
                    ]
                ),
                fn ($s) => true
            ));
        }

        if ($theme === 'web-development') {
            return [
                self::sectionTemplate('hero', 'Hero', 0, $base[0]['data']),
                self::sectionTemplate('pain', 'Pain points', 1, [
                    'eyebrow' => 'The problem',
                    'title' => 'What hurts',
                    'lede' => '',
                    'cards' => [['title' => 'Pain', 'body' => 'Description', 'icon_key' => 'clock']],
                ]),
                self::sectionTemplate('services', 'Services', 2, $base[3]['data'] ?? [
                    'eyebrow' => 'What We Do',
                    'title' => 'Our services',
                    'lede' => '',
                    'cards' => [],
                ]),
                self::sectionTemplate('process', 'Process', 3, $base[4]['data'] ?? [
                    'eyebrow' => 'Process',
                    'title' => 'How we work',
                    'steps' => [],
                ]),
                self::sectionTemplate('faq', 'FAQ', 4, [
                    'eyebrow' => 'FAQ',
                    'title' => 'Questions',
                    'items' => [['q' => 'Sample?', 'a' => 'Answer.']],
                ]),
                self::sectionTemplate('cta', 'CTA', 5, [
                    'title' => 'Ready to start?',
                    'body' => '',
                    'cta_text' => 'Contact us',
                    'cta_url' => '#contact',
                ]),
                self::sectionTemplate('contact', 'Contact', 6, $base[count($base) - 1]['data'] ?? [
                    'title' => 'Contact',
                    'service_options' => ['General inquiry'],
                ]),
            ];
        }

        if ($theme === 'about') {
            return [
                self::sectionTemplate('hero', 'Hero', 0, [
                    'eyebrow' => 'About KodRank',
                    'title' => 'About us title',
                    'title_html' => '',
                    'lede' => '',
                    'image' => 'media/about/kodrank-hero-team.jpg',
                    'image_alt' => 'KodRank team',
                    'stats' => [
                        ['num' => '0+', 'label' => 'Stat'],
                    ],
                ]),
                self::sectionTemplate('why_exist', 'Why we exist', 1, [
                    'eyebrow' => 'Why we exist',
                    'title' => 'Why KodRank exists',
                    'lede' => '',
                    'columns' => [
                        ['tag' => 'Typical agency', 'title' => 'Agency model', 'items' => [['mark' => 'x', 'text' => 'Item']], 'footer' => ''],
                        ['tag' => 'KodRank', 'title' => 'Our model', 'items' => [['mark' => 'v', 'text' => 'Item']], 'footer' => ''],
                    ],
                ]),
                self::sectionTemplate('values', 'Values', 2, [
                    'eyebrow' => 'Values',
                    'title' => 'What we stand for',
                    'lede' => '',
                    'cards' => [
                        ['title' => 'Value', 'body' => 'Description', 'icon_key' => 'check'],
                    ],
                ]),
                self::sectionTemplate('leadership', 'Leadership', 3, [
                    'eyebrow' => 'Leadership',
                    'title' => 'The team',
                    'lede' => '',
                    'background_image' => 'media/about/kodrank-leadership-bg.jpg',
                    'members' => [
                        [
                            'name' => 'Name',
                            'role' => 'Role',
                            'bio' => 'Bio',
                            'image' => '',
                            'linkedin' => '',
                            'tags' => [],
                        ],
                    ],
                ]),
                self::sectionTemplate('mission', 'Mission', 4, [
                    'eyebrow' => 'Mission',
                    'title' => 'Our mission',
                    'lede' => '',
                    'body' => '',
                ]),
                self::sectionTemplate('cta', 'CTA', 5, [
                    'title' => 'Ready to work together?',
                    'body' => '',
                    'cta_text' => 'Get in touch',
                    'cta_url' => '#contact',
                ]),
                self::sectionTemplate('contact', 'Contact', 6, $base[count($base) - 1]['data'] ?? [
                    'title' => 'Contact',
                    'service_options' => ['General inquiry'],
                ]),
            ];
        }

        if ($theme === 'ai-chatbot') {
            return [
                self::sectionTemplate('hero', 'Hero', 0, [
                    'eyebrow' => 'AI Chatbot Development Services',
                    'title_html' => 'Headline with <span class="hl">accent</span>',
                    'lede_html' => '',
                    'cta_text' => 'Book A Free Strategy Call',
                    'cta_url' => '#contact',
                    'trust' => [
                        ['value' => '24/7', 'label' => 'Always-on support'],
                    ],
                    'chat' => [
                        'avatar' => 'K',
                        'title' => 'KodRank Assistant',
                        'subtitle' => 'Trained on your business',
                        'messages' => [
                            ['role' => 'b', 'text' => 'Hello!'],
                            ['role' => 'u', 'text' => 'Hi there'],
                        ],
                        'input_placeholder' => 'Ask anything…',
                    ],
                ]),
                self::sectionTemplate('problem', 'The real problem', 1, [
                    'eyebrow' => 'The Real Problem',
                    'title_html' => 'Problem headline',
                    'lede' => '',
                    'items' => [['title' => 'Issue', 'body' => 'Description']],
                    'panel' => [
                        'big' => '67%',
                        'title' => 'Stat title',
                        'body' => '',
                        'flip_html' => '',
                    ],
                ]),
                self::sectionTemplate('services', 'What we build', 2, [
                    'eyebrow' => 'What We Build',
                    'title_html' => 'Services headline',
                    'lede' => '',
                    'cards' => [
                        ['icon_key' => 'message', 'title' => 'Service', 'body_html' => '', 'link_text' => 'Learn more', 'link_url' => '#contact'],
                    ],
                ]),
                self::sectionTemplate('why', 'Why KodRank', 3, [
                    'eyebrow' => 'Why KodRank',
                    'title_html' => 'Why headline',
                    'lede' => '',
                    'cards' => [['num' => '01', 'title' => 'Reason', 'body_html' => '']],
                ]),
                self::sectionTemplate('stats', 'Stats', 4, [
                    'eyebrow' => 'Stats',
                    'title' => 'Stats headline',
                    'items' => [['value' => '24/7', 'label' => 'Label', 'highlight' => true]],
                    'note' => '',
                ]),
                self::sectionTemplate('process', 'Process', 5, [
                    'eyebrow' => 'How We Work',
                    'title_html' => 'Process headline',
                    'lede' => '',
                    'steps' => [['num' => '1', 'title' => 'Step', 'body' => '']],
                ]),
                self::sectionTemplate('compare', 'Comparison', 6, [
                    'eyebrow' => 'Compare',
                    'title_html' => 'Compare headline',
                    'lede' => '',
                    'bad' => ['tag' => 'Typical', 'title' => 'Bad', 'items' => ['Item']],
                    'good' => ['tag' => 'KodRank', 'title' => 'Good', 'items' => ['Item']],
                ]),
                self::sectionTemplate('tech', 'Technology', 7, [
                    'eyebrow' => 'Under The Hood',
                    'title_html' => 'Tech headline',
                    'lede' => '',
                    'items' => [['title' => 'Capability', 'body' => '']],
                    'chips' => ['Claude', 'GPT-4o'],
                ]),
                self::sectionTemplate('testimonials', 'Testimonials', 8, [
                    'eyebrow' => 'Client Words',
                    'title_html' => 'Testimonials headline',
                    'cards' => [
                        ['quote' => '', 'initials' => 'AB', 'name' => 'Name', 'role' => 'Role'],
                    ],
                ]),
                self::sectionTemplate('faq', 'FAQ', 9, [
                    'eyebrow' => 'Answers',
                    'title_html' => 'FAQ headline',
                    'lede' => '',
                    'items' => [['q' => 'Question?', 'a' => 'Answer.']],
                ]),
                self::sectionTemplate('cta', 'Final CTA', 10, [
                    'eyebrow' => "Let's Build It",
                    'title_html' => 'CTA headline',
                    'body' => '',
                    'cta_text' => 'Book A Free Strategy Call',
                    'cta_url' => '#contact',
                    'cta2_text' => 'Explore Our Services',
                    'cta2_url' => '#services',
                ]),
                self::sectionTemplate('contact', 'Contact', 11, [
                    'eyebrow' => 'Get A Quote',
                    'title' => 'Contact headline',
                    'lede' => '',
                    'meta' => [
                        ['label' => 'Email us', 'value' => 'info@kodrank.com', 'icon_key' => 'mail'],
                    ],
                    'fields' => [
                        'name_label' => 'Your name',
                        'email_label' => 'Work email',
                        'company_label' => 'Company',
                        'service_label' => 'Chatbot type',
                        'message_label' => 'What should your chatbot do?',
                    ],
                    'service_options' => ['Customer support bot', 'Not sure yet'],
                    'default_service' => 'Customer support bot',
                    'submit_text' => 'Get My Free Quote',
                    'disclaimer' => "No commitment. We'll never share your details.",
                ]),
            ];
        }

        return $base;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array{key:string,label:string,sort_order:int,data:array}
     */
    private static function sectionTemplate(string $key, string $label, int $sort, array $data): array
    {
        return [
            'key' => $key,
            'label' => $label,
            'sort_order' => $sort,
            'data' => $data,
        ];
    }

    /**
     * @return list<array{key:string,label:string,sort_order:int,data:array}>
     */
    private static function digitalMarketingSectionTemplates(): array
    {
        return [
            [
                'key' => 'hero',
                'label' => 'Hero',
                'sort_order' => 0,
                'data' => [
                    'eyebrow' => '',
                    'title' => 'New service page title',
                    'title_html' => '',
                    'lede' => 'Short supporting text for this service.',
                    'cta_text' => 'Get A Free Proposal',
                    'cta_url' => '#contact',
                    'image' => 'media/services/digital-marketing/hero.png',
                    'image_alt' => 'Service hero image',
                    'visual_aria_label' => 'Service hero visual',
                    'breadcrumb' => [
                        ['label' => 'Home', 'url' => '/'],
                        ['label' => 'Services', 'url' => '#'],
                        ['label' => 'New Service', 'url' => ''],
                    ],
                    'badges' => [
                        ['num' => '0+', 'label' => 'Projects'],
                    ],
                ],
            ],
            [
                'key' => 'trust',
                'label' => 'Trust bar',
                'sort_order' => 1,
                'data' => [
                    'label' => 'Trusted by growth teams at',
                    'logos' => ['Client One', 'Client Two'],
                ],
            ],
            [
                'key' => 'problem',
                'label' => 'Problem',
                'sort_order' => 2,
                'data' => [
                    'eyebrow' => 'The Problem',
                    'title' => 'What is going wrong',
                    'title_html' => '',
                    'lede' => 'Describe the pain points.',
                    'cards' => [
                        ['title' => 'Card title', 'body' => 'Card body text', 'icon_key' => 'clock'],
                    ],
                ],
            ],
            [
                'key' => 'services',
                'label' => 'Services',
                'sort_order' => 3,
                'data' => [
                    'eyebrow' => 'What We Do',
                    'title' => 'Our services',
                    'lede' => 'List the offerings on this page.',
                    'cards' => [
                        [
                            'title' => 'Service name',
                            'body' => 'Service description',
                            'link_text' => 'Learn more',
                            'link_url' => '#contact',
                            'icon_key' => 'search',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'process',
                'label' => 'Process',
                'sort_order' => 4,
                'data' => [
                    'eyebrow' => 'Process',
                    'title' => 'How we work',
                    'lede' => '',
                    'steps' => [
                        ['num' => '01', 'title' => 'Discover', 'body' => 'Step description'],
                    ],
                ],
            ],
            [
                'key' => 'faq',
                'label' => 'FAQ',
                'sort_order' => 5,
                'data' => [
                    'eyebrow' => 'Common Questions',
                    'title' => 'FAQ',
                    'lede' => '',
                    'items' => [
                        ['q' => 'Sample question?', 'a' => 'Sample answer.'],
                    ],
                ],
            ],
            [
                'key' => 'cta',
                'label' => 'CTA band',
                'sort_order' => 6,
                'data' => [
                    'title' => 'Ready to get started?',
                    'body' => 'Talk to our team.',
                    'cta_text' => 'Contact us',
                    'cta_url' => '#contact',
                ],
            ],
            [
                'key' => 'contact',
                'label' => 'Contact',
                'sort_order' => 7,
                'data' => [
                    'eyebrow' => 'Get In Touch',
                    'title' => 'Tell us about your project',
                    'lede' => '',
                    'meta' => [
                        ['label' => 'Email', 'value' => 'info@kodrank.com', 'icon_key' => 'email'],
                        ['label' => 'Phone', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
                    ],
                    'fields' => [
                        'first_name_label' => 'First Name',
                        'last_name_label' => 'Last Name',
                        'email_label' => 'Work Email',
                        'phone_label' => 'Phone (Optional)',
                        'company_label' => 'Company',
                        'service_label' => 'Service Needed',
                        'message_label' => 'Message',
                        'submit_text' => 'Send Message',
                    ],
                    'service_options' => ['General inquiry'],
                ],
            ],
        ];
    }

    /**
     * Templates when adding a single section to an existing page.
     *
     * @return array<string, array{label:string,data:array}>
     */
    public static function sectionTypes(): array
    {
        $map = [];
        foreach (self::digitalMarketingSectionTemplates() as $section) {
            $map[$section['key']] = [
                'label' => $section['label'],
                'data' => $section['data'],
            ];
        }

        $map['custom'] = [
            'label' => 'Custom (blank)',
            'data' => [
                'title' => '',
                'lede' => '',
                'items' => [
                    ['title' => '', 'body' => ''],
                ],
            ],
        ];

        $map['cards'] = [
            'label' => 'Cards grid',
            'data' => [
                'eyebrow' => '',
                'title' => '',
                'lede' => '',
                'cards' => [
                    ['title' => 'Card 1', 'body' => 'Description', 'link_text' => '', 'link_url' => '#'],
                ],
            ],
        ];

        $map['playbook'] = [
            'label' => 'Playbook',
            'data' => [
                'eyebrow' => '',
                'title' => '',
                'lede' => '',
                'cards' => [
                    [
                        'title' => '',
                        'body' => '',
                        'bullets' => [''],
                        'link_text' => '',
                        'link_url' => '#',
                        'icon_key' => 'b2b',
                    ],
                ],
            ],
        ];

        $map['stats'] = [
            'label' => 'Stats',
            'data' => [
                'eyebrow' => '',
                'title' => '',
                'lede' => '',
                'items' => [
                    ['value' => '0+', 'label' => 'Metric', 'signal' => true],
                ],
            ],
        ];

        $map['included'] = [
            'label' => 'What\'s included',
            'data' => [
                'eyebrow' => '',
                'title' => '',
                'title_html' => '',
                'lede' => '',
                'cards' => [
                    [
                        'title' => '',
                        'body' => '',
                        'icon_key' => 'onpage',
                    ],
                ],
            ],
        ];

        $map['compare'] = [
            'label' => 'Compare',
            'data' => [
                'eyebrow' => '',
                'title' => '',
                'title_html' => '',
                'lede' => '',
                'columns' => [
                    [
                        'title' => 'Option A',
                        'subtitle' => '',
                        'items' => [
                            ['mark' => 'x', 'text' => ''],
                        ],
                    ],
                    [
                        'title' => 'Option B',
                        'subtitle' => '',
                        'items' => [
                            ['mark' => 'v', 'text' => ''],
                        ],
                    ],
                ],
            ],
        ];

        $map['platforms'] = [
            'label' => 'Comparison',
            'data' => [
                'eyebrow' => '',
                'title' => '',
                'lede' => '',
                'columns' => [
                    [
                        'title' => 'Option A',
                        'variant' => 'muted',
                        'items' => [
                            ['mark' => 'x', 'text' => ''],
                        ],
                    ],
                    [
                        'title' => 'Option B',
                        'variant' => 'pro',
                        'items' => [
                            ['mark' => 'v', 'text' => ''],
                        ],
                    ],
                ],
            ],
        ];

        $map['why_us'] = [
            'label' => 'Why us',
            'data' => [
                'eyebrow' => '',
                'title' => '',
                'lede' => '',
                'cards' => [
                    [
                        'title' => '',
                        'body' => '',
                        'bullets' => [''],
                        'icon_key' => 'senior',
                    ],
                ],
            ],
        ];

        $map['testimonials'] = [
            'label' => 'Testimonials',
            'data' => [
                'eyebrow' => '',
                'title' => '',
                'lede' => '',
                'items' => [
                    [
                        'quote' => '',
                        'name' => '',
                        'role' => '',
                        'company' => '',
                        'metric' => '',
                    ],
                ],
            ],
        ];

        $map['why_exist'] = [
            'label' => 'Why we exist (compare)',
            'data' => [
                'eyebrow' => '— Why We Exist',
                'title' => '',
                'title_html' => '',
                'lede' => '',
                'columns' => [
                    [
                        'tag' => 'The typical agency',
                        'title' => '',
                        'variant' => 'muted',
                        'items' => [['mark' => 'x', 'text' => '']],
                        'footer' => '',
                    ],
                    [
                        'tag' => 'The KodRank way',
                        'title' => '',
                        'variant' => 'pro',
                        'items' => [['mark' => 'v', 'text' => '']],
                        'footer' => '',
                    ],
                ],
            ],
        ];

        $map['values'] = [
            'label' => 'Values / how we work',
            'data' => [
                'eyebrow' => '',
                'title' => '',
                'lede' => '',
                'cards' => [
                    ['title' => '', 'body' => '', 'icon_key' => 'check'],
                ],
            ],
        ];

        $map['leadership'] = [
            'label' => 'Leadership / team',
            'data' => [
                'eyebrow' => '— Leadership',
                'title' => '',
                'title_html' => '',
                'lede' => '',
                'background_image' => 'media/about/kodrank-leadership-bg.jpg',
                'members' => [
                    [
                        'name' => '',
                        'role' => '',
                        'linkedin' => '',
                        'bio' => '',
                        'tags' => [''],
                        'image' => '',
                        'image_position' => 'center top',
                    ],
                ],
            ],
        ];

        $map['mission'] = [
            'label' => 'Mission / vision',
            'data' => [
                'num' => '01',
                'eyebrow' => '— Our Vision',
                'title' => '',
                'title_html' => '',
                'lede' => '',
                'items' => [
                    ['title' => '', 'body' => ''],
                ],
            ],
        ];

        return $map;
    }

    /**
     * Homepage CmsSection starter templates.
     *
     * @return array<string, array{label:string,data:array}>
     */
    public static function homepageSectionTypes(): array
    {
        return [
            'custom' => [
                'label' => 'Custom block',
                'data' => [
                    'eyebrow' => '',
                    'title' => '',
                    'lede' => '',
                    'items' => [
                        ['title' => '', 'body' => ''],
                    ],
                ],
            ],
            'cards' => [
                'label' => 'Cards',
                'data' => [
                    'eyebrow' => '',
                    'title' => '',
                    'lede' => '',
                    'cards' => [
                        ['title' => '', 'body' => ''],
                    ],
                ],
            ],
            'faq' => [
                'label' => 'FAQ list',
                'data' => [
                    'eyebrow' => 'FAQ',
                    'title' => '',
                    'items' => [
                        ['q' => '', 'a' => ''],
                    ],
                ],
            ],
        ];
    }
}
