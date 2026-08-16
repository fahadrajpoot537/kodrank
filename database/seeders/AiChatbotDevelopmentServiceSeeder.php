<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use App\Models\ServicePageSection;
use Illuminate\Database\Seeder;

class AiChatbotDevelopmentServiceSeeder extends Seeder
{
    public function run(): void
    {
        $parent = ServicePage::query()
            ->where('slug', 'web-design-and-development-services')
            ->first();

        $page = ServicePage::query()->updateOrCreate(
            ['slug' => 'ai-chatbot-development-services'],
            [
                'parent_id' => $parent?->id,
                'name' => 'AI Chatbot Development Services',
                'is_active' => true,
                'sort_order' => 2,
                'seo' => [
                    'theme' => 'ai-chatbot',
                    'seo_title' => 'AI Chatbot Development Services | Custom Conversational AI That Converts — KodRank',
                    'seo_description' => 'KodRank builds custom, LLM-powered AI chatbots that understand context, hand off to humans cleanly, and turn conversations into customers.',
                    'og_title' => 'AI Chatbot Development Services That Convert — KodRank',
                    'og_description' => 'Custom AI chatbot development that people actually finish conversations with. Understands context, hands off to humans, drives revenue.',
                    'og_image' => 'media/services/ai-chatbot/bg-1.jpg',
                    'keywords' => 'AI Chatbot Development Services, custom chatbot development, conversational AI, LLM chatbot, RAG chatbot, AI chatbot agency',
                    'robots' => 'index, follow',
                    'canonical_url' => '',
                ],
            ]
        );

        $page->sections()->delete();

        $sections = [
            ['key' => 'hero', 'label' => 'Hero', 'sort_order' => 0, 'data' => [
                'eyebrow' => 'AI Chatbot Development Services',
                'title_html' => 'AI Chatbot Development Services That Turn Conversations Into <span class="hl">Customers</span>',
                'lede_html' => 'Most chatbots get abandoned. We build the other kind — <strong>custom AI chatbots that understand context, answer like a person, and hand off to your team the moment it matters.</strong> Support that never sleeps. Leads that don\'t slip away.',
                'cta_text' => 'Book A Free Strategy Call',
                'cta_url' => '#contact',
                'trust' => [
                    ['value' => '24/7', 'label' => 'Always-on support'],
                    ['value' => '4–12 wks', 'label' => 'To go live'],
                    ['value' => '50+', 'label' => 'Languages supported'],
                    ['value' => '1-Day', 'label' => 'Discovery turnaround'],
                ],
                'chat' => [
                    'avatar' => 'K',
                    'title' => 'KodRank Assistant',
                    'subtitle' => 'Trained on your business',
                    'messages' => [
                        ['role' => 'b', 'text' => 'Hey! Looking for something specific, or just browsing? 😊'],
                        ['role' => 'u', 'text' => "Where's my order #4821? It's late."],
                        ['role' => 'b', 'text' => 'Got it — order #4821 shipped Tuesday and is out for delivery today by 6pm. Want me to text you tracking updates?', 'pill' => 'Yes, text me →'],
                    ],
                    'input_placeholder' => 'Ask anything…',
                ],
            ]],

            ['key' => 'problem', 'label' => 'The real problem', 'sort_order' => 1, 'data' => [
                'eyebrow' => 'The Real Problem',
                'title_html' => 'Nobody hates chatbots. They hate <span class="o">bad</span> ones.',
                'lede' => 'You\'ve met them. The bot that loops the same three menu options. The one that can\'t understand a simple question. The dead-end that makes you type "agent" five times. That\'s not automation — that\'s a customer walking out the door.',
                'items' => [
                    ['title' => 'It misunderstands the question', 'body' => 'Rigid, keyword-matching bots break the moment a real person phrases things their own way.'],
                    ['title' => 'The handoff to a human is a mess', 'body' => 'The customer repeats everything, waits in a queue, and loses trust before an agent even says hello.'],
                    ['title' => 'It forgets who you are', 'body' => 'No memory, no order history, no context — so every conversation starts from zero.'],
                ],
                'panel' => [
                    'big' => '67%',
                    'title' => 'of shoppers have quit a purchase after a frustrating chatbot.',
                    'body' => 'Industry research keeps finding the same thing: a clumsy bot doesn\'t just fail once — it costs the sale and damages the relationship. In e-commerce, that shopper doesn\'t wait. They buy somewhere else.',
                    'flip_html' => 'Our whole approach flips that. We build <span class="o">AI chatbot development services</span> around one question: would a real customer actually want to finish this conversation?',
                ],
            ]],

            ['key' => 'services', 'label' => 'What we build', 'sort_order' => 2, 'data' => [
                'eyebrow' => 'What We Build',
                'title_html' => 'AI chatbot development services, tailored to <span class="o">how you make money</span>',
                'lede' => 'Every business needs something different from a chatbot. We scope, design, and engineer each one around a real outcome — more sales, faster support, better-qualified leads — not a generic template you\'ll rip out in six months.',
                'cards' => [
                    [
                        'icon_key' => 'message',
                        'title' => 'Customer Support Bots',
                        'body_html' => 'Resolve the repetitive 80% instantly — order status, returns, FAQs — and <span class="o">escalate the hard 20% to a human with full context</span>. No loops, no dead ends.',
                        'link_text' => 'Get a support bot',
                        'link_url' => '#contact',
                    ],
                    [
                        'icon_key' => 'pulse',
                        'title' => 'Lead-Gen & Sales Bots',
                        'body_html' => 'Qualify visitors in real time, book demos while you sleep, and <span class="o">route hot prospects straight to your sales team</span> — so no good lead ever goes cold in a form.',
                        'link_text' => 'Capture more leads',
                        'link_url' => '#contact',
                    ],
                    [
                        'icon_key' => 'cart',
                        'title' => 'E-commerce Assistants',
                        'body_html' => 'Guide undecided buyers, recommend products, recover abandoned carts, and answer sizing questions on the spot — <span class="o">nudging shoppers toward checkout</span>, not away.',
                        'link_text' => 'Lift your conversions',
                        'link_url' => '#contact',
                    ],
                    [
                        'icon_key' => 'document',
                        'title' => 'RAG Knowledge Assistants',
                        'body_html' => 'Chatbots grounded in <span class="o">your</span> documents, policies, and product data — so answers are accurate and current, not hallucinated from a model\'s general training.',
                        'link_text' => 'Ground it in your data',
                        'link_url' => '#contact',
                    ],
                    [
                        'icon_key' => 'users',
                        'title' => 'Internal & HR Bots',
                        'body_html' => 'Free your team from repetitive questions. Staff get instant answers on leave, policies, IT tickets, and onboarding — <span class="o">without pinging a human every time</span>.',
                        'link_text' => 'Streamline internal ops',
                        'link_url' => '#contact',
                    ],
                    [
                        'icon_key' => 'agent',
                        'title' => 'Agentic AI Chatbots',
                        'body_html' => 'Bots that <span class="o">do</span>, not just talk — issuing refunds, updating your CRM, booking appointments, and completing tasks end to end inside your existing systems.',
                        'link_text' => 'Automate real tasks',
                        'link_url' => '#contact',
                    ],
                ],
            ]],

            ['key' => 'why', 'label' => 'Why KodRank', 'sort_order' => 3, 'data' => [
                'eyebrow' => 'Why KodRank',
                'title_html' => 'What makes our AI chatbot development services <span class="o">different</span>',
                'lede' => 'We\'re a web development and SEO agency first — which means we don\'t just ship a bot and leave. We build conversational AI that fits your site, your funnel, and your brand voice, then keep improving it against real numbers.',
                'cards' => [
                    ['num' => '01', 'title' => 'Built on modern LLMs, not rigid scripts', 'body_html' => 'We use today\'s language models with <span class="o">retrieval from your own data</span>, so the bot handles messy, real-world phrasing instead of breaking on anything off-script.'],
                    ['num' => '02', 'title' => 'Human handoff done right', 'body_html' => 'When a conversation needs a person, the bot passes <span class="o">full context</span> to your team — so customers never repeat themselves and never hit a dead end.'],
                    ['num' => '03', 'title' => 'Designed to convert, not just deflect', 'body_html' => 'Coming from an SEO and CRO background, we tune every flow toward a <span class="o">measurable outcome</span> — a booked call, a recovered cart, a captured lead.'],
                    ['num' => '04', 'title' => 'Deep integration with your stack', 'body_html' => 'Your CRM, helpdesk, e-commerce platform, and internal tools — <span class="o">connected securely</span>, so the bot acts on real data instead of guessing.'],
                    ['num' => '05', 'title' => 'Guardrails against hallucination', 'body_html' => 'Retrieval grounding, tested prompts, and escalation rules keep answers <span class="o">accurate and on-brand</span> — no made-up policies, no costly mistakes.'],
                    ['num' => '06', 'title' => 'We don\'t disappear after launch', 'body_html' => 'We monitor conversations, spot where the bot struggles, and <span class="o">keep training it</span> as your products, policies, and customers evolve.'],
                ],
            ]],

            ['key' => 'stats', 'label' => 'Stats', 'sort_order' => 4, 'data' => [
                'eyebrow' => 'The Case For Doing It Right',
                'title' => 'Good conversational AI pays for itself',
                'items' => [
                    ['value' => '24/7', 'label' => 'Coverage with zero shift costs', 'highlight' => true],
                    ['value' => '1,000s', 'label' => 'Chats handled at once, no queue', 'highlight' => false],
                    ['value' => '<1s', 'label' => 'Average first response time', 'highlight' => true],
                    ['value' => '50+', 'label' => 'Languages, one deployment', 'highlight' => false],
                ],
                'note' => 'Figures reflect typical outcomes for well-built conversational AI. Your real numbers are scoped during discovery.',
            ]],

            ['key' => 'process', 'label' => 'Process', 'sort_order' => 5, 'data' => [
                'eyebrow' => 'How We Work',
                'title_html' => 'Our AI chatbot development <span class="o">process</span>',
                'lede' => 'A clear, five-step path from "we\'re thinking about a chatbot" to a live assistant that earns its keep. No mystery, no scope creep — you\'ll always know exactly where things stand.',
                'steps' => [
                    ['num' => '1', 'title' => 'Discovery', 'body' => 'We map your real customer questions, goals, and systems to find the highest-impact use case to build first.'],
                    ['num' => '2', 'title' => 'Design', 'body' => 'We shape conversation flows, brand voice, edge cases, and — crucially — the moments the bot should hand off to a human.'],
                    ['num' => '3', 'title' => 'Build', 'body' => 'We engineer the bot with the right LLM, RAG retrieval from your data, and secure connections to your CRM and tools.'],
                    ['num' => '4', 'title' => 'Train & Test', 'body' => 'We feed it your knowledge base and stress-test it against tricky, real-world questions before a single customer sees it.'],
                    ['num' => '5', 'title' => 'Launch & Optimize', 'body' => 'We deploy, watch live conversations, and keep refining — so the bot gets sharper the longer it runs.'],
                ],
            ]],

            ['key' => 'compare', 'label' => 'Comparison', 'sort_order' => 6, 'data' => [
                'eyebrow' => 'The Difference Is Obvious',
                'title_html' => 'A typical chatbot vs. a <span class="o">KodRank</span> chatbot',
                'lede' => 'Same idea, opposite experience. One frustrates customers into leaving. The other quietly does its job and makes you money.',
                'bad' => [
                    'tag' => 'The Typical Bot',
                    'title' => 'Deflect-and-hope',
                    'items' => [
                        'Breaks on any question outside its script',
                        'Loops menus instead of answering',
                        'Clunky handoff — customer repeats everything',
                        'No memory of the customer or their history',
                        'Bolted on, ignores your funnel and brand',
                        'Launched once, never improved',
                    ],
                ],
                'good' => [
                    'tag' => 'Built By KodRank',
                    'title' => 'Understand-and-convert',
                    'items' => [
                        'Understands natural, messy human phrasing',
                        'Answers accurately from your own data',
                        'Seamless handoff with full context passed along',
                        'Remembers orders, accounts, and preferences',
                        'Tuned to your conversion goals and voice',
                        'Monitored and retrained continuously',
                    ],
                ],
            ]],

            ['key' => 'tech', 'label' => 'Technology', 'sort_order' => 7, 'data' => [
                'eyebrow' => 'Under The Hood',
                'title_html' => 'Enterprise-grade tech, <span class="o">no jargon on your end</span>',
                'lede' => 'You focus on outcomes. We handle the architecture — choosing the right model, grounding it in your data, and wiring it into the tools you already run every day.',
                'items' => [
                    ['title' => 'Leading LLMs', 'body' => 'We build on top-tier models like Claude, GPT, and Gemini — matched to your accuracy, speed, and budget needs.'],
                    ['title' => 'RAG & vector search', 'body' => 'Retrieval-augmented generation keeps answers grounded in your real documents, not a model\'s guesswork.'],
                    ['title' => 'Secure integrations', 'body' => 'CRM, helpdesk, e-commerce, and internal APIs — connected with proper auth, permissions, and testing.'],
                    ['title' => 'Omnichannel deployment', 'body' => 'Web, mobile, WhatsApp, and more — one assistant, consistent everywhere your customers are.'],
                ],
                'chips' => [
                    'Claude', 'GPT-4o', 'Gemini', 'LangChain', 'Pinecone', 'Weaviate', 'Salesforce',
                    'HubSpot', 'Zendesk', 'Shopify', 'WhatsApp API', 'Twilio', 'Dialogflow', 'Rasa',
                ],
            ]],

            ['key' => 'testimonials', 'label' => 'Testimonials', 'sort_order' => 8, 'data' => [
                'eyebrow' => 'Client Words',
                'title_html' => 'Teams that stopped losing customers to <span class="o">bad bots</span>',
                'cards' => [
                    [
                        'quote' => 'Our old bot did nothing but frustrate people. KodRank rebuilt it around our actual support tickets — now it resolves most chats before they ever reach my team, and the handoffs are clean.',
                        'initials' => 'RM',
                        'name' => 'Rebecca Malik',
                        'role' => 'Head of CX, DTC Retail Brand',
                    ],
                    [
                        'quote' => 'We wanted more qualified demos without hiring more SDRs. Their lead-gen assistant books calls straight into our calendar and only passes on people who actually fit. It paid for itself fast.',
                        'initials' => 'JT',
                        'name' => 'James Tan',
                        'role' => 'Founder, B2B SaaS',
                    ],
                    [
                        'quote' => 'What sold me was that they cared about the details — memory, tone, the moment it should call a human. It doesn\'t feel like a chatbot. It feels like a good employee who never clocks out.',
                        'initials' => 'AO',
                        'name' => 'Amara Okafor',
                        'role' => 'Operations Lead, Services Firm',
                    ],
                ],
            ]],

            ['key' => 'faq', 'label' => 'FAQ', 'sort_order' => 9, 'data' => [
                'eyebrow' => 'Answers',
                'title_html' => 'AI chatbot development services — <span class="o">FAQ</span>',
                'lede' => 'The questions we hear most before a project starts. Don\'t see yours? Ask us on a quick call.',
                'items' => [
                    [
                        'q' => 'What exactly do your AI chatbot development services include?',
                        'a' => 'Everything from strategy to launch and beyond: use-case discovery, conversation design, engineering the bot on the right LLM with RAG retrieval from your data, integrating it with your CRM and tools, training and testing it, deploying across your channels, and monitoring and improving it once it\'s live. You get a working assistant tied to a real business goal — not a demo that gathers dust.',
                    ],
                    [
                        'q' => 'How much does it cost to build a custom AI chatbot?',
                        'a' => 'It depends on complexity. A focused FAQ or lead-qualification bot is a smaller build; an LLM-powered assistant with RAG, several integrations, and omnichannel deployment sits higher. The biggest cost drivers are how many systems you connect, the size of your knowledge base, and any compliance requirements. We scope every project to a fixed, transparent quote after a discovery call — so you never get a year-two billing surprise.',
                    ],
                    [
                        'q' => 'How long does development take?',
                        'a' => 'Most chatbots go live in 4 to 12 weeks. A single-channel support or lead bot lands on the faster end; enterprise projects with many integrations, a large knowledge base, or strict compliance take longer. We\'ll give you a realistic timeline in the discovery phase, not an optimistic one.',
                    ],
                    [
                        'q' => 'Will the chatbot hand off to a human when it can\'t help?',
                        'a' => 'Always. Clean human handoff is non-negotiable in every bot we build. When a conversation needs a person, the bot recognizes it early and passes the full context to your team, so the customer never has to start over. A bot that traps people is a bot that loses them.',
                    ],
                    [
                        'q' => 'How do you stop the AI from making things up?',
                        'a' => 'We ground the chatbot in your own content using retrieval-augmented generation, so it answers from your real documents and data instead of the model\'s general training. Add tested prompts, strict guardrails, and escalation rules, and you get answers that stay accurate and on-brand — not invented policies that create liability.',
                    ],
                    [
                        'q' => 'Can it integrate with our existing tools and website?',
                        'a' => 'Yes. We connect the chatbot to your CRM, helpdesk, e-commerce platform, and internal APIs with proper authentication and testing. Since we\'re a web development agency, dropping it cleanly into your existing site and design system is part of the job, not an afterthought.',
                    ],
                    [
                        'q' => 'What happens after launch?',
                        'a' => 'Launch is the start, not the finish. We monitor real conversations, find where the bot stumbles or where customers drop off, and keep retraining it as your products, policies, and audience change. A chatbot that isn\'t maintained slowly drifts out of date — ours don\'t.',
                    ],
                ],
            ]],

            ['key' => 'cta', 'label' => 'Final CTA', 'sort_order' => 10, 'data' => [
                'eyebrow' => "Let's Build It",
                'title_html' => 'Ready for a chatbot people actually <span class="o">want to talk to?</span>',
                'body' => 'Tell us what you\'re trying to fix — slow support, leaking leads, an overworked team — and we\'ll show you exactly how a custom AI chatbot solves it. No pitch, no pressure.',
                'cta_text' => 'Book A Free Strategy Call',
                'cta_url' => '#contact',
                'cta2_text' => 'Explore Our Services',
                'cta2_url' => '#services',
            ]],

            ['key' => 'contact', 'label' => 'Contact', 'sort_order' => 11, 'data' => [
                'eyebrow' => 'Get A Quote',
                'title' => 'Start with a free strategy call',
                'lede' => 'Tell us a little about your business and what you want your chatbot to do. We\'ll come back with a clear plan and a fixed quote — usually within one working day.',
                'meta' => [
                    ['label' => 'Email us', 'value' => 'info@kodrank.com', 'icon_key' => 'mail'],
                    ['label' => 'Call us', 'value' => '+92 305 9202732', 'icon_key' => 'phone'],
                    ['label' => 'Response time', 'value' => 'Within 1 business day', 'icon_key' => 'clock'],
                ],
                'fields' => [
                    'name_label' => 'Your name',
                    'name_placeholder' => 'Jane Doe',
                    'email_label' => 'Work email',
                    'email_placeholder' => 'jane@company.com',
                    'company_label' => 'Company',
                    'company_placeholder' => 'Company name',
                    'service_label' => 'Chatbot type',
                    'message_label' => 'What should your chatbot do?',
                    'message_placeholder' => 'e.g. Handle order-status questions and cut our support tickets in half…',
                ],
                'service_options' => [
                    'Customer support bot',
                    'Lead-gen & sales bot',
                    'E-commerce assistant',
                    'RAG knowledge assistant',
                    'Internal / HR bot',
                    'Agentic AI chatbot',
                    'Not sure yet',
                ],
                'default_service' => 'Customer support bot',
                'submit_text' => 'Get My Free Quote',
                'disclaimer' => 'No commitment. We\'ll never share your details.',
            ]],
        ];

        foreach ($sections as $section) {
            ServicePageSection::query()->create([
                'service_page_id' => $page->id,
                'key' => $section['key'],
                'label' => $section['label'],
                'sort_order' => $section['sort_order'],
                'data' => $section['data'],
            ]);
        }

        ServicePage::forgetCache($page->slug);
        ServicePage::forgetNavCache();
    }
}
