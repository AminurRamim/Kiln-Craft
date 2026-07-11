<?php
/**
 * Kiln & Craft — Creative Arts & Maker Community Hub
 * Data source (arrays) + reusable helper functions.
 * All member and event data lives here so every page pulls from one place.
 */

/**
 * Returns the full list of community members.
 * Each member: id, name, discipline, bio, initials, projects[]
 */
function get_members(): array {
    return [
        [
            'id' => 1,
            'name' => 'Maya Chen',
            'discipline' => 'Illustration',
            'initials' => 'MC',
            'bio' => 'Maya draws ink-and-gouache portraits inspired by Chinatown storefronts. She teaches a Saturday sketch walk every month.',
            'projects' => [
                ['title' => 'Storefront Series No. 4',
                    'pictures' => [
                        'storefront-no4.jpg'
                    ]
                ],
                ['title' => 'Night Market Sketchbook',
                    'pictures' => [
                        'nightmarket-sketch1.jpg',
                        'nightmarket-sketch2.jpg'
                    ]
                ],
            ],
        ],
        [
            'id' => 2,
            'name' => 'Jordan Oduya',
            'discipline' => 'Photography',
            'initials' => 'JO',
            'bio' => 'Jordan shoots medium-format film around old industrial buildings, chasing the light before it changes.',
            'projects' => [
                ['title' => 'Foundry Light',
                    'pictures' => ['foundry-light.jpg']
                ],
                ['title' => 'Rooftop Water Towers',
                    'pictures' => [
                        'rooftop-water-tower1.jpg',
                        'rooftop-water-tower2.jpg'
                    ]
                ],
            ],
        ],
        [
            'id' => 3,
            'name' => 'Elena Petrova',
            'discipline' => 'Ceramics',
            'initials' => 'EP',
            'bio' => 'Elena throws stoneware on a kick wheel and finishes every piece with a hand-mixed ash glaze.',
            'projects' => [
                ['title' => 'Ash-Glaze Tea Set',
                    'pictures' => [
                         'pottery1.jpg',
                         'pottery2.jpg'
                    ]
                ],
                ['title' => 'Coiled Vessel Study',
                    'pictures' => [
                        'pottery3.jpg',
                        'pottery4.jpg'
                    ]
                ],
            ],
        ],
        [
            'id' => 4,
            'name' => 'Sam Whitfield',
            'discipline' => 'Printmaking',
            'initials' => 'SW',
            'bio' => 'Sam carves linocuts of neighborhood corner stores, printing small runs on a hand press.',
            'projects' => [
                ['title' => 'Corner Store Linocuts',
                    'pictures' => [
                        'linocut1.jpg',
                        'linocut2.jpg'
                    ]
                ],
                ['title' => 'Rainy Day Reduction Print',
                    'pictures' => [
                        'rainy-day-reduction-print.jpg'
                    ]
                ],
            ],
        ],
        [
            'id' => 5,
            'name' => 'Priya Anand',
            'discipline' => 'Weaving',
            'initials' => 'PA',
            'bio' => 'Priya weaves floor looms with hand-dyed wool, working in patterns passed down from her grandmother.',
            'projects' => [
                ['title' => 'Indigo Runner',
                    'pictures' => [
                         'weaving1.jpg'
                    ]
                ],
                ['title' => 'Grandmother\'s Pattern, Reworked',
                     'pictures' => [
                            'weaving2.jpg',
                            'weaving3.jpg'
                      ]
                ],
            ],
        ],
        [
            'id' => 6,
            'name' => 'Marcus Boone',
            'discipline' => 'Woodworking',
            'initials' => 'MB',
            'bio' => 'Marcus builds joined furniture without nails, favoring reclaimed oak and hand-cut dovetails.',
            'projects' => [
                ['title' => 'Reclaimed Oak Bench',
                    'pictures' => [
                        'woodworking1.jpg',
                        'woodworking2.jpg'
                    ]
                ],
                ['title' => 'Dovetail Keepsake Box',
                    'pictures' => [
                        'woodworking3.jpg',
                        'woodworking4.jpg'
                    ]
                ],
            ],
        ],
    ];
}

/**
 * Returns the full list of upcoming workshops/events.
 * Each event: title, date (Y-m-d), discipline, description
 */
function get_events(): array {
    return [
        [
            'title' => 'Intro to Wheel Throwing',
            'date' => '2026-07-22',
            'discipline' => 'Ceramics',
            'description' => 'A hands-on evening at the kick wheel. Clay and firing included, no experience needed.',
        ],
        [
            'title' => 'Linocut Carving Basics',
            'date' => '2026-07-15',
            'discipline' => 'Printmaking',
            'description' => 'Carve and pull your first print on the hand press. Small groups, all tools provided.',
        ],
        [
            'title' => 'Film Photography Walk',
            'date' => '2026-08-02',
            'discipline' => 'Photography',
            'description' => 'A guided walk through the old foundry district, shooting medium-format film.',
        ],
        [
            'title' => 'Floor Loom Fundamentals',
            'date' => '2026-07-29',
            'discipline' => 'Weaving',
            'description' => 'Warp your first loom and weave a small sampler to take home.',
        ],
        [
            'title' => 'Hand-Cut Dovetail Joints',
            'date' => '2026-08-09',
            'discipline' => 'Woodworking',
            'description' => 'Learn to cut a dovetail joint by hand, the way furniture used to be built.',
        ],
    ];
}

/**
 * Finds a single member by numeric id. Returns null when no match exists.
 */
function find_member(int $id, array $members): ?array {
    $found = array_filter($members, fn($m) => $m['id'] === $id);
    return $found ? array_values($found)[0] : null;
}

/**
 * Flattens every member's projects into one list for the gallery page,
 * tagging each project with its maker's name and discipline.
 */
function get_all_projects(array $members): array {
    $projects = [];
    foreach ($members as $m) {
        foreach ($m['projects'] as $p) {
            $p['member_id'] = $m['id'];
            $p['member_name'] = $m['name'];
            $p['discipline'] = $m['discipline'];
            $projects[] = $p;
        }
    }
    return $projects;
}

/**
 * Trims and escapes user input in one step, used on every $_POST/$_GET value
 * before it is stored or displayed.
 */
function clean(?string $value): string {
    return htmlspecialchars(trim($value ?? ''), ENT_QUOTES, 'UTF-8');
}

/**
 * Turns "Woodworking" into "woodworking" for use in CSS class names.
 */
function slug(string $text): string {
    return strtolower(str_replace(' ', '-', $text));
}

/**
 * Shortens a string to a max length, adding an ellipsis if it was cut.
 * Plain substr() is used instead of the mbstring extension so this
 * works even on servers where mbstring isn't enabled.
 */
function truncate(string $text, int $length = 90): string {
    if (strlen($text) <= $length) {
        return $text;
    }
    return rtrim(substr($text, 0, $length)) . '…';
}
